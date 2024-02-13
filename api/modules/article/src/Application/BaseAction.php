<?php

namespace GustavoMorais\Article\Application;

abstract class BaseAction
{
    protected $data;
    
    abstract public function execute();

    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }
}
