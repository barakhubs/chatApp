<?php

namespace App\Http\Livewire;

use App\Http\Livewire\Auth as LivewireAuth;
use App\Models\Message;
use Livewire\Component;

use Auth;

use App\User;
use App\Models\Thread;

class Home extends Component
{
    public $noChat = false;

    public $receiver;
    public $current_user;
    public $message;
    public $thread;
    public $receiver_id;

    protected $rules = ['message' => 'required'];

    public function startChat($id)
    {
        $this->noChat = true;

        $this->receiver = $id;

        $this->current_user = Auth::user()->id;

    }



    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function sendChat ()
    {
        $this->validate();

        $thread_value = $this->current_user . '-' .$this->receiver;

        if($this->thread = 0){
            Message::create([
                'thread' => $thread_value,
                'message' => $this->message,
                'receiver_id' => $this->receiver,
                'sender_id' => $this->current_user
            ]);
        }else{
            Message::create([
                'thread' => $thread_value,
                'message' => $this->message,
                'receiver_id' => $this->receiver,
                'sender_id' => $this->current_user
            ]);
        }

        $this->clearForm();

    }

    public function clearForm ()
    {
        $this->message = "";
    }

    public function render ()
    {
        // All variables
        $user = Auth::user()->id;
        $receiver = $this->receiver;
        $current = User::find($receiver);
        $users = User::where('id', '!=', $user)->get();

        $messages = Message::where('thread', $user.'-'.$receiver)->orWhere('thread', $receiver.'-'.$user)->get();

        return view('livewire.home', compact('messages', 'users', 'current'));
    }
}
