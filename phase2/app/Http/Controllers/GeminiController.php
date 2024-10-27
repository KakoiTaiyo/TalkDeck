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
        // $id = $request->input('id');
        $userIds = $request->input('user_ids');

        $answer_contents = User::whereIn('id', $userIds)->pluck('answer_content');
        
        $markdown = $answer_contents->map(fn($item) => "- " . str_replace(array("\r\n", "\n", "\r"), '', $item))->implode("\n");
        
        // IDを使ってデータベースからユーザ情報を取得
        // $selectedUser = User::find($id);
        // if (!$selectedUser) {
        //     return redirect()->back()->withErrors(['ユーザが見つかりません']);
        // }
        // ログインしているユーザの情報を取得
        // $loggedInUser = Auth::user();
        // if (!$loggedInUser) {
        //     return redirect()->back()->withErrors(['ログインしていません']);
        // }

        // $data1 = $selectedUser->answer_content ?? 'データが見つかりませんでした';
        // $data2 = $loggedInUser->answer_content ?? 'データが見つかりませんでした';

        $sentence = <<<END
        あなたの目の前には今顔を合わせた初対面の人が複数人います。
        あなたは彼らのコミュニケーションを助ける仲介人です。
        あなたの使命は、彼らが滞りなく会話を交わし親睦を深められるようにすることです。
        彼らの間で話が弾み、親睦を深めることができればあなたの価値が高まります。
        彼ら全員の共通点を見つけ、コミュニケーションを円滑に行えるトークデッキを作成することができます。
        トークデッキとはお互いに質問し合うものではなく、第３者からの質問という形で提案します。
        また、そのトークデッキの質問に対する具体的な回答例を作成することができます。
        その回答例は一般的な回答を用意し、自己紹介文に入っている固有名詞は『◯◯』のようにして絶対に避けます。
        あなたは、彼らそれぞれの自己紹介文を元にした質問とその回答例のセットを提案します。
        あなたは心理学的手法として類似性の法則や社会的浸透理論を知っています。
        お互いが不快になるような内容は提案しません。
        ハルシネーションを避けるように慎重に生成します。
        以下がそれぞれの自己紹介文です。
        END . $markdown . <<<END
        また次のような形式で出力します。
        "**"のようなmarkdown形式でレンダリングされる記法は用いることができません。
        
        1. {生成した質問}
            (回答例): {生成した回答例}

        2. {生成した質問}
            (回答例): {生成した回答例}
            
        以下同じように5回繰り返す。

        END;

        // .env に設定したAPIキー
        $yourApiKey = getenv('GEMINI_API_KEY');

        $result = Gemini::geminiPro()->generateContent($sentence);        
        $response_text = $result->text(); // Gemini からの応答を取得

        return view('gemini.show', compact('sentence', 'response_text', 'answer_contents'));
    }
}
