<?php
/**
 * @var \App\User|null $model
 */
?>

<form enctype="multipart/form-data"
      action="{{ isset($model) ? route('update-user', ['id' => $model->id]) : route('create-user') }}"
      method="post">
    @csrf

    <div class="row">

        <div class="col-lg-12">
            <div class="form-group text-right">
                <button class="btn btn-sm btn-success" type="submit">Сохранить</button>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="form-group">
                <div class="label">Имя</div>
                <input type="text" name="name" class="form-control" value="{{ $model->name ?? old('name') }}">
            </div>

            <div class="form-group">
                <div class="label">Email</div>
                <input type="text" name="email" class="form-control" value="{{ $model->email ?? old('email') }}">
            </div>

            <div class="form-group">
                <div class="label">Пароль</div>
                <input type="text" name="password" class="form-control">
            </div>
        </div>

    </div>
</form>

