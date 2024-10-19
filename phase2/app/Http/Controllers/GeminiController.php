<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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
        $sentence = "こんにちは";

        // .env に設定したAPIキー
        $yourApiKey = getenv('GEMINI_API_KEY');

        $result = Gemini::geminiPro()->generateContent($sentence);        
        $response_text = $result->text(); // Gemini からの応答を取得

        return view('gemini.show', compact('sentence', 'response_text'));
    }
}
