<?php

namespace Api\Domains\Common\Models;

abstract class Entity
{
    abstract public function toArray();
    abstract public function fromArray(array $data);
}
