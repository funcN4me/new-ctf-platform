<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TaskController extends Controller
{
    public function show(): View
    {
        $categories = Category::all();

        return view('tasks.show', compact('categories'));
    }
}
