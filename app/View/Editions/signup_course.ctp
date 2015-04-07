<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<h1><?php echo $course['Course']['title']; ?></h1>
<div class="panel panel-default">
    <div class="panel-body">
        <p class="small"><strong><?php echo __('hours'); ?>: </strong><?php echo $course['Course']['hours']; ?></p>
        <p class="small"><strong><?php echo __('Prerequisites'); ?>: </strong><?php echo $course['Course']['prerequisite']; ?></p>
    </div>
</div>
