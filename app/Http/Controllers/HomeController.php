<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Action;
use App\Models\Category;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(): \Illuminate\Contracts\Support\Renderable
    {
        $lastActions = Action::orderBy('created_at', 'desc')->limit(5)->get();

        $actions = [];

        foreach ($lastActions as $action) {
            if (isset($action->actionTargetName)) {
                $actions[$action->created_at->format('d.m.Y')][] = $action;
            }
        }

        $users = User::withCount('tasks')->get();

        return view('home', compact('actions', 'users'));
    }

    public function getFavouriteCategories(): array
    {
        $categories = Category::with('tasks')->get();
        $categoriesTasks = collect();
        foreach ($categories as $category) {
            $tasksCount = 0;
            $categoriesTasks->put($category->id, $category);

            foreach ($category->tasks as $task) {
                $tasksCount += $task->users->count();
            }

            $category->tasks_count = $tasksCount;
            $categoriesTasks->put($category->id, $category);
        }

        return $categoriesTasks->filter(function ($category) {
            return $category->tasks_count ? $category : null;
        })->toArray();
    }

    public function getTasksCountByMonth(): array
    {
        $totalTasksByMonths = [];

        $totalCount = 0;

        foreach (range(1, 12) as $monthNumber) {
            $totalCount += Task::whereYear('created_at', now()->year)->whereMonth('created_at', $monthNumber)->count();
            $solvedCount = DB::table('task_user')->whereYear('created_at', now()->year)->whereMonth('created_at', $monthNumber)->count();

            $totalTasksByMonths[$monthNumber]['totalTasksCount'] = $totalCount;
            $totalTasksByMonths[$monthNumber]['userTasksCount'] = $solvedCount;
        }

        return $totalTasksByMonths;
    }
}
