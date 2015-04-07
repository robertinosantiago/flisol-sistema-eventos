<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<h1><?php echo __('Course'); ?></h1>

<div class="breadcrumb">
    <?php $this->Html->addCrumb(__('Editions'), '/Editions'); ?>
    <?php
    echo $this->Html->getCrumbs('&nbsp;/&nbsp;', array(
        'text' => $this->Html->tag('i', '', array('class' => 'fa fa-home')),
        'url' => array('controller' => 'Users', 'action' => 'myEditions'),
        'escape' => false
    ));
    ?>
</div>

<div class="panel panel-default">
    <div class="panel-heading"><h3><?php echo __('Course') ?></h3></div>
    <div class="panel-body">
        <p><strong><?php echo __('Title'); ?>: </strong> <?php echo $course['Course']['title']; ?></p>
    </div>
</div>
<div class="panel panel-default">
    <div class="panel-heading">
        <h3><?php echo __('Teachers') ?></h3>
    </div>
    <div class="panel-body">
        <?php echo $this->Form->create('Course', array('id' => 'TeacherUserForm', 'url' => array('controller' => 'Editions', 'action' => 'addTeacherUser'), 'role' => 'form', 'class' => 'form-inline')); ?>
        <div class="input-group">
            <div class="input-group-addon"><i class="fa fa-user"></i></div>
            <?php echo $this->Form->input('TeacherUser.name', array('label' => false, 'class' => 'form-control', 'placeholder' => __('Type a name'))); ?>
            <span class="input-group-btn">
                <button class="btn btn-primary" type="submit" id="TeacherUserButton">
                    <i class="fa fa-plus"></i> <?php echo __('Add'); ?>
                </button>
            </span>
        </div>
        <div class="input-group navbar-right">
            <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#modalReportTeacher">
                <i class="fa fa-print"></i> <?php echo __('Print'); ?>
            </button>
        </div>
        <?php echo $this->Form->hidden('TeacherUser.id'); ?>
        <?php echo $this->Form->hidden('TeacherUser.teacher_id', array('value' => $course['Teacher']['id'])); ?>

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
                <?php if (empty($teachers)): ?>
                    <tr>
                        <td colspan="5"><?php echo __('There are no registered teachers for this edition'); ?></td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($teachers as $record) : ?>
                        <tr>
                            <td><?php echo $record['User']['fullname']; ?></td>
                            <td><?php echo $record['User']['document']; ?></td>
                            <td>
                                <?php echo $this->Form->postLink(__("<i class='fa fa-trash-o'></i>"), array('controller' => 'Editions', 'action' => 'deleteTeacherUser', $record['TeacherUser']['id']), array('class' => 'btn btn-sm btn-danger', 'title' => __('Remove teacher this edition'), 'escape' => false, 'confirm' => __('Are you sure?'))); ?>
                            </td>
                            <td>
                                <?php echo $this->Form->postLink(__("<i class='fa fa-file-pdf-o'></i>"), array('controller' => 'Editions', 'action' => 'viewCertificateTeacher', 'ext' => 'pdf', $record['Teacher']['id'], $record['User']['id']), array('class' => 'btn btn-sm btn-default', 'title' => __('View certificate this teacher'), 'escape' => false)); ?>
                            </td>
                            <td>
                                <?php echo $this->Form->postLink(__("<i class='fa fa-envelope-o'></i>"), array('controller' => 'Editions', 'action' => 'sendCertificateTeacher', $record['Teacher']['id'], $record['User']['id']), array('class' => 'btn btn-sm btn-success', 'title' => __('Send certificate for teacher'), 'escape' => false)); ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="5">
                        <strong><?php echo __('Total of teachers'); ?>:</strong> <?php echo $totalOfTeachers; ?>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

