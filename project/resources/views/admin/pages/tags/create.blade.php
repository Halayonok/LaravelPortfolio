@extends('admin.layouts.base')

@section('content')

    <nav aria-label="breadcrumb" class="shadow">
        <ol class="breadcrumb small bg-white">
            <li class="breadcrumb-item"><a href="{{ route('admin-tags') }}">Теги</a></li>
            <li class="breadcrumb-item active">Добавить тег</li>
        </ol>
    </nav>

    @include('admin.pages.tags._form')

@endsection
