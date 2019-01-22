<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Message;

class MessageController extends Controller
{
    //
    protected $messages;

    public function __construct(Auth $auth){

    }

    public function index(){
        $messages = Message::where('user_id',Auth::user()->id)->orderBy('id','desc')->paginate(5);
        return view('dashboard.messages.inbox',compact('messages'));
    }

    public function show(Message $message){
        $messages = Auth::user()->messages->sortByDesc('id');
        $message->update(['read'=> true]);
        return view('dashboard.messages.message',compact('message','messages'));
    }

    public function create(){
        $messages = Auth::user()->messages->sortByDesc('id');
        return view('dashboard.messages.compose',compact('messages'));
    }

    public function store(){

        $validateData = request()->validate([
            'subject' => 'required|min:5|max:50',
            'content' => 'required|min:15|max:300'
        ]);

        $validateData['sender_id'] = Auth::user()->id; //setting the sender as the logged in user
        $validateData['user_id'] = Auth::user()->role = 'customer'||'reseller' ? 1 : 0;

        Message::create($validateData);
        request()->session()->flash('response','message sent successfully');
        return redirect(route('messages'));
    }

    public function reply(Message $message){
        $validateData = request()->validate([
            'subject' => 'required|min:5|max:50','content' => 'required|min:15|max:300'
        ]);
        $validateData['reply'] = $message->id; // id of the message to be replied
        $validateData['user_id'] = $message->sender_id; //sender
        $validateData['sender_id'] = $message->user_id;
        Message::create($validateData);
        request()->session()->flash('response','message sent successfully');
        return redirect(route('messages'));
    }

    public function delete(Message $message){
        $message->delete();
        request()->session()->flash('response','message deleted succesfully');
        return redirect(route('messages'));
    }
}
