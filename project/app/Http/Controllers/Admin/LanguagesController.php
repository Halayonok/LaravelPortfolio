<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\LanguageCreate;
use App\Http\Requests\LanguageUpdate;
use App\Http\Requests\TagCreate;
use App\Http\Requests\TagUpdate;
use App\Languages;
use App\Tags;

class LanguagesController extends Controller
{
    /** @var Languages */
    private $modelClass = Languages::class;

    public function index()
    {
        $models = $this->modelClass::all();

        return view('admin.pages.languages.index', [
            'models' => $models
        ]);
    }

    public function create(LanguageCreate $request)
    {
        if ($request->isMethod('get')) {
            return view('admin.pages.languages.create', [
                'mainFlags' => $this->modelClass::getMainFlags()
            ]);
        }

        $model = new $this->modelClass();
        if (!$model->builder($request)) {
            abort(500, 'create error');
        }

        return redirect()->route('admin-languages-update', ['id' => $model->id]);
    }

    public function update(LanguageUpdate $request, $id)
    {
        $model = $this->modelClass::find($id);
        if (!$model instanceof $this->modelClass) {
            abort(404);
        }

        if ($request->isMethod('get')) {
            return view('admin.pages.languages.update', [
                'model' => $model,
                'mainFlags' => $this->modelClass::getMainFlags()
            ]);
        }

        if (!$model->builder($request)) {
            abort(500, 'update error');
        }

        return redirect()->route('admin-languages-update', ['id' => $model->id]);
    }

    public function delete($code)
    {
        $model = $this->modelClass::find($code);
        if (!$model instanceof $this->modelClass) {
            abort(404);
        }

        if ($model->delete() !== false) {
            abort(500, 'update error');
        }

        return redirect()->route('admin-languages');
    }
}
