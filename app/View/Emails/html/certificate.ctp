<h1><?php echo __('Certificate'); ?></h1>
<p><?php echo __('Hello <strong>%s</strong>!', $fullname); ?></p>
<p><?php echo __('Your participation certificate is available through the link below.') ?></p>
<p><?php echo __('Event: <strong>%s</strong>.', $event) ?></p>
<p>
    <?php echo $this->Html->link(__('View the certificate'), array('controller' => 'Events', 'action' => 'getCertificate', $type, $id, $hash_code, 'full_base' => true, 'ext' => 'pdf')); ?>
</p>
<p><?php echo __('Or copy and paste this link in our browser: %s', $this->Html->url(array('controller' => 'Events', 'action' => 'getCertificate', $type, $id, $hash_code, 'full_base' => true, 'ext' => 'pdf'), true)); ?></p>

<hr>
<h5><?php echo __('Sistema de Gerenciamento de Eventos'); ?></h5>
<h6><?php echo __('Universidade Federal do Paraná'); ?></h6>
<h6><?php echo __('Campus Avançado de Jandaia do Sul'); ?></h6>