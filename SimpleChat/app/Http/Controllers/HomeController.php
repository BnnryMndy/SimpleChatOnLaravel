<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $messages = DB::select('select u.name as username, m.text as message_text, m.created_at from messages m, users u where m.user_id = u.id order by created_at desc');
        return view('home',['messages'=>$messages]);
    }
}
