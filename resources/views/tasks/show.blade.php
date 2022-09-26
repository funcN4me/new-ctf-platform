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
        <div class="col-3">
            <div class="card card-default">
                <div class="card-header">
                    <h3 class="card-title">
                        <i class="fas fa-exclamation-triangle"></i>
                        Alerts
                    </h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="alert alert-danger alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-ban"></i> Alert!</h5>
                        Danger alert preview. This alert is dismissable. A wonderful serenity has taken possession of my
                        entire
                        soul, like these sweet mornings of spring which I enjoy with my whole heart.
                    </div>
                    <div class="alert alert-info alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-info"></i> Alert!</h5>
                        Info alert preview. This alert is dismissable.
                    </div>
                    <div class="alert alert-warning alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
                        Warning alert preview. This alert is dismissable.
                    </div>
                    <div class="alert alert-success alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <h5><i class="icon fas fa-check"></i> Alert!</h5>
                        Success alert preview. This alert is dismissable.
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
        </div>
    </div>
@endsection


@section('custom-styles')
    <link rel="stylesheet" href="/css/custom-css/tasks/tasks.css">
@endsection
