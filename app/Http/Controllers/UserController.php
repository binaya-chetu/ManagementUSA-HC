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

/**
* Class is used to handle all the action related to user module
*
* @category App\Http\Controllers;
* 
* @return void
*/
class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct() 
    {
        // uses auth middleware
        $this->middleware('auth');
    }
    
    // declare properties
    protected $success = true;
    protected $error = false;
    protected $doctor_role = 5;
    protected $patient_role = 6;
    
    /**
    * define the server side vaidation rules 
    *
    * @return array
    */
    private $rules = array(
        'first_name' => 'required|max:255',
        'last_name' => 'required|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required',
        'role' => 'required'
    );
    
    /**
    * addUser() is used to call the layout for Add User
    * super admin can add staff member from here.
    *
    * @param void
    * 
    * @return \resource\views\user\add_user.blade.php
    */
    public function addUser() 
    {
        // get the all role except doctor and patient
        $roles = Role::whereNotIn('id', [$this->doctor_role, $this->patient_role])
                ->lists('role_title', 'id')
                ->toArray();
        
        // get the state list from state table
        $states = State::lists('name', 'id')->toArray();
        
        return view('user.add_user', ['roles' => $roles, 'states' => $states]);
    }
    
    /**
    * This function is used to save user data in database
    *
    * @param $request
    *
    * @return redirect to '/user/listUsers'
    */
    public function saveUser(Request $request) 
    {
        // validation rules 
        $this->validate($request, [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'role' => 'required',
            'phone' => 'required',
            'zipCode' => 'required|min:6|max:15'
        ]);
        
        // create new object for User
        $userData = new User;
        $userData->first_name = $request->first_name;
        $userData->last_name = $request->last_name;
        $userData->email = $request->email;
        $userData->password = bcrypt($request['password']);
        $userData->role = $request->role;
        
        // save data in user table
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
           
           // save user details in user_details table
           if($userDetailData->save())
           {
               // set flash message when user created successfully.
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
    
    /**
    * This function is used to fetch all users except which have role doctor or patient.
    *
    * @param void
    *
    * @return \resource\views\user\index.blade.php
    */
    public function listUsers() 
    {
        // get all users except doctor and patient to show on listing page
        $users = User::with('roleName')->whereNotIn('role', [$this->doctor_role, $this->patient_role])
                ->orderBy('id', 'DESC')
                ->get();
        
        return view('user.index', [
            'users' => $users
        ]);
    }
    
    /**
    * Active or Diactivate user status
    *
    * @param $request
    *
    * @return null
    */
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
            // update the user status by user id
            \DB::table('users')
            ->where('id', $userId)
            ->update(['status' => $status]);
            
            echo $this->success; die;
        }
    }
    
    /**
    * This function is used to update the user detail
    *
    * @param $id and $request
    *
    * @return \Illuminate\Http\Response
    */
    public function updateUser($id = null, Request $request) 
    {
        if (!($userData = User::find($id))) 
        {
            App::abort(404, 'Page not found.');
        }
        
        // validation rule
        $this->validate($request, [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'phone' => 'required',
            'zipCode' => 'required|min:6|max:15'
        ]);
        
        $userInput['first_name'] = $request->first_name;
        $userInput['last_name'] = $request->last_name;
        
        // get user details data by user id
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
        
        // save user data in user table and user details data in user details table.
        if ($userData->fill($userInput)->save() && $userDetailData[0]->fill($userDetailInput)->save()) 
        {
            \Session::flash('flash_message', 'User details updated successfully.');
           
            return redirect('/user/listUsers');
        } 
        else 
        {
            return redirect('/user/editUser');
        }
    }

    /**
    * This function is used to delete the user
    * soft delete technique is used to delete the user
    *
    * @param $id 
    *
    * @return \Illuminate\Http\Response
    */
    public function deleteUser( $id = null )
    {
        if (!($user = User::find(base64_decode($id)))) 
        {
            App::abort(404, 'Page not found.');
        }
        // delete the user by user id
        User::destroy(base64_decode($id));
        // set the flash message.
        \Session::flash('flash_message', 'User deleted successfully.');
        // redirect back to the page.
        return Redirect::back();
    }
    
    /**
    * This function is used to fetch layout of edit user form and user details to display on that form
    *
    * @param $id
    *
    * @return \Illuminate\Http\Response
    */
    public function editUser( $id = null )
    {
        if (!($user = User::with('userDetail')->find(base64_decode($id)))) 
        {
            App::abort(404, 'Page not found.');
        }
        
        // get the state list from state table
        $states = State::lists('name', 'id')->toArray();
        
        return view('user.edit_user', [
            'user' => $user,
            'states' => $states
        ]);
    }
    
    /**
    * This function is used to view the details of a particular user
    *
    * @param $id
    *
    * @return \Illuminate\Http\Response
    */
    public function viewUser($id = null) 
    {
        // find the user details by user id
        if (!($user = User::with('userDetail', 'UserDetail.userStateName', 'roleName')->find(base64_decode($id)))) 
        {
            App::abort(404, 'Page not found.');
        }

        return view('user.view_user', [
            'user' => $user
        ]);
    }
}
