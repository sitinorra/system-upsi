<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\Validation\Validator;

class DepartmentsTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('departments');
        $this->setDisplayField('dept_name');
        $this->setPrimaryKey('dept_id');

        // NO hasMany here - remove it completely!
    }

    public function validationDefault(Validator $validator): Validator
    {
        return $validator;
    }
}