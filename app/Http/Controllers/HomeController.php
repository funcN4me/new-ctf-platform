<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Task;
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
        return view('home');
    }

    public function getFavouriteCategories(): array
    {
        $categories = Category::withCount('tasks')->get();

        return $categories->filter(function ($category) {
            return $category->tasks_count > 0;
        })->toArray();
    }

    public function getTasksCountByMonth(): array
    {
        $totalTasksByMonths = [];

        $totalCount = 0;
        $solvedCount = 0;

        foreach (range(1, 12) as $monthNumber) {
            $totalCount += Task::whereYear('created_at', now()->year)->whereMonth('created_at', $monthNumber)->count();
            $solvedCount += DB::table('task_user')->whereYear('created_at', now()->year)->whereMonth('created_at', $monthNumber)->count();

            $totalTasksByMonths[$monthNumber]['totalTasksCount'] = $totalCount;
            $totalTasksByMonths[$monthNumber]['userTasksCount'] = $solvedCount;
        }

        return $totalTasksByMonths;
    }
}
