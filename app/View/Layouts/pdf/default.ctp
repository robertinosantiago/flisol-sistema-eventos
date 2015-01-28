<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//header("Content-type: application/pdf");
?>
<!DOCTYPE html>
<html>
    <head>
        <title><?php echo $title_for_layout; ?></title>
        <?php //echo $this->Html->charset(); ?>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        
        <?php

        echo $this->Html->css('pdf', array('fullBase' => true));

        //echo HtmlHelper::css('common', array('fullBase' => true));

        //echo $this->fetch('meta');
        echo $this->fetch('css');
        //echo $this->fetch('script');
        ?>
    </head>
    <body>
        <?php
        echo $content_for_layout;
        ?>
    </body>
</html>

