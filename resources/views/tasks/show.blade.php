@extends('layouts.app')

@section('title', 'Задачи')

@section('header')
    <div class="col-12">
        <div class="d-flex justify-content-between">
            <h1 class="m-0 text-dark">
                Задачи
            </h1>
            <select class="select2 form-control col-3 taskCategories" name="tasksCategories" id="tasksCategories">
                <option value="all" selected>Все категории</option>
                @foreach($categories as $category)
                    <option value="{{$category->id}}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        @forelse($categories as $category)
            @if(!$category->tasks->isEmpty())
                <div class="col-12 categoryContainer" data-category-id="{{ $category->id }}">
                    <h3>{{ $category->name }}</h3>
                    <div class="row">
                        @forelse($category->tasks as $task)
                            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                <div class="card task task-card @if(auth()->user()->tasks->contains($task)) card-success @endif" data-task-id="{{ $task->id }}">
                                    <div class="card-header">
                                        <h3 class="card-title w-100 d-flex justify-content-between">
                                            {{ $task->subcategory->name }}
                                            @if(auth()->user()->isAdmin())
                                                <div class="flex-btns">
                                                    <a class="changeTask" href="{{ route('tasks.edit.show', ['task' => $task]) }}">
                                                        <i class="changeTask my-icon-hover nav-icon fas fa-pen"></i>
                                                    </a>
                                                    <i class="deleteTask my-icon-hover nav-icon fas fa-trash" data-task-id="{{ $task->id }}"></i>
                                                </div>
                                            @endif
                                        </h3>
                                    </div>
                                    <div class="card-body">
                                        <p class="card-text">{{ $task->name }}</p>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12">
                                <p>Задачи отсутствуют</p>
                            </div>
                        @endforelse
                    </div>
                </div>
            @endif
        @empty
            <div class="col-12">
                <p>Категории отсутствуют</p>
            </div>
        @endforelse
    </div>
    <div id="taskModal"></div>
    <div id="deleteModal"></div>
@endsection


@section('custom-styles')
    <link rel="stylesheet" href="/css/custom-css/tasks/tasks.css">
@endsection

@section('custom-scripts')
    <script src="/js/custom-scripts/tasks/tasks.js"></script>
@endsection
