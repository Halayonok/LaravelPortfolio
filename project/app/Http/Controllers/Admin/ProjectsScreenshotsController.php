<?php

namespace App\Http\Controllers\Admin;

use App\ProjectsScreenshots;

class ProjectsScreenshotsController extends Controller
{
    public function delete($projectId, $id)
    {
        $model = ProjectsScreenshots::where([
            ['id', $id],
            ['project_id', $projectId],
        ])->first();

        if (!$model instanceof ProjectsScreenshots) {
            return $this->response(404, parent::NOTIFY_NOT_FOUND);
        }

        if (!$model->delete()) {
            return $this->response(500, parent::NOTIFY_ERROR_DELETED);
        }

        return $this->response(201, parent::NOTIFY_DELETED, [
            'remove_model_id' => $id,
            'message' => 'Скриншот удалён'
        ]);
    }
}
