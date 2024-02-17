<?php

namespace GustavoMorais\User\Domain\DataTransferObjects;

class AuthData
{
    public function __construct(
        public string $email,
        public string $password
    ) {}

    public static function fromArray(array $data)
    {
        if (
            !is_array($data)
            || empty($data)
            || !isset($data['email'])
            || !isset($data['password'])
        ) {
            throw new \Exception('Invalid data');
        }
        return new self(
            $data['email'],
            $data['password']
        );
    }
}
