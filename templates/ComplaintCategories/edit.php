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
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $complaintCategory->category_id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $complaintCategory->category_id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Complaint Categories'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="complaintCategories form content">
            <?= $this->Form->create($complaintCategory) ?>
            <fieldset>
                <legend><?= __('Edit Complaint Category') ?></legend>
                <?php
                    echo $this->Form->control('category_name');
                    echo $this->Form->control('description');
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
