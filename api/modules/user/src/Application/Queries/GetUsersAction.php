<?php

namespace GustavoMorais\User\Application\Queries;

use GustavoMorais\User\Application\BaseAction;
use GustavoMorais\User\Domain\Entity\User;
use Spatie\QueryBuilder\QueryBuilder;

class GetUsersAction extends BaseAction
{
    public function execute()
    {
        return QueryBuilder::for(User::class)
            ->allowedFilters('name')
            ->paginate()
            ->appends(request()->query());
    }
}
