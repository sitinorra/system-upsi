<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Student Model
 *
 * @property \App\Model\Table\UsersTable&\Cake\ORM\Association\BelongsTo $Users
 *
 * @method \App\Model\Entity\Student newEmptyEntity()
 * @method \App\Model\Entity\Student newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\Student> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Student get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\Student findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\Student patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\Student> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\Student|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\Student saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\Student>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Student>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Student>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Student> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Student>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Student>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\Student>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\Student> deleteManyOrFail(iterable $entities, array $options = [])
 */
class StudentTable extends Table
{
    /**
     * Initialize method
     *
     * @param array<string, mixed> $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config): void
    {
        parent::initialize($config);

        $this->setTable('student');
        $this->setDisplayField('full_name');
        $this->setPrimaryKey('student_id');

        $this->belongsTo('Users', [
            'foreignKey' => 'user_id',
            'className' => 'Users'
        ]);
        
        $this->hasMany('Complaints', [
            'foreignKey' => 'student_id',
            'className' => 'Complaints'
        ]);
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator): Validator
{
    $validator
        ->integer('student_id')
        ->allowEmptyString('student_id', null, 'create');

    $validator
        ->integer('user_id')
        ->requirePresence('user_id', 'create')
        ->notEmptyString('user_id');

    $validator
        ->scalar('full_name')
        ->maxLength('full_name', 255)
        ->allowEmptyString('full_name');

    $validator
        ->scalar('no_student')
        ->maxLength('no_student', 20)
        ->allowEmptyString('no_student');

    $validator
        ->scalar('gender')
        ->allowEmptyString('gender');

    $validator
        ->integer('semester')
        ->allowEmptyString('semester');

    $validator
        ->email('email_address')
        ->allowEmptyString('email_address');

    $validator
        ->scalar('phone_number')
        ->maxLength('phone_number', 15)
        ->allowEmptyString('phone_number');

    $validator
        ->scalar('address')
        ->allowEmptyString('address');

    $validator
        ->scalar('postcode')
        ->maxLength('postcode', 10)
        ->allowEmptyString('postcode');

    $validator
        ->scalar('city')
        ->maxLength('city', 100)
        ->allowEmptyString('city');

    $validator
        ->scalar('state')
        ->allowEmptyString('state');

    return $validator;
}

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules): RulesChecker
    {
        $rules->add($rules->existsIn(['user_id'], 'Users'), ['errorField' => 'user_id']);

        return $rules;
    }
}
