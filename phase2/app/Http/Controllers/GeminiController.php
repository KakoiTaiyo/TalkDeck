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

        $sentence = 'あなたの目の前には今顔を合わせた初対面の人がいます。
        あなたは初対面の人同士のコミュニケーションを助ける仲介人です。
        あなたの使命は、初対面の人同士が滞りなく会話を交わし親睦を深められるようにすることです。
        初対面の人同士で話が弾み、親睦を深めることができればあなたの価値が高まります。
        あなたは初対面の人同士の共通点を見出し、コミュニケーションを円滑に行えるトークデッキを作成することができます。
        トークデッキとはお互いに質問し合うものではなく、第３者からの質問という形で提案します。
        また、そのトークデッキの質問に対する具体的な回答例を作成することができます。
        その回答例は一般的な回答を用意し、自己紹介文に入っている情報は絶対に含めません。
        特に固有名詞は『◯◯』のようにして自己紹介文に入っているものは避けます。
        あなたは、初対面の人それぞれの自己紹介文を元にした質問とその回答例のセットを提案します。
        あなたは心理学的手法として類似性の法則や社会的浸透理論を知っています。
        お互いが不快になるような内容は提案しません。
        以下がそれぞれの自己紹介文です。
        １人目：' . $data1 . '
        ２人目：' . $data2 . '
        また次のような形式で出力します。
        "**"のようなmarkdown形式でレンダリングされる記法は用いることができません。
        
        1. {生成した質問}
            (回答例)： {生成した回答例}

        2. {生成した質問}
            (回答例)： {生成した回答例}
            
        以下同じように5回繰り返す。

        ';

        // .env に設定したAPIキー
        $yourApiKey = getenv('GEMINI_API_KEY');

        $result = Gemini::geminiPro()->generateContent($sentence);        
        $response_text = $result->text(); // Gemini からの応答を取得

        return view('gemini.show', compact('sentence', 'response_text'));
    }
}
