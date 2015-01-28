<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<h1><?php echo __('Users'); ?></h1>

<div class="breadcrumb">
    <?php $this->Html->addCrumb(__('Users'), '/Users'); ?>
    <?php
    echo $this->Html->getCrumbs('&nbsp;/&nbsp;', array(
        'text' => $this->Html->tag('i', '', array('class' => 'fa fa-home')),
        'url' => array('controller' => 'Users', 'action' => 'myEvents'),
        'escape' => false
    ));
    ?>
</div>

<a href="<?php echo $this->Html->url(array('action' => 'form')); ?>" title="<?php echo __('New') ?>" class="btn btn-sm btn-primary">
    <i class="fa fa-plus"></i> <?php echo __('New') ?>
</a>
<a href="<?php echo $this->Html->url(array('action' => 'import')); ?>" title="<?php echo __('Import') ?>" class="btn btn-sm btn-default">
    <i class="fa fa-download"></i> <?php echo __('Import') ?>
</a>

<?php echo $this->SearchBox->makeSearchBox(array('action' => 'index'), $query, isset($activeClear)); ?>

<?php echo $this->Form->create('User', array('id' => 'formindex', 'action' => 'deleteMany')) ?>
<table class="table table-striped table-hover table-condensed">
    <caption style="display: none;">
        <?php echo $this->Form->postLink('', array()); ?>
    </caption>
    <thead>
        <tr>
            <th class="check text-center"><input id="checkall" name="selall" type="checkbox" /></th>
            <th class="text-left"><?php echo __('Fullname'); ?></th>
            <th class="text-left hidden-sm hidden-xs"><?php echo __('Document'); ?></th>
            <th class="text-center"><?php echo __('Verified'); ?></th>
            <th class="text-center"><?php echo __('Actived'); ?></th>
            <th class="acoes text-center"></th>
            <th class="acoes text-center"></th>
            <th class="acoes text-center"></th>
            <th class="acoes text-center"></th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($records)): ?>
        <tr>
            <td colspan="9"><?php echo __('There are no registered records'); ?></td>
        </tr>
        <?php else: ?>
            <?php foreach ($records as $record) : ?>
            <tr>
                <td class="text-center">
                    <?php echo $this->Form->checkbox('Records.id.' . $record['User']['id'] . '', array('label' => false, 'value' => $record['User']['id'], 'class' => 'ids', 'hiddenField' => false)); ?>
                </td>
                <td class="text-left"><?php echo $record['User']['fullname']; ?></td>
                <td class="text-left hidden-sm hidden-xs"><?php echo $record['User']['document']; ?></td>
                <td class="text-center"><?php echo $record['User']['verifiedText']; ?></td>
                <td class="text-center"><?php echo $record['User']['activeText']; ?></td>
                <td class="text-center">
                    <?php echo $this->Form->postLink(__("<i class='fa fa-pencil'></i>"), array('action' => 'update', $record['User']['id']), array('class' => 'btn btn-sm btn-warning', 'title' => __('Update'), 'escape' => false)); ?>
                </td>
                <td class="text-center">                    
                    <?php echo $this->Form->postLink(__("<i class='fa fa-trash-o'></i>"), array('action' => 'delete', $record['User']['id']), array('class' => 'btn btn-sm btn-danger', 'title' => __('Delete'), 'escape' => false, 'confirm' => __('Are you sure?'))); ?>
                </td>
                <td class="text-center">                
                    <?php echo $this->Form->postLink(__("<i class='fa fa-random'></i>"), array('action' => 'status', $record['User']['id']), array('class' => 'btn btn-sm btn-default', 'escape' => false)); ?>
                </td>
                <td class="text-center">
                    <?php echo ($record['User']['verified'] == _('Yes'))? '' : $this->Form->postLink(__("<i class='fa fa-check'></i>"), array('action' => 'verify', $record['User']['id']), array('class' => 'btn btn-sm btn-success', 'escape' => false)); ?>
                </td>
            </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
    <tfoot>
        <?php if (!empty($records)): ?>
        <tr>
            <th class="esquerda" colspan="9">
                <button class="btn btn-sm btn-danger" type="submit">
                    <i class="fa fa-trash-o"></i> <?php echo __('Delete selected'); ?>
                </button>
            </th>
        </tr>
            <td colspan="9">
                <ul class="pagination pagination-sm">
                    <?php echo $this->Paginator->numbers(array('first' => 3, 'last' => 3, 'ellipsis' => '<li class="disabled"><a>...</a></li>', 'tag' => 'li', 'currentTag' => 'a', 'currentClass' => 'active', 'modulus' => 2, 'separator' => false)); ?>
                </ul>
            </td>
        </tr>
        <?php endif; ?>
    </tfoot>
</table>

<?php echo $this->Form->end(); ?>

<?php $this->start('scripts'); ?>
    <?php echo $this->Html->script('script-index'); ?>
<?php $this->end(); ?>