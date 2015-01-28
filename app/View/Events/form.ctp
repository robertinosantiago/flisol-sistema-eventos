<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<h1><?php echo __('Event'); ?></h1>

<div class="breadcrumb">
    <?php $this->Html->addCrumb(__('Events'), '/Events'); ?>
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

<?php echo $this->Form->create('Event', array('action' => 'save', 'role' => 'form', 'type' => 'file')); ?>

<?php echo $this->Form->input('Event.title', array('label' => __('Title'), 'class' => 'form-control', 'div' => 'form-group')); ?>
<?php echo $this->Form->input('Event.description', array('label' => __('Description'), 'class' => 'form-control', 'div' => 'form-group')); ?>
<?php echo $this->Form->input('Event.registration_begin', array('label' => __('Registration begin'), 'type' => 'text', 'data-mask' => '00/00/0000', 'class' => 'form-control', 'div' => 'form-group')); ?>
<?php echo $this->Form->input('Event.registration_end', array('label' => __('Registration end'), 'type' => 'text', 'data-mask' => '00/00/0000', 'class' => 'form-control', 'div' => 'form-group')); ?>
<?php echo $this->Form->input('Event.start_date', array('label' => __('Start date'), 'type' => 'text', 'data-mask' => '00/00/0000', 'class' => 'form-control', 'div' => 'form-group')); ?>
<?php echo $this->Form->input('Event.closing_date', array('label' => __('Closing date'), 'type' => 'text', 'data-mask' => '00/00/0000', 'class' => 'form-control', 'div' => 'form-group')); ?>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo __('Listeners') ?></h3>
    </div>
    <div class="panel-body">
        <?php echo $this->Form->input('Listener.file_certificate', array('label' => __('File of listeners certificate image'), 'type' => 'file', 'div' => 'form-group')); ?>
        <?php echo $this->Form->input('Listener.fullname_position', array('label' => __('Fullname position (in pixels) in relation to the certificate of listeners'), 'class' => 'form-control', 'div' => 'form-group', 'required' => true)); ?>
        <?php echo $this->Form->input('Listener.has_back', array('label' => __('Has content on the back of certificate?'), 'options' => array(0 => __('No'), 1 => __('Yes')), 'default' => 0, 'class' => 'form-control', 'div' => 'form-group', 'required' => true)); ?>
        <?php echo $this->Form->input('Listener.back_content', array('label' => __('Content of back of certificate'), 'class' => 'form-control', 'div' => 'form-group')); ?>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo __('Coordinators') ?></h3>
    </div>
    <div class="panel-body">
        <?php echo $this->Form->input('Coordinator.file_certificate', array('label' => __('File of coordinators certificate image'), 'type' => 'file', 'div' => 'form-group')); ?>
        <?php echo $this->Form->input('Coordinator.fullname_position', array('label' => __('Fullname position (in pixels) in relation to the certificate of coordinators'), 'class' => 'form-control', 'div' => 'form-group')); ?>
        <?php echo $this->Form->input('Coordinator.has_back', array('label' => __('Has content on the back of certificate?'), 'options' => array(0 => __('No'), 1 => __('Yes')), 'default' => 0, 'class' => 'form-control', 'div' => 'form-group', 'required' => true)); ?>
        <?php echo $this->Form->input('Coordinator.back_content', array('label' => __('Content of back of certificate'), 'class' => 'form-control', 'div' => 'form-group')); ?>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title"><?php echo __('Presenters') ?></h3>
    </div>
    <div class="panel-body">
        <?php echo $this->Form->input('Presenter.file_certificate', array('label' => __('File of presenters certificate image'), 'type' => 'file', 'div' => 'form-group')); ?>
        <?php echo $this->Form->input('Presenter.fullname_position', array('label' => __('Position of fullname (in pixels) in relation to the certificate of presenters'), 'class' => 'form-control', 'div' => 'form-group')); ?>
        <?php echo $this->Form->input('Presenter.title_position', array('label' => __('Position of presentation title (in pixels) in relation to the certificate of presenters'), 'class' => 'form-control', 'div' => 'form-group')); ?>
        <?php echo $this->Form->input('Presenter.has_back', array('label' => __('Has content on the back of certificate?'), 'options' => array(0 => __('No'), 1 => __('Yes')), 'default' => 0, 'class' => 'form-control', 'div' => 'form-group', 'required' => true)); ?>
        <?php echo $this->Form->input('Presenter.back_content', array('label' => __('Content of back of certificate'), 'class' => 'form-control', 'div' => 'form-group')); ?>
    </div>
</div>

<?php echo $this->Form->hidden('Event.id'); ?>
<?php echo $this->Form->hidden('Listener.id'); ?>
<?php echo $this->Form->hidden('Coordinator.id'); ?>
<?php echo $this->Form->hidden('Presenter.id'); ?>

<button type="submit" class="btn btn-sm btn-primary">
    <i class="fa fa-save"></i>  <?php echo __('Save'); ?>
</button>

<a href="<?php echo $this->Session->read('urlBack'); ?>" class="btn btn-sm btn-default">
    <i class="fa fa-undo"></i> <?php echo __('Cancel'); ?>
</a>

<?php echo $this->Form->end(); ?>

<?php $this->start('scripts'); ?>
<?php echo $this->Html->script('jquery.mask.min'); ?>

<script type="text/javascript" src="http://js.nicedit.com/nicEdit-latest.js"></script> <script type="text/javascript">
//<![CDATA[
    bkLib.onDomLoaded(function() {
        new nicEditor({
            buttonList: [
                'bold', 'italic', 'underline', 'left', 'center', 'right', 'justify',
                'ol', 'ul', 'subscript', 'superscript', 'hr', 'forecolor', 'bgcolor',
                'link', 'unlink'
            ]}).panelInstance('EventDescription');
        new nicEditor({
            buttonList: [
                'bold', 'italic', 'underline', 'left', 'center', 'right', 'justify',
                'ol', 'ul', 'subscript', 'superscript', 'hr', 'forecolor', 'bgcolor',
                'link', 'unlink'
            ]}).panelInstance('ListenerBackContent');
        new nicEditor({
            buttonList: [
                'bold', 'italic', 'underline', 'left', 'center', 'right', 'justify',
                'ol', 'ul', 'subscript', 'superscript', 'hr', 'forecolor', 'bgcolor',
                'link', 'unlink'
            ]}).panelInstance('CoordinatorBackContent');
        new nicEditor({
            buttonList: [
                'bold', 'italic', 'underline', 'left', 'center', 'right', 'justify',
                'ol', 'ul', 'subscript', 'superscript', 'hr', 'forecolor', 'bgcolor',
                'link', 'unlink'
            ]}).panelInstance('PresenterBackContent');
    });
//]]>
</script>

<?php $this->end(); ?>



