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
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $complaintType->type_id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $complaintType->type_id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Complaint Types'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="complaintTypes form content">
            <?= $this->Form->create($complaintType) ?>
            <fieldset>
                <legend><?= __('Edit Complaint Type') ?></legend>
                <?php
                    echo $this->Form->control('type_name');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
