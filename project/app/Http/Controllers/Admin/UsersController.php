<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\UserCreate;
use App\Http\Requests\UserUpdate;
use App\Users;

class UsersController extends Controller
{
    public function index()
    {
        $models = Users::all();

        return view('admin.pages.users.index', [
            'models' => $models
        ]);
    }

    public function create(UserCreate $request)
    {
        if ($request->isMethod('get')) {
            return view('admin.pages.users.create');
        }

        if ($request->post('role') === Users::ROLE_ROOT && !Users::authUserIsRole(Users::ROLE_ROOT)) {
            abort(403);
        }

        $model = new Users();
        if (!$model->builder($request)) {
            abort(500, 'create error');
        }

        return redirect()->route('admin-users-update', ['id' => $model->id]);
    }

    public function update(UserUpdate $request, $id)
    {
        $model = Users::find($id);
        if (!$model instanceof Users) {
           abort(404);
        }

        if ($model->checkRole(Users::ROLE_ROOT) && !Users::authUserIsRole(Users::ROLE_ROOT)) {
            abort(403);
        }

        if ($request->isMethod('get')) {
            return view('admin.pages.users.update', [
                'model' => $model,
            ]);
        }

        if (!$model->builder($request)) {
            abort(500, 'create error');
        }

        return redirect()->route('admin-users-update', ['id' => $model->id]);
    }

    public function delete($id)
    {
        $model = Users::find($id);
        if (!$model instanceof Users) {
            abort(404);
        }

        if ($model->checkRole(Users::ROLE_ROOT) && !Users::authUserIsRole(Users::ROLE_ROOT)) {
            abort(403);
        }

        $model->delete();

        return redirect()->route('admin-users');
    }
}
