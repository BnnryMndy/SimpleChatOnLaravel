<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class messages extends Model
{
    use HasFactory;
    protected $fillable = ['messages'];
    $user = App\User::find(1);
    foreach ($user->messages as $message) {
        echo $message->name;
    }

    public function getAjaxMessages(){
       $messagesList = messages::all()->get();
       return response()->json($messagesList);
    }

    public function sendAjaxMessages(Request $request){

    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
