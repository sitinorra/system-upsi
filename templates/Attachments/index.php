<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\Attachment> $attachments
 */
?>
<div class="attachments index content">
    <?= $this->Html->link(__('New Attachment'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Attachments') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('attachment_id') ?></th>
                    <th><?= $this->Paginator->sort('complaint_id') ?></th>
                    <th><?= $this->Paginator->sort('file_name') ?></th>
                    <th><?= $this->Paginator->sort('file_path') ?></th>
                    <th><?= $this->Paginator->sort('file_type') ?></th>
                    <th><?= $this->Paginator->sort('upload_date') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($attachments as $attachment): ?>
                <tr>
                    <td><?= $this->Number->format($attachment->attachment_id) ?></td>
                    <td><?= $attachment->hasValue('complaint') ? $this->Html->link($attachment->complaint->complaint_id, ['controller' => 'Complaints', 'action' => 'view', $attachment->complaint->complaint_id]) : '' ?></td>
                    <td><?= h($attachment->file_name) ?></td>
                    <td><?= h($attachment->file_path) ?></td>
                    <td><?= h($attachment->file_type) ?></td>
                    <td><?= h($attachment->upload_date) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $attachment->attachment_id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $attachment->attachment_id]) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $attachment->attachment_id],
                            [
                                'method' => 'delete',
                                'confirm' => __('Are you sure you want to delete # {0}?', $attachment->attachment_id),
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