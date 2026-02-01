<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Feedback> $feedback
 */
?>
<div class="feedback index content">
    <?= $this->Html->link(__('New Feedback'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Feedback') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('feedback_id') ?></th>
                    <th><?= $this->Paginator->sort('complaint_id') ?></th>
                    <th><?= $this->Paginator->sort('staff_id') ?></th>
                    <th><?= $this->Paginator->sort('department') ?></th>
                    <th><?= $this->Paginator->sort('feedback_type') ?></th>
                    <th><?= $this->Paginator->sort('created_at') ?></th>
                    <th><?= $this->Paginator->sort('updated_at') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($feedback as $feedback): ?>
                <tr>
                    <td><?= $this->Number->format($feedback->feedback_id) ?></td>
                    <td><?= $feedback->hasValue('complaint') ? $this->Html->link($feedback->complaint->complaint_id, ['controller' => 'Complaints', 'action' => 'view', $feedback->complaint->complaint_id]) : '' ?></td>
                    <td><?= $feedback->hasValue('staff') ? $this->Html->link($feedback->staff->staff_name, ['controller' => 'Staffs', 'action' => 'view', $feedback->staff->staff_id]) : '' ?></td>
                    <td><?= $feedback->department === null ? '' : $this->Number->format($feedback->department) ?></td>
                    <td><?= h($feedback->feedback_type) ?></td>
                    <td><?= h($feedback->created_at) ?></td>
                    <td><?= h($feedback->updated_at) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $feedback->feedback_id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $feedback->feedback_id]) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $feedback->feedback_id],
                            [
                                'method' => 'delete',
                                'confirm' => __('Are you sure you want to delete # {0}?', $feedback->feedback_id),
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