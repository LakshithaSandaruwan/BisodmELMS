<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userData = Auth::user();
        if ($userData->user_role == 1) {
            return view('Admin.Dashboard');
        }

        else if ($userData->user_role == 2) {
            return view('Teacher.Dashboard');
        }

        else if ($userData->user_role == 3) {
            return view('Student.Dashboard');
        }

        else{
            return view('welcome');
        }
    }
}
