<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Users\StoreUserAvatarRequest;
use App\Http\Requests\Users\StoreUserRequest;
use App\Http\Requests\Users\UpdateUserRequest;
use App\Models\Category;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Carbon;
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
            $actions = [];

            $userActionsDates = $user->actions()->orderBy('created_at')->get()->pluck('created_at');

            foreach ($userActionsDates as $userActionsDate) {
                $actions[$userActionsDate->format('d.m.Y')] = $user->actions()->whereDate('created_at', $userActionsDate)->get();
            }


            return view('users.profile', compact('user', 'actions'));
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

    public function getFavouriteCategories(User $user): array
    {
        $favouriteCategories = collect();
        $categories = Category::all();

        foreach ($categories as $category) {
            $tasksCount = 0;
            $favouriteCategories->put($category->id, $tasksCount);

            foreach ($category->tasks as $task) {
                if ($user->tasks->contains($task)) {
                    $tasksCount += 1;
                }
            }
            $category->tasks_count = $tasksCount;
            $favouriteCategories->put($category->id, $category);
        }

        return $favouriteCategories->filter(function ($category) {
            return $category->tasks_count ? $category : null;
        })->toArray();
    }

    public function getTasksCountByMonth(User $user): array
    {
        $totalTasksByMonths = [];
        $totalCount = 0;
        $userCount = 0;

        foreach (range(1, 12) as $monthNumber) {
            $totalCount += Task::whereYear('created_at', now()->year)->whereMonth('created_at', $monthNumber)->count();
            $userCount = $user->tasks()->wherePivotBetween(
                'created_at', [Carbon::create(now()->year, $monthNumber)->startOfMonth(), Carbon::create(now()->year, $monthNumber)->endOfMonth()])
                ->get()->count();

            $totalTasksByMonths[$monthNumber]['totalTasksCount'] = $totalCount;
            $totalTasksByMonths[$monthNumber]['userTasksCount'] = $userCount;
        }

        return $totalTasksByMonths;
    }
}
