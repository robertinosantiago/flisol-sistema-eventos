<h1><?php echo __('Confirmation'); ?></h1>
<p><?php echo __('Hello <strong>%s</strong>!', $fullname); ?></p>
<p><?php echo __('To complete your registration in the site, please click on link below.') ?></p>
<p>
    <?php echo $this->Html->link(__('Confirm the registry'), array('controller' => 'Users', 'action' => 'confirmation', $hash_code_verified, 'full_base' => true)); ?>
</p>
<p><?php echo __('Or copy and paste this link in our browser: %s', $this->Html->url(array('controller' => 'Users', 'action' => 'confirmation', $hash_code_verified, 'full_base' => true), true)); ?></p>
<hr>
<h5><?php echo __('FLISoL - Festival Latino-americano de Instalação de Software Livre'); ?></h5>
<h6><?php echo __('Jandaia do Sul - Paraná - Brasil'); ?></h6>
