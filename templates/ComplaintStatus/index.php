<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\ComplaintStatus> $complaintStatus
 */
?>
<div class="complaintStatus index content">
    <?= $this->Html->link(__('New Complaint Status'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Complaint Status') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('status_id') ?></th>
                    <th><?= $this->Paginator->sort('complaint_id') ?></th>
                    <th><?= $this->Paginator->sort('department_section') ?></th>
                    <th><?= $this->Paginator->sort('old_status') ?></th>
                    <th><?= $this->Paginator->sort('new_status') ?></th>
                    <th><?= $this->Paginator->sort('changed_by_staff_id') ?></th>
                    <th><?= $this->Paginator->sort('changed_at') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($complaintStatus as $complaintStatus): ?>
                <tr>
                    <td><?= $this->Number->format($complaintStatus->status_id) ?></td>
                    <td><?= $complaintStatus->hasValue('complaint') ? $this->Html->link($complaintStatus->complaint->complaint_id, ['controller' => 'Complaints', 'action' => 'view', $complaintStatus->complaint->complaint_id]) : '' ?></td>
                    <td><?= $complaintStatus->department_section === null ? '' : $this->Number->format($complaintStatus->department_section) ?></td>
                    <td><?= h($complaintStatus->old_status) ?></td>
                    <td><?= h($complaintStatus->new_status) ?></td>
                    <td><?= $complaintStatus->hasValue('changed_by_staff') ? $this->Html->link($complaintStatus->changed_by_staff->staff_name, ['controller' => 'ChangedByStaffs', 'action' => 'view', $complaintStatus->changed_by_staff->staff_id]) : '' ?></td>
                    <td><?= h($complaintStatus->changed_at) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $complaintStatus->status_id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $complaintStatus->status_id]) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $complaintStatus->status_id],
                            [
                                'method' => 'delete',
                                'confirm' => __('Are you sure you want to delete # {0}?', $complaintStatus->status_id),
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