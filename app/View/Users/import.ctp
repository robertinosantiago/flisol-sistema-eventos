<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<h1><?php echo __('User'); ?></h1>

<div class="breadcrumb">
    <?php $this->Html->addCrumb(__('Users'), '/Users'); ?>
    <?php
    echo $this->Html->getCrumbs('&nbsp;/&nbsp;', array(
        'text' => $this->Html->tag('i', '', array('class' => 'fa fa-home')),
        'url' => array('controller' => 'Users', 'action' => 'myEvents'),
        'escape' => false
    ));
    ?>
</div>

<div class="alert alert-info" role="alert">
    <h3>Atenção</h3>
    <p>O arquivo CSV deverá conter 4 colunas separadas por vírgula (,)</p>
    <p>A primeira coluna deverá conter o nome do usuário, a segunda coluna deverá conter o email do usuário, a terceira coluna deverá conter o CPF (sem pontuação) do usuário e a quarta coluna deverá conter o telefone do usuário.</p>
    <p>A única coluna que poderá ficar vazia é a última, referente ao telefone do usuário</p>
    <p>Observe o modelo abaixo:</p>
    <div class="alert alert-warning" role="alert">
        Maria dos Santos, maria@santos.com.br, 12345678900, 4412341234<br />
        João Souza, joao@gmail.com, 11122233344, 
    </div>
</div>

<?php echo $this->Form->create('User', array('action' => 'importCheck', 'role' => 'form', 'type' => 'file')); ?>

<?php echo $this->Form->input('filecsv', array('label' => __('File CSV'), 'type' => 'file', 'div' => 'form-group', 'required' => 'required')); ?>

<button type="submit" class="btn btn-sm btn-primary">
    <i class="fa fa-save"></i>  <?php echo __('Save'); ?>
</button>

<a href="<?php echo $this->Session->read('urlBack'); ?>" class="btn btn-sm btn-default">
    <i class="fa fa-undo"></i> <?php echo __('Cancel'); ?>
</a>

<?php echo $this->Form->end(); ?>