<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Student> $student
 */
?>
<div class="student index content">
    <?= $this->Html->link(__('New Student'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Student') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('student_id') ?></th>
                    <th><?= $this->Paginator->sort('user_id') ?></th>
                    <th><?= $this->Paginator->sort('full_name') ?></th>
                    <th><?= $this->Paginator->sort('no_student') ?></th>
                    <th><?= $this->Paginator->sort('gender') ?></th>
                    <th><?= $this->Paginator->sort('semester') ?></th>
                    <th><?= $this->Paginator->sort('address_1') ?></th>
                    <th><?= $this->Paginator->sort('address_2') ?></th>
                    <th><?= $this->Paginator->sort('posscode') ?></th>
                    <th><?= $this->Paginator->sort('state') ?></th>
                    <th><?= $this->Paginator->sort('phone_number') ?></th>
                    <th><?= $this->Paginator->sort('email_address') ?></th>
                    <th><?= $this->Paginator->sort('created_at') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($student as $student): ?>
                <tr>
                    <td><?= $this->Number->format($student->student_id) ?></td>
                    <td><?= $student->hasValue('user') ? $this->Html->link($student->user->username, ['controller' => 'Users', 'action' => 'view', $student->user->user_id]) : '' ?></td>
                    <td><?= h($student->full_name) ?></td>
                    <td><?= h($student->no_student) ?></td>
                    <td><?= h($student->gender) ?></td>
                    <td><?= h($student->semester) ?></td>
                    <td><?= h($student->address_1) ?></td>
                    <td><?= h($student->address_2) ?></td>
                    <td><?= h($student->posscode) ?></td>
                    <td><?= h($student->state) ?></td>
                    <td><?= h($student->phone_number) ?></td>
                    <td><?= h($student->email_address) ?></td>
                    <td><?= h($student->created_at) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $student->student_id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $student->student_id]) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $student->student_id],
                            [
                                'method' => 'delete',
                                'confirm' => __('Are you sure you want to delete # {0}?', $student->student_id),
                            ]
                        ) ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(__('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')) ?></p>
    </div>
</div>