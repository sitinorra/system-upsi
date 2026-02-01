<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Student $student
 * @var \Cake\Collection\CollectionInterface|string[] $users
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('List Student'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="student form content">
            <?= $this->Form->create($student) ?>
            <fieldset>
                <legend><?= __('Add Student') ?></legend>
                <?php
                    echo $this->Form->control('user_id', ['options' => $users, 'empty' => true]);
                    echo $this->Form->control('full_name');
                    echo $this->Form->control('no_student');
                    echo $this->Form->control('gender');
                    echo $this->Form->control('semester');
                    echo $this->Form->control('address_1');
                    echo $this->Form->control('address_2');
                    echo $this->Form->control('posscode');
                    echo $this->Form->control('state');
                    echo $this->Form->control('phone_number');
                    echo $this->Form->control('email_address');
                    echo $this->Form->control('created_at');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
