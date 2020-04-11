<?php

namespace App\Http\Controllers\Admin;

use App\Services\ToggleModelService\EnabledModelInterface;
use Illuminate\Http\Request;

class SystemController extends Controller
{
    public function toggleEnable(Request $request)
    {
        $id = $request->post('id');
        $modelClass = $request->post('model');

        try {
            $model = $modelClass::find($id);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Invalid model class'
            ], 500);
        }

        if (!$model instanceof EnabledModelInterface) {
            return response()->json([
                'message' => 'Model not found'
            ], 404);
        }

        if (!$model->toggleStatus()) {
            return response()->json([
                'message' => 'Error update status'
            ], 500);
        }

        return response()->json([
            'model' => $model,
            'color' => (int)$model->enable ? 'success' : 'danger',
            'text' => $model->enable ? 'вкл' : 'выкл',
        ], 200);
    }
}
