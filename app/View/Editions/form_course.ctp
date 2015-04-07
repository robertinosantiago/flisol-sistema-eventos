<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<h1><?php echo __('Course'); ?></h1>

<div class="breadcrumb">
    <?php $this->Html->addCrumb(__('Editions'), '/Editions'); ?>
    <?php $this->Html->addCrumb(__('Courses'), '/Editions/courses/' . $edition['Edition']['id']); ?>
    <?php
    echo $this->Html->getCrumbs('&nbsp;/&nbsp;', array(
        'text' => $this->Html->tag('i', '', array('class' => 'fa fa-home')),
        'url' => array('controller' => 'Users', 'action' => 'myEditions'),
        'escape' => false
    ));
    ?>
</div>

<div class="alert alert-warning">
    <strong><?php echo __('Attention:'); ?></strong>
    <?php echo __('Fields marked with the asterisk symbol (*) are required'); ?>
</div>

<?php echo $this->Form->create(null, array('url' => array('controller' => 'Editions', 'action' => 'saveCourse'), 'role' => 'form', 'type' => 'file')); ?>

<?php echo $this->Form->input('Course.title', array('label' => __('Title'), 'class' => 'form-control', 'div' => 'form-group')); ?>
<?php echo $this->Form->input('Course.hours', array('label' => __('Hours'), 'class' => 'form-control', 'div' => 'form-group')); ?>
<?php echo $this->Form->input('Course.maximum_of_students', array('label' => __('Maximum of students'), 'class' => 'form-control', 'div' => 'form-group')); ?>
<?php echo $this->Form->input('Course.prerequisite', array('label' => __('Prerequisites'), 'type' => 'textarea', 'class' => 'form-control', 'div' => 'form-group')); ?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo __('Teachers') ?></h3>
    </div>
    <div class="panel-body">
        <?php echo $this->Form->input('Teacher.file_certificate', array('label' => __('File of teachers certificate image'), 'type' => 'file', 'div' => 'form-group')); ?>
        <?php echo $this->Form->input('Teacher.fullname_position', array('label' => __('Fullname position (in pixels) in relation to the certificate of teachers'), 'class' => 'form-control', 'div' => 'form-group', 'required' => true)); ?>
        <?php echo $this->Form->input('Teacher.has_back', array('label' => __('Has content on the back of certificate?'), 'options' => array(0 => __('No'), 1 => __('Yes')), 'default' => 0, 'class' => 'form-control', 'div' => 'form-group', 'required' => true)); ?>
        <?php echo $this->Form->input('Teacher.back_content', array('label' => __('Content of back of certificate'), 'type' => 'textarea', 'class' => 'form-control', 'div' => 'form-group')); ?>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo __('Students') ?></h3>
    </div>
    <div class="panel-body">
        <?php echo $this->Form->input('Student.file_certificate', array('label' => __('File of students certificate image'), 'type' => 'file', 'div' => 'form-group')); ?>
        <?php echo $this->Form->input('Student.fullname_position', array('label' => __('Fullname position (in pixels) in relation to the certificate of students'), 'class' => 'form-control', 'div' => 'form-group')); ?>
        <?php echo $this->Form->input('Student.has_back', array('label' => __('Has content on the back of certificate?'), 'options' => array(0 => __('No'), 1 => __('Yes')), 'default' => 0, 'class' => 'form-control', 'div' => 'form-group', 'required' => true)); ?>
        <?php echo $this->Form->input('Student.back_content', array('label' => __('Content of back of certificate'), 'type' => 'textarea', 'class' => 'form-control', 'div' => 'form-group')); ?>
    </div>
</div>

<?php echo $this->Form->hidden('Edition.id', array('value' => $edition['Edition']['id'])); ?>
<?php echo $this->Form->hidden('Course.id'); ?>
<?php echo $this->Form->hidden('Teacher.id'); ?>
<?php echo $this->Form->hidden('Student.id'); ?>

<button type="submit" class="btn btn-sm btn-primary">
    <i class="fa fa-save"></i>  <?php echo __('Save'); ?>
</button>

<a href="<?php echo $this->Session->read('urlBack'); ?>" class="btn btn-sm btn-default">
    <i class="fa fa-undo"></i> <?php echo __('Cancel'); ?>
</a>

<?php echo $this->Form->end(); ?>

<?php $this->start('scripts'); ?>
<script src="//tinymce.cachefly.net/4.1/tinymce.min.js" type="text/javascript"></script>
<?php echo $this->Html->script('tinymce-lang/pt_BR.js'); ?>

<script type="text/javascript">

    tinymce.init({
        selector: "textarea",
        plugins: [
            "advlist image lists table paste textcolor colorpicker"
        ],
        image_advtab: true,
        toolbar1: "fontselect fontsizeselect | bold italic underline | alignleft aligncenter alignright alignjustify | forecolor backcolor | undo redo",
        toolbar2: "cut copy paste | bullist numlist | image | table",
        menubar: false,
        toolbar_items_size: 'small'
    });

</script>
<?php $this->end(); ?>



