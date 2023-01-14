@extends('layouts.app')

@section('title', 'Обучающие ресурсы|Создать ресурс')

@section('header')
    <div class="col-sm-6">
        <h1 class="m-0 text-dark">Создать ресурс</h1>
    </div>
@endsection

@section('breadcrumbs')
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('resources.show') }}">Обучающие ресурсы</a></li>
            <li class="breadcrumb-item active">Создать ресурс</li>
        </ol>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('resources.create.store') }}" method="post">
                        <div class="form-group">
                            <div class="row">
                                <div class="col-6">
                                    <label for="name">Название ресурса</label>
                                    <input id="name" type="text" name="name" class="form-control" value="{{ old('name') }}">
                                </div>
                                <div class="col-6">
                                    <label for="resource_parts">Основные части</label>
                                    <select name="resource_parts[]" multiple id="resource_parts" class="form-control select2">
                                        <option disabled>Основные части ресурса</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        @csrf
                        <label for="summernote">Содержание</label>
                        <textarea id="summernote" name="description"></textarea>
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-success" type="submit">Сохранить</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('custom-styles')
    <link rel="stylesheet" href="/css/custom-css/tasks/tasks.css">
@endsection

@section('custom-scripts')
    <script>
        $(document).ready(function () {
            $('#summernote').summernote();
            $('#resource_parts').select2({
                tags: true
            });
        });
    </script>
@endsection
