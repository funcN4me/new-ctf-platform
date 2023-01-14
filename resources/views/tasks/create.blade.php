@extends('layouts.app')

@section('title', 'Создать задачу')

@section('header')
    <div class="col-sm-6">
        <h1 class="m-0 text-dark">Создать задачу</h1>
    </div>
@endsection

@section('content')
    <div class="row justify-content-center">
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Новая задача</h3>
                </div>
                <form method="POST" action="{{ route('tasks.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Название задачи</label>
                            <input type="text" name="name" class="form-control" id="name" placeholder="Название задачи" value="{{ old('name') }}">
                        </div>
                        <div class="form-group">
                            <label for="category_id">Категория</label>
                            <select class="select2 form-control" name="category_id" id="category_id">
                                @forelse($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @empty
                                    <option value="">Нет категорий</option>
                                @endforelse
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="subcategory_id">Подкатегория</label>
                            <select class="form-control select2" name="subcategory_id" id="subcategory_id">
                                @forelse($subcategories as $subcategory)
                                    <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
                                @empty
                                    <option value="">Нет категорий</option>
                                @endforelse
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="description">Описание задачи</label>
                            <textarea class="form-control" name="description" id="description" rows="3"
                                      placeholder="Описание задачи">{{ old('description') }}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Файлы для задания</label>
                            <div class="col-12">
                                <input type="file" multiple name="files[]" id="exampleInputFile">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="url">Ссылка на задание</label>
                            <input type="url" name="url" class="form-control" id="url" placeholder="https://google.com" value="{{ old('url') }}">
                        </div>
                        <div class="form-group">
                            <label for="flag">Флаг</label>
                            <input type="text" name="flag" class="form-control" id="flag" placeholder="GUMRF{FLAG}" value="{{ old('flag') }}">
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Создать</button>
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

