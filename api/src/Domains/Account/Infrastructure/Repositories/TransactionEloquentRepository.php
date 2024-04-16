<?php

namespace Api\Domains\Account\Infrastructure\Repositories;

use Api\Domains\Common\Repositories\Repository;
use Api\Domains\Common\Models\Entity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class TransactionEloquentRepository extends Model implements Repository
{
    protected $table = 'transactions';
    protected $primaryKey = 'transaction_id';
    protected $fillable = ['transaction_id', 'account_id', 'payment_type_id', 'value'];

    public function saveEntity(Entity $entity): Entity
    {
        $createdTransaction = $this->create($entity->toArray());
        return $entity->fromArray($createdTransaction->toArray());
    }

    public function findEntities(array $filters)
    {
        $result = null;
        $query = $this->query();
        if (!empty($filters)) {
            if (isset($filters['id']) && !empty($filters['id'])) {
                $query->where('transaction_id', '=', $filters['id']);
            }

            if (isset($filters['account_id']) && !empty($filters['account_id'])) {
                $query->where('account_id', '=', $filters['account_id']);
            }

            if (isset($filters['payment_type_id']) && !empty($filters['payment_type_id'])) {
                $query->where('payment_type_id', '=', $filters['payment_type_id']);
            }

            if (isset($filters['value']) && !empty($filters['value'])) {
                $query->where('value', '=', $filters['value']);
            }

            $result = $query->get()->toArray();
            sort($result);
        }
        return $result;
    }

    public function findAll(): array
    {
        return $this->all()->toArray();
    }

    public function getTransactionTypeByAcronym(string $acronym)
    {
        $result = null;
        if (!empty($acronym)) {
            $result = DB::table('payment_types')->where('acronym', '=', strtoupper($acronym))->get()->toArray();
            if (!empty($result) && isset($result[0])) {
                $result = json_decode(json_encode($result[0]), true);
            }
        }
        return $result;
    }
}
