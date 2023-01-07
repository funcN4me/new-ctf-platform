@extends('layouts.app')

@section('title', 'Создать задачу')

@section('header')
    <h1 class="m-0 text-dark">Создать задачу</h1>
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
                            <input type="text" name="name" class="form-control" id="name" placeholder="Название задачи">
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
                                      placeholder="Описание задачи"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">Файл для задания</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" multiple name="files[]" class="custom-file-input" id="exampleInputFile">
                                    <label class="custom-file-label" for="exampleInputFile">Выберите файл</label>
                                </div>
                                <div class="input-group-append">
                                    <span class="input-group-text">Загрузить</span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="url">Ссылка на задание</label>
                            <input type="url" name="url" class="form-control" id="url" placeholder="https://google.com">
                        </div>
                        <div class="form-group">
                            <label for="flag">Флаг</label>
                            <input type="text" name="flag" class="form-control" id="flag" placeholder="GUMRF{FLAG}">
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
