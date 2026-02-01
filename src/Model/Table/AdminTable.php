<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class AdminTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('admin');
        $this->setDisplayField('first_name');
        $this->setPrimaryKey('admin_id');
        $this->addBehavior('Timestamp');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'className' => 'Users'
        ]);
        
        $this->belongsTo('Departments', [
            'foreignKey' => 'department',
            'className' => 'Departments',
            'propertyName' => 'department_assoc'
        ]);
    }

    public function validationDefault(Validator $validator): Validator
    {
        return $validator;
    }
}