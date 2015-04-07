<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<h1><?php echo __('Courses'); ?> - <?php echo __('Edition %d', $edition['Edition']['year']); ?></h1>

<div class="breadcrumb">
    <?php $this->Html->addCrumb(__('Editions'), '/Editions'); ?>
    <?php $this->Html->addCrumb(__('Courses'), '/Editions/courses/'.$edition['Edition']['id']); ?>
    <?php
    echo $this->Html->getCrumbs('&nbsp;/&nbsp;', array(
        'text' => $this->Html->tag('i', '', array('class' => 'fa fa-home')),
        'url' => array('controller' => 'Editions', 'action' => 'index'),
        'escape' => false
    ));
    ?>
</div>

<a href="<?php echo $this->Html->url(array('action' => 'formCourse', $edition['Edition']['id'])); ?>" title="<?php echo __('New') ?>" class="btn btn-sm btn-primary">
    <i class="fa fa-plus"></i> <?php echo __('New') ?>
</a>

<?php echo $this->Form->create('Edition', array('id' => 'formindex', 'action' => 'deleteManyCourses')) ?>
<table class="table table-striped table-hover table-condensed">
    <caption style="display: none;">
        <?php echo $this->Form->postLink('', array()); ?>
    </caption>
    <thead>
        <tr>
            <th class="check text-center"><input id="checkall" name="selall" type="checkbox" /></th>
            <th class="text-left"><?php echo __('Title'); ?></th>
            <th class="text-center"><?php echo __('Hours'); ?></th>
            <th class="acoes text-center"></th>
            <th class="acoes text-center"></th>
            <th class="acoes text-center"></th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($records)): ?>
        <tr>
            <td colspan="6"><?php echo __('There are no registered records'); ?></td>
        </tr>
        <?php else: ?>
            <?php foreach ($records as $record) : ?>
            <tr>
                <td class="text-center">
                    <?php echo $this->Form->checkbox('Records.id.' . $record['Course']['id'] . '', array('label' => false, 'value' => $record['Course']['id'], 'class' => 'ids', 'hiddenField' => false)); ?>
                </td>
                <td class="text-left"><?php echo $record['Course']['title']; ?></td>
                <td class="text-center"><?php echo $record['Course']['hours']; ?></td>
                <td class="text-center">
                    <?php echo $this->Form->postLink(__("<i class='fa fa-pencil'></i>"), array('action' => 'updateCourse', $record['Course']['id'], $edition['Edition']['id']), array('class' => 'btn btn-sm btn-warning', 'title' => __('Update'), 'escape' => false)); ?>
                </td>
                <td class="text-center">                    
                    <?php echo $this->Form->postLink(__("<i class='fa fa-trash-o'></i>"), array('action' => 'deleteCourse', $record['Course']['id']), array('class' => 'btn btn-sm btn-danger', 'title' => __('Delete'), 'escape' => false, 'confirm' => __('Are you sure?'))); ?>
                </td>
                                <td class="text-center">                
                    <?php echo $this->Form->postLink(__("<i class='fa fa-users'></i>"), array('action' => 'peoplesCourse', $record['Course']['id'], $edition['Edition']['id']), array('class' => 'btn btn-sm btn-success', 'title' => __('Manage peoples'), 'escape' => false)); ?>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
    <tfoot>
        <?php if (!empty($records)): ?>
        <tr>
            <th class="esquerda" colspan="6">
                <button class="btn btn-sm btn-danger" type="submit">
                    <i class="fa fa-trash-o"></i> <?php echo __('Delete selected'); ?>
                </button>
            </th>
        </tr>
        <?php endif; ?>
    </tfoot>
</table>

<?php echo $this->Form->end(); ?>

<?php $this->start('scripts'); ?>
    <?php echo $this->Html->script('script-index'); ?>
<?php $this->end(); ?>