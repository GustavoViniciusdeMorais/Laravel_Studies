<?php

namespace Api\Domains\Account\Models;

use Api\Domains\Common\Models\Entity;
use Api\Domains\Common\Models\DomainException;

class Account extends Entity
{
    private $account_id;
    private $email;
    private $balance;

    public function getAccountId() {
        return $this->account_id;
    }

    public function setAccountId($account_id) {
        $this->account_id = $account_id;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function getBalance() {
        return $this->balance;
    }

    public function setBalance($balance) {
        $this->balance = $balance;
    }

    public function toArray()
    {
        return [
            "account_id" => $this->getAccountId(),
            "email" => $this->getEmail(),
            "balance" => $this->getBalance(),
        ];
    }

    public function fromArray(array $data)
    {
        if (
            !is_array($data)
            || empty($data)
            || !isset($data['email'])
            || empty($data['email'])
            || !isset($data['balance'])
            || empty($data['balance'])
        ) {
            $data = json_encode($data);
            throw new DomainException('Invalid data for account: ' . $data);
        }
        $account = new self();
        if (isset($data['account_id'])) {
            $account->setAccountId($data['account_id']);
        }
        if (isset($data['email'])) {
            $account->setEmail($data['email']);
        }
        if (isset($data['balance'])) {
            $account->setBalance($data['balance']);
        }
        return $account;
    }

    public function withdraw(int $transactionValue)
    {
        if ($this->validateTransaction($transactionValue)) {
            $this->setBalance($this->getBalance() - $transactionValue);
            return $this;
        }
        return false;
    }

    public function validateTransaction(int $transactionValue)
    {
        $result = $this->getBalance() - $transactionValue;
        if ($result >= 0) {
            return true;
        }
        return false;
    }
}
