<?php

namespace App\Http\Livewire;

use Livewire\Component;

use Auth;

use App\User;

class Home extends Component
{
    public $receiver;

    public $sender;

    public $meaage;

    public $noChat = false;

    protected $rules = ['message' => 'required'];

    public function startChat ($id)
    {
        $this->noChat = true;
        $this->receiver = $id;
    }

    public function save ()
    {

    }
    public function clearForm ()
    {
        //
    }

    public function render()
    {
        // select current user to chat with
        $receiver = $this->receiver;
        $current = User::find($receiver);

        // select all users
        $users = User::get()->where('id', '!=', Auth::user()->id);

        return view('livewire.home', compact('users', 'current'));
    }
}
