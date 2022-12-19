@extends('layouts.app')

@section('title', 'Обучающие ресурсы')

@section('header')
    <h1 class="m-0 text-dark">Обучающие ресурсы</h1>
@endsection

@section('content')
    <div class="row">
        @forelse($resources as $resource)
            <div class="col-12 col-sm-6 col-md-4 col-lg-6">
                <div class="card resource-card @if(auth()->user()->resources->contains($resource)) card-success @endif" data-resource-id="{{ $resource->id }}">
                    <div class="card-header">
                        <h3 class="card-title w-100 d-flex justify-content-between">
                            {{ $resource->name }}
                            @if(auth()->user()->isAdmin())
                                <a href="{{ route('resources.resource.edit', ['resource' => $resource->id]) }}">
                                    <i class="my-icon-hover nav-icon fas fa-pen"></i>
                                </a>
                            @endif
                        </h3>
                    </div>
                    <div class="card-body">
                        {!! Str::limit($resource->description, 100) !!}
                    </div>
                </div>
            </div>
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

@section('custom-scripts')
    <script src="/js/custom-scripts/resources/list.js"></script>
@endsection
