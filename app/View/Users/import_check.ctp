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
    <?php echo __('Por favor, confirme os dados a serem importados.'); ?>
</div>

<?php echo $this->Form->create(null, array('url' => array('controller' => 'Users', 'action' => 'saveImport'), 'class' => 'form-horizontal', 'role' => 'form', 'inputDefaults' => array('label' => false, 'div' => false))); ?>
<?php foreach ($this->data as $key => $value): ?>
    <div class="panel panel-default">
        <div class="panel-body">
            <button type="button" class="close" data-dismiss="alert">&times;</button>

            <div class="form-group">
                <?php echo $this->Form->label("$key.User.fullname", __('Fullname'), array()); ?>
                <?php echo $this->Form->input("$key.User.fullname", array('name' => "data[$key][User][fullname]", 'value' => $value['User']['fullname'], 'class' => 'form-control', 'required' => 'required')); ?>
            </div>

            <div class="form-group">
                <?php echo $this->Form->label("$key.User.email", __('Email'), array()); ?>
                <?php echo $this->Form->input("$key.User.email", array('name' => "data[$key][User][email]", 'value' => $value['User']['email'], 'class' => 'form-control')); ?>
            </div>

            <div class="form-group">
                <?php echo $this->Form->label("$key.User.document", __('Document'), array()); ?>
                <?php echo $this->Form->input("$key.User.document", array('name' => "data[$key][User][document]", 'value' => $value['User']['document'], 'class' => 'form-control', 'required' => 'required')); ?>
            </div>

            <div class="form-group">
                <?php echo $this->Form->label("$key.User.phone", __('Phone'), array()); ?>
                <?php echo $this->Form->input("$key.User.phone", array('name' => "data[$key][User][phone]", 'value' => $value['User']['phone'], 'class' => 'form-control')); ?>
            </div>
        </div>
    </div>
<?php endforeach; ?>

<button type="submit" class="btn btn-sm btn-primary">
    <i class="fa fa-save"></i>  <?php echo __('Save'); ?>
</button>

<a href="<?php echo $this->Session->read('urlBack'); ?>" class="btn btn-sm btn-default">
    <i class="fa fa-undo"></i> <?php echo __('Cancel'); ?>
</a>

<?php echo $this->Form->end(); ?>