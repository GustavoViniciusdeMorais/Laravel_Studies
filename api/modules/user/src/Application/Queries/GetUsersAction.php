<?php

namespace GustavoMorais\User\Application\Queries;

use GustavoMorais\User\Application\BaseAction;
use GustavoMorais\User\Domain\Entity\User;

class GetUsersAction extends BaseAction
{
    public function execute()
    {
        return User::all();
    }
}
