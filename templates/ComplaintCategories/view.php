<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ComplaintCategory $complaintCategory
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Complaint Category'), ['action' => 'edit', $complaintCategory->category_id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Complaint Category'), ['action' => 'delete', $complaintCategory->category_id], ['confirm' => __('Are you sure you want to delete # {0}?', $complaintCategory->category_id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Complaint Categories'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Complaint Category'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="complaintCategories view content">
            <h3><?= h($complaintCategory->category_name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Category Name') ?></th>
                    <td><?= h($complaintCategory->category_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Category Id') ?></th>
                    <td><?= $this->Number->format($complaintCategory->category_id) ?></td>
                </tr>
            </table>
            <div class="text">
                <strong><?= __('Description') ?></strong>
                <blockquote>
                    <?= $this->Text->autoParagraph(h($complaintCategory->description)); ?>
                </blockquote>
            </div>
        </div>
    </div>
</div>