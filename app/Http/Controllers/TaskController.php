<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Tasks\StoreTaskRequest;
use App\Models\Category;
use App\Models\File;
use App\Models\Subcategory;
use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class TaskController extends Controller
{
    public function show(): View
    {
        $categories = Category::all();

        return view('tasks.show', compact('categories'));
    }

    public function create(): View
    {
        $categories = Category::all();
        $subcategories = Subcategory::all();

        return view('tasks.create', compact('categories', 'subcategories'));
    }

    public function store(StoreTaskRequest $request): RedirectResponse
    {
        $input = $request->input();
        $files = $request->file('files');

        $task = Task::create($input);

        foreach ($files as $file) {
            File::create([
                'name' => $file->getClientOriginalName(),
                'path' => $file->store('files'),
                'task_id' => $task->id,
            ]);
        }

        return back()->with('message-success', 'Задача успешно создана');
    }
}
