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
                        <?php echo $this->Html->link(__('Sign up'), array('controller' => 'Editions', 'action' => 'signup', $edition['Edition']['id']), array('class' => 'btn btn-primary btn-block')) ?>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php endif; ?>


