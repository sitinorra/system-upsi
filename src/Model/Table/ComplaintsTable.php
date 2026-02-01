<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Table;
use Cake\ORM\RulesChecker;
use Cake\Validation\Validator;

class ComplaintsTable extends Table
{
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('complaints');
        $this->setDisplayField('complaint_id');
        $this->setPrimaryKey('complaint_id');

        $this->addBehavior('Timestamp');

        // Define associations
        $this->belongsTo('Student', [
            'foreignKey' => 'student_id',
            'joinType' => 'LEFT',
            'className' => 'Student'
        ]);
        
        $this->belongsTo('ComplaintTypes', [
            'foreignKey' => 'type_id',
            'className' => 'ComplaintTypes'
        ]);
        
        $this->belongsTo('ComplaintCategories', [
            'foreignKey' => 'category_id',
            'className' => 'ComplaintCategories'
        ]);
    }

    public function validationDefault(Validator $validator): Validator
    {
        $validator
            ->integer('complaint_id')
            ->allowEmptyString('complaint_id', null, 'create');

        $validator
            ->integer('student_id')
            ->allowEmptyString('student_id');

        $validator
            ->integer('type_id')
            ->notEmptyString('type_id', 'Please select a complaint type');

        $validator
            ->integer('category_id')
            ->notEmptyString('category_id', 'Please select a category');

        $validator
            ->scalar('description')
            ->maxLength('description', 5000)
            ->requirePresence('description', 'create')
            ->notEmptyString('description', 'Please provide a description')
            ->minLength('description', 20, 'Description must be at least 20 characters');

        $validator
            ->scalar('status')
            ->allowEmptyString('status');

        $validator
            ->boolean('is_confidential')
            ->allowEmptyString('is_confidential');

        return $validator;
    }

    public function buildRules(RulesChecker $rules): RulesChecker
    {
        // Don't check existsIn for student_id since it can be NULL
        // $rules->add($rules->existsIn(['student_id'], 'Student'));
        
        $rules->add($rules->existsIn(['type_id'], 'ComplaintTypes'), [
            'errorField' => 'type_id',
            'message' => 'Invalid complaint type selected'
        ]);
        
        $rules->add($rules->existsIn(['category_id'], 'ComplaintCategories'), [
            'errorField' => 'category_id',
            'message' => 'Invalid category selected'
        ]);

        return $rules;
    }
}