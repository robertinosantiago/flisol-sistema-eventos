<h1><?php echo __('Certificate'); ?></h1>
<p><?php echo __('Hello <strong>%s</strong>!', $fullname); ?></p>
<p><?php echo __('Your participation certificate is available through the link below.') ?></p>
<p><?php echo __('Edition: <strong>%s</strong>.', $edition) ?></p>
<p>
    <?php echo $this->Html->link(__('View the certificate'), array('controller' => 'Editions', 'action' => 'getCertificate', $type, $id, $hash_code, 'full_base' => true, 'ext' => 'pdf')); ?>
</p>
<p><?php echo __('Or copy and paste this link in our browser: %s', $this->Html->url(array('controller' => 'Editions', 'action' => 'getCertificate', $type, $id, $hash_code, 'full_base' => true, 'ext' => 'pdf'), true)); ?></p>

<hr>
<h5><?php echo __('FLISoL - Festival Latino-americano de Instalação de Software Livre'); ?></h5>
<h6><?php echo __('Jandaia do Sul - Paraná - Brasil'); ?></h6>