<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<h1><?php echo $event['Edition']['year']; ?></h1>
<div class="panel panel-default">
    <div class="panel-body">
        <p><?php echo $event['Edition']['description']; ?></p>
        <p class="small"><strong><?php echo __('Period of registration'); ?>: </strong><?php echo $event['Edition']['registration']; ?></p>
        <p class="small"><strong><?php echo __('Date of event'); ?>: </strong><?php echo $event['Edition']['date_of']; ?></p>
    </div>
</div>
