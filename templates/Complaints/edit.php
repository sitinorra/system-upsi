<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Complaint $complaint
 * @var string[]|\Cake\Collection\CollectionInterface $students
 * @var string[]|\Cake\Collection\CollectionInterface $types
 * @var string[]|\Cake\Collection\CollectionInterface $categories
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $complaint->complaint_id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $complaint->complaint_id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Complaints'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="complaints form content">
            <?= $this->Form->create($complaint) ?>
            <fieldset>
                <legend><?= __('Edit Complaint') ?></legend>
                <?php
                    echo $this->Form->control('student_id', ['options' => $students, 'empty' => true]);
                    echo $this->Form->control('complainant_name');
                    echo $this->Form->control('complainant_phone');
                    echo $this->Form->control('complainant_email');
                    echo $this->Form->control('type_id', ['options' => $types, 'empty' => true]);
                    echo $this->Form->control('category_id', ['options' => $categories, 'empty' => true]);
                    echo $this->Form->control('submission_date', ['empty' => true]);
                    echo $this->Form->control('description');
                    echo $this->Form->control('status');
                    echo $this->Form->control('is_confidential');
                    echo $this->Form->control('created_at');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
