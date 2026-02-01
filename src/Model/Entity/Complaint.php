<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Complaint Entity
 *
 * @property int $complaint_id
 * @property int|null $student_id
 * @property string|null $complainant_name
 * @property string|null $complainant_phone
 * @property string|null $complainant_email
 * @property int|null $type_id
 * @property int|null $category_id
 * @property \Cake\I18n\Date|null $submission_date
 * @property string|null $description
 * @property string|null $status
 * @property bool|null $is_confidential
 * @property \Cake\I18n\DateTime|null $created_at
 *
 * @property \App\Model\Entity\Student $student
 * @property \App\Model\Entity\Type $type
 * @property \App\Model\Entity\Category $category
 */
class Complaint extends Entity
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
        'student_id' => true,
        'complainant_name' => true,
        'complainant_phone' => true,
        'complainant_email' => true,
        'type_id' => true,
        'category_id' => true,
        'submission_date' => true,
        'description' => true,
        'status' => true,
        'is_confidential' => true,
        'created_at' => true,
        'student' => true,
        'type' => true,
        'category' => true,
    ];
}
