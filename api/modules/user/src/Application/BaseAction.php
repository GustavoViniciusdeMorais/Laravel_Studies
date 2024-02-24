<?php

namespace GustavoMorais\User\Application;

abstract class BaseAction
{
    protected $data;
    
    abstract public function execute();

    public function setData($data)
    {
        $this->data = $data;
        return $this;
    }

    public function validateRequest()
    {
        if (
            $this->data->hasHeader('Authorization')
            && !empty($this->data->header('Authorization'))
        ) {
            $token = $this->data->header('Authorization');
            return str_replace('Bearer ', '', $token);
        }
        
        return false;
    }
}
