<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?php if ($error): ?>
    <h1><?php echo __('Image not found'); ?></h1>
<?php else: ?>
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
        <h4 class="modal-title" id="modalListenerTitle"><?php echo __('Image preview'); ?></h4>
    </div>
    <div class="modal-body">
        <div style="width: 100%; margin: 0 auto; text-align: center">
            <img class="img-thumbnail" src="<?php echo $base64; ?>" style="border: 0; margin: 0 auto; padding: 0">
        </div>
    </div>
<?php endif; ?>
