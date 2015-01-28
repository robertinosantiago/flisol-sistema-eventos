<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<h1><?php echo __('Events available') ?></h1>
<?php if (empty($events)): ?>
    <div class="panel panel-default">
        <div class="panel-body">
            <?php echo __('No events available'); ?>
        </div>
    </div>
<?php else: ?>
    <?php foreach ($events as $event): ?>
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-10">
                        <h4><strong><?php echo $event['Event']['title']; ?></strong></h4>
                        <p class="small"><?php echo $event['Event']['description']; ?></p>
                        <p class="small"><strong><?php echo __('Period of registration'); ?>: </strong><?php echo $event['Event']['registration']; ?></p>
                        <p class="small"><strong><?php echo __('Period of event'); ?>: </strong><?php echo $event['Event']['period']; ?></p>
                    </div>
                    <div class="col-lg-2">
                        <?php echo $this->Html->link(__('Details'), array('controller' => 'Events', 'action' => 'details', $event['Event']['id']), array('class' => 'btn btn-success btn-block')) ?>
                        <?php echo $this->Html->link(__('Sign up'), array('controller' => 'Events', 'action' => 'signup', $event['Event']['id']), array('class' => 'btn btn-primary btn-block')) ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>

<h1><?php echo __('Next events') ?></h1>
<?php if (empty($nextEvents)): ?>
    <div class="panel panel-default">
        <div class="panel-body">
            <?php echo __('No next events available'); ?>
        </div>
    </div>
<?php else: ?>
    <?php foreach ($nextEvents as $event): ?>
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-10">
                        <h4><strong><?php echo $event['Event']['title']; ?></strong></h4>
                        <p class="small"><?php echo $event['Event']['description']; ?></p>
                        <p class="small"><strong><?php echo __('Period of registration'); ?>: </strong><?php echo $event['Event']['registration']; ?></p>
                        <p class="small"><strong><?php echo __('Period of event'); ?>: </strong><?php echo $event['Event']['period']; ?></p>
                    </div>
                    <div class="col-lg-2">
                        <?php echo $this->Html->link(__('Sign up'), array('controller' => 'Events', 'action' => 'signup', $event['Event']['id']), array('class' => 'btn btn-primary btn-block')) ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>
