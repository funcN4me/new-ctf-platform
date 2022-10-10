@extends('layouts.app')

@section('title', 'Задачи')

@section('header')
    <h1 class="m-0 text-dark">Задачи</h1>
@endsection

@section('content')
    <div class="row">
        @forelse($categories as $category)
            @if(!$category->tasks->isEmpty())
                <div class="col-12">
                    <h3>{{ $category->name }}</h3>
                    <div class="row">
                        @forelse($category->tasks as $task)
                            <div class="col-12 col-sm-6 col-md-4 col-lg-3">
                                <div class="card task-card">
                                    <div class="card-header">
                                        <h3 class="card-title">{{ $task->subcategory->name }}</h3>
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
@endsection


@section('custom-styles')
    <link rel="stylesheet" href="/css/custom-css/tasks/tasks.css">
@endsection
