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
        $messages = DB::select('select m.id as message_id, u.name as username, m.text as message_text, m.created_at from messages m, users u where m.user_id = u.id order by created_at desc');
        return view('home',['messages'=>$messages]);
    }

    public function ajaxIndex(){
        $messages = DB::select('select m.id as message_id, u.name as username, m.text as message_text, m.created_at from messages m, users u where m.user_id = u.id order by created_at desc');
        return response()->json(['messages'=>$messages]);
    }

    public static function ajaxFromId($id){
        $messages = DB::select('select m.id as message_id, u.name as username, m.text as message_text, m.created_at from messages m, users u where m.user_id = u.id and m.id > '.$id.' order by created_at desc');
        return response()->json(['messages'=>$messages]);
    }

    public static function store(Request $request){
        $res = DB::insert('insert into messages (user_id, text, created_at) values (?, ?, CURRENT_TIME)', [$request->sender_id, $request->message_text]);
        // $res = Message::create(['text' => $request->message_text, 'user_id' => $request->sender_id]);
        return '200';
    }
}
