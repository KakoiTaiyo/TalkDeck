<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth; 

use App\Models\User; 
use Gemini\Laravel\Facades\Gemini;

class GeminiController extends Controller
{
    /**
    * chat
    *
    * @param  Request  $request
    */
    public function show(Request $request)
    {
        // フォームから送信されたIDを取得
        $id = $request->input('id');

        // IDを使ってデータベースからユーザ情報を取得
        $selectedUser = User::find($id);
        if (!$selectedUser) {
            return redirect()->back()->withErrors(['ユーザが見つかりません']);
        }
        // ログインしているユーザの情報を取得
        $loggedInUser = Auth::user();
        if (!$loggedInUser) {
            return redirect()->back()->withErrors(['ログインしていません']);
        }


        $data1 = $selectedUser->answer_content ?? 'データが見つかりませんでした';
        $data2 = $loggedInUser->answer_content ?? 'データが見つかりませんでした';
        $sentence = '以下は初対面の二人の自己紹介です。トークデッキを作成してください' . $data1 . $data2;

        // .env に設定したAPIキー
        $yourApiKey = getenv('GEMINI_API_KEY');

        $result = Gemini::geminiPro()->generateContent($sentence);        
        $response_text = $result->text(); // Gemini からの応答を取得

        return view('gemini.show', compact('sentence', 'response_text'));
    }
}
