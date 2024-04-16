<?php

namespace Api\Domains\Common\Actions;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Api\Domains\Common\Repositories\Repository;

abstract class Action
{
    private $data;
    public $log;

    public function __construct(
        protected Repository $repository
    ) {
        $this->log = new Log();
        $this->repository = $repository;
    }

    public function __invoke()
    {
        return $this->execute();
    }

    abstract public function execute();

    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }

    public function getData()
    {
        return $this->data;
    }

    public function respond(
        $data = false,
        $status = 201,
        $message = "Something went wrong. More info in the logs."
    ) {
        return new JsonResponse([
           "status" => $status,
           "message" => $message,
           "data" => $data
        ], $status);
    }
}
