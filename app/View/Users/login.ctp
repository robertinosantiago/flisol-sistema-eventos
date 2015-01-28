<div class="row">
    <div class="col-lg-6">
        <div class="panel panel-success panel-login">
            <div class="panel-heading">
                <h2 class="form-signin-heading"><?php echo __('Login to your account'); ?></h2>
            </div>
            <div class="panel-body">
                <?php echo $this->Form->create('User', array('url' => array('controller' => 'Users', 'action' => 'login'), 'role' => 'form', 'class' => 'form-signin')); ?>

                <?php echo $this->Form->input('User.email', array('label' => false, 'type' => 'email', 'class' => 'form-control', 'div' => false, 'placeholder' => __('Email'), 'required' => true, 'autofocus' => true)); ?>
                <?php echo $this->Form->input('User.password', array('label' => false, 'type' => 'password', 'class' => 'form-control', 'div' => false, 'placeholder' => __('Password'), 'required' => true)); ?>

                <button class="btn btn-lg btn-primary btn-block" type="submit"><?php echo __('Login'); ?></button>

                <?php echo $this->Html->link(__('Recovery password'), array('controller' => 'Users', 'action' => 'recoveryPassword')) ?>

                <?php echo $this->Form->end(); ?>
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="panel panel-info panel-login">
            <div class="panel-heading">
                <h2 class="form-signin-heading"><?php echo __('New users'); ?></h2>
            </div>
            <div class="panel-body">
                <div class="form-signin">
                    <p>
                        <?php echo __('To access this site, you must be authenticated.'); ?>
                    </p>
                    <p>
                        <?php echo __('If you do not yet have active membership on this site, please register via the button below.'); ?>
                    </p>

                    <?php echo $this->Html->link(__('Register'), array('controller' => 'Users', 'action' => 'register'), array('class' => 'btn btn-lg btn-primary btn-block')); ?>
                </div>

            </div>
        </div>
    </div>


</div>

