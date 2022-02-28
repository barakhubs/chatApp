<?php

namespace App\Http\Livewire;

use App\Models\Message;
use Livewire\Component;

use Auth;

use App\User;
use App\Models\Thread;

class Home extends Component
{
    public $receiver;

    public $sender;

    public $message;

    public $receiver_id;

    public $noChat = false;

    public $check;

    public $thread;

    public $user;

    protected $rules = ['message' => 'required'];

    public function startChat ($id)
    {
        $this->noChat = true;

        $this->receiver = $id;

        $this->user = Auth::user()->id;

        $get_thread = Thread::where('sender', $user)->where('receiver', $receiver)->first()->id;

        if($get_thread){
            $this->thread = $get_thread;
        }else{
            $this->thread = 0;
        }

    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function sendChat ()
    {
        $this->validate();

        $receiver = $this->receiver;



        }

        $this->clearForm();

    }
    public function clearForm ()
    {
        $this->message = "";
    }

    public function render()
    {
        // select current user to chat with
        $receiver = $this->receiver;

        $current = User::find($receiver);

        // select all users
        $users = User::get()->where('id', '!=', Auth::user()->id);

        // Retrive messages between the two parties

        $check = $this->thread;

        $messages = Message::where('thread', $check)->get();

        return view('livewire.home', compact('users', 'current', 'receiver', 'messages'));
    }
}
