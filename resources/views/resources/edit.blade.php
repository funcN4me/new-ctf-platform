@extends('layouts.app')

@section('title', 'Обучающие ресурсы|' . $resource->name)

@section('header')
    <h1 class="m-0 text-dark">{{ $resource->name }}</h1>
@endsection

@section('breadcrumbs')
    <ol class="breadcrumb float-sm-right">
        <li class="breadcrumb-item"><a href="{{ route('resources.show') }}">Обучающие ресурсы</a></li>
        <li class="breadcrumb-item active">{{ $resource->name }}</li>
    </ol>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('resources.resource.edit.submit', ['resource' => $resource->id]) }}" method="post">
                        <div class="form-group">
                            <label for="name">Название ресурса</label>
                            <input id="name" type="text" name="name" class="form-control" value="{{ $resource->name }}">
                        </div>
                        <div class="form-group">
                            <select name="resource_parts[]" multiple id="resource_parts" class="form-control select2">
                                <option disabled>Основные части ресурса</option>
                            </select>
                        </div>
                        @csrf
                        <textarea id="summernote" name="description">{!! $resource->description !!}</textarea>
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
