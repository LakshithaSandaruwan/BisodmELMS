<?php

namespace App\Providers;

use App\Models\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('*', function ($view) {
            if (Auth::check()) {
                $userId = Auth::id();
                $messages = Message::where('to_user', $userId)
                    ->orderBy('created_at', 'desc')
                    ->get();

                $messagesCount = Message::where('to_user', $userId)->where('is_read', false)
                    ->count();

                $view->with('messages', $messages)->with('messagesCount', $messagesCount);
            }
        });
    }
}
