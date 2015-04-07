<div style="<?php if ($teacher['Teacher']['has_back'] == 1): ?> page-break-after: always; <?php endif; ?> width: 100%; height: 99%; margin: 0 auto; padding: 0; border: 0; background-image: url(<?php echo $base64; ?>)">
    <div class="certificate-fullname" style="margin: 0 auto; z-index: 1000; position: absolute; top: <?php echo $teacher['Teacher']['fullname_position']; ?>px; width: 100%; text-align: center; padding: 0; border: 0;">
        <span style="font-size: 18pt; margin: 0; padding: 0; border: 0;"><?php echo strtoupper($user['User']['fullname']); ?></span>
    </div>
    <div class="certificate-auth" style="margin: 0; padding: 0; border: 0;">
        <h5 style="margin: 0; padding: 0; border: 0; position: absolute; top: 96%">
            <?php echo __('The authenticity of this document may be verified at this link:'); ?><br>
            <?php echo $this->Html->url(array('controller' => 'Editions', 'action' => 'verifyCertificate', 'teacher', $teacher['Teacher']['id'], $teacherUser['TeacherUser']['hash_code']), true); ?>
        </h5>
    </div>

</div>
<?php if ($teacher['Teacher']['has_back'] == 1): ?>
<div style="width: 100%; height: 100%; margin: 0 auto; padding: 0; border: 0;">
    <div>
        <?php echo $teacher['Teacher']['back_content']; ?>
    </div>
    <div class="certificate-auth" style="margin: 0; padding: 0; border: 0;">
        <h5 style="margin: 0; padding: 0; border: 0; position: absolute; top: 96%">
            <?php echo __('The authenticity of this document may be verified at this link:'); ?><br>
            <?php echo $this->Html->url(array('controller' => 'Editions', 'action' => 'verifyCertificate', 'teacher', $teacher['Teacher']['id'], $teacherUser['TeacherUser']['hash_code']), true); ?>
        </h5>
    </div>
</div>
<?php endif; ?>