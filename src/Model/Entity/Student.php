<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Student Entity
 *
 * @property int $student_id
 * @property int|null $user_id
 * @property string $full_name
 * @property string $no_student
 * @property string|null $gender
 * @property string|null $semester
 * @property string $address_1
 * @property string|null $address_2
 * @property string $posscode
 * @property string $state
 * @property string|null $phone_number
 * @property string|null $email_address
 * @property \Cake\I18n\DateTime|null $created_at
 *
 * @property \App\Model\Entity\User $user
 */
class Student extends Entity
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
        'full_name' => true,
        'no_student' => true,
        'gender' => true,
        'semester' => true,
        'address_1' => true,
        'address_2' => true,
        'posscode' => true,
        'state' => true,
        'phone_number' => true,
        'email_address' => true,
        'created_at' => true,
        'user' => true,
    ];
}
