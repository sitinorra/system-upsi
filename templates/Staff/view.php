<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Staff $staff
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Staff'), ['action' => 'edit', $staff->staff_id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Staff'), ['action' => 'delete', $staff->staff_id], ['confirm' => __('Are you sure you want to delete # {0}?', $staff->staff_id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Staff'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Staff'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column column-80">
        <div class="staff view content">
            <h3><?= h($staff->staff_name) ?></h3>
            <table>
                <tr>
                    <th><?= __('User') ?></th>
                    <td><?= $staff->hasValue('user') ? $this->Html->link($staff->user->username, ['controller' => 'Users', 'action' => 'view', $staff->user->user_id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Staff Name') ?></th>
                    <td><?= h($staff->staff_name) ?></td>
                </tr>
                <tr>
                    <th><?= __('No Staff') ?></th>
                    <td><?= h($staff->no_staff) ?></td>
                </tr>
                <tr>
                    <th><?= __('Position') ?></th>
                    <td><?= h($staff->position) ?></td>
                </tr>
                <tr>
                    <th><?= __('Email') ?></th>
                    <td><?= h($staff->email) ?></td>
                </tr>
                <tr>
                    <th><?= __('Phone Number') ?></th>
                    <td><?= h($staff->phone_number) ?></td>
                </tr>
                <tr>
                    <th><?= __('Staff Id') ?></th>
                    <td><?= $this->Number->format($staff->staff_id) ?></td>
                </tr>
                <tr>
                    <th><?= __('Categories') ?></th>
                    <td><?= $staff->categories === null ? '' : $this->Number->format($staff->categories) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>