<?php
declare(strict_types=1);

namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Attachment Entity
 *
 * @property int $attachment_id
 * @property int|null $complaint_id
 * @property string $file_name
 * @property string $file_path
 * @property string|null $file_type
 * @property \Cake\I18n\DateTime|null $upload_date
 *
 * @property \App\Model\Entity\Complaint $complaint
 */
class Attachment extends Entity
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
        'file_name' => true,
        'file_path' => true,
        'file_type' => true,
        'upload_date' => true,
        'complaint' => true,
    ];
}
