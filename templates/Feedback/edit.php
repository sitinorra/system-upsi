<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Feedback $feedback
 * @var string[]|\Cake\Collection\CollectionInterface $complaints
 * @var string[]|\Cake\Collection\CollectionInterface $staffs
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $feedback->feedback_id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $feedback->feedback_id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Feedback'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="feedback form content">
            <?= $this->Form->create($feedback) ?>
            <fieldset>
                <legend><?= __('Edit Feedback') ?></legend>
                <?php
                    echo $this->Form->control('complaint_id', ['options' => $complaints]);
                    echo $this->Form->control('staff_id', ['options' => $staffs, 'empty' => true]);
                    echo $this->Form->control('department');
                    echo $this->Form->control('feedback_type');
                    echo $this->Form->control('feedback_text');
                    echo $this->Form->control('created_at');
                    echo $this->Form->control('updated_at');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
