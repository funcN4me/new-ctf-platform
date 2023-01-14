@extends('layouts.app')

@section('title', 'Изменить задачу')

@section('header')
    <div class="col-sm-6">
        <h1 class="m-0 text-dark">Изменить задачу</h1>
    </div>
@endsection

@section('breadcrumbs')
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('tasks.show') }}">Список задач</a></li>
            <li class="breadcrumb-item active">{{ $task->name }}</li>
        </ol>
    </div>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">{{ $task->name }}</h3>
                </div>
                <form method="POST" action="{{ route('tasks.edit', ['task' => $task->id]) }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Название задачи</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="Название задачи" value="{{ $task->name }}">
                        </div>
                        <div class="form-group">
                            <label for="category_id">Категория</label>
                            <select class="form-control select2" name="category_id" id="category_id">
                                @foreach($categories as $category)
                                    <option @if($task->category->id === $category->id) selected @endif value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="subcategory_id">Подкатегория</label>
                            <select class="form-control select2" name="subcategory_id" id="subcategory_id">
                                @foreach($subcategories as $subcategory)
                                    <option @if($task->subcategory->id === $subcategory->id) selected @endif value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="description">Описание задачи</label>
                            <textarea class="form-control" name="description" id="description" rows="3"
                                      placeholder="Описание задачи">{{ $task->description }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Файлы для задания</label>
                            <div class="col-12">
                                <input type="file" multiple name="files[]" id="exampleInputFile">
                            </div>
                            <div class="col-12">
                                @foreach($task->files as $file)
                                    <a target="_blank" class="btn btn-primary mr-2 mt-3 taskFile" href="{{ $file->downloadUrl }}">
                                        {{ $file->name }}
                                        <button type="button" class="ml-2 close deleteFile" aria-label="Close" data-file-id="{{ $file->id }}">
                                            <span class="text-danger" aria-hidden="true">×</span>
                                        </button>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="url">Ссылка на задание</label>
                            <input type="url" name="url" class="form-control" id="url" placeholder="https://google.com" value="{{ $task->url }}">
                        </div>
                        <div class="form-group">
                            <label for="flag">Флаг</label>
                            <input type="text" name="flag" class="form-control" id="flag" placeholder="GUMRF{FLAG}" value="{{ $task->flag }}">
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Обновить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('custom-styles')
    <link rel="stylesheet" href="/css/custom-css/tasks/tasks.css">
@endsection

@section('custom-scripts')
    <script src="/js/custom-scripts/tasks/tasks.js"></script>
    <script>
        $(document).ready(function () {
            $('#category_id').select2({
                theme: 'bootstrap4',
                tags: true
            });
            $('#subcategory_id').select2({
                theme: 'bootstrap4',
                tags: true
            });
        });
    </script>
@endsection
