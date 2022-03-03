<?php

namespace App\Http\Livewire\Auth;

use App\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class Register extends Component
{
    use WithFileUploads;

    public $first_name;

    public $last_name;

    public $avator;

    public $username;

    public $email;

    public $password;

    public $password_confirmation;

    public function signIn ()
    {
        return redirect()->to('/login');
    }

    protected $rules = [
        'first_name' => 'required',
        'last_name' => 'required',
        'avator' => 'image|max:1024',
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

        $avator = $this->avator;
        $avator = $this->username.'-'.$avator->extension();

        User::create([
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'avator' => $avator,
            'username' => $this->username,
            'email' => $this->email,
            'password' => $this->password
        ]);

        // Store file in the public folder
        $this->avator->storeAs('public/avators', $avator);
        $this->clearForm();

        $this->dispatchBrowserEvent('alert',
                ['type' => 'success',  'message' => 'Account created successfully!']);

        // $this->clearForm();
        return redirect()->to('/thank-you');
    }

    public function clearForm ()
    {
        $this->first_name = "";

        $this->last_name = "";

        $this->avator = "";

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
