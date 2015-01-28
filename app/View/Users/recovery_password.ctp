<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<h1><?php echo __('User'); ?></h1>

<?php echo $this->Form->create('User', array('action' => 'sendPassword', 'role' => 'form')); ?>
<?php echo $this->Form->input('User.email', array('label' => __('Please, type your email'), 'type' => 'email', 'class' => 'form-control', 'div' => 'form-group')); ?>
<?php echo $this->Form->hidden('id'); ?>

<button type="submit" class="btn btn-sm btn-primary">
    <i class="fa fa-save"></i>  <?php echo __('Send'); ?>
</button>

<?php echo $this->Form->end(); ?>
