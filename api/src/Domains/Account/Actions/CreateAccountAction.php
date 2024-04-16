<?php

namespace Api\Domains\Account\Actions;

use Api\Domains\Account\Models\Account;
use Api\Domains\Common\Models\DomainException;
use Api\Domains\Common\Actions\Action;

class CreateAccountAction extends Action
{
    public function execute()
    {
        try {
            $message = "Something went wrong";
            $status = 404;
            $accountData = (new Account())->fromArray($this->getData());
            $account = $this->repository->saveEntity($accountData)->toArray();
            if (!empty($account)) {
                $message = "Success";
                $status = 201;
            }
            return $this->respond(
                $account,
                $status,
                $message
            );
        } catch (DomainException $e) {
            $this->log::info($e->getMessage());
            return $this->respond(false, 404);
        }
    }
}
