<?php

namespace App\Livewire;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class UserCreate extends Component
{
    public $name;
    public $email;
    public $password;
    public $alamat;

    public function createUser()
    {
        // Validasi input
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'alamat' => 'required|string|max:255',
        ]);

        // Buat pengguna baru
        $user = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'role' => 3, // Role customer
        ]);

        // Simpan data customer
        Customer::create([
            'nama' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'alamat' => $this->alamat,
        ]);

        // Reset form input setelah pengguna dibuat
        $this->reset();
        
        return redirect()->route('livewire.user.index');
    }

    public function render()
    {
        return view('livewire.create-user');
    }
}
