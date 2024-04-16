<?php

namespace Api\Domains\Common\Repositories;

use Api\Domains\Common\Models\Entity;

interface Repository
{
    public function saveEntity(Entity $entity):? object;
    public function findEntities(array $filters);
    public function findAll():array;
}
