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

        $sentence = 'あなたの目の前には今顔を合わせた初対面の人がいます。あなたは初対面の人同士のコミュニケーションを助ける仲介人です。
        あなたの使命は、初対面の人同士が滞りなく会話を交わし親睦を深められるようにすることです。
        初対面の人同士で話が弾み、親睦を深めることがあなたの楽しみです。
        あなたは初対面の人同士の共通点を見出し、コミュニケーションを円滑に行えるトークデッキを作成することができます。
        トークデッキとはお互いに質問し合うものではなく、第３者からの質問という形で提案します。
        また、そのトークデッキの質問に対する具体的な回答の例を作成することができます。
        あなたは心理学的手法として類似性の法則や社会的浸透理論を知っています。
        あなたは、初対面の人それぞれの自己紹介文を元にしたトークデッキとその回答例を提案します。
        作成のポイントや心理学的な視点の解説などは要らず、トークデッキとしての質問とその回答例以外は何も提案しません。
        お互いが不快になるような内容は提案しません。
        以下がそれぞれの自己紹介文です。
        ' . $selectedUser->account_name . 'さん：' . $data1 . '
        ' . $loggedInUser->account_name . 'さん：' . $data2 . '
        また次のような形式で出力してください。
        ```
        1. {生成した質問}
            -回答例： {回答例}

        2. {生成した質問}
            -回答例： {回答例}
            
        3. {以下同じように}
        
        ```
        ';

        // .env に設定したAPIキー
        $yourApiKey = getenv('GEMINI_API_KEY');

        $result = Gemini::geminiPro()->generateContent($sentence);        
        $response_text = $result->text(); // Gemini からの応答を取得

        return view('gemini.show', compact('sentence', 'response_text'));
    }
}
