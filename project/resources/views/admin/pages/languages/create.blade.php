@extends('admin.layouts.base')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb small bg-white">
            <li class="breadcrumb-item"><a href="{{ route('admin-languages') }}">Локализация</a></li>
            <li class="breadcrumb-item active">Добавить язык</li>
        </ol>
    </nav>

    @include('admin.pages.languages._form')
@endsection
