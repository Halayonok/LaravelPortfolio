@extends('admin.layouts.base')

@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb small bg-white">
            <li class="breadcrumb-item"><a href="{{ route('admin-projects') }}">Проекты</a></li>
            <li class="breadcrumb-item active">Добавить проект</li>
        </ol>
    </nav>

    @include('admin.pages.projects._form')

@endsection
