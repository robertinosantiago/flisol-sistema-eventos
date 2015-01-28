<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<h1><?php echo $event['Event']['title']; ?></h1>
<div class="panel panel-default">
    <div class="panel-body">
        <p><?php echo $event['Event']['description']; ?></p>
        <p class="small"><strong><?php echo __('Period of registration'); ?>: </strong><?php echo $event['Event']['registration']; ?></p>
        <p class="small"><strong><?php echo __('Period of event'); ?>: </strong><?php echo $event['Event']['period']; ?></p>
    </div>
</div>
