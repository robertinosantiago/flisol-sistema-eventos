<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<h1><?php echo __('Verification of certificates'); ?></h1>
<p><?php echo __('The certificate with code <strong>%s</strong> is valid.', $record['hash_code']); ?></p>
<p><?php echo __('Participant: <strong>%s</strong>.', strtoupper($record['fullname'])); ?></p>
<p><?php echo __('Year of event: <strong>%s</strong>', $record['year']); ?></p>
