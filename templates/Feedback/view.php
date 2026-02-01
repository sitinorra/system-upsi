<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Feedback $feedback
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Feedback'), ['action' => 'edit', $feedback->feedback_id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Feedback'), ['action' => 'delete', $feedback->feedback_id], ['confirm' => __('Are you sure you want to delete # {0}?', $feedback->feedback_id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Feedback'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Feedback'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="feedback view content">
            <h3><?= h($feedback->feedback_id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Complaint') ?></th>
                    <td><?= $feedback->hasValue('complaint') ? $this->Html->link($feedback->complaint->complaint_id, ['controller' => 'Complaints', 'action' => 'view', $feedback->complaint->complaint_id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Staff') ?></th>
                    <td><?= $feedback->hasValue('staff') ? $this->Html->link($feedback->staff->staff_name, ['controller' => 'Staffs', 'action' => 'view', $feedback->staff->staff_id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Feedback Type') ?></th>
                    <td><?= h($feedback->feedback_type) ?></td>
                </tr>
                <tr>
                    <th><?= __('Feedback Id') ?></th>
                    <td><?= $this->Number->format($feedback->feedback_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Department') ?></th>
                    <td><?= $feedback->department === null ? '' : $this->Number->format($feedback->department) ?></td>
                </tr>
                <tr>
                    <th><?= __('Created At') ?></th>
                    <td><?= h($feedback->created_at) ?></td>
                </tr>
                <tr>
                    <th><?= __('Updated At') ?></th>
                    <td><?= h($feedback->updated_at) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Feedback Text') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($feedback->feedback_text)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>