<div class="modal fade" id="modalReportTeacher" tabindex="-1" role="dialog" aria-labelledby="modalReportTeacherLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?php echo $this->Html->url(array('action' => 'reportCoordinador.pdf')); ?>" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="modalReportTeacherLabel"><?php echo __('Export Teachers'); ?></h4>
                </div>
                <div class="modal-body">
                    <?php echo $this->Form->input('onlyActive', array('label' => __('Show only actives?'), 'options' => array(0 => __('No'), 1 => __('Yes')), 'default' => 1, 'class' => 'form-control', 'div' => 'form-group')); ?>
                    <?php echo $this->Form->hidden('Course.id', array('value' => $course['Course']['id'])); ?>
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
    <div class="panel-heading"><h3><?php echo __('Students') ?></h3></div>
    <div class="panel-body">
        <?php echo $this->Form->create('Course', array('id' => 'StudentUserForm', 'url' => array('controller' => 'Editions', 'action' => 'addStudentUser'), 'role' => 'form', 'class' => 'form-inline')); ?>
        <div class="input-group">
            <div class="input-group-addon"><i class="fa fa-user"></i></div>
            <?php echo $this->Form->input('StudentUser.name', array('label' => false, 'class' => 'form-control', 'placeholder' => __('Type a name'))); ?>
            <span class="input-group-btn">
                <button class="btn btn-primary" type="submit" id="StudentUserButton">
                    <i class="fa fa-plus"></i> <?php echo __('Add'); ?>
                </button>
            </span>
        </div>
        <div class="input-group navbar-right">
            <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#modalReportStudent">
                <i class="fa fa-print"></i> <?php echo __('Print'); ?>
            </button>
        </div>
        <?php echo $this->Form->hidden('StudentUser.id'); ?>
        <?php echo $this->Form->hidden('StudentUser.student_id', array('value' => $course['Student']['id'])); ?>

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
                <?php if (empty($students)): ?>
                    <tr>
                        <td colspan="6"><?php echo __('There are no registered students for this edition'); ?></td>
                    </tr>
                <?php else: ?>
                    <?php foreach ($students as $record) : ?>
                        <tr>
                            <td><?php echo $record['User']['fullname']; ?></td>
                            <td><?php echo $record['User']['document']; ?></td>
                            <td>
                                <?php echo ($record['StudentUser']['attended'] == 1 ? '' : $this->Form->postLink(__("<i class='fa fa-check'></i>"), array('controller' => 'Editions', 'action' => 'attendStudentUser', $record['Student']['id'], $record['User']['id']), array('class' => 'btn btn-sm btn-info', 'title' => __('Confirm attend for this student'), 'escape' => false))); ?>
                            </td>
                            <td>
                                <?php echo $this->Form->postLink(__("<i class='fa fa-trash-o'></i>"), array('controller' => 'Editions', 'action' => 'deleteStudentUser', $record['StudentUser']['id']), array('class' => 'btn btn-sm btn-danger', 'title' => __('Remove student this edition'), 'escape' => false, 'confirm' => __('Are you sure?'))); ?>
                            </td>
                            <td>
                                <?php echo ($record['StudentUser']['attended'] == 0 ? '' : $this->Form->postLink(__("<i class='fa fa-file-pdf-o'></i>"), array('controller' => 'Editions', 'action' => 'viewCertificateStudent', 'ext' => 'pdf', $record['Student']['id'], $record['User']['id']), array('class' => 'btn btn-sm btn-default', 'title' => __('View certificate this student'), 'escape' => false))); ?>
                            </td>
                            <td>
                                <?php echo ($record['StudentUser']['attended'] == 0 ? '' : $this->Form->postLink(__("<i class='fa fa-envelope-o'></i>"), array('controller' => 'Editions', 'action' => 'sendCertificateStudent', $record['Student']['id'], $record['User']['id']), array('class' => 'btn btn-sm btn-success', 'title' => __('Send certificate for student'), 'escape' => false))); ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php endif; ?>
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="6">
                        <strong><?php echo __('Total of students'); ?>:</strong> <?php echo $totalOfStudents; ?>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>
