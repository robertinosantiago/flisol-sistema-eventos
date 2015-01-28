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
<?php if (!empty($presenters)): ?>
<div class="panel panel-default">
    <div class="panel-body">
        <div class="row">
            <div class="col-lg-12">
                <h4><strong><?php echo __('Panelists'); ?></strong></h4>
                <dl>
                    <?php foreach ($presenters as $presenter): ?>
                    <dt><?php echo $presenter['PresenterUser']['title']; ?></dt>
                    <dd><?php echo $presenter['User']['fullname']; ?></dd>
                    <?php endforeach; ?>
                </dl>
                
            </div>
        </div>
    </div>
</div>
<?php endif; ?>
