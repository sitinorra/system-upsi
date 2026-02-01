<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;

class AttachmentsTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('attachments');
        $this->setPrimaryKey('attachment_id');
        $this->addBehavior('Timestamp');

        $this->belongsTo('Complaints', [
            'foreignKey' => 'complaint_id'
        ]);
    }
}