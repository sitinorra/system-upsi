<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Attachment $attachment
 * @var string[]|\Cake\Collection\CollectionInterface $complaints
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $attachment->attachment_id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $attachment->attachment_id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Attachments'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="attachments form content">
            <?= $this->Form->create($attachment) ?>
            <fieldset>
                <legend><?= __('Edit Attachment') ?></legend>
                <?php
                    echo $this->Form->control('complaint_id', ['options' => $complaints, 'empty' => true]);
                    echo $this->Form->control('file_name');
                    echo $this->Form->control('file_path');
                    echo $this->Form->control('file_type');
                    echo $this->Form->control('upload_date');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
