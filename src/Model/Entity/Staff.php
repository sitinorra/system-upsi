<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Staff Entity
 *
 * @property int $staff_id
 * @property int|null $user_id
 * @property string $staff_name
 * @property string $no_staff
 * @property string|null $position
 * @property int|null $categories
 * @property string|null $email
 * @property string|null $phone_number
 *
 * @property \App\Model\Entity\User $user
 */
class Staff extends Entity
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
        'staff_name' => true,
        'no_staff' => true,
        'position' => true,
        'categories' => true,
        'email' => true,
        'phone_number' => true,
        'user' => true,
    ];
}
