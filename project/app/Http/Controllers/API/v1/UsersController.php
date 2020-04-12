<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Resources\Entity\User;
use App\Users;

class UsersController extends ApiController
{
    /**
     * @SWG\Get(path="/api/v1/users",
     *     tags={"Users v1"},
     *     summary="Returns current auth user",
     *     @SWG\Parameter(
     *          name = "Authorization",
     *          in = "header",
     *          description = "Access token given by auth methods, usage: 'Authorization: Bearer [api_token]'",
     *          required = true,
     *          type = "string",
     *          default = "Bearer"
     *      ),
     *     produces={"application/json"},
     *
     *     @SWG\Response(
     *         response = 200,
     *         description = "Response",
     *         @SWG\Schema(ref = "#/definitions/Users")
     *     )
     * )
     */
    public function index()
    {
        $activeUser = $this->getAuthUser();

        return new User($activeUser);
    }

    /**
     * @SWG\Delete(path="/api/v1/users/{id}",
     *     tags={"Users v1"},
     *     summary="Delete user by id",
     *     @SWG\Parameter(
     *          name = "Authorization",
     *          in = "header",
     *          description = "Access token given by auth methods, usage: 'Authorization: Bearer [api_token]'",
     *          required = true,
     *          type = "string",
     *          default = "Bearer"
     *      ),
     *     produces={"application/json"},
     *
     *     @SWG\Response(
     *         response = 200,
     *         description = "Ok",
     *     ),
     *
     *     @SWG\Response(
     *         response = 404,
     *         description = "Not found",
     *     ),
     * )
     */
    public function destroy($id)
    {
        $user = Users::find($id);
        if (!($user instanceof Users) ||
            (int)$this->getAuthUser()->id !== (int)$user->id && !$this->getAuthUser()->isAdmin()) {
            return $this->responseError(404, 'User not found');
        }

        $user->forceDelete();

        return $this->response(200, 'ok');
    }
}
