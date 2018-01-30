<?php

namespace App\Http\Controllers;

use App\Http\Requests\SampleRequest;
use Illuminate\Http\Request;

class SampleFormController extends Controller
{
    public function index()
    {
        return view('sample_form');
    }

    public function store(SampleRequest $request)
    {
        // 確認画面で戻るボタンが押された場合
        if ($request->get('_action') === 'back') {
            return redirect()
                ->back()
                ->withInput($request->except(['_action', '_confirm']));
        }
        
        // 何か処理
        \Log::debug($request->except(['_token', '_action', '_confirm']));
        
        // ブラウザリロード等の二重送信防止
        $request->session()->regenerateToken();

        // 完了画面を表示
        return redirect()->back()->with('status', 'success');
    }
}
