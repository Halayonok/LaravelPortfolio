@extends('admin.layouts.base')

@section('content')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb small bg-white">
            <li class="breadcrumb-item"><a href="{{ route('admin-users') }}">Персонал</a></li>
            <li class="breadcrumb-item active">Создать</li>
        </ol>
    </nav>

    <div class="card">
        <!--Card content-->
        <div class="card-body py-0">
            <div class="row m-0">
                <div class="col-12">
                    @include('admin.pages.users._form')
                </div>
            </div>
        </div>
    </div>
@endsection
