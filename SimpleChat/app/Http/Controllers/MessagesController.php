<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
class MessagesController extends Controller
{

    public function index(){
        $messages = DB::select('select * from messages');
        $usermam
        return view('home',['messages'=>$messages]);
    }

    public function getUsername($id){
        $user = App\User::find($id);
        return $user->name;
    }

    
}
