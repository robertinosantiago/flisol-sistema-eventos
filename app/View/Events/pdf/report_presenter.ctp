<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$i = 1;
?>

<table>
    <thead>
        <tr>
            <th style="width: 20%">
                <?php echo $this->Html->image('ufpr_logo.png', array('fullBase' => true, 'height' => 55, 'alt' => 'UFPR Logo')); ?>
            </th>
            <th style="width: 80%; text-align: center">
                <strong>
                    <?php echo $event['Event']['title']; ?>
                </strong>
            </th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td colspan="2">
                <table>
                    <thead>
                        <tr>
                            <th colspan="4" style="text-align: center;">
                                <?php echo __('List of presenters'); ?>
                            </th>
                        </tr>
                        <tr>
                            <th style="width: 5%"></th>
                            <th style="width: 25%"><strong><?php echo __('Full name'); ?></strong></th>
                            <th style="width: 30%"><strong><?php echo __('Title of presentation'); ?></strong></th>
                            <th style="width: 20%"><strong><?php echo __('Document'); ?></strong></th>
                            <th style="width: 20%"><strong><?php echo __('Signature'); ?></strong></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($records as $record) : ?>
                        <tr style="line-height: 20px; ">
                            <td><?php echo $i++; ?></td>
                            <td><?php echo ucwords(strtolower($record['User']['fullname'])); ?></td>
                            <td><?php echo $record['PresenterUser']['title']; ?></td>
                            <td><?php echo $record['User']['document']; ?></td>
                            <td style="border-bottom: 1px solid #000"></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
    <tfoot>
        <tr>
            <td colspan="2">
                <?php echo __('Total of presenters'); ?>: <?php echo $count; ?>
            </td>
        </tr>
    </tfoot>
</table>

