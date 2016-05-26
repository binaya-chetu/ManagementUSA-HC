@extends('layouts.common')

@section('content')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Users List</h2>

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

            <h2 class="panel-title">Users List</h2>
        </header>
        <div class="panel-body">
          
            @if(Session::has('flash_message'))
            <div class="alert alert-success"><span class="glyphicon glyphicon-ok"></span><em>{!! session('flash_message') !!}</em></div>
            @endif	
            <div class="row">
                <div class="col-sm-6">
                    <div class="mb-md">
                        <a id="addToTable" class="btn btn-primary" href='/user/addUser'>Add User <i class="fa fa-plus"></i></a>
                    </div>
                </div>
            </div>
            <table class="table table-bordered table-striped mb-none" id="datatable-default">
                <thead>
                    <tr>
                        <th>Sr. No.</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Role</th>
                        @if( Auth::user()->role == 1 )
                        <th>Status</th>
                        @endif
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 0; ?>
                    @foreach ($users as $user)
                    <tr class="gradeX">
                        <td>{{ ++$i }}</td>
                        <td><a class="defaultColor" href="/user/viewUser/{{ base64_encode($user->id) }}">{{ $user->first_name }} {{ $user->last_name }}</a></td>
                        <td><a class="defaultColor" href="/user/viewUser/{{ base64_encode($user->id) }}">{{ $user->email }}</a></td>
                        <td> {{ $user['roleName']->role_title }}</td>
                        @if( Auth::user()->role == 1 )
                        <td>
                            <div class="switch switch-sm switch-primary user_status" >
                                <input type="checkbox" name="switch" <?php if($user->status === 1) { echo "checked"; }  ?> class="check_div" data-plugin-ios-switch user_id ="{{ $user->id }}" />
                            </div>
                        </td>
                        @endif
                        <td class="actions">
                            <a href="/user/editUser/{{ base64_encode($user->id) }}" class="on-default" title="Edit"><i class="fa fa-pencil"></i></a> |
                            <a href="javascript:void(0)" data-href="/user/deleteUser/{{ base64_encode($user->id) }}" class="on-default remove-row confirmation-callback"><i class="fa fa-trash-o"></i></a> 
                        </td>
                    </tr>
                    @endforeach 
                </tbody>
            </table>
        </div>
    </section>
</section>
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection