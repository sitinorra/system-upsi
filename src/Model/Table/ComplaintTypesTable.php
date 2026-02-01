<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ComplaintTypes Model
 *
 * @method \App\Model\Entity\ComplaintType newEmptyEntity()
 * @method \App\Model\Entity\ComplaintType newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\ComplaintType> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ComplaintType get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\ComplaintType findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\ComplaintType patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\ComplaintType> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\ComplaintType|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\ComplaintType saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\ComplaintType>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ComplaintType>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\ComplaintType>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ComplaintType> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\ComplaintType>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ComplaintType>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\ComplaintType>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ComplaintType> deleteManyOrFail(iterable $entities, array $options = [])
 */
class ComplaintTypesTable extends Table
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

        $this->setTable('complaint_types');
        $this->setDisplayField('type_name');
        $this->setPrimaryKey('type_id');

         $this->hasMany('Complaints', [
            'foreignKey' => 'type_id',
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
            ->scalar('type_name')
            ->maxLength('type_name', 100)
            ->requirePresence('type_name', 'create')
            ->notEmptyString('type_name');

        return $validator;
    }
}
