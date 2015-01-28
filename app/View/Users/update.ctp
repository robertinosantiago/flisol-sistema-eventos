<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<h1><?php echo __('User'); ?></h1>

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

<div class="alert alert-warning">
    <strong><?php echo __('Attention:'); ?></strong>
    <?php echo __('Fields marked with the asterisk symbol (*) are required'); ?>
</div>

<div class="panel panel-default">
    <div class="panel-heading"><h3><?php echo __('Update data') ?></h3></div>
    <div class="panel-body">
        <?php echo $this->Form->create('User', array('action' => 'save', 'role' => 'form')); ?>

        <?php echo $this->Form->input('User.fullname', array('label' => __('Full name'), 'class' => 'form-control', 'div' => 'form-group')); ?>
        <?php echo $this->Form->input('User.email', array('label' => __('Email'), 'type' => 'email', 'class' => 'form-control', 'div' => 'form-group')); ?>
        <?php echo $this->Form->input('User.document', array('label' => __('Document'), 'class' => 'form-control', 'div' => 'form-group')); ?>
        <?php echo $this->Form->input('User.phone', array('label' => __('Phone'), 'type' => 'phone', 'class' => 'form-control', 'div' => 'form-group')); ?>
        <?php echo $this->Form->input('User.role', array('label' => __('Role'), 'options' => array('user' => __('User'), 'admin' => __('Administrator')), 'default' => _('User'), 'class' => 'form-control', 'div' => 'form-group')); ?>

        <?php echo $this->Form->hidden('id'); ?>

        <button type="submit" class="btn btn-sm btn-primary">
            <i class="fa fa-save"></i>  <?php echo __('Save'); ?>
        </button>

        <a href="<?php echo $this->Session->read('urlBack'); ?>" class="btn btn-sm btn-default">
            <i class="fa fa-undo"></i> <?php echo __('Cancel'); ?>
        </a>
        <?php echo $this->Form->end(); ?>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading"><h3><?php echo __('Update password') ?></h3></div>
    <div class="panel-body">
        <?php echo $this->Form->create('User', array('action' => 'save', 'role' => 'form')); ?>

        <?php echo $this->Form->input('User.password', array('label' => __('Password'), 'value' => false, 'class' => 'form-control', 'div' => 'form-group')); ?>

        <?php echo $this->Form->hidden('id'); ?>

        <button type="submit" class="btn btn-sm btn-primary">
            <i class="fa fa-save"></i>  <?php echo __('Save'); ?>
        </button>

        <a href="<?php echo $this->Session->read('urlBack'); ?>" class="btn btn-sm btn-default">
            <i class="fa fa-undo"></i> <?php echo __('Cancel'); ?>
        </a>
        <?php echo $this->Form->end(); ?>
    </div>
</div>


