<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Feedback Entity
 *
 * @property int $feedback_id
 * @property int $complaint_id
 * @property int|null $staff_id
 * @property int|null $department
 * @property string|null $feedback_type
 * @property string $feedback_text
 * @property \Cake\I18n\DateTime|null $created_at
 * @property \Cake\I18n\DateTime|null $updated_at
 *
 * @property \App\Model\Entity\Complaint $complaint
 * @property \App\Model\Entity\Staff $staff
 */
class Feedback extends Entity
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
        'complaint_id' => true,
        'staff_id' => true,
        'department' => true,
        'feedback_type' => true,
        'feedback_text' => true,
        'created_at' => true,
        'updated_at' => true,
        'complaint' => true,
        'staff' => true,
    ];
}
