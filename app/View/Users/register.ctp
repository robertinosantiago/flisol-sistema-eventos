<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<h1><?php echo __('User register'); ?></h1>

<div class="alert alert-warning">
    <strong><?php echo __('Attention:'); ?></strong>
    <?php echo __('Fields marked with the asterisk symbol (*) are required'); ?>
</div>

<?php echo $this->Form->create('User', array('action' => 'saveRegister', 'role' => 'form')); ?>

<?php echo $this->Form->input('User.fullname', array('label' => __('Full name'), 'class' => 'form-control', 'div' => 'form-group')); ?>
<?php echo $this->Form->input('User.email', array('label' => __('Email'), 'type' => 'email', 'class' => 'form-control', 'div' => 'form-group')); ?>
<?php echo $this->Form->input('User.password', array('label' => __('Password'), 'class' => 'form-control', 'div' => 'form-group')); ?>
<?php echo $this->Form->input('User.document', array('label' => __('Document'), 'class' => 'form-control', 'div' => 'form-group')); ?>
<?php echo $this->Form->input('User.phone', array('label' => __('Phone'), 'type' => 'phone', 'class' => 'form-control', 'div' => 'form-group')); ?>

<?php echo $this->Form->hidden('id'); ?>

<button type="submit" class="btn btn-sm btn-primary">
    <i class="fa fa-save"></i>  <?php echo __('Save'); ?>
</button>

<?php echo $this->Form->end(); ?>