</div>
<div class="modal fade" id="modalReportStudent" tabindex="-1" role="dialog" aria-labelledby="modalReportStudentLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="<?php echo $this->Html->url(array('action' => 'reportStudent.pdf')); ?>" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="modalReportStudentabel"><?php echo __('Export Students'); ?></h4>
                </div>
                <div class="modal-body">
                    <?php echo $this->Form->input('onlyActive', array('label' => __('Show only actives?'), 'options' => array(0 => __('No'), 1 => __('Yes')), 'default' => 1, 'class' => 'form-control', 'div' => 'form-group')); ?>
                    <?php echo $this->Form->input('onlyVerified', array('label' => __('Show only verified?'), 'options' => array(0 => __('No'), 1 => __('Yes')), 'default' => 0, 'class' => 'form-control', 'div' => 'form-group')); ?>
                    <?php echo $this->Form->hidden('Course.id', array('value' => $course['Course']['id'])); ?>
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
        //Teacher
        $("#TeacherUserName").autocomplete({
            source: "<?php echo $this->Html->url(array('controller' => 'Users', 'action' => 'restGetUsers')); ?>",
            focus: function(edition, ui) {
                $("#TeacherUserName").val(ui.item.fullname);
                return false;
            },
            select: function(edition, ui) {
                $("#TeacherUserName").val(ui.item.fullname);
                $("#TeacherUserId").val(ui.item.id);
                return false;
            },
            change: function(edition, ui) {
                if (ui.item == null) {
                    $("#TeacherUserId").val("");
                }
                return false;
            }
        }).autocomplete("instance")._renderItem = function(ul, item) {
            return $("<li>")
                    .append("<a><strong>" + item.fullname + "</strong><br>" + item.document + "</a>")
                    .appendTo(ul);
        };

        $("#TeacherUserForm").submit(function(edition) {
            $("#TeacherUserButton").focus();

            if ($("#TeacherUserId").val() !== "") {
                return true;
            }

            if ($("#TeacherUserId").val() === "") {
                alert("<?php echo __('User not found'); ?>");
                return false;
            }

            edition.preditionDefault();
            return false;
        });

        //Presenter
        $("#PresenterUserName").autocomplete({
            source: "<?php echo $this->Html->url(array('controller' => 'Users', 'action' => 'restGetUsers')); ?>",
            focus: function(edition, ui) {
                $("#PresenterUserName").val(ui.item.fullname);
                return false;
            },
            select: function(edition, ui) {
                $("#PresenterUserName").val(ui.item.fullname);
                $("#PresenterUserId").val(ui.item.id);
                return false;
            },
            change: function(edition, ui) {
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

        $("#PresenterUserForm").submit(function(edition) {
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

            edition.preditionDefault();
            return false;
        });

        //Student
        $("#StudentUserName").autocomplete({
            source: "<?php echo $this->Html->url(array('controller' => 'Users', 'action' => 'restGetUsers')); ?>",
            focus: function(edition, ui) {
                $("#StudentUserName").val(ui.item.fullname);
                return false;
            },
            select: function(edition, ui) {
                $("#StudentUserName").val(ui.item.fullname);
                $("#StudentUserId").val(ui.item.id);
                return false;
            },
            change: function(edition, ui) {
                if (ui.item == null) {
                    $("#StudentUserId").val("");
                }
                return false;
            }
        }).autocomplete("instance")._renderItem = function(ul, item) {
            return $("<li>")
                    .append("<a><strong>" + item.fullname + "</strong><br>" + item.document + "</a>")
                    .appendTo(ul);
        };

        $("#StudentUserForm").submit(function(edition) {
            $("#StudentUserButton").focus();
            if ($("#StudentUserId").val() !== "") {
                return true;
            }
            edition.preditionDefault();
            alert("<?php echo __('User not found'); ?>");
            return false;
        });
    });
</script>


<?php $this->end(); ?>