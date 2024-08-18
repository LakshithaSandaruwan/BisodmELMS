<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
{
    //
    public function ViewMessages()
    {
        $userId = Auth::id();
        $messages = Message::where('to_user', $userId)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('Student.AllMessages', compact('messages'));
    }
}
