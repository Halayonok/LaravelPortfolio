<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TagCreate;
use App\Http\Requests\TagUpdate;
use App\Tags;

class TagsController extends Controller
{
    /** @var Tags */
    private $modelClass = Tags::class;

    public function index()
    {
        $models = $this->modelClass::all();

        return view('admin.pages.tags.index', [
            'models' => $models
        ]);
    }

    public function create(TagCreate $request)
    {
        if ($request->isMethod('get')) {
            return view('admin.pages.tags.create', [
                'tags' => $this->modelClass::all()
            ]);
        }

        $model = new $this->modelClass();
        if (!$model->builder($request)) {
            abort(500, 'create error');
        }

        return redirect()->route('admin-projects-update', ['id' => $model->id]);
    }

    public function update(TagUpdate $request, $id)
    {
        $model = $this->modelClass::find($id);
        if (!$model instanceof $this->modelClass) {
            abort(404);
        }

        if ($request->isMethod('get')) {
            return view('admin.pages.tags.update', [
                'model' => $model,
            ]);
        }

        $model = new $this->modelClass();
        if (!$model->builder($request)) {
            abort(500, 'update error');
        }

        return redirect()->route('admin-tags-update', ['id' => $model->id]);
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

        return redirect()->route('admin-tags');
    }
}
