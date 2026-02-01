<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\ComplaintStatus $complaintStatus
 * @var \Cake\Collection\CollectionInterface|string[] $complaints
 * @var \Cake\Collection\CollectionInterface|string[] $changedByStaffs
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Complaint Status'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="complaintStatus form content">
            <?= $this->Form->create($complaintStatus) ?>
            <fieldset>
                <legend><?= __('Add Complaint Status') ?></legend>
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
