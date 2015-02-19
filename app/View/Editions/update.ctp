<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<h1><?php echo __('Edition'); ?></h1>

<div class="breadcrumb">
    <?php $this->Html->addCrumb(__('Editions'), '/Editions'); ?>
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
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo __('Edition Data') ?></h3>
    </div>
    <div class="panel-body">
        <?php echo $this->Form->create('Edition', array('action' => 'save', 'role' => 'form', 'method' => 'post')); ?>

        <?php echo $this->Form->input('Edition.year', array('label' => __('Year'), 'class' => 'form-control', 'div' => 'form-group')); ?>
        <?php echo $this->Form->input('Edition.registration_begin', array('label' => __('Registration begin'), 'type' => 'date', 'class' => 'form-control', 'div' => 'form-group date-class', 'dateFormat' => 'DMY')); ?>
        <?php echo $this->Form->input('Edition.registration_end', array('label' => __('Registration end'), 'type' => 'date', 'class' => 'form-control', 'div' => 'form-group date-class', 'dateFormat' => 'DMY')); ?>
        <?php echo $this->Form->input('Edition.date_of', array('label' => __('Date of'), 'type' => 'date', 'class' => 'form-control', 'div' => 'form-group date-class', 'dateFormat' => 'DMY')); ?>

        <?php echo $this->Form->hidden('Edition.id'); ?>

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
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo __('Listeners') ?></h3>
    </div>
    <div class="panel-body">
        <div>
            <a data-toggle="modal" data-target="#modalListenerPreview" href="<?php echo $this->Html->url(array('controller' => 'Editions', 'action' => 'viewListenerImage', $edition_id)); ?>" class="btn btn-sm btn-success">
                <i class="fa fa-eye"></i> <?php echo __('View listener image certificate'); ?>
            </a>
        </div>
        <?php echo $this->Form->create('Edition', array('action' => 'saveFiles', 'role' => 'form', 'type' => 'file', 'method' => 'post')); ?>
        <?php echo $this->Form->input('Listener.file_certificate', array('label' => __('File of listeners certificate image'), 'type' => 'file', 'div' => 'form-group', 'required' => false)); ?>
        <?php echo $this->Form->input('Listener.fullname_position', array('label' => __('Fullname position (in pixels) in relation to the certificate of listeners'), 'class' => 'form-control', 'div' => 'form-group')); ?>
        <?php echo $this->Form->input('Listener.has_back', array('label' => __('Has content on the back of certificate?'), 'options' => array(0 => __('No'), 1 => __('Yes')), 'default' => 0, 'class' => 'form-control', 'div' => 'form-group', 'required' => true)); ?>
        <?php echo $this->Form->input('Listener.back_content', array('label' => __('Content of back of certificate'), 'class' => 'form-control', 'div' => 'form-group')); ?>
        <?php echo $this->Form->hidden('Edition.id'); ?>
        <?php echo $this->Form->hidden('Listener.id'); ?>

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
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo __('Coordinators') ?></h3>
    </div>
    <div class="panel-body">
        <?php if ($showButtonCoordinator): ?>
        <div>
            <a data-toggle="modal" data-target="#modalCoordinatorPreview" href="<?php echo $this->Html->url(array('controller' => 'Editions', 'action' => 'viewCoordinatorImage', $edition_id)); ?>" class="btn btn-sm btn-success">
                <i class="fa fa-eye"></i> <?php echo __('View coordinator image certificate'); ?>
            </a>
        </div>
        <?php endif; ?>
        <?php echo $this->Form->create('Edition', array('action' => 'saveFiles', 'role' => 'form', 'type' => 'file', 'method' => 'post')); ?>
        <?php echo $this->Form->input('Coordinator.file_certificate', array('label' => __('File of coordinators certificate image'), 'type' => 'file', 'div' => 'form-group')); ?>
        <?php echo $this->Form->input('Coordinator.fullname_position', array('label' => __('Fullname position (in pixels) in relation to the certificate of coordinators'), 'class' => 'form-control', 'div' => 'form-group')); ?>
        <?php echo $this->Form->input('Coordinator.has_back', array('label' => __('Has content on the back of certificate?'), 'options' => array(0 => __('No'), 1 => __('Yes')), 'default' => 0, 'class' => 'form-control', 'div' => 'form-group', 'required' => true)); ?>
        <?php echo $this->Form->input('Coordinator.back_content', array('label' => __('Content of back of certificate'), 'class' => 'form-control', 'div' => 'form-group')); ?>
        <?php echo $this->Form->hidden('Edition.id'); ?>
        <?php echo $this->Form->hidden('Coordinator.id'); ?>

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
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo __('Presenters') ?></h3>
    </div>
    <div class="panel-body">
        <?php if ($showButtonPresenter): ?>
        <div>
            <a data-toggle="modal" data-target="#modelPresenterPreview" href="<?php echo $this->Html->url(array('controller' => 'Editions', 'action' => 'viewPresenterImage', $edition_id)); ?>" class="btn btn-sm btn-success">
                <i class="fa fa-eye"></i> <?php echo __('View presenter image certificate'); ?>
            </a>
        </div>
        <?php endif; ?>
        <?php echo $this->Form->create('Edition', array('action' => 'saveFiles', 'role' => 'form', 'type' => 'file', 'method' => 'post')); ?>
        <?php echo $this->Form->input('Presenter.file_certificate', array('label' => __('File of presenters certificate image'), 'type' => 'file', 'div' => 'form-group')); ?>
        <?php echo $this->Form->input('Presenter.fullname_position', array('label' => __('Position of fullname (in pixels) in relation to the certificate of presenters'), 'class' => 'form-control', 'div' => 'form-group')); ?>
        <?php echo $this->Form->input('Presenter.title_position', array('label' => __('Position of presentation title (in pixels) in relation to the certificate of presenters'), 'class' => 'form-control', 'div' => 'form-group')); ?>
        <?php echo $this->Form->input('Presenter.has_back', array('label' => __('Has content on the back of certificate?'), 'options' => array(0 => __('No'), 1 => __('Yes')), 'default' => 0, 'class' => 'form-control', 'div' => 'form-group', 'required' => true)); ?>
        <?php echo $this->Form->input('Presenter.back_content', array('label' => __('Content of back of certificate'), 'class' => 'form-control', 'div' => 'form-group')); ?>
        <?php echo $this->Form->hidden('Edition.id'); ?>
        <?php echo $this->Form->hidden('Presenter.id'); ?>

        <button type="submit" class="btn btn-sm btn-primary">
            <i class="fa fa-save"></i>  <?php echo __('Save'); ?>
        </button>

        <a href="<?php echo $this->Session->read('urlBack'); ?>" class="btn btn-sm btn-default">
            <i class="fa fa-undo"></i> <?php echo __('Cancel'); ?>
        </a>

        <?php echo $this->Form->end(); ?>
    </div>
</div>


<?php echo $this->Form->hidden('Listener.id'); ?>
<?php echo $this->Form->hidden('Coordinator.id'); ?>
<?php echo $this->Form->hidden('Presenter.id'); ?>



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

<div class="modal fade" id="modalListenerPreview" tabindex="-1" role="dialog" aria-labelledby="modalListenerTitle" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

        </div>
    </div>
</div>

<div class="modal fade" id="modalCoordinatorPreview" tabindex="-1" role="dialog" aria-labelledby="modalCoordinatorTitle" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

        </div>
    </div>
</div>

<div class="modal fade" id="modelPresenterPreview" tabindex="-1" role="dialog" aria-labelledby="modalPresenterTitle" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

        </div>
    </div>
</div>
