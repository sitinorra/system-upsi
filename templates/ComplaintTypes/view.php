<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ComplaintType $complaintType
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Complaint Type'), ['action' => 'edit', $complaintType->type_id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Complaint Type'), ['action' => 'delete', $complaintType->type_id], ['confirm' => __('Are you sure you want to delete # {0}?', $complaintType->type_id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Complaint Types'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Complaint Type'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="complaintTypes view content">
            <h3><?= h($complaintType->type_name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Type Name') ?></th>
                    <td><?= h($complaintType->type_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Type Id') ?></th>
                    <td><?= $this->Number->format($complaintType->type_id) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>