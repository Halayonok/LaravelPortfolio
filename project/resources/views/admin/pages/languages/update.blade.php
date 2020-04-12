@extends('admin.layouts.base')

@section('content')
    <nav aria-label="breadcrumb" class="shadow">
        <ol class="breadcrumb small bg-white">
            <li class="breadcrumb-item"><a href="{{ route('admin-languages') }}">Локализация</a></li>
            <li class="breadcrumb-item active">Редактировать язык</li>
        </ol>
    </nav>

    @include('admin.pages.languages._form')
@endsection
