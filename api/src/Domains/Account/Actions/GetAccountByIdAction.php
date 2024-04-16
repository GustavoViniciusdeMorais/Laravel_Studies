<?php

namespace Api\Domains\Account\Actions;

use Api\Domains\Common\Models\DomainException;
use Api\Domains\Common\Actions\Action;

class GetAccountByIdAction extends Action
{
    public function execute()
    {
        try {
            $message = "Something went wrong";
            $status = 404;
            $account = $this->repository->findEntities($this->getData());
            if (!empty($account)) {
                $message = "Success";
                $status = 200;
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
