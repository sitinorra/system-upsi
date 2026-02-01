<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ComplaintStatus $complaintStatus
 * @var string[]|\Cake\Collection\CollectionInterface $complaints
 * @var string[]|\Cake\Collection\CollectionInterface $changedByStaffs
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $complaintStatus->status_id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $complaintStatus->status_id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Complaint Status'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="complaintStatus form content">
            <?= $this->Form->create($complaintStatus) ?>
            <fieldset>
                <legend><?= __('Edit Complaint Status') ?></legend>
                <?php
                    echo $this->Form->control('complaint_id', ['options' => $complaints]);
                    echo $this->Form->control('department_section');
                    echo $this->Form->control('old_status');
                    echo $this->Form->control('new_status');
                    echo $this->Form->control('changed_by_staff_id', ['options' => $changedByStaffs, 'empty' => true]);
                    echo $this->Form->control('remarks');
                    echo $this->Form->control('changed_at');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
