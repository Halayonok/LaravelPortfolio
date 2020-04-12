@extends('admin.layouts.base')

@section('content')
    <nav aria-label="breadcrumb" class="shadow">
        <ol class="breadcrumb small bg-white">
            <li class="breadcrumb-item">Система</li>
            <li class="breadcrumb-item active"><a href="{{ route('admin-users') }}">Пользователи</a></li>
        </ol>
    </nav>

    <div class="card shadow">
        <div class="card-header py-2">
            <div class="row">
                <div class="col-6 p-0 d-flex align-items-center">
                    <h6 class="m-0 font-weight-bold ">Пользователи</h6>
                </div>

                <div class="col-6 p-0 d-flex align-items-center justify-content-end">
                    <a href="{{ route('admin-users-create') }}" class="btn btn-icon-split btn-sm btn-info">
                            <span class="icon text-white-50">
                            <i class="fas fa-plus-circle"></i>
                            </span>
                        <span class="text">Новый пользователь</span>
                    </a>
                </div>
            </div>
        </div>

        <!--Card content-->
        <div class="card-body">
            <table class="table table-hover table-bordered table-sm">
                <thead>
                <th>Имя</th>
                <th>Email</th>
                <th></th>
                </thead>
                <tbody>
                @foreach($models as $model)
                    @include('admin.pages.users.parts.index_tr')
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
