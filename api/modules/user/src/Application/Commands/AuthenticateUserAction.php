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
                $token = [
                    'token' => $this->generateToken($validUser),
                    'refresh_token' => $this->generateRefreshToken($validUser),
                ];
            }
        } else {
            throw new \Exception('Invalid credentials');
        }

        return $token;
    }

    public function generateToken($user)
    {
        $token = null;
        if ($user) {
            $issued_at = time();
            $expiration_time = $issued_at + (60 * 60);
            $payload = [
                'iat' => $issued_at,
                'exp' => $expiration_time,
                'sub' => $user->email
            ];
            
            $token = JWT::encode($payload, $user->getJwtSecret(), 'HS256');
        }
        return $token;
    }

    public function generateRefreshToken($user)
    {
        $refreshToken = null;
        if ($user) {
            $issued_at = time();
            $expiration_time = $issued_at + (3600 * 24);
            $payload = [
                'iat' => $issued_at,
                'exp' => $expiration_time,
                'sub' => [
                    "email" => $user->email,
                    "type" => "refresh"
                ]
            ];
            
            $refreshToken = JWT::encode($payload, $user->getJwtSecret(), 'HS256');
        }
        return $refreshToken;
    }
}
