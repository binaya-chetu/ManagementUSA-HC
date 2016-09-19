@extends('layouts.common')

@section('content')
<meta name="csrf-token" content="{{ csrf_token() }}" />
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Missed Call Lists</h2>

        <div class="right-wrapper pull-right">
            {!! Breadcrumbs::render('apptsetting.missedCall') !!}

            <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
        </div>
    </header>

    <section class="panel panel-primary">
        <header class="panel-heading">
            <div class="panel-actions">
                <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
            </div>

            <h2 class="panel-title">Missed Call Lists</h2>
        </header>
        <div class="panel-body">
            <div class="row">
                @if(Session::has('flash_message'))
                <div class="col-sm-12"><div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span><em> {!! session('flash_message') !!}</em></div></div>
                @endif
            </div>
            <table class="table table-bordered table-striped mb-none" id="datatable-default">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Phone No.</th>
                        <th>Call Time</th>
                        <th>Source</th>
                        <!---Niwedita: Removing Actions!>
<!--                        <th>Actions</th>-->
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="table-text table-text-id"><div>1</div></td>
                        <td class="table-text">+120-964644</td>

                        <td class="table-text"> 31-05-2016 11:00am</td>
                        <td class="table-text">Advertisement</td>
<!--                        <td class="actions">
                            <a href="#modalCall" class="on-editing save-row missedcall_popup" title="Edit"><i class="fa fa-pencil"></i></a>
                            <a href="#" class="on-editing cancel-row"><i class="fa fa-times"></i></a>                            
                        </td>-->
                    </tr>
                    <tr>
                        <td class="table-text table-text-id"><div>2</div></td>
                        <td class="table-text">+120-699045</td>

                        <td class="table-text"> 31-05-2016 12:00am</td>
                        <td class="table-text">Newsletter</td>
<!--                        <td class="actions">
                            <a href="#modalCall" class="on-editing save-row missedcall_popup" title="Edit"><i class="fa fa-pencil"></i></a>
                            <a href="#" class="on-editing cancel-row"><i class="fa fa-times"></i></a>                            
                        </td>-->
                    </tr>
                    <tr>
                        <td class="table-text table-text-id"><div>3</div></td>
                        <td class="table-text">+120-756757</td>

                        <td class="table-text"> 31-05-2016 11:00am</td>
                        <td class="table-text">Digital Media</td>
<!--                        <td class="actions">
                            <a href="#modalCall" class="on-editing save-row missedcall_popup" title="Edit"><i class="fa fa-pencil"></i></a>
                            <a href="#" class="on-editing cancel-row"><i class="fa fa-times"></i></a>                            
                        </td>-->
                    </tr>
                    <tr>
                        <td class="table-text table-text-id"><div>4</div></td>
                        <td class="table-text">+120-964644</td>

                        <td class="table-text"> 30-05-2016 4:00pm</td>
                        <td class="table-text">Advertisement</td>
                          <!---Niwedita: Removing Actions!>
<!--                        <td class="actions">
                            <a href="#" class="on-editing save-row missedcall_popup" title="Edit"><i class="fa fa-pencil"></i></a>
                            <a href="#" class="on-editing cancel-row"><i class="fa fa-times"></i></a>                            
                        </td>-->
                    </tr>


                </tbody>
            </table>
        </div>
    </section>
</section>
<!-- Modal Form -->
<div id="modalCall" class="modal-block modal-block-primary mfp-hide">    
    {{ Form::open(array('url' => '#', 'method' => "post", 'class'=>'form-horizontal', 'id' => 'callStatus')) }}  
    <section class="panel panel-primary">
        <header class="panel-heading">
            <h2 class="panel-title">Missed Call Followup</h2>
        </header>
        <div class="panel-body">            
            
        </div>
        <footer class="panel-footer">
            <div class="row">

                <div class="col-md-12 text-right">
<!--                    {{ Form::button( 'Submit', array( 'class'=>'mb-xs mt-xs mr-xs btn btn-primary', 'type' => 'submit')) }}-->
                    <button class="btn btn-default closePop">Cancel</button>
                </div>
            </div>
        </footer>
    </section>
    {{ Form::close() }}
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
    $('.missedcall_popup').on('click', function() {
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
@endsection