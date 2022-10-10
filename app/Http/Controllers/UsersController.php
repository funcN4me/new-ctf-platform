<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function list()
    {
        $users = User::all();
        return view('users.list', compact('users'));
    }

    public function profile(User $user)
    {
        return view('users.profile', compact('user'));
    }

    public function delete(User $user)
    {
        $user->delete();
        return redirect()->route('users.list')->with('message-success', 'Пользователь заблокирован');
    }
}
