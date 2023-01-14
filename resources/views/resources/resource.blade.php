@extends('layouts.app')

@section('title', 'Обучающие ресурсы|' . $resource->name)

@section('header')
    <div class="col-sm-6">
        <h1 class="m-0 text-dark">{{ $resource->name }}</h1>
    </div>
@endsection

@section('breadcrumbs')
    <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="{{ route('resources.show') }}">Обучающие ресурсы</a></li>
            <li class="breadcrumb-item active">{{ $resource->name }}</li>
        </ol>
    </div>
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    {!! $resource->description !!}
                    <div class="flex-btns justify-content-end mt-3">
                        @if(auth()->user()->isAdmin())
                            <a href="{{ route('resources.resource.edit', ['resource' => $resource->id]) }}" class="btn btn-primary">Перейти в режим редактора</a>
                        @endif
                        @if(!auth()->user()->resources->contains($resource))
                            <a class="btn btn-success" href="{{ route('resources.resource.mark_as_read', ['resource' => $resource->id]) }}">
                                Отметить прочитанным
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('custom-styles')
    <link rel="stylesheet" href="/css/custom-css/tasks/tasks.css">
@endsection
