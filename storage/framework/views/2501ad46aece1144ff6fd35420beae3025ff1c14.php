<?php $__env->startSection('content'); ?>
<meta name="csrf-token" content="<?php echo e(csrf_token()); ?>" />
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Call Lists</h2>

        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="index.html">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Call Lists</span></li>
            </ol>

            <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
        </div>
    </header>

    <section class="panel panel-primary">
        <header class="panel-heading">
            <div class="panel-actions">
                <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
            </div>

            <h2 class="panel-title">Call Lists</h2>
        </header>
        <div class="panel-body">
            <div class="row">
                <?php if(Session::has('flash_message')): ?>
                <div class="col-sm-12"><div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span><em> <?php echo session('flash_message'); ?></em></div></div>
                <?php endif; ?>
            </div>
            <table class="table table-bordered table-striped mb-none" id="datatable-default">
               
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Phone No.</th>
                        <th>Call Time</th>
                        <th>Source</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="table-text table-text-id"><div>1</div></td>
                        <td class="table-text">+120-964644</td>
                        <td class="table-text"> 31-05-2016 11:00am</td>
                        <td class="table-text">Advertisement</td>
                        <td class="actions">
                            <a href="#modalCall" class="on-editing save-row call_popup" title="Edit"><i class="fa fa-pencil"></i></a>
                            <a href="#" class="on-editing cancel-row"><i class="fa fa-times"></i></a>                            
                        </td>
                    </tr>
                    <tr>
                        <td class="table-text table-text-id"><div>2</div></td>
                        <td class="table-text">+120-699045</td>

                        <td class="table-text"> 31-05-2016 12:00am</td>
                        <td class="table-text">Newsletter</td>
                        <td class="actions">
                            <a href="#modalCall" class="on-editing save-row call_popup" title="Edit"><i class="fa fa-pencil"></i></a>
                            <a href="#" class="on-editing cancel-row"><i class="fa fa-times"></i></a>                            
                        </td>
                    </tr>
                    <tr>
                        <td class="table-text table-text-id"><div>3</div></td>
                        <td class="table-text">+120-756757</td>

                        <td class="table-text"> 31-05-2016 11:00am</td>
                        <td class="table-text">Digital Media</td>
                        <td class="actions">
                            <a href="#modalCall" class="on-editing save-row call_popup" title="Edit"><i class="fa fa-pencil"></i></a>
                            <a href="#" class="on-editing cancel-row"><i class="fa fa-times"></i></a>                            
                        </td>
                    </tr>
                    <tr>
                        <td class="table-text table-text-id"><div>4</div></td>
                        <td class="table-text">+120-964644</td>

                        <td class="table-text"> 30-05-2016 4:00pm</td>
                        <td class="table-text">Advertisement</td>
                        <td class="actions">
                            <a href="#" class="on-editing save-row call_popup" title="Edit"><i class="fa fa-pencil"></i></a>
                            <a href="#" class="on-editing cancel-row"><i class="fa fa-times"></i></a>                            
                        </td>
                    </tr>


                </tbody>
            </table>
        </div>
    </section>
</section>
<!-- Modal Form -->
<div id="modalCall" class="modal-block modal-block-primary mfp-hide">    
    <?php echo e(Form::open(array('url' => '#', 'method' => "post", 'class'=>'form-horizontal', 'id' => 'callStatus'))); ?>  
    <section class="panel panel-primary">
        <header class="panel-heading">
            <h2 class="panel-title">Call Status</h2>
        </header>
        <div class="panel-body">
            <div class="form-group"> 
                <?php echo e(Form::label('status', 'Status', array('class' => 'col-sm-4 control-label call_label mandatory'))); ?>

                <div class="col-sm-8"> 
                    <div class="col-sm-6"> 
                        <div class="radio-custom radio-primary"> 

                            <?php echo e(Form::radio('status', 'Set', false, ['id' => 'awesome', 'class' => 'callStatus required'])); ?>

                            <label for="awesome">Set
                            </label>
                        </div> 
                    </div> 
                    <div class="col-sm-6"> 
                        <div class="radio-custom radio-primary"> 

                            <?php echo e(Form::radio('status', 'No Set', false, ['id' => 'very-awesome', 'class' => 'callStatus required'])); ?>

                            <label for="very-awesome">No Set
                            </label> 
                        </div> 
                    </div> 
                </div> 
            </div>
            <div  id="reasonCode">
                <div class="form-group">
                    <?php echo e(Form::label('reason_code', 'Reason Code', array('class' => 'col-sm-4 control-label mandatory'))); ?>


                    <div class="col-md-6">
                        <select  class="form-control required" name="reason_code" >
                            <option value="">Choose Reason Code</option>
                            <option value="No Insurance" >No Insurance</option>
                            <option value="Talk to wife" >Talk to wife</option>
                            <option value="Information Only" >Information Only</option>
                            <option value="Cant Afford" >Cant Afford</option>
                            <option value="Think about It" >Think about It</option>
                            <option value="Wrong Number" >Wrong Number</option>
                            <option value="Scheduling Issue" >Scheduling Issue</option>
                            <option value="Advertising Call" >Advertising Call</option>
                        </select>                
                    </div>
                </div>
                <div class="form-group">
                    <?php echo e(Form::label('comment', 'Comment', array('class' => 'col-sm-4 control-label mandatory'))); ?>

                    <div class="col-md-6">
                        <?php echo e(Form::textarea('comment', null, ['class' => 'form-control required', 'placeholder' => 'Enter Comment', 'rows' => '3'])); ?>                        
                    </div>
                </div>
            </div>
        </div>
        <footer class="panel-footer">
            <div class="row">

                <div class="col-md-12 text-right">
                    <?php echo e(Form::button( 'Submit', array( 'class'=>'mb-xs mt-xs mr-xs btn btn-primary', 'type' => 'submit'))); ?>

                    <button class="btn btn-default closePop">Cancel</button>
                </div>
            </div>
        </footer>
    </section>
    <?php echo e(Form::close()); ?>

</div>
<style>
    .call_label { padding-top:0px !important; }
</style>
<script>
    $('document').ready(function() {
        $('#reasonCode').hide();
        $('#callStatus').validate();
    })
    $('#callStatus').on('submit', function() {
        return false;
    });
    $('.call_popup').on('click', function() {
        $.magnificPopup.open({
            items: {
                src: '#modalCall',
                type: 'inline'
            }
        });
    });
    $('.callStatus').on('click', function() {
        var call_value = $(this).val();
        if (call_value === 'Set') {
            $('#reasonCode').hide();
        } else {
            $('#reasonCode').show();
        }
    });

</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.common', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>