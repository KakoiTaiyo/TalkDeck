<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

use Gemini\Laravel\Facades\Gemini;

class GeminiController extends Controller
{
    /**
    * index
    *
    * @param  Request  $request
    */
    public function index(Request $request)
    {
        return view('index');
    }

    /**
    * chat
    *
    * @param  Request  $request
    */
    public function post(Request $request)
    {
        // // バリデーション
        // $request->validate([
        //     'sentence' => 'required',
        // ]);

        $sentence = "こんにちは";

        // .env に設定したAPIキー
        // .env には GEMINI_API_KEY='' の形式でAPIキーを追加しておきます。
        $yourApiKey = getenv('GEMINI_API_KEY');

        $result = Gemini::geminiPro()->generateContent($sentence);        
        $response_text = $result->text(); // Gemini からの応答を取得

        return view('index', compact('sentence', 'response_text'));
    }
}
