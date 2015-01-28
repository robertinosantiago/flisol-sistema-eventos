<h1><?php echo __('Confirmation'); ?></h1>
<p><?php echo __('Hello <strong>%s</strong>!', $fullname); ?></p>
<p><?php echo __('To complete your registration, please click on link below.') ?></p>
<p>
    <?php echo $this->Html->link(__('Confirm the registry'), array('controller' => 'Users', 'action' => 'confirmation', $hash_code_verified, 'full_base' => true)); ?>
</p>
<p><?php echo __('Or copy and paste this link in our browser: %s', $this->Html->url(array('controller' => 'Users', 'action' => 'confirmation', $hash_code_verified, 'full_base' => true), true)); ?></p>
<hr>
<h5><?php echo __('Sistema de Gerenciamento de Eventos'); ?></h5>
<h6><?php echo __('Universidade Federal do Paraná'); ?></h6>
<h6><?php echo __('Campus Avançado de Jandaia do Sul'); ?></h6>
