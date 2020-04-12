<?php
/**
 * @var \App\User|null $model
 */
?>

<?php
/**
 * @var \App\Projects $model
 * @var \App\ProjectsScreenshots $screenshot
 * @var \App\Tags[] $tags
 */
?>

<form enctype="multipart/form-data"
      action="{{ isset($model) ? route('admin-users-update', ['id' => $model->id]) : route('admin-users-create') }}"
      method="post">
    @csrf

    <div class="card shadow">
        <div class="card-header py-2">
            <div class="row">
                <div class="col-6 p-0 d-flex align-items-center">
                    <h6 class="m-0 font-weight-bold ">
                        @if(isset($model))
                            Редактировать пользователя
                        @else
                            Новый пользователь
                        @endif
                    </h6>
                </div>

                <div class="col-6 p-0 d-flex align-items-center justify-content-end">
                    @if(isset($model))
                        <a href="{{ route('admin-users-create') }}" class="btn btn-icon-split btn-sm btn-info mr-2">
                            <span class="icon text-white-50">
                            <i class="fas fa-plus-circle"></i>
                            </span>
                            <span class="text">Новый пользователь</span>
                        </a>
                    @endif

                    <button class="btn btn-icon-split btn-sm btn-success" type="submit">
                        <span class="icon text-white-50">
                        <i class="fas fa-save"></i>
                        </span>
                        <span class="text">Сохранить</span>
                    </button>
                </div>
            </div>
        </div>

        <!--Card content-->
        <div class="card-body">
            <div class="row">

                <div class="col-lg-12">

                    <div class="form-group">
                        <div class="label">Имя</div>
                        <input type="text" name="name" class="form-control form-control-sm"
                               value="{{ $model->name ?? old('name') }}">
                    </div>

                    <div class="form-group">
                        <div class="label">Email</div>
                        <input type="text" name="email" class="form-control form-control-sm"
                               value="{{ $model->email ?? old('email') }}">
                    </div>

                    <div class="form-group">
                        <div class="label">Пароль</div>
                        <input type="text" name="password" class="form-control form-control-sm">
                    </div>

                </div>
            </div>
        </div>
    </div>


</form>



