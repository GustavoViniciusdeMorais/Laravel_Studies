<?php

namespace GustavoMorais\User\Application\Commands;

use GustavoMorais\User\Application\BaseAction;
use GustavoMorais\User\Domain\DataTransferObjects\UserData;
use GustavoMorais\User\Domain\Entity\User;

class CreateUserAction extends BaseAction
{
    public function execute()
    {
        $userData = UserData::fromArray($this->data);
        $user = new User();
        $user->first_name = $userData->firstName;
        $user->last_name = $userData->lastName;
        $user->email = $userData->email;
        $user->password = $user->generateHashPassword($userData->password);
        // print_r(json_encode(['user' => $user]));echo "\n\n";exit;
        $user->save();
        return $user;
    }
}
