<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Admin Entity
 *
 * @property int $admin_id
 * @property int|null $user_id
 * @property int $department
 * @property string $first_name
 * @property string $last_name
 * @property string $position
 * @property string $no_phone
 * @property string $email
 *
 * @property \App\Model\Entity\User $user
 */
class Admin extends Entity
{
    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array<string, bool>
     */
    protected array $_accessible = [
        'user_id' => true,
        'department' => true,
        'first_name' => true,
        'last_name' => true,
        'position' => true,
        'no_phone' => true,
        'email' => true,
        'user' => true,
    ];
}
