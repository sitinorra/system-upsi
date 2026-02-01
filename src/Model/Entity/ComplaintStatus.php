<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ComplaintStatus Entity
 *
 * @property int $status_id
 * @property int $complaint_id
 * @property int|null $department_section
 * @property string|null $old_status
 * @property string $new_status
 * @property int|null $changed_by_staff_id
 * @property string|null $remarks
 * @property \Cake\I18n\DateTime|null $changed_at
 *
 * @property \App\Model\Entity\Complaint $complaint
 * @property \App\Model\Entity\ChangedByStaff $changed_by_staff
 */
class ComplaintStatus extends Entity
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
        'department_section' => true,
        'old_status' => true,
        'new_status' => true,
        'changed_by_staff_id' => true,
        'remarks' => true,
        'changed_at' => true,
        'complaint' => true,
        'changed_by_staff' => true,
    ];
}
