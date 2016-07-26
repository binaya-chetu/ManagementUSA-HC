<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use App\Permission;
use App\Role;
use App\User;
use App\PermissionRole;
use View;
use App;
use Auth;

class AclController extends Controller {

    protected $success = true;
    protected $error = false;

    public function __construct() {
        $this->middleware('auth');
    }

    private $rules = array(
        'role_title' => 'required',
    );

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Methods related to Role Module
     * @return type
     */
    public function addRole() {
        return view('acl.add_new_role');
    }
    
    /**
    * This function is used to save the new role in tables.
    *
    * @param Request
    *
    * @return \Illuminate\Http\Response
    */
    public function saveRole(Request $request) {

        $this->validate($request, [
            'role_title' => 'required|unique:roles',
        ]);

        $roleData = new Role();
        $roleData = array(
            'role_title' => $request['role_title'],
            'role_slug' => strtolower($request['role_title']),
            'status' => 1,
        );

        $validator = Validator::make($roleData, $this->rules);
        if ($validator->fails()) {
            return redirect('/acl/listRole')
                            ->withInput()
                            ->withErrors($validator);
        } else {
            //save to DB user details
            $role = new Role;
            if ($role::create($roleData)) {
                \Session::flash('flash_message', 'Role Created successfully.');
                return redirect('/acl/listRole')
                                ->withInput()
                                ->withErrors($validator);
            } else {
                return redirect('/acl/listRole')
                                ->withInput()
                                ->withErrors($validator);
            }
        }
    }
    
    /**
    * This function is used to fetch all role from table and list them.
    *
    * @param void
    *
    * @return \Illuminate\Http\Response
    */
    public function listRoles() {
        $role = new Role;
        $roles = $role->get();

        return view('acl.roles', [
            'roles' => $roles
        ]);
    }
    
    /**
    * This function is used to fetch the layout to edit the existing role.
    *
    * @param Role Id
    *
    * @return \Illuminate\Http\Response
    */
    public function editRole($id = null) {
        if (!($role = Role::find(base64_decode($id)))) {
            App::abort(404, 'Page not found.');
        }
        return view('acl.edit_role', [
            'role' => $role
        ]);
    }
    
    /**
    * This function is used to delete the existing role.
    *
    * @param Role Id
    *
    * @return \Illuminate\Http\Response
    */
    public function deleteRole($id = null) {
        if (!($role = Role::find(base64_decode($id)))) {
            App::abort(404, 'Page not found.');
        }
        Role::destroy(base64_decode($id));
        \Session::flash('flash_message', 'Data deleted successfully.');
        return Redirect::back();
    }

    /**
    * This function is used to UPDATE THE ROLE title.
    *
    * @param Request
    *
    * @return \Illuminate\Http\Response
    */
    public function updateRole($id = null, Request $request) {
        if (!($role = Role::find($id))) {
            App::abort(404, 'Page not found.');
        }
        
        $this->validate($request, [
            'role_title' => 'required'
        ]);
        
        $input = $request->all();
        if ($role->fill($input)->save()) {
            \Session::flash('flash_message', 'Role updated successfully.');
            return redirect('/acl/listRole');
        } else {
            return redirect('/acl/editRole');
        }
    }

    /**
    * This function is used to list all the permission related to a particular role.
    *
    * @param RoleId
    *
    * @return \Illuminate\Http\Response
    */
    public function listPermissions($roleId = null) {
        $parents = Permission::with('children', 'parent')->get();
        $permissionRoleData = PermissionRole::where('role_id', base64_decode($roleId))->get();
        return view('acl.permission', [
            'permissions' => $parents,
            'roleId' => base64_decode($roleId),
            'permissionRoleDatas' => $permissionRoleData
        ]);
    }

    /**
    * This function is used to update the permission.
    *
    * @param Request
    *
    * @return \Illuminate\Http\Response
    */
    public function updatePermission(Request $request) {
        $data = $request->all();
        $status = $data['data']['status'];
        $roleId = $data['data']['roleId'];
        $permissionId = $data['data']['permissionId'];

        if ($status == 1) {
            $permissionRole = new PermissionRole;
            $permissionRole->permission_id = $permissionId;
            $permissionRole->role_id = $roleId;
            $permissionRole->status = $status;
            if ($permissionRole->save()) {
                echo $this->success;
                die;
            } else {
                echo $this->error;
                die;
            }
        } else {
            $delete = PermissionRole::where('permission_id', $permissionId)
                    ->where('role_id', $roleId)
                    ->delete();
            if ($delete) {
                echo $this->success;
                die;
            } else {
                echo $this->error;
                die;
            }
        }
    }
}
