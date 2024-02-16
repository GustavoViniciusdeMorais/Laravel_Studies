<?php

namespace GustavoMorais\User\Domain\DataTransferObjects;

class UserData
{
    public function __construct(
        public string $firstName,
        public string $lastName,
        public string $email,
        public string $password
    ) {}

    public static function fromArray(array $data)
    {
        if (
            !is_array($data)
            || empty($data)
            || !isset($data['first_name'])
            || !isset($data['last_name'])
            || !isset($data['email'])
            || !isset($data['password'])
        ) {
            throw new \Exception('Invalid data');
        }
        return new self(
            $data['first_name'],
            $data['last_name'],
            $data['email'],
            $data['password']
        );
    }
}
