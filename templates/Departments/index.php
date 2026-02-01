<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Department> $departments
 */
?>
<div class="departments index content">
    <?= $this->Html->link(__('New Department'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Departments') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('dept_id') ?></th>
                    <th><?= $this->Paginator->sort('dept_name') ?></th>
                    <th><?= $this->Paginator->sort('dept_code') ?></th>
                    <th><?= $this->Paginator->sort('dept_email') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($departments as $department): ?>
                <tr>
                    <td><?= $this->Number->format($department->dept_id) ?></td>
                    <td><?= h($department->dept_name) ?></td>
                    <td><?= h($department->dept_code) ?></td>
                    <td><?= h($department->dept_email) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $department->dept_id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $department->dept_id]) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $department->dept_id],
                            [
                                'method' => 'delete',
                                'confirm' => __('Are you sure you want to delete # {0}?', $department->dept_id),
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