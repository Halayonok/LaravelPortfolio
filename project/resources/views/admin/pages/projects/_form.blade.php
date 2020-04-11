<?php
/**
 * @var \App\Projects $model
 * @var \App\ProjectsScreenshots $screenshot
 * @var \App\Tags[] $tags
 */
?>

<form enctype="multipart/form-data"
      action="{{ isset($model) ? route('admin-projects-update', ['id' => $model->id]) : route('admin-projects-create') }}"
      id="project_form"
      method="post">
    @csrf

    <div class="card shadow">
        <div class="card-header py-2">
            <div class="row">
                <div class="col-6 p-0 d-flex align-items-center">
                    <h6 class="m-0 font-weight-bold ">
                    @if(isset($model))
                        Редактировать проект
                    @else
                        Новый проект
                    @endif
                    </h6>
                </div>

                <div class="col-6 p-0 d-flex align-items-center justify-content-end">
                    @if(isset($model))
                        <a href="{{ route('admin-projects-create') }}" class="btn btn-info btn-sm mr-2">
                            <i class="fas fa-plus-circle"></i>
                            Добавить ещё один проект
                        </a>
                    @endif
                    <button class="btn btn-success btn-sm" type="submit">
                        <i class="fas fa-save"></i>
                        Сохранить
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
                        <div class="label small">Служебное название</div>

                        @error('back_name')
                        <div class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></div>
                        @enderror

                        <input type="text" name="back_name" class="form-control form-control-sm"
                               value="{{ $model->back_name ?? old('back_name') }}">
                    </div>

                    {{-- Link --}}
                    <div class="form-group">
                        <div class="label small">Ссылка</div>

                        @error('link')
                        <div class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></div>
                        @enderror

                        <input type="text" name="link" class="form-control form-control-sm"
                               value="{{ $model->link ?? old('link') }}">
                    </div>

                    <!-- Localization data -->
                    <div class="classic-tabs">
                        <ul class="nav tabs-cyan" id="model_data_tabs" role="tablist">
                            @foreach($languages as $language)
                                <li class="nav-item">
                                    <a class="nav-link waves-light @if($loop->first) active show @endif"
                                       id="{{$language->id}}-tab-model"
                                       data-toggle="tab"
                                       href="#{{$language->id}}_model_data"
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

                        <div class="tab-content border-right border-bottom border-left rounded-bottom"
                             id="model_data_tabs_content">
                            @foreach($languages as $language)
                                <div class="tab-pane fade @if($loop->first) show active @endif"
                                     id="{{$language->id}}_model_data" role="tabpanel"
                                     aria-labelledby="{{$language->id}}-tab">

                                    {{-- title --}}
                                    <div class="form-group">
                                        <div class="label small">Название на сайте</div>

                                        @error('title_' . $language->id)
                                        <div class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></div>
                                        @enderror

                                        <input type="text" name="title_{{$language->id}}" class="form-control form-control-sm"
                                               value="{{ $data[$language->id]->title ?? old('title_' . $language->id) }}">
                                    </div>

                                    {{-- content --}}
                                    <div class="form-group">
                                        <div class="label small">Содержимое</div>

                                        @error('content_' . $language->id)
                                        <div class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></div>
                                        @enderror

                                        <textarea type="text" name="content_{{$language->id}}"
                                                  class="form-control form-control-sm textarea_tinymce">{!! $data[$language->id]->content ?? old('content_' . $language->id) !!}</textarea>
                                    </div>

                                    {{-- meta title --}}
                                    <div class="form-group">
                                        <div class="label small">Meta title</div>

                                        @error('meta_title_' . $language->id)
                                        <div class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></div>
                                        @enderror

                                        <input type="text" name="meta_title_{{$language->id}}"
                                               class="form-control form-control-sm"
                                               value="{{ $data[$language->id]->meta_title ?? old('meta_title_' . $language->id) }}">
                                    </div>

                                    {{-- meta keywords --}}
                                    <div class="form-group">
                                        <div class="label small">Meta keywords</div>

                                        @error('meta_keywords_' . $language->id)
                                        <div class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></div>
                                        @enderror

                                        <input type="text" name="meta_keywords_{{$language->id}}"
                                               class="form-control form-control-sm"
                                               value="{{ $data[$language->id]->meta_keywords ?? old('meta_keywords_' . $language->id) }}">
                                    </div>

                                    {{-- meta description --}}
                                    <div class="form-group">
                                        <div class="label small">Meta description</div>

                                        @error('meta_description_' . $language->id)
                                        <div class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></div>
                                        @enderror

                                        <textarea type="text" rows="5" name="meta_description_{{$language->id}}"
                                                  class="form-control form-control-sm">{{ $data[$language->id]->meta_description ?? old('meta_description_' . $language->id) }}</textarea>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Screenshots --}}
                    <div class="form-group">
                        <div class="label small">Скриншоты</div>

                        @error('screenshots')
                        <div class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></div>
                        @enderror

                        <div class="dropzone_container">
                            <div class="input-images" data-field-name="screenshots"></div>
                        </div>

                        <div class="mt-2 screenshots">
                            @if(isset($model))
                                @foreach($model->screenshots as $screenshot)
                                    <div class="screenshot" id="screenshot_{{ $screenshot->id }}">
                                        <button class="btn btn-danger delete_screenshot"
                                                data-delete-action="{{ route('admin-applications-preview-delete', ['projectId' => $model->id, 'id' => $screenshot->id]) }}">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>

                                        <a href="{{ asset($screenshot->assetPath()) }}"
                                           data-lightbox="screenshot-{{ $model->id }}">
                                            <img
                                                src="{{ asset($screenshot->assetPath()) }}"
                                                alt="{{ $model->app_name }}">
                                        </a>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>

                </div>

                <div class="col-lg-4">

                    {{-- Tags --}}
                    <div class="form-group">
                        <div class="label small mb-1">
                            <a href="{{ route('admin-tags') }}" target="_blank">Теги</a>
                        </div>

                        @error('tags_ids')
                        <div class="invalid-feedback" role="alert"><strong>{{ $message }}</strong></div>
                        @enderror

                        <div class="tags_container p-2">
                            @if(count($tags))
                                @foreach($tags as $tag)
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="tags_ids[]"
                                               id="tags_ids_{{ $tag->id }}"
                                               value="{{ $tag->id }}"{{ isset($modelTags) && key_exists($tag->id, $modelTags) ? 'checked' : '' }}>

                                        <label class="{{ !$tag->isEnabled() ? 'red-text' : '' }} custom-control-label"
                                               for="tags_ids_{{ $tag->id }}">
                                            <small>{{ $tag->back_name }}</small>
                                        </label>
                                    </div>
                                @endforeach
                            @else
                                <span class="red-text">
                        в системе нет тегов
                    </span>
                            @endif
                        </div>
                    </div>

                    {{-- Enable --}}
                    @include('admin.parts.form_enable_trigger')

                    {{-- Statuses --}}
                    <div class="form-group">
                        <div class="label small">Статус</div>

                        <select name="status" class="form-control form-control-sm" id="project_status">
                            @foreach($statuses as $status)
                                <option value="{{ $status }}" @if(isset($model) && $model->status === $status) selected @endif>{{ $status }}</option>
                            @endforeach
                        </select>
                    </div>

                </div>
            </div>
        </div>
    </div>


</form>

