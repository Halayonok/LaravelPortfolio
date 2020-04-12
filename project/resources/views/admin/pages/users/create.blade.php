@extends('admin.layouts.base')

@section('content')
    <nav aria-label="breadcrumb" class="shadow">
        <ol class="breadcrumb small bg-white">
            <li class="breadcrumb-item"><a href="{{ route('admin-users') }}">Персонал</a></li>
            <li class="breadcrumb-item active">Создать</li>
        </ol>
    </nav>

    @include('admin.pages.users._form')
@endsection
