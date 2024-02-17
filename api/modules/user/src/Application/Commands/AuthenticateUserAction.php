<?php

namespace GustavoMorais\User\Application\Commands;

use GustavoMorais\Article\Application\BaseAction;
use GustavoMorais\User\Domain\DataTransferObjects\AuthData;
use GustavoMorais\User\Domain\Entity\User;
use Firebase\JWT\JWT;

class AuthenticateUserAction extends BaseAction
{
    public function execute()
    {
        $token = false;
        $authData = AuthData::fromArray($this->data);
        $user = User::where(['email' => $authData->email])->first();
        
        if (!empty($user) && isset($user->id)) {
            $validUser = $user->verifyHashPassword($authData->password);
            if ($validUser) {
                $issued_at = time();
                $expiration_time = $issued_at + (60 * 60);
                $payload = [
                    'iat' => $issued_at,
                    'exp' => $expiration_time,
                    'sub' => $validUser->email
                ];
                
                $token = [
                    'token' => JWT::encode($payload, $validUser->getJwtSecret(), 'HS256')
                ];
            }
        } else {
            throw new \Exception('Invalid credentials');
        }

        return $token;
    }
}
