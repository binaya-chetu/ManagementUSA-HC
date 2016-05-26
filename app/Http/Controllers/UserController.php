<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Role;
use App\User;
use App\UserDetail;
use App\State;
use View;
use App;

class UserController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }
    protected $success = true;
    protected $error = false;
    
    private $rules = array(
        'first_name' => 'required|max:255',
        'last_name' => 'required|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required',
        'role' => 'required'
    );
    
    public function addUser() {
      
        $roles = Role::where('id','!=',5)
                ->where('id','!=',6)
                ->get();
        $roleArray = array();
        foreach($roles as $role)
        {
            $roleArray[$role->id] = $role->role_title;
        }
        
        $states = State::get();
        
        $stateArray = array();
       
        foreach($states as $state)
        {
            $stateArray[$state->id] = $state->name;
        }
        
        return view('user.add_user', ['roles' => $roleArray, 'states' => $stateArray]);
    }
    
    public function saveUser(Request $request) {
        
        $this->validate($request, [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'role' => 'required',
            'phone' => 'required',
            'zipCode' => 'required|min:6|max:15'
        ]);
        
        $userData = new User;
        $userData->first_name = $request->first_name;
        $userData->last_name = $request->last_name;
        $userData->email = $request->email;
        $userData->password = bcrypt($request['password']);
        $userData->role = $request->role;
       
        if ($userData->save()) 
        {
           $userDetailData = new UserDetail;
           $userDetailData->user_id = $userData->id;
           if($request->dob)
            {
                $userDetailData->dob = date('Y-m-d', strtotime($request->dob));
            }
           $userDetailData->gender = $request->gender;
           $userDetailData->phone = $request->phone;
           $userDetailData->address1 = $request->address1;
           $userDetailData->address2 = $request->address2;
           $userDetailData->city = $request->city;
           $userDetailData->state = $request->state;
           $userDetailData->zipCode = $request->zipCode;
           
           if($userDetailData->save())
           {
            \Session::flash('flash_message', 'User created successfully.');
            return redirect('/user/listUsers');
           }
           else
           {
                return redirect('/user/addUser');
           }
        }
        else 
        {
            return redirect('/user/addUser');
        }
    }
    
     public function listUsers() {
        $users = User::with('roleName')->where('role','!=',5)
                ->where('role','!=',6)
                ->get();
        
        return view('user.index', [
            'users' => $users
        ]);
    }
    
    public function updateUserStatus(Request $request)
    {
        $data = $request->all();
        $status = $data['data']['status'];
        $userId = $data['data']['userId'];
        if (!($user = User::find($userId))) 
        {
            App::abort(404, 'Page not found.');
            echo $this->error; die;
        }
        else 
        {
            \DB::table('users')
            ->where('id', $userId)
            ->update(['status' => $status]);
            echo $this->success; die;
        }
    }
    
    public function updateUser($id = null, Request $request) {
        if (!($userData = User::find($id))) {
            App::abort(404, 'Page not found.');
        }
        $this->validate($request, [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'phone' => 'required',
            'zipCode' => 'required|min:6|max:15'
        ]);
        
        $userInput['first_name'] = $request->first_name;
        $userInput['last_name'] = $request->last_name;
                
        $userDetailData = UserDetail::where('user_id',$id)->get();
        if($request->dob)
        {
            $userDetailInput['dob'] = date('Y-m-d', strtotime($request->dob));
        }
        $userDetailInput['gender'] = $request->gender;
        $userDetailInput['phone'] = $request->phone;
        $userDetailInput['address1'] = $request->address1;
        $userDetailInput['address2'] = $request->address2;
        $userDetailInput['city'] = $request->city;
        $userDetailInput['state'] = $request->state;
        $userDetailInput['zipCode'] = $request->zipCode;
        
        if ($userData->fill($userInput)->save() && $userDetailData[0]->fill($userDetailInput)->save()) {
            \Session::flash('flash_message', 'User details updated successfully.');
           
            return redirect('/user/listUsers');
        } else {
            return redirect('/user/editUser');
        }
    }

    
    public function deleteUser( $id = null )
    {
        if (!($user = User::find(base64_decode($id)))) {
            App::abort(404, 'Page not found.');
        }
        User::destroy($id);
        \Session::flash('flash_message', 'User deleted successfully.');
        return Redirect::back();
    }
    
    public function editUser( $id = null )
    {
        if (!($user = User::with('userDetail')->find(base64_decode($id)))) {
            App::abort(404, 'Page not found.');
        }
        
        $states = State::get();
        
        $stateArray = array();
       
        foreach($states as $state)
        {
            $stateArray[$state->id] = $state->name;
        }
        
        return view('user.edit_user', [
            'user' => $user,
            'states' => $stateArray
        ]);
    }
    
    public function viewUser($id = null) {
        if (!($user = User::with('userDetail', 'UserDetail.userStateName', 'roleName')->find(base64_decode($id)))) {
            App::abort(404, 'Page not found.');
        }

        return view('user.view_user', [
            'user' => $user
        ]);
    }
}
