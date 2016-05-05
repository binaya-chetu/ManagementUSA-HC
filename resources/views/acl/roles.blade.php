@extends('layouts.common')

@section('content')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Roles List</h2>

        <div class="right-wrapper pull-right">
            <ol class="breadcrumbs">
                <li>
                    <a href="{{url('/')}}">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
            </ol>

            <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
        </div>
    </header>

    <!-- start: page -->
    <section class="panel panel-primary">
        <header class="panel-heading">
            <div class="panel-actions">
                <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
            </div>

            <h2 class="panel-title">Roles List</h2>
        </header>
        <div class="panel-body">
            @if(Session::has('flash_message'))
            <div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span><em> {!! session('flash_message') !!}</em></div>
            @endif	
            <div class="row">
                <div class="col-sm-6">
                    <div class="mb-md">
                        <a id="addToTable" class="btn btn-primary" href="{{ url('/addRole') }}"> Add Role <i class="fa fa-plus"></i></a>
                    </div>
                </div>
            </div>
            <table class="table table-bordered table-striped mb-none" id="datatable-default">
                <thead>
                    <tr>
                        <th>Sr. No</th>
                        <th>Name</th>
                        <th>Slug</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                   {{--*/ $i = 1  /*--}}
                    @foreach ($roles as $role)
                    <tr class="gradeX">
                        <td>{{ $i }}</td>
                        <td>{{ $role->role_title }}</td>
                        <td>{{ $role->role_slug }}</td>                      
                        <td><?php if($role->status == 1){ echo "Active" ; } else { echo "Inactive"; } ?></td>  
                        <td class="actions">
                           <a href="/editRole/{{ $role->id }}" class="on-default edit-row" title="Edit"><i class="fa fa-pencil"></i></a> | 
                            <a href="/listPermission/{{ $role->id }}"  class="on-default remove-row" title="Permission Setting"><i class="fa fa-wrench"></i></a> | 
                            <a href="javascript:void(0)" data-href="/deleteRole/{{ $role->id }}" class="on-default remove-row confirmation-callback"><i class="fa fa-trash-o"></i></a>
                        </td>
                    </tr>
                    <?php $i++; ?>
                    @endforeach 

                </tbody>
            </table>
        </div>
    </section>
    <!-- end: page -->
</section>
@endsection