<?php

namespace Api\Domains\Account\Infrastructure\Repositories;

use Api\Domains\Common\Repositories\Repository;
use Api\Domains\Common\Models\Entity;
use Illuminate\Database\Eloquent\Model;

class AccountEloquentRepository extends Model implements Repository
{
    protected $table = 'accounts';
    protected $primaryKey = 'account_id';
    protected $fillable = ['account_id', 'balance', 'email'];

    public function saveEntity(Entity $entity): Entity
    {
        $account = $entity->toArray();
        unset($account['account_id']);
        $createdAccount = $this->create($account);
        return $entity->fromArray($createdAccount->toArray());
    }

    public function findEntities(array $filters)
    {
        $result = null;
        $query = $this->query();
        if (!empty($filters)) {
            if (isset($filters['id']) && !empty($filters['id'])) {
                $query->where('account_id', '=', $filters['id']);
            }

            if (isset($filters['balance']) && !empty($filters['balance'])) {
                $query->where('balance', '=',$filters['balance']);
            }
            $result = $query->get()->toArray();
            sort($result);
        }
        return $result;
    }

    public function findAll():array
    {
        return $this->all()->toArray();
    }

    public function searchById($account_id)
    {
        $result = null;
        if (!empty($account_id)) {
            $result = $this->where('account_id', '=', $account_id)->get()->toArray();
            if (!empty($result) && isset($result[0])) {
                $result = json_decode(json_encode($result[0]), true);
            }
        }
        return $result;
    }

    public function withdraw(Entity $entity, int $value)
    {
        $result = false;
        if ($entity->withdraw($value)) {
            $result = $this->updateEntity($entity);
        }
        return $result;
    }

    public function updateEntity(Entity $entity): Entity
    {
        if (
            $this->where('account_id', '=', $entity->getAccountId())->update($entity->toArray())
        ) {
            return $entity;
        }
        return false;
    }
}
