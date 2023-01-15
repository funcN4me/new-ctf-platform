<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\Tasks\StoreTaskRequest;
use App\Http\Services\TasksService;
use App\Models\Action;
use App\Models\Category;
use App\Models\File;
use App\Models\Subcategory;
use App\Models\Task;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class TaskController extends Controller
{
    public function show(): View
    {
        $categories = Category::all();

        return view('tasks.show', compact('categories'));
    }

    public function get(Task $task)
    {
        return view('tasks.modals.task', compact('task'));
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

        $input = TasksService::prepareTaskInput($input);

        $task = Task::create($input);

        if (isset($files)) {
            foreach ($files as $file) {
                File::create([
                    'name' => $file->getClientOriginalName(),
                    'path' => $file->storeAs('public/files/' . $task->id, $file->getClientOriginalName()),
                    'task_id' => $task->id,
                ]);
            }
        }

        return back()->with('message-success', 'Задача успешно создана');
    }

    public function deleteFile(File $file): JsonResponse
    {
        $file->task()->disassociate();

        Storage::delete($file->path);

        $file->delete();

        return response()->json(['message' => 'Файл удалён']);
    }

    public function checkFlag(Task $task, Request $request): RedirectResponse
    {
        $input = $request->input();
        $currentUser = Auth::user();

        if ($task->flag !== $input['flag']) {
            return back()->with('message-danger', 'Флаг не подходит');
        }

        $currentUser->tasks()->attach($task->id);

        $currentUser->actions()->create([
            'type' => Action::ACTION_SOLVED_TASK,
            'target_id' => $task->id,
            'target_name' => $task->name,
        ]);

        return back()->with('message-success', 'Задача решена');
    }

    public function editShow(Task $task): View
    {
        $categories = Category::all();
        $subcategories = Subcategory::all();

        return view('tasks.edit', compact('task', 'categories', 'subcategories'));
    }

    public function edit(Task $task, StoreTaskRequest $request): RedirectResponse
    {
        $input = $request->input();
        $files = $request->file('files');

        $input = TasksService::prepareTaskInput($input);

        $task->update($input);

        if (isset($files)) {
            foreach ($files as $file) {
                File::create([
                    'name' => $file->getClientOriginalName(),
                    'path' => $file->storeAs('public/files/' . $task->id, $file->getClientOriginalName()),
                    'task_id' => $task->id,
                ]);
            }
        }

        return back()->with('message-success', 'Задача обновлена');
    }

    public function deleteShow(Task $task): View
    {
        return view('tasks.modals.delete_task', compact('task'));
    }

    public function delete(Task $task): RedirectResponse
    {
        foreach ($task->files as $file) {
            Storage::delete($file->path);
        }

        $task->delete();

        return back()->with('message-success', 'Задача удалена');
    }
}
