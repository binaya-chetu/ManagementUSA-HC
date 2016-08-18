<?php
use Input;
use App\Item;
use DB;
use Excel;
class WebLeadsController extends Controller
{
	   public function __construct() {
        $this->middleware('auth');
    }
  
     public function listWebLeads() {
       
        $webLeads = DB :: table('web_leads')->get();
        return view('apptsetting.web_lead', [
            'web_leads' => $webLeads
        ]);
    }
}