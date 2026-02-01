<?php
/**
 * @var \App\View\AppView $this
 * @var iterable<\App\Model\Entity\ComplaintCategory> $complaintCategories
 */
?>
<div class="complaintCategories index content">
    <?= $this->Html->link(__('New Complaint Category'), ['action' => 'add'], ['class' => 'button float-right']) ?>
    <h3><?= __('Complaint Categories') ?></h3>
    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th><?= $this->Paginator->sort('category_id') ?></th>
                    <th><?= $this->Paginator->sort('category_name') ?></th>
                    <th class="actions"><?= __('Actions') ?></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($complaintCategories as $complaintCategory): ?>
                <tr>
                    <td><?= $this->Number->format($complaintCategory->category_id) ?></td>
                    <td><?= h($complaintCategory->category_name) ?></td>
                    <td class="actions">
                        <?= $this->Html->link(__('View'), ['action' => 'view', $complaintCategory->category_id]) ?>
                        <?= $this->Html->link(__('Edit'), ['action' => 'edit', $complaintCategory->category_id]) ?>
                        <?= $this->Form->postLink(
                            __('Delete'),
                            ['action' => 'delete', $complaintCategory->category_id],
                            [
                                'method' => 'delete',
                                'confirm' => __('Are you sure you want to delete # {0}?', $complaintCategory->category_id),
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