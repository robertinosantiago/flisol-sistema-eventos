<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<h1><?php echo __('Change password'); ?></h1>

<div class="alert alert-warning">
    <strong><?php echo __('Attention:'); ?></strong>
    <?php echo __('Fields marked with the asterisk symbol (*) are required'); ?>
</div>

<?php echo $this->Form->create('User', array('action' => 'changePassword', 'role' => 'form')); ?>

<?php echo $this->Form->input('User.fullname', array('label' => __('Full name'), 'readonly' => true, 'class' => 'form-control', 'div' => 'form-group')); ?>
<?php echo $this->Form->input('User.email', array('label' => __('Email'), 'readonly' => true, 'type' => 'email', 'class' => 'form-control', 'div' => 'form-group')); ?>
<?php echo $this->Form->input('User.oldpassword', array('label' => __('Old Password'), 'type' => 'password', 'class' => 'form-control', 'div' => 'form-group')); ?>
<?php echo $this->Form->input('User.newpassword', array('label' => __('New Password'), 'type' => 'password', 'class' => 'form-control', 'div' => 'form-group')); ?>

<?php echo $this->Form->hidden('id'); ?>

<button type="submit" class="btn btn-sm btn-primary">
    <i class="fa fa-save"></i>  <?php echo __('Save'); ?>
</button>

<?php echo $this->Form->end(); ?>


