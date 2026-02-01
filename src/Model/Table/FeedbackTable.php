<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;

class FeedbackTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('feedback');
        $this->setPrimaryKey('feedback_id');
        $this->addBehavior('Timestamp');

        $this->belongsTo('Complaints', [
            'foreignKey' => 'complaint_id'
        ]);
        
        $this->belongsTo('Staff', [
            'foreignKey' => 'staff_id'
        ]);
    }
}