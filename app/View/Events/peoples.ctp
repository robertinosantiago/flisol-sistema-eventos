<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<h1><?php echo __('Event'); ?></h1>

<div class="breadcrumb">
    <?php $this->Html->addCrumb(__('Events'), '/Events'); ?>
    <?php
    echo $this->Html->getCrumbs('&nbsp;/&nbsp;', array(
        'text' => $this->Html->tag('i', '', array('class' => 'fa fa-home')),
        'url' => array('controller' => 'Users', 'action' => 'myEvents'),
        'escape' => false
    ));
    ?>
</div>

<div class="panel panel-default">
    <div class="panel-heading"><h3><?php echo __('Event') ?></h3></div>
    <div class="panel-body">
        <p><strong><?php echo __('Title'); ?>: </strong> <?php echo $event['Event']['title']; ?></p>
        <p><strong><?php echo __('Description'); ?>: </strong> <?php echo $event['Event']['description']; ?></p>

    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3><?php echo __('Coordinators') ?></h3>
    </div>
    <div class="panel-body">
        <?php echo $this->Form->create('Event', array('id' => 'CoordinatorUserForm', 'url' => array('controller' => 'Events', 'action' => 'addCoordinatorUser'), 'role' => 'form', 'class' => 'form-inline')); ?>
        <div class="input-group">
            <div class="input-group-addon"><i class="fa fa-user"></i></div>
            <?php echo $this->Form->input('CoordinatorUser.name', array('label' => false, 'class' => 'form-control', 'placeholder' => __('Type a name'))); ?>
            <span class="input-group-btn">
                <button class="btn btn-primary" type="submit" id="CoordinatorUserButton">
                    <i class="fa fa-plus"></i> <?php echo __('Add'); ?>
                </button>
            </span>
        </div>
        <div class="input-group navbar-right">
            <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#modalReportCoordinator">
                <i class="fa fa-print"></i> <?php echo __('Print'); ?>
            </button>
        </div>
        <?php echo $this->Form->hidden('CoordinatorUser.id'); ?>
        <?php echo $this->Form->hidden('CoordinatorUser.coordinator_id', array('value' => $event['Coordinator']['id'])); ?>

        <?php echo $this->Form->end(); ?>

        <table class="table table-striped table-hover table-condensed">
            <caption style="display: none;">
                <?php echo $this->Form->postLink('', array()); ?>
            </caption>
            <thead>
                <tr>
                    <th class="text-left"><?php echo __('Name'); ?></th>
                    <th class="text-left"><?php echo __('Document'); ?></th>
                    <th class="acoes text-center"></th>
                    <th class="acoes text-center"></th>
                    <th class="acoes text-center"></th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($coordinators)): ?>
                    <tr>
                        <td colspan="5"><?php echo __('There are no registered coordinators for this event'); ?></td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($coordinators as $record) : ?>
                        <tr>
                            <td><?php echo $record['User']['fullname']; ?></td>
                            <td><?php echo $record['User']['document']; ?></td>
                            <td>
                                <?php echo $this->Form->postLink(__("<i class='fa fa-trash-o'></i>"), array('controller' => 'Events', 'action' => 'deleteCoordinatorUser', $record['CoordinatorUser']['id']), array('class' => 'btn btn-sm btn-danger', 'title' => __('Remove coordinator this event'), 'escape' => false, 'confirm' => __('Are you sure?'))); ?>
                            </td>
                            <td>
                                <?php echo $this->Form->postLink(__("<i class='fa fa-file-pdf-o'></i>"), array('controller' => 'Events', 'action' => 'viewCertificateCoordinator', 'ext' => 'pdf', $record['Coordinator']['id'], $record['User']['id']), array('class' => 'btn btn-sm btn-default', 'title' => __('View certificate this coordinator'), 'escape' => false)); ?>
                            </td>
                            <td>
                                <?php echo $this->Form->postLink(__("<i class='fa fa-envelope-o'></i>"), array('controller' => 'Events', 'action' => 'sendCertificateCoordinator', $record['Coordinator']['id'], $record['User']['id']), array('class' => 'btn btn-sm btn-success', 'title' => __('Send certificate for coordinator'), 'escape' => false)); ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="5">
                        <strong><?php echo __('Total of coordinators'); ?>:</strong> <?php echo $totalOfCoordinators; ?>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<div class="modal fade" id="modalReportCoordinator" tabindex="-1" role="dialog" aria-labelledby="modalReportCoordinatorLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?php echo $this->Html->url(array('action' => 'reportCoordinador.pdf')); ?>" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="modalReportCoordinatorLabel"><?php echo __('Export Coordinators'); ?></h4>
                </div>
                <div class="modal-body">
                    <?php echo $this->Form->input('onlyActive', array('label' => __('Show only actives?'), 'options' => array(0 => __('No'), 1 => __('Yes')), 'default' => 1, 'class' => 'form-control', 'div' => 'form-group')); ?>
                    <?php echo $this->Form->hidden('Event.id', array('value' => $event['Event']['id'])); ?>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"> 
                        <i class="fa fa-print"></i> <?php echo __('Print'); ?>
                    </button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-heading"><h3><?php echo __('Presenters') ?></h3></div>
    <div class="panel-body">
        <?php echo $this->Form->create('Event', array('id' => 'PresenterUserForm', 'url' => array('controller' => 'Events', 'action' => 'addPresenterUser'), 'role' => 'form', 'class' => 'form-inline')); ?>
        <div class="input-group">
            <div class="input-group-addon"><i class="fa fa-user"></i></div>
            <?php echo $this->Form->input('PresenterUser.name', array('label' => false, 'required' => true, 'class' => 'form-control', 'placeholder' => __('Type a name'))); ?>
        </div>
        <div class="input-group">
            <div class="input-group-addon"><i class="fa fa-font"></i></div>
            <?php echo $this->Form->input('PresenterUser.title', array('label' => false, 'required' => true, 'class' => 'form-control', 'placeholder' => __('Type a title of presentation'))); ?>
            <span class="input-group-btn">
                <button class="btn btn-primary" type="submit" id="PresenterUserButton">
                    <i class="fa fa-plus"></i> <?php echo __('Add'); ?>
                </button>
            </span>
        </div>
        <div class="input-group navbar-right">
            <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#modalReportPresenter">
                <i class="fa fa-print"></i> <?php echo __('Print'); ?>
            </button>
        </div>
        <?php echo $this->Form->hidden('PresenterUser.id'); ?>
        <?php echo $this->Form->hidden('PresenterUser.presenter_id', array('value' => $event['Presenter']['id'])); ?>

        <?php echo $this->Form->end(); ?>

        <table class="table table-striped table-hover table-condensed">
            <caption style="display: none;">
                <?php echo $this->Form->postLink('', array()); ?>
            </caption>
            <thead>
                <tr>
                    <th class="text-left"><?php echo __('Name'); ?></th>
                    <th class="text-left"><?php echo __('Title'); ?></th>
                    <th class="text-left"><?php echo __('Document'); ?></th>
                    <th class="acoes text-center"></th>
                    <th class="acoes text-center"></th>
                    <th class="acoes text-center"></th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($presenters)): ?>
                    <tr>
                        <td colspan="6"><?php echo __('There are no registered presenters for this event'); ?></td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($presenters as $record) : ?>
                        <tr>
                            <td><?php echo $record['User']['fullname']; ?></td>
                            <td><?php echo $record['PresenterUser']['title']; ?></td>
                            <td><?php echo $record['User']['document']; ?></td>
                            <td>
                                <?php echo $this->Form->postLink(__("<i class='fa fa-trash-o'></i>"), array('controller' => 'Events', 'action' => 'deletePresenterUser', $record['PresenterUser']['id']), array('class' => 'btn btn-sm btn-danger', 'title' => __('Remove presenter this event'), 'escape' => false, 'confirm' => __('Are you sure?'))); ?>
                            </td>
                            <td>
                                <?php echo $this->Form->postLink(__("<i class='fa fa-file-pdf-o'></i>"), array('controller' => 'Events', 'action' => 'viewCertificatePresenter', 'ext' => 'pdf', $record['Presenter']['id'], $record['User']['id']), array('class' => 'btn btn-sm btn-default', 'title' => __('View certificate this presenter'), 'escape' => false)); ?>
                            </td>
                            <td>
                                <?php echo $this->Form->postLink(__("<i class='fa fa-envelope-o'></i>"), array('controller' => 'Events', 'action' => 'sendCertificatePresenter', $record['Event']['id'], $record['Presenter']['id'], $record['User']['id']), array('class' => 'btn btn-sm btn-success', 'title' => __('Send certificate for presenter'), 'escape' => false)); ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="6">
                        <strong><?php echo __('Total of presenters'); ?>:</strong> <?php echo $totalOfPresenters; ?>
                    </td>
                </tr>
            </tfoot>
        </table>

    </div>
