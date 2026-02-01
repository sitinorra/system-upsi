<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class StaffTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('staff');
        $this->setDisplayField('staff_name');
        $this->setPrimaryKey('staff_id');

        $this->addBehavior('Timestamp');

        // Define associations
        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'className' => 'Users'
        ]);
        
        $this->belongsTo('ComplaintCategories', [
            'foreignKey' => 'categories',
            'className' => 'ComplaintCategories'
        ]);
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('staff_id')
            ->allowEmptyString('staff_id', null, 'create');

        $validator
            ->scalar('staff_name')
            ->maxLength('staff_name', 255)
            ->requirePresence('staff_name', 'create')
            ->notEmptyString('staff_name');

        return $validator;
    }
}