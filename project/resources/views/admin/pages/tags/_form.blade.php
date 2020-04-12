<?php
/**
 * @var \App\Projects $model
 * @var \App\ProjectsScreenshots $screenshot
 * @var \App\Tags[] $tags
 */
?>

<form enctype="multipart/form-data"
      action="{{ isset($model) ? route('admin-tags-update', ['id' => $model->id]) : route('admin-tags-create') }}"
      method="post">
    @csrf

    <div class="card shadow">
        <div class="card-header py-2">
            <div class="row">
                <div class="col-6 p-0 d-flex align-items-center">
                    <h6 class="m-0 font-weight-bold ">
                        @if(isset($model))
                            Редактировать тег
                        @else
                            Новый тег
                        @endif
                    </h6>
                </div>

                <div class="col-6 p-0 d-flex align-items-center justify-content-end">
                    @if(isset($model))
                        <a href="{{ route('admin-tags-create') }}" class="btn btn-icon-split btn-sm btn-info mr-2">
                            <span class="icon text-white-50">
                            <i class="fas fa-plus-circle"></i>
                            </span>
                            <span class="text">Новый тег</span>
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

                <div class="col-lg-8">

                    {{-- Back name --}}
                    <div class="form-group">
                        <div class="label small">Системное название</div>

                        @error('back_name')
                        <div class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></div>
                        @enderror

                        <input type="text" name="back_name" class="form-control form-control-sm"
                               value="{{ $model->back_name ?? old('back_name') }}">
                    </div>

                    <!-- Localization data -->
                    <div class="form-group">
                        <div class="classic-tabs">
                            <ul class="nav bg-primary" id="model_data_tabs" role="tablist">
                                @foreach($languages as $language)
                                    <li class="nav-item">
                                        <a class="nav-link waves-light @if($loop->first) active show @endif"
                                           id="{{$language->code}}-tab-model"
                                           data-toggle="tab"
                                           href="#{{$language->code}}_model_data"
                                           role="tab"
                                           aria-controls="{{$language->id}}"
                                           @if($loop->first)
                                           aria-selected="true"
                                           @else
                                           aria-selected="false"
                                            @endif
                                        >
                                            {{$language->code}}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>

                            <div class="tab-content border-right border-bottom border-left rounded-bottom bg-contrast"
                                 id="model_data_tabs_content">
                                @foreach($languages as $language)
                                    <div class="tab-pane fade @if($loop->first) show active @endif"
                                         id="{{$language->code}}_model_data" role="tabpanel"
                                         aria-labelledby="{{$language->code}}-tab">

                                        {{-- title --}}
                                        <div class="form-group">
                                            <div class="label small">Название на сайте</div>

                                            @error('title_' . $language->id)
                                            <div class="invalid-feedback" role="alert"><strong>{{ $message }}</strong>
                                            </div>
                                            @enderror

                                            <input type="text" name="title_{{$language->id}}"
                                                   class="form-control form-control-sm"
                                                   value="{{ $data[$language->id]->title ?? old('title_' . $language->id) }}">
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>


                </div>

                <div class="col-lg-4">

                    {{-- Enable --}}
                    @include('admin.parts.form_enable_trigger')

                </div>
            </div>
        </div>
    </div>


</form>