</div>
<div class="modal fade" id="modalReportPresenter" tabindex="-1" role="dialog" aria-labelledby="modalReportPresenterLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?php echo $this->Html->url(array('action' => 'reportPresenter.pdf')); ?>" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="modalReportCoordinatorLabel"><?php echo __('Export Presenters'); ?></h4>
                </div>
                <div class="modal-body">
                    <?php echo $this->Form->input('onlyActive', array('label' => __('Show only actives?'), 'options' => array(0 => __('No'), 1 => __('Yes')), 'default' => 1, 'class' => 'form-control', 'div' => 'form-group')); ?>
                    <?php echo $this->Form->hidden('Event.id', array('value' => $event['Event']['id'])); ?>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"> 
                        <i class="fa fa-print"></i> <?php echo __('Print'); ?>
                    </button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="panel panel-default">
    <div class="panel-heading"><h3><?php echo __('Listeners') ?></h3></div>
    <div class="panel-body">
        <?php echo $this->Form->create('Event', array('id' => 'ListenerUserForm', 'url' => array('controller' => 'Events', 'action' => 'addListenerUser'), 'role' => 'form', 'class' => 'form-inline')); ?>
        <div class="input-group">
            <div class="input-group-addon"><i class="fa fa-user"></i></div>
            <?php echo $this->Form->input('ListenerUser.name', array('label' => false, 'class' => 'form-control', 'placeholder' => __('Type a name'))); ?>
            <span class="input-group-btn">
                <button class="btn btn-primary" type="submit" id="ListenerUserButton">
                    <i class="fa fa-plus"></i> <?php echo __('Add'); ?>
                </button>
            </span>
        </div>
        <div class="input-group navbar-right">
            <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#modalReportListener">
                <i class="fa fa-print"></i> <?php echo __('Print'); ?>
            </button>
        </div>
        <?php echo $this->Form->hidden('ListenerUser.id'); ?>
        <?php echo $this->Form->hidden('ListenerUser.listener_id', array('value' => $event['Listener']['id'])); ?>

        <?php echo $this->Form->end(); ?>

        <table class="table table-striped table-hover table-condensed">
            <caption style="display: none;">
                <?php echo $this->Form->postLink('', array()); ?>
            </caption>
            <thead>
                <tr>
                    <th class="text-left"><?php echo __('Name'); ?></th>
                    <th class="text-left"><?php echo __('Document'); ?></th>
                    <th class="acoes text-center"></th>
                    <th class="acoes text-center"></th>
                    <th class="acoes text-center"></th>
                    <th class="acoes text-center"></th>
                </tr>
            </thead>
            <tbody>
                <?php if (empty($listeners)): ?>
                    <tr>
                        <td colspan="6"><?php echo __('There are no registered listeners for this event'); ?></td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($listeners as $record) : ?>
                        <tr>
                            <td><?php echo $record['User']['fullname']; ?></td>
                            <td><?php echo $record['User']['document']; ?></td>
                            <td>
                                <?php echo ($record['ListenerUser']['attended'] == 1 ? '' : $this->Form->postLink(__("<i class='fa fa-check'></i>"), array('controller' => 'Events', 'action' => 'attendListenerUser', $record['Listener']['id'], $record['User']['id']), array('class' => 'btn btn-sm btn-info', 'title' => __('Confirm attend for this listener'), 'escape' => false))); ?>
                            </td>
                            <td>
                                <?php echo $this->Form->postLink(__("<i class='fa fa-trash-o'></i>"), array('controller' => 'Events', 'action' => 'deleteListenerUser', $record['ListenerUser']['id']), array('class' => 'btn btn-sm btn-danger', 'title' => __('Remove listener this event'), 'escape' => false, 'confirm' => __('Are you sure?'))); ?>
                            </td>
                            <td>
                                <?php echo ($record['ListenerUser']['attended'] == 0 ? '' : $this->Form->postLink(__("<i class='fa fa-file-pdf-o'></i>"), array('controller' => 'Events', 'action' => 'viewCertificateListener', 'ext' => 'pdf', $record['Listener']['id'], $record['User']['id']), array('class' => 'btn btn-sm btn-default', 'title' => __('View certificate this listener'), 'escape' => false))); ?>
                            </td>
                            <td>
                                <?php echo ($record['ListenerUser']['attended'] == 0 ? '' : $this->Form->postLink(__("<i class='fa fa-envelope-o'></i>"), array('controller' => 'Events', 'action' => 'sendCertificateListener', $record['Listener']['id'], $record['User']['id']), array('class' => 'btn btn-sm btn-success', 'title' => __('Send certificate for listener'), 'escape' => false))); ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="6">
                        <strong><?php echo __('Total of listeners'); ?>:</strong> <?php echo $totalOfListeners; ?>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
