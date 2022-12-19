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
                    {!! $resource->description !!}
                    <div class="d-flex justify-content-end">
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
