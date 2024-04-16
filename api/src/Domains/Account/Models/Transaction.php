<?php

namespace Api\Domains\Account\Models;

use Api\Domains\Common\Models\Entity;
use Api\Domains\Common\Models\DomainException;

class Transaction extends Entity
{
    private $payment_type_id;
    private $account_id;
    private $value;

    public function getPaymentTypeId() {
        return $this->payment_type_id;
    }

    public function getAccountId()
    {
        return $this->account_id;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function setPaymentTypeId($payment_type_id) {
        $this->payment_type_id = $payment_type_id;
    }

    public function setAccountId($account_id)
    {
        $this->account_id = $account_id;
    }

    public function setValue($value)
    {
        $this->value = $value;
    }

    public function toArray()
    {
        return [
            "payment_type_id" => $this->getPaymentTypeId(),
            "account_id" => $this->getAccountId(),
            "value" => $this->getValue(),
        ];
    }

    public function fromArray(array $data)
    {
        if (
            !is_array($data)
            || empty($data)
            || !isset($data['payment_type_id'])
            || empty($data['payment_type_id'])
            || !isset($data['account_id'])
            || empty($data['account_id'])
            || !isset($data['value'])
            || empty($data['value'])
        ) {
            $data = json_encode($data);
            throw new DomainException('Invalid data for transaction: ' . $data);
        }
        $payment = new self();
        if (isset($data['payment_type_id'])) {
            $payment->setPaymentTypeId($data['payment_type_id']);
        }
        if (isset($data['account_id'])) {
            $payment->setAccountId($data['account_id']);
        }
        if (isset($data['value'])) {
            $payment->setValue($data['value']);
        }
        return $payment;
    }

    public function addDebitTax()
    {
        if (!empty($this->getValue())) {
            $this->setValue($this->getValue() + ($this->getValue() * 0.03));
        }
        return $this;
    }

    public function addCreditTax()
    {
        if (!empty($this->getValue())) {
            $this->setValue($this->getValue() + ($this->getValue() * 0.05));
        }
        return $this;
    }
}
