<?php

namespace GustavoMorais\User\Infrastructure\Controllers;

use GustavoMorais\User\Infrastructure\Controllers\BaseController;
use GustavoMorais\User\Application\Commands\CreateUserAction;
use Illuminate\Http\Request;

class UserController extends BaseController
{
    public function createUser(Request $request)
    {
        try {
            return $this->success(
                (new CreateUserAction())->setData($request->all())->execute()
            );
        } catch (\Throwable $th) {
            return $this->error($th->getMessage());
        }
    }
}
