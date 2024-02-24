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

class VerifyUserAction extends BaseAction
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
                if (
                    is_object($decodedData)
                    && isset($decodedData->sub)
                    && !empty($decodedData->sub)
                ) {
                    return [
                        'email' => $decodedData->sub,
                        'token' => $token
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
}
