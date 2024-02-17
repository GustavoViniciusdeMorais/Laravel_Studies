<?php

namespace GustavoMorais\User\Infrastructure\Controllers;

use GustavoMorais\User\Application\Commands\AuthenticateUserAction;
use GustavoMorais\Article\Infrastructure\Controllers\BaseController;
use Illuminate\Http\Request;

class AuthController extends BaseController
{
    public function login(Request $request)
    {
        try {
            return $this->success(
                (new AuthenticateUserAction())->setData($request->all())->execute()
            );
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }
}
