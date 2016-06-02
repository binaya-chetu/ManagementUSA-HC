<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\WebLead;
use App\ReasonCode;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Session;
use App;
use Auth;

class ApptSettingController extends Controller
{
    protected $success = true;
    protected $error = false;

    public function __construct() {
        $this->middleware('auth');
    }
    /**
     * Listing all the Call List from the Api
     *
     * @return \resource\view\apptsetting\call_list
     */
    public function callList() {        
        return view('apptsetting.call_list');
    }
    
    /**
     * Listing all the Call List from the Api
     *
     * @return \resource\view\apptsetting\call_list
     */
    public function missedCall() {        
        return view('apptsetting.missed_call');
    }
    
    /**
     * Listing all the Call List from the Api
     *
     * @return \resource\view\apptsetting\call_list
     */
    public function webLead() {        

        $webLeads = WebLead::get();
        $reasonCode = ReasonCode::get();
        return view('apptsetting.web_lead', [
            'webLeads' => $webLeads, 'reason' => $reasonCode
        ]);
    }
}
