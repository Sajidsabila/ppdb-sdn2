<?php

namespace App\Livewire\Frontend;

use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;

class ProfileUser extends Component
{
    public $name, $email, $password;


    public function mount()
    {
        $user = auth()->user();
        if ($user) {
            $this->name = $user->name;
            $this->email = $user->email;
        }
    }

    public function update()
    {
        $user_update = $this->validate([
            'name' => 'required|string|max:255|unique:users,name,' . auth()->id(),
            'email' => 'required|email|unique:users,email,' . auth()->id(),
            'password' => 'nullable|min:5',
        ]);

        try {
            if ($this->password) {
                $user_update['password'] = Hash::make($this->password);
            } else {
                unset($user_update['password']);
            }

            $user = auth()->user();
            $user->update($user_update);
            $user->refresh();

            $this->reset(['password']);
            $this->name = $user->name;
            $this->email = $user->email;


            $this->dispatch(
                'swal',
                type: "success",
                title: "Data Berhasil Diubah",
                position: "center",
            );
        } catch (\Throwable $th) {
            session()->flash('error', 'Terjadi kesalahan: ' . $th->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.frontend.profile-user')
            ->layout('layouts.app');
    }
}
