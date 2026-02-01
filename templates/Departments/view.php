<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Department $department
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Department'), ['action' => 'edit', $department->dept_id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Department'), ['action' => 'delete', $department->dept_id], ['confirm' => __('Are you sure you want to delete # {0}?', $department->dept_id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Departments'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Department'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="departments view content">
            <h3><?= h($department->dept_name) ?></h3>
            <table>
                <tr>
                    <th><?= __('Dept Name') ?></th>
                    <td><?= h($department->dept_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('Dept Code') ?></th>
                    <td><?= h($department->dept_code) ?></td>
                </tr>
                <tr>
                    <th><?= __('Dept Email') ?></th>
                    <td><?= h($department->dept_email) ?></td>
                </tr>
                <tr>
                    <th><?= __('Dept Id') ?></th>
                    <td><?= $this->Number->format($department->dept_id) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>