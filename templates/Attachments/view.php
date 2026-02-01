<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Attachment $attachment
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Attachment'), ['action' => 'edit', $attachment->attachment_id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Attachment'), ['action' => 'delete', $attachment->attachment_id], ['confirm' => __('Are you sure you want to delete # {0}?', $attachment->attachment_id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Attachments'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Attachment'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="attachments view content">
            <h3><?= h($attachment->file_name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Complaint') ?></th>
                    <td><?= $attachment->hasValue('complaint') ? $this->Html->link($attachment->complaint->complaint_id, ['controller' => 'Complaints', 'action' => 'view', $attachment->complaint->complaint_id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('File Name') ?></th>
                    <td><?= h($attachment->file_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('File Path') ?></th>
                    <td><?= h($attachment->file_path) ?></td>
                </tr>
                <tr>
                    <th><?= __('File Type') ?></th>
                    <td><?= h($attachment->file_type) ?></td>
                </tr>
                <tr>
                    <th><?= __('Attachment Id') ?></th>
                    <td><?= $this->Number->format($attachment->attachment_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Upload Date') ?></th>
                    <td><?= h($attachment->upload_date) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>