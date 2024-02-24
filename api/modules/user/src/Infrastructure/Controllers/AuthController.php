<?php

namespace GustavoMorais\User\Infrastructure\Controllers;

use GustavoMorais\User\Application\Commands\RefreshUserAction;
use GustavoMorais\User\Application\Commands\AuthenticateUserAction;
use GustavoMorais\User\Application\Commands\VerifyUserAction;
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

    public function verify(Request $request)
    {
        try {
            return $this->success(
                (new VerifyUserAction())->setData($request)->execute()
            );
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }

    public function refresh(Request $request)
    {
        try {
            return $this->success(
                (new RefreshUserAction())->setData($request)->execute()
            );
        } catch (\Exception $e) {
            return $this->error($e->getMessage());
        }
    }
}
