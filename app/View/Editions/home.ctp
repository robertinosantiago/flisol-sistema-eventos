<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<h1><?php echo __('Editions available') ?></h1>
<?php if (empty($editions)): ?>
    <div class="panel panel-default">
        <div class="panel-body">
            <?php echo __('No editions available'); ?>
        </div>
    </div>
<?php else: ?>
    <?php foreach ($editions as $edition): ?>
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-10">
                        <h4><strong><?php echo $edition['Edition']['year']; ?></strong></h4>
                        <p class="small"><strong><?php echo __('Period of registration'); ?>: </strong><?php echo $edition['Edition']['registration']; ?></p>
                        <p class="small"><strong><?php echo __('Date'); ?>: </strong><?php echo $edition['Edition']['dateText']; ?></p>
                    </div>
                    <div class="col-lg-2">
                        <?php if ($edition['Edition']['userIsRegistered']): ?>
                            <button class="btn btn-default" disabled="disabled"><?php echo __('User already enrolled'); ?></button>
                        <?php else: ?>
                            <?php echo $this->Html->link(__('Sign up'), array('controller' => 'Editions', 'action' => 'signup', $edition['Edition']['id']), array('class' => 'btn btn-primary btn-block')) ?>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <h4><?php echo __('Courses available for this edition') ?></h4>
                    </div>

                </div>
                <?php foreach ($edition['Edition']['Courses'] as $edition): ?>
                    <div class="panel panel-default">
                        <div class="panel-body">    
                            <div class="row">
                                <div class="col-lg-10">
                                    <h5><strong><?php echo $edition['Course']['title']; ?></strong></h5> 
                                    <p class="small"><strong><?php echo __('Duration'); ?>: </strong> <?php echo __('%d hours', $edition['Course']['hours']); ?></p>
                                    <p class="small"><strong><?php echo __('Maximum of students'); ?>: </strong><?php echo $edition['Course']['maximum_of_students']; ?></p>
                                    <p class="small"><strong><?php echo __('Users registered'); ?>: </strong><?php echo $edition['Course']['usersRegistered']; ?></p>
                                        <?php if (!empty($edition['Course']['prerequisite'])): ?>
                                        <p class="small"><strong><?php echo __('Prerequisites'); ?>:</strong></p>
                                        <?php echo $edition['Course']['prerequisite']; ?>
                                    <?php endif; ?>
                                </div>
                                <div class="col-lg-2">
                                    <?php if ($edition['Course']['userIsRegistered']): ?>
                                        <button class="btn btn-block btn-default" disabled="disabled"><?php echo __('User already enrolled'); ?></button>
                                    <?php elseif ($edition['Course']['overLimitCourse']): ?>
                                        <button class="btn btn-block btn-default" disabled="disabled"><?php echo __('Over limit'); ?></button>
                                    <?php else: ?>
                                        <?php if (empty($edition['Course']['prerequisite'])): ?>
                                            <?php echo $this->Html->link(__('Sign up'), array('controller' => 'Editions', 'action' => 'signupCourse', $edition['Course']['id']), array('class' => 'btn btn-success btn-block')) ?>
                                        <?php else: ?>
                                            <a data-toggle="modal" data-target="#modelPrerequisites" href="<?php echo $this->Html->url(array('controller' => 'Editions', 'action' => 'prerequisitesCourse', $edition['Course']['id'])); ?>" class="btn btn-block btn-success">
                                                <?php echo __('Sign up'); ?>
                                            </a>
                                        <?php endif; ?>
                                    <?php endif; ?>

                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<?php $this->start('scripts'); ?>
<script type="text/javascript">
    $('body').on('hidden.bs.modal', '.modal', function () {
        $(this).removeData('bs.modal');
    });
</script>
<?php $this->end(); ?>


<div class="modal fade" id="modelPrerequisites" tabindex="-1" role="dialog" aria-labelledby="modalPrerequisitesTitle" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

        </div>
    </div>
</div>
