<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ComplaintStatus $complaintStatus
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Complaint Status'), ['action' => 'edit', $complaintStatus->status_id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Complaint Status'), ['action' => 'delete', $complaintStatus->status_id], ['confirm' => __('Are you sure you want to delete # {0}?', $complaintStatus->status_id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Complaint Status'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Complaint Status'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="complaintStatus view content">
            <h3><?= h($complaintStatus->new_status) ?></h3>
            <table>
                <tr>
                    <th><?= __('Complaint') ?></th>
                    <td><?= $complaintStatus->hasValue('complaint') ? $this->Html->link($complaintStatus->complaint->complaint_id, ['controller' => 'Complaints', 'action' => 'view', $complaintStatus->complaint->complaint_id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Old Status') ?></th>
                    <td><?= h($complaintStatus->old_status) ?></td>
                </tr>
                <tr>
                    <th><?= __('New Status') ?></th>
                    <td><?= h($complaintStatus->new_status) ?></td>
                </tr>
                <tr>
                    <th><?= __('Changed By Staff') ?></th>
                    <td><?= $complaintStatus->hasValue('changed_by_staff') ? $this->Html->link($complaintStatus->changed_by_staff->staff_name, ['controller' => 'ChangedByStaffs', 'action' => 'view', $complaintStatus->changed_by_staff->staff_id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Status Id') ?></th>
                    <td><?= $this->Number->format($complaintStatus->status_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Department Section') ?></th>
                    <td><?= $complaintStatus->department_section === null ? '' : $this->Number->format($complaintStatus->department_section) ?></td>
                </tr>
                <tr>
                    <th><?= __('Changed At') ?></th>
                    <td><?= h($complaintStatus->changed_at) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Remarks') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($complaintStatus->remarks)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>