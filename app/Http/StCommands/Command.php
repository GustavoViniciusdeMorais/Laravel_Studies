<?php

namespace App\Http\StCommands;

abstract class Command
{

    public $data;

    public function withData($data)
    {
        $this->data = $data;
        return $this;
    }

    public abstract function execute();

}