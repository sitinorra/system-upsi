<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

class User extends Entity
{
    protected array $_accessible = [
        'username' => true,
        'password' => true,
        'user_type' => true,
        'email' => true,
    ];

    protected array $_hidden = [
        'password',
    ];

    // Automatically hash password when set
    protected function _setPassword(string $password): ?string
    {
        if (strlen($password) > 0) {
            return password_hash($password, PASSWORD_DEFAULT);
        }
        return null;
    }
}