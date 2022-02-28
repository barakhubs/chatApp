<?php

namespace App\Http\Livewire\Auth;

use Livewire\Component;

use Illuminate\Support\Facades\Auth;

class Login extends Component
{
    public $username;

    public $password;

    protected $rules = [
        'username' => 'required',
        'password' => 'required'
    ];

    public function register ()
    {
        return redirect()->to('/register');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function login ()
    {
        $validatedData = $this->validate();

        if(Auth::attempt(array('username' => $this->username, 'password' => $this->password))){
            $this->dispatchBrowserEvent('alert',
                ['type' => 'success',  'message' => 'Logged in successfully!']);
            return redirect()->route('home');
        }else{
            $this->dispatchBrowserEvent('alert',
                ['type' => 'error',  'message' => 'Wrong login credentials!']);
        }
    }
    public function render()
    {
        return view('livewire.auth.login');
    }
}
