<?php

namespace App\Http\Livewire\Auth;

use App\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class Register extends Component
{
    public $username;

    public $email;

    public $password;

    public $password_confirmation;

    public function signIn ()
    {
        return redirect()->to('/login');
    }

    protected $rules = [
        'username' => 'required|unique:users,username',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6|confirmed'
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function signUp ()
    {
        $validatedData = $this->validate();

        $this->password = Hash::make($this->password);

        User::create([
            'username' => $this->username,
            'email' => $this->email,
            'password' => $this->password
        ]);

        $this->dispatchBrowserEvent('alert',
                ['type' => 'success',  'message' => 'Account created successfully!']);

        // $this->clearForm();
        return redirect()->to('/thank-you');
    }

    public function clearForm ()
    {
        $this->username = "";

        $this->email = "";

        $this->password = "";

        $this->password_confirmation = "";
    }

    public function render()
    {
        return view('livewire.auth.register');
    }
}