<div class="modal fade" id="modalReportListener" tabindex="-1" role="dialog" aria-labelledby="modalReportListenerLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?php echo $this->Html->url(array('action' => 'reportListener.pdf')); ?>" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="modalReportListenerabel"><?php echo __('Export Listeners'); ?></h4>
                </div>
                <div class="modal-body">
                    <?php echo $this->Form->input('onlyActive', array('label' => __('Show only actives?'), 'options' => array(0 => __('No'), 1 => __('Yes')), 'default' => 1, 'class' => 'form-control', 'div' => 'form-group')); ?>
                    <?php echo $this->Form->input('onlyVerified', array('label' => __('Show only verified?'), 'options' => array(0 => __('No'), 1 => __('Yes')), 'default' => 0, 'class' => 'form-control', 'div' => 'form-group')); ?>
                    <?php echo $this->Form->hidden('Event.id', array('value' => $event['Event']['id'])); ?>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary"> 
                        <i class="fa fa-print"></i> <?php echo __('Print'); ?>
                    </button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php echo $this->Html->css('http://code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css', array('inline' => false)); ?>

<?php $this->start('scripts'); ?>
<script src="//code.jquery.com/ui/1.11.0/jquery-ui.js"></script>
<script type="text/javascript">
    jQuery(document).ready(function() {
        //Coordinator
        $("#CoordinatorUserName").autocomplete({
            source: "<?php echo $this->Html->url(array('controller' => 'Users', 'action' => 'restGetUsers')); ?>",
            focus: function(event, ui) {
                $("#CoordinatorUserName").val(ui.item.fullname);
                return false;
            },
            select: function(event, ui) {
                $("#CoordinatorUserName").val(ui.item.fullname);
                $("#CoordinatorUserId").val(ui.item.id);
                return false;
            },
            change: function(event, ui) {
                if (ui.item == null) {
                    $("#CoordinatorUserId").val("");
                }
                return false;
            }
        }).autocomplete("instance")._renderItem = function(ul, item) {
            return $("<li>")
                    .append("<a><strong>" + item.fullname + "</strong><br>" + item.document + "</a>")
                    .appendTo(ul);
        };

        $("#CoordinatorUserForm").submit(function(event) {
            $("#CoordinatorUserButton").focus();

            if ($("#CoordinatorUserId").val() !== "") {
                return true;
            }

            if ($("#CoordinatorUserId").val() === "") {
                alert("<?php echo __('User not found'); ?>");
                return false;
            }

            event.preventDefault();
            return false;
        });

        //Presenter
        $("#PresenterUserName").autocomplete({
            source: "<?php echo $this->Html->url(array('controller' => 'Users', 'action' => 'restGetUsers')); ?>",
            focus: function(event, ui) {
                $("#PresenterUserName").val(ui.item.fullname);
                return false;
            },
            select: function(event, ui) {
                $("#PresenterUserName").val(ui.item.fullname);
                $("#PresenterUserId").val(ui.item.id);
                return false;
            },
            change: function(event, ui) {
                if (ui.item == null) {
                    $("#PresenterUserId").val("");
                }
                return false;
            }
        }).autocomplete("instance")._renderItem = function(ul, item) {
            return $("<li>")
                    .append("<a><strong>" + item.fullname + "</strong><br>" + item.document + "</a>")
                    .appendTo(ul);
        };

        $("#PresenterUserForm").submit(function(event) {
            $("#PresenterUserButton").focus();

            if ($("#PresenterUserId").val() !== "" && $("#PresenterUserTitle").val() !== "") {
                return true;
            }

            if ($("#PresenterUserId").val() === "") {
                alert("<?php echo __('User not found'); ?>");
                return false;
            }

            if ($("#PresenterUserTitle").val() === "") {
                alert("<?php echo __('Type the title of presentation, please'); ?>");
                return false;
            }

            event.preventDefault();
            return false;
        });

        //Listener
        $("#ListenerUserName").autocomplete({
            source: "<?php echo $this->Html->url(array('controller' => 'Users', 'action' => 'restGetUsers')); ?>",
            focus: function(event, ui) {
                $("#ListenerUserName").val(ui.item.fullname);
                return false;
            },
            select: function(event, ui) {
                $("#ListenerUserName").val(ui.item.fullname);
                $("#ListenerUserId").val(ui.item.id);
                return false;
            },
            change: function(event, ui) {
                if (ui.item == null) {
                    $("#ListenerUserId").val("");
                }
                return false;
            }
        }).autocomplete("instance")._renderItem = function(ul, item) {
            return $("<li>")
                    .append("<a><strong>" + item.fullname + "</strong><br>" + item.document + "</a>")
                    .appendTo(ul);
        };

        $("#ListenerUserForm").submit(function(event) {
            $("#ListenerUserButton").focus();
            if ($("#ListenerUserId").val() !== "") {
                return true;
            }
            event.preventDefault();
            alert("<?php echo __('User not found'); ?>");
            return false;
        });
    });
</script>


<?php $this->end(); ?>