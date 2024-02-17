<?php

namespace GustavoMorais\User\Domain\Entity;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Model
{
    use HasUuids, SoftDeletes;

    protected $jwtSecret = 'e884a9d4ff6b705d7f71a3';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * Get the columns that should receive a unique identifier.
     *
     * @return array<int, string>
     */
    public function uniqueIds(): array
    {
        return ['uuid'];
    }

    public function generateHashPassword($password)
    {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    public function verifyHashPassword($password)
    {
        if (password_verify($password, $this->password)) {
            return $this;
        } else {
            throw new \Exception('Invalid user password');
        }
    }

    public function getJwtSecret()
    {
        return $this->jwtSecret;
    }
}
