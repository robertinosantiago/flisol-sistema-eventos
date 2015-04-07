<div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
    <h4 class="modal-title" id="modalPrerequisitesTitle"><?php echo __('Attention'); ?>!</h4>
</div>
<div class="modal-body">
    <div style="width: 100%; margin: 0 auto; text-align: center">
        <p><?php echo __('This course has prerequisites.'); ?></p>
        <?php echo $course['Course']['prerequisite']; ?>
        <p><?php echo __('Are you sure you have these prerequisites?') ?></p>
    </div>
</div>
<div class="modal-footer">
    <?php echo $this->Html->link(__('Yes, I sure!'), array('controller' => 'Editions', 'action' => 'signupCourse', $course['Course']['id']), array('class' => 'btn btn-success')) ?>
    <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo __('No'); ?></button>
</div>