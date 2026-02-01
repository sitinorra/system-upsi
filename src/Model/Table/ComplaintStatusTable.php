<?php
declare(strict_types=1);

namespace App\Model\Table;

use Cake\ORM\Query\SelectQuery;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ComplaintStatus Model
 *
 * @property \App\Model\Table\ComplaintsTable&\Cake\ORM\Association\BelongsTo $Complaints
 * @property \App\Model\Table\StaffTable&\Cake\ORM\Association\BelongsTo $ChangedByStaffs
 *
 * @method \App\Model\Entity\ComplaintStatus newEmptyEntity()
 * @method \App\Model\Entity\ComplaintStatus newEntity(array $data, array $options = [])
 * @method array<\App\Model\Entity\ComplaintStatus> newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ComplaintStatus get(mixed $primaryKey, array|string $finder = 'all', \Psr\SimpleCache\CacheInterface|string|null $cache = null, \Closure|string|null $cacheKey = null, mixed ...$args)
 * @method \App\Model\Entity\ComplaintStatus findOrCreate($search, ?callable $callback = null, array $options = [])
 * @method \App\Model\Entity\ComplaintStatus patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method array<\App\Model\Entity\ComplaintStatus> patchEntities(iterable $entities, array $data, array $options = [])
 * @method \App\Model\Entity\ComplaintStatus|false save(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method \App\Model\Entity\ComplaintStatus saveOrFail(\Cake\Datasource\EntityInterface $entity, array $options = [])
 * @method iterable<\App\Model\Entity\ComplaintStatus>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ComplaintStatus>|false saveMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\ComplaintStatus>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ComplaintStatus> saveManyOrFail(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\ComplaintStatus>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ComplaintStatus>|false deleteMany(iterable $entities, array $options = [])
 * @method iterable<\App\Model\Entity\ComplaintStatus>|\Cake\Datasource\ResultSetInterface<\App\Model\Entity\ComplaintStatus> deleteManyOrFail(iterable $entities, array $options = [])
 */
class ComplaintStatusTable extends Table
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

        $this->setTable('complaint_status');
        $this->setDisplayField('new_status');
        $this->setPrimaryKey('status_id');

        $this->belongsTo('Complaints', [
            'foreignKey' => 'complaint_id',
            'joinType' => 'INNER',
        ]);
        $this->belongsTo('ChangedByStaffs', [
            'foreignKey' => 'changed_by_staff_id',
            'className' => 'Staff',
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
            ->integer('complaint_id')
            ->notEmptyString('complaint_id');

        $validator
            ->integer('department_section')
            ->allowEmptyString('department_section');

        $validator
            ->scalar('old_status')
            ->maxLength('old_status', 50)
            ->allowEmptyString('old_status');

        $validator
            ->scalar('new_status')
            ->maxLength('new_status', 50)
            ->requirePresence('new_status', 'create')
            ->notEmptyString('new_status');

        $validator
            ->integer('changed_by_staff_id')
            ->allowEmptyString('changed_by_staff_id');

        $validator
            ->scalar('remarks')
            ->allowEmptyString('remarks');

        $validator
            ->dateTime('changed_at')
            ->allowEmptyDateTime('changed_at');

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
        $rules->add($rules->existsIn(['complaint_id'], 'Complaints'), ['errorField' => 'complaint_id']);
        $rules->add($rules->existsIn(['changed_by_staff_id'], 'ChangedByStaffs'), ['errorField' => 'changed_by_staff_id']);

        return $rules;
    }
}
