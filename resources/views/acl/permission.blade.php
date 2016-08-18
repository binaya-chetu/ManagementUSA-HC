@extends('layouts.common')

@section('content')
<section role="main" class="content-body">
    <header class="page-header">
        <h2>Permission</h2>

        <div class="right-wrapper pull-right">
            {!! Breadcrumbs::render('acl.listPermission', $roleId) !!}
            
            <a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
        </div>
    </header>

    <div class="row">
        <div class="col-lg-12">
            <section class="panel panel-primary">
                <header class="panel-heading">
                    <div class="panel-actions">
                        <a href="#" class="panel-action panel-action-toggle" data-panel-toggle></a>
                        <a href="#" class="panel-action panel-action-dismiss" data-panel-dismiss></a>
                    </div>

                    <h2 class="panel-title">Permission List</h2>
                </header>
                <div class="panel-body">
                    <div class="row">
                        <div class="panel-group" id="accordionPrimary">
                            @foreach($permissions as $permission)
                            @if($permission->parent_id == 0)
                            {{--*/ $childs = $permission['children']  /*--}}

                            <div class="col-md-8">
                                <div class="panel panel-accordion panel-accordion-primary">
                                    <div class="panel-heading panel-custom">
                                        <h4 class="panel-title">
                                            <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordionPrimary" href="#collapsePrimary{{ $permission->id }}"> <i class="list-toggle fa fa-plus"></i>
                                                {{ $permission->permission_title }} 
                                            </a>
                                        </h4>
                                    </div>
                                    <div id="collapsePrimary{{ $permission->id }}" class="accordion-body collapse">
                                        <div class="panel-body">
                                            @if(!empty($childs[0]))
                                            <table class="table table-bordered table-striped mb-none" >
                                                <thead>
                                                    <tr>
                                                        <th>Sr. No</th>
                                                        <th>Name</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    {{--*/ $inc = 1  /*--}}
                                                    @foreach($childs as $child)
                                                    <tr>
                                                        <td class="table-text">{{ $inc }}</td>
                                                        <td class="table-text">{{ $child->permission_title }}</td>
                                                        <td class="table-text">
                                                            <?php $status = false; ?>
                                                            @if(!empty($permissionRoleDatas[0]))

                                                            @foreach($permissionRoleDatas as $permissionRoleData)
                                                            @if($permissionRoleData->permission_id == $child->id)
                                                            <?php $status = true; ?>
                                                            @endif
                                                            @endforeach
                                                            @endif
                                                            <div class="switch switch-sm switch-primary permission_status">
                                                                <input type="checkbox" name="switch" data-plugin-ios-switch <?php if ($status) {
                                                                echo "checked";
                                                            } ?> class="check_permission" permission_id ="{{ $child->id }}" role_id="{{ $roleId }}" />
                                                            </div>

                                                        </td>
                                                    </tr>
                                                    <?php $inc++; ?>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <?php $status = false; ?>
                                @if(!empty($permissionRoleDatas[0]))

                                @foreach($permissionRoleDatas as $permissionRoleData)
                                @if(isset($permissionRoleData->permission_id) && $permissionRoleData->permission_id == $permission->id)
                                <?php $status = true; ?>
                                @endif
                                @endforeach
                                @endif

                                <div class="switch switch-sm switch-primary permission_status">
                                    <input type="checkbox" name="switch" data-plugin-ios-switch <?php if ($status) {
                                       echo "checked";
                                        } ?> class="check_permission"  permission_id ="{{ $permission->id }}" role_id="{{ $roleId }}" />
                                </div>
                            </div>
                            @endif
                            @endforeach
                        </div>
                    </div>                 
                    <a href="{{ url('/acl/listRole') }}" class = 'mb-xs mt-xs mr-xs btn btn-default cancl-btn'>Back</a>
                </div>
            </section>
        </div>
    </div>
</section>
<meta name="csrf-token" content="{{ csrf_token() }}" />
@endsection