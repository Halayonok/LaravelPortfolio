<?php
/**
 * @var \App\Languages $model
 */
?>

<form action="{{ isset($model) ? route('admin-languages-update', ['id' => $model->id]) : route('admin-languages-create') }}" method="POST"
     >

    @csrf

    <div class="card shadow">
        <div class="card-header py-2">
            <div class="row">
                <div class="col-6 p-0 d-flex align-items-center">
                    <h6 class="m-0 font-weight-bold ">
                        @if(isset($model))
                            Редактировать язык
                        @else
                            Новый язык
                        @endif
                    </h6>
                </div>

                <div class="col-6 p-0 d-flex align-items-center justify-content-end">
                    @if(isset($model))
                        <a href="{{ route('admin-languages-create') }}" class="btn btn-icon-split btn-sm btn-info mr-2">
                            <span class="icon text-white-50">
                            <i class="fas fa-plus-circle"></i>
                            </span>
                            <span class="text">Новый язык</span>
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

        <div class="card-body">
            <div class="row">
                <div class="col-lg-8">
                    <div class="form-group">
                        <div class="label">Код</div>

                        @error('code')
                        <div class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></div>
                        @enderror

                        <input type="text" name="code" class="form-control form-control-sm" value="{{ $model->code ?? old('code') }}">
                    </div>
                </div>

                <div class="col-lg-4">
                    @include('admin.parts.form_enable_trigger')

                    <div class="form-group">
                        <div class="label small">Главный</div>

                        @error('main')
                        <div class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></div>
                        @enderror

                        <select name="main" class="form-control form-control-sm" id="language_main">
                            @foreach($mainFlags as $mainFlag)
                                <option value="{{ $mainFlag }}" @if(isset($model) && (int)$model->main === (int)$mainFlag) selected @endif>{{ (int)$mainFlag ? 'Да' : 'Нет' }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>

</form>

