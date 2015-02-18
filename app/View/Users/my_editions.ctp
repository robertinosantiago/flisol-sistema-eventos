<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<h1><?php echo __('My participation'); ?></h1>

<div class="panel panel-default">
    <div class="panel-heading"><h3><?php echo __('Participation as a listener') ?></h3></div>
    <div class="panel-body">
        <?php if (empty($listeners)): ?>
        <strong><?php echo __('You did not participate in any event as a listener'); ?></strong>
        <?php else: ?>
        <table class="table table-striped table-hover table-condensed">
            <thead>
                <tr>
                    <th class="text-left" style="width: 50%;"><?php echo __('Event'); ?></th>
                    <th class="text-left"><?php echo __('Period'); ?></th>
                    <th class="acoes"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($listeners as $record): ?>
                <tr>
                    <td class="text-left"><?php echo $record['Event']['title']; ?></td>
                    <td class="text-left"><?php echo $record['Event']['start_date']; ?> - <?php echo $record['Event']['closing_date']; ?></td>
                    <td>
                        <?php echo ($record['ListenerUser']['attended'] == 0 ? '' : $this->Form->postLink(__("<i class='fa fa-file-pdf-o'></i>"), array('controller' => 'Events', 'action' => 'getCertificate', 'listener', $record['Listener']['id'], $record['ListenerUser']['hash_code'], 'ext' => 'pdf'), array('class' => 'btn btn-sm btn-danger', 'title' => __('View certificate this listener'), 'escape' => false))); ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php endif; ?>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading"><h3><?php echo __('Participation as a presenter') ?></h3></div>
    <div class="panel-body">
        <?php if (empty($presenters)): ?>
        <strong><?php echo __('You did not participate in any event as a presenter'); ?></strong>
        <?php else: ?>
        <table class="table table-striped table-hover table-condensed">
            <thead>
                <tr>
                    <th class="text-left" style="width: 30%;"><?php echo __('Event'); ?></th>
                    <th class="text-left" style="width: 30%;"><?php echo __('Title of presentation'); ?></th>
                    <th class="text-left"><?php echo __('Period'); ?></th>
                    <th class="acoes"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($presenters as $record): ?>
                <tr>
                    <td class="text-left"><?php echo $record['Event']['title']; ?></td>
                    <td class="text-left"><?php echo $record['PresenterUser']['title']; ?></td>
                    <td class="text-left"><?php echo $record['Event']['start_date']; ?> - <?php echo $record['Event']['closing_date']; ?></td>
                    <td>
                        <?php echo $this->Form->postLink(__("<i class='fa fa-file-pdf-o'></i>"), array('controller' => 'Events', 'action' => 'getCertificate', 'presenter', $record['Presenter']['id'], $record['PresenterUser']['hash_code'], 'ext' => 'pdf'), array('class' => 'btn btn-sm btn-danger', 'title' => __('View certificate this presenter'), 'escape' => false)); ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php endif; ?>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading"><h3><?php echo __('Participation as a coordinator') ?></h3></div>
    <div class="panel-body">
        <?php if (empty($coordinators)): ?>
        <strong><?php echo __('You did not participate in any event as a coordinator'); ?></strong>
        <?php else: ?>
        <table class="table table-striped table-hover table-condensed">
            <thead>
                <tr>
                    <th class="text-left" style="width: 50%;"><?php echo __('Event'); ?></th>
                    <th class="text-left"><?php echo __('Period'); ?></th>
                    <th class="acoes"></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($coordinators as $record): ?>
                <tr>
                    <td class="text-left"><?php echo $record['Event']['title']; ?></td>
                    <td class="text-left"><?php echo $record['Event']['start_date']; ?> - <?php echo $record['Event']['closing_date']; ?></td>
                    <td>
                        <?php echo $this->Form->postLink(__("<i class='fa fa-file-pdf-o'></i>"), array('controller' => 'Events', 'action' => 'getCertificate', 'coordinator', $record['Coordinator']['id'], $record['CoordinatorUser']['hash_code'], 'ext' => 'pdf'), array('class' => 'btn btn-sm btn-danger', 'title' => __('View certificate this coordinator'), 'escape' => false)); ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php endif; ?>
    </div>
</div>



