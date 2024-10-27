<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\History;

class HistoryController extends Controller
{
    public function saveHistory(Request $request)
    {
       
        $request->validate([
            'content' => 'required|string',
            
        ]);

        // データを保存
        History::create([
            'user_id' => Auth::id(),
            'content' => $request->input('content'),
            'response_text' => $request->input('response_text')
        ]);

         return response()->json(['message' => 'データが保存されました！']);
    }

    public function index()
    {
        $savedHistories = auth()->user()->histories()->latest()->get();
        return view('history.index', compact('savedHistories'));
    }
}
