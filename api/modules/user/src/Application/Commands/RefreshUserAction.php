<?php

namespace GustavoMorais\User\Application\Commands;

use GustavoMorais\User\Application\BaseAction;
use Firebase\JWT\ExpiredException;
use Firebase\JWT\SignatureInvalidException;
use Firebase\JWT\BeforeValidException;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
use GustavoMorais\User\Domain\Entity\User;
use Exception;

class RefreshUserAction extends BaseAction
{
    public function execute()
    {
        $token = $this->validateRequest();
        if ($token) {
            try {
                $decodedData = JWT::decode(
                    $token,
                    new Key((new User())->getJwtSecret(), 'HS256')
                );
                if ($this->validateRefreshInfo($decodedData)) {
                    $user = User::where(['email' => $decodedData->sub->email])->first();
                    return [
                        'email' => $user->email,
                        'token' => $this->generateToken($user),
                        'refresh_token' => $this->generateRefreshToken($user),
                    ];
                }
            } catch (ExpiredException $e) {
                throw new Exception('Token expired');
            } catch (SignatureInvalidException $e) {
                throw new Exception('Invalid token signature');
            } catch (BeforeValidException $e) {
                throw new Exception('Token not valid yet');
            } catch (Exception $e) {
                throw new Exception('Invalid token');
            }
        } else {
            throw new \Exception('Invalid auth data');
        }
    }

    public function validateRefreshInfo($decodedData)
    {
        if (
            is_object($decodedData)
            && isset($decodedData->sub)
            && !empty($decodedData->sub)
            && is_object($decodedData->sub)
            && isset($decodedData->sub->email)
            && !empty($decodedData->sub->email)
            && isset($decodedData->sub->type)
            && !empty($decodedData->sub->type)
            && $decodedData->sub->type === 'refresh'
        ) {
            return $decodedData;
        }
        return false;
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
