<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ProjectCreate;
use App\Http\Requests\ProjectUpdate;
use App\Projects;
use App\Services\LocalisationService\LocalisationToggleService;
use App\Tags;

class ProjectsController extends Controller
{
    /** @var Projects */
    private $modelClass = Projects::class;

    public function index()
    {
        $models = $this->modelClass::with(['tags', 'data'])->get();

        return view('admin.pages.projects.index', [
            'models' => $models
        ]);
    }

    public function create(ProjectCreate $request)
    {
        if ($request->isMethod('get')) {
            return view('admin.pages.projects.create', [
                'tags' => Tags::all(),
                'languages' => LocalisationToggleService::getLanguages(),
                'statuses' => $this->modelClass::getStatuses(),
            ]);
        }

        $model = new $this->modelClass();
        if (!$model->builder($request)) {
            abort(500, 'create error');
        }

        return redirect()->route('admin-projects-update', ['id' => $model->id]);
    }

    public function update(ProjectUpdate $request, $id)
    {
        $model = $this->modelClass::with(['tags', 'data'])->find($id);
        if (!$model instanceof $this->modelClass) {
            abort(404);
        }

        if ($request->isMethod('get')) {
            return view('admin.pages.projects.update', [
                'model' => $model,
                'data' => $model->data->keyBy('language_id'),
                'modelTags' => $model->tags->keyBy('id')->all(),
                'tags' => Tags::all(),
                'languages' => LocalisationToggleService::getLanguages(),
                'statuses' => $this->modelClass::getStatuses(),
            ]);
        }

        if (!$model->builder($request)) {
            abort(500, 'update error');
        }

        return redirect()->route('admin-projects-update', ['id' => $model->id]);
    }

    public function delete($id)
    {
        $model = $this->modelClass::find($id);
        if (!$model instanceof $this->modelClass) {
            abort(404);
        }

        if ($model->delete() !== false) {
            abort(500, 'update error');
        }

        return redirect()->route('admin-projects');
    }
}
