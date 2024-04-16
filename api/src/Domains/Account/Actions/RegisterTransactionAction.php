<?php

namespace Api\Domains\Account\Actions;

use Api\Domains\Common\Models\DomainException;
use Api\Domains\Common\Actions\Action;
use Api\Domains\Account\Models\Transaction;
use Api\Domains\Account\Models\Account;
use Api\Domains\Account\Infrastructure\Repositories\AccountEloquentRepository;

class RegisterTransactionAction extends Action
{
    public function execute()
    {
        try {
            $accountRepository = new AccountEloquentRepository();
            $data = $this->getData();
            $result = false;
            $message = "Something went wrong";
            $status = 404;
            if (
                !empty($data)
                && !empty($data['payment_type'])
                && !empty($data['account_id'])
                && !empty($data['value'])
            ) {
                $paymentType = $this->repository->getTransactionTypeByAcronym($data['payment_type']);
                $account = (new Account())->fromArray(
                    $accountRepository->searchById($data['account_id'])
                );
                if (
                    !empty($paymentType)
                    && !empty($paymentType['payment_type_id'])
                    && !empty($paymentType['acronym'])
                    && !empty($account)
                    && !empty($account->getAccountId())
                ) {
                    $data['payment_type_id'] = $paymentType['payment_type_id'];
                    $transaction = (new Transaction)->fromArray($data);
                    $transaction = $this->calculateTransactionFee($transaction, $paymentType['acronym']);
                    if ($account = $accountRepository->withdraw($account, $transaction->getValue())) {
                        $this->repository->saveEntity($transaction);
                        $result = $account->toArray();
                        $message = "Success";
                        $status = 201;
                    }
                }
            }
            return $this->respond(
                $result,
                $status,
                $message
            );
        } catch (DomainException $e) {
            $this->log::info($e->getMessage());
            return $this->respond(false, 404);
        }
    }

    public function calculateTransactionFee($transaction, $transactionType)
    {
        if ($transactionType == "D") {
            $transaction = $transaction->addDebitTax();
        }

        if ($transactionType == "C") {
            $transaction = $transaction->addCreditTax();
        }

        return $transaction;
    }
}
