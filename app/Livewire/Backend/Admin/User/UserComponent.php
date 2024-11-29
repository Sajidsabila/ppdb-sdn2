<?php

namespace App\Livewire\Backend\Admin\User;

use App\Models\User;
use Livewire\Component;

class UserComponent extends Component
{
    public $title = "Data User";
    public $email, $name, $role, $password;
    public $user_id;
    public $search;
    public $isModalOpen = false;

    protected $listeners = [
        'creatUser',
        'updateUser',
        'deleteUser'
    ];
    public function resetFields()
    {
        $this->gallery_id = null;
        $this->email = '';
        $this->name = '';
        $this->role = '';
        $this->password = '';

    }

    public function createUser()
    {
        $this->isModalOpen = true;
        $this->resetFields();
    }

    public function updateUser($user_id)
    {
        $user = User::find($user_id);
        if ($user) {
            $this->user_id = $user->id;
            $this->email = $user->email;
            $this->name = $user->name;
            $this->password = '';
            $this->role = $user->role;
            $this->isModalOpen = true; // Membuka modal
        } else {
            session()->flash('error', 'user tidak ditemukan');
        }

    }

    public function save()
    {
        $this->validate([
            'email' => $this->user_id ? 'nullable|unique:users,email,' . $this->user_id : 'required|unique:users,email',
            'name' => $this->user_id ? 'nullable|unique:users,name,' . $this->user_id : 'required|unique:users,name',
            'password' => $this->user_id ? 'nullable|min:5' : 'required|min:5',
            'role' => 'required'
        ], [
            'required' => ':attribute harus diisi',
            'email' => ':attribute hanya bertipe email',
            'unique' => ':attribute sudah tersedia',
            'min' => ':attribute minimal karakter harus :min karakter'
        ], [
            'email' => 'Email',
            'name' => 'Username',
            'role' => 'Role',
            'password' => 'Password',
        ]);

        try {

            User::updateOrCreate(
                ['id' => $this->user_id],
                [
                    'name' => $this->name,
                    'email' => $this->email,
                    'role' => $this->role,
                    'password' => $this->password ? Hash::make($this->password) : ($this->user_id ? User::find($this->user_id)->password : null),
                    'email_verified_at' => now()
                ]
            );

            $this->resetFields();
            $this->isModalOpen = false;
            session()->flash('success', 'Data Berhasil Disimpan');
        } catch (\Throwable $th) {
            dd("error", "Terjadi Kesalahan: " . $th->getMessage());
        }
    }


    public function deleteUser($user_id)
    {
        try {
            if ($user_id) {
                $user = User::find($user_id);
                if ($user) {
                    $user->delete();
                    session()->flash('success', 'Data Berhasil Dihapus');

                } else {
                    session()->flash('error', "Data Tidak Ditemukan");
                }

            }

        } catch (\Throwable $th) {
            session()->flash('error', "TErjadi Kesalahan : " . $th->getMessage());
        }
    }
    public function render()
    {
        $users = User::paginate(10);
        return view('livewire.backend.admin.user.index', compact('users'))
            ->layout('layouts.app', ['title' => $this->title]);
    }
}
