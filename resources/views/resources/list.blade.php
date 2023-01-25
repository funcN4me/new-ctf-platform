@extends('layouts.app')

@section('title', 'Обучающие ресурсы')

@section('header')
    <div class="col-12">
        <div class="d-flex justify-content-between">
            <h1 class="m-0 text-dark">Обучающие ресурсы</h1>
            <input type="text" placeholder="Поиск" class="form-control searchResource col-3">
        </div>
    </div>
@endsection

@section('content')
    <div class="row">
        @forelse($resources as $resource)
            <div class="col-12 col-sm-6 col-md-4 col-lg-6">
                <div class="card resource-card @if(auth()->user()->resources->contains($resource)) card-success @endif" data-resource-id="{{ $resource->id }}">
                    <div class="card-header">
                        <h3 class="card-title w-100 d-flex justify-content-between">
                            <p class="h5 resourceName">{{ $resource->name }}</p>
                            @if(auth()->user()->isAdmin())
                                <div class="flex-btns">
                                    <a href="{{ route('resources.resource.edit', ['resource' => $resource->id]) }}">
                                        <i class="my-icon-hover nav-icon fas fa-pen"></i>
                                    </a>
                                    <i class="deleteResource my-icon-hover nav-icon fas fa-trash" data-resource-id="{{ $resource->id }}"></i>
                                </div>
                            @endif
                        </h3>
                    </div>
                    <div class="card-body d-flex justify-content-start align-items-start">
                        <ul>
                            @forelse($resource->parts->take(3) as $part)
                                <li>{{ $part->name }}</li>
                            @empty
                                Пока нет данных
                            @endforelse
                            @if($resource->parts->count() > 3)
                                <li>И др.</li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <p>Обучающие ресурсы отсутствуют</p>
            </div>
        @endforelse
    </div>
    <div id="deleteModal"></div>
@endsection


@section('custom-styles')
    <link rel="stylesheet" href="/css/custom-css/tasks/tasks.css">
@endsection

@section('custom-scripts')
    <script src="/js/custom-scripts/resources/list.js"></script>
@endsection
