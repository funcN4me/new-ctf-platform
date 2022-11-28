<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Users\StoreUserAvatarRequest;
use App\Http\Requests\Users\StoreUserRequest;
use App\Http\Requests\Users\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class UsersController extends Controller
{
    public function list(): View
    {
        $users = User::all();
        return view('users.list', compact('users'));
    }

    public function profile(User $user)
    {
        if (Auth::user()->isAdmin() || Auth::user()->id === $user->id) {
            return view('users.profile', compact('user'));
        }

        return back()->with('message-danger', 'У вас нет прав для просмотра этой страницы');
    }

    public function store(StoreUserRequest $request): RedirectResponse
    {
        $input = $request->input();
        $input['password'] = bcrypt($input['password']);

        User::create($input);

        return back()->with('message-success', 'Пользователь успешно создан');
    }

    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        $input = $request->input();
        $user->update($input);

        return back()->with('message-success', 'Данные обновлены');
    }

    public function changeUserStatus(User $user): JsonResponse
    {
        $user->update(['is_active' => !$user->is_active]);
        return response()->json(['message' => 'Статус пользователя обновлён.']);
    }

    public function changeAvatar(StoreUserAvatarRequest $request, User $user): RedirectResponse
    {
        $avatar_path = $request->file('avatar')->store('public/avatars/' . $user->id);
        $user->update(['avatar_path' => $avatar_path]);

        return back()->with('message-success', 'Аватар успешно изменен');
    }

    public function deleteAvatar(User $user): RedirectResponse
    {
        $user->update(['avatar_path' => null]);

        return back()->with('message-success', 'Аватар удален');
    }
}
