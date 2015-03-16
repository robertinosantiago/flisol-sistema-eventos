<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<h1><?php echo $edition['Edition']['year']; ?></h1>
<div class="panel panel-default">
    <div class="panel-body">
        <p class="small"><strong><?php echo __('Period of registration'); ?>: </strong><?php echo $edition['Edition']['registration']; ?></p>
        <p class="small"><strong><?php echo __('Date of edition'); ?>: </strong><?php echo $edition['Edition']['dateText']; ?></p>
    </div>
</div>
