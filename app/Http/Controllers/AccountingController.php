<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Redirect;
use App;
use Auth;
use App\Cashlogs;
use App\Order;
use App\Payment;

class AccountingController extends Controller
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
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('account.cash_voucher');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validation rules 
        $this->validate($request, [
            'date' => 'required',
            'operation' => 'required',
            'amount' => 'required',
            'details' => 'required|max:255'
        ]);

        // create new object for User
        $voucherData = new Cashlogs;
        $voucherData->user_id = Auth::user()->id;
        $voucherData->date = date('Y-m-d', strtotime($request->date));
        if($request->operation == '1')
        {
            $voucherData->cash_out = $request->amount;
        } else if($request->operation == '2') {
            $voucherData->cash_in = $request->amount;
        }
        
        $voucherData->details = $request->details;
        
       
        // save data in user table
        if ($voucherData->save()) {
            // set flash message when user created successfully.
            \Session::flash('flash_message', 'Cash Voucher Saved Successfully.');
            return redirect('/accounting/listCashLogs');
        } else {
            return redirect('/accounting/create');
        }
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function listCashLogs()
    {
        $cashLogs = Cashlogs::with('agent')->get();
        
        return view('account.cash_logs', [
            'cashLogs' => $cashLogs
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // find the user details by user id
        if (!($order = Order::with('orderDetail', 'categories', 'categoryType', 'orderDetail.product')->find(base64_decode($id)))) 
        {
            App::abort(404, 'Page not found.');
        }
        //echo '<pre>';print_r($order);die;
        return view('account.order_details', [
            'order' => $order
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (!($order = Order::find(base64_decode($id)))) {
            App::abort(404, 'Page not found.');
        }
        Order::destroy(base64_decode($id));
        \Session::flash('flash_message', 'Order deleted successfully.');
        return Redirect::back();
    }
    
    /**
     * List today's orders from orders tables.
     * 
     * @param null
     * @return \Illuminate\Http\Response
     */
    public function dailySalesReport()
    {
        $sales = Order::with('orderDetail', 'invoice', 'payment', 'payment.agent')
                ->whereDate('created_at', '=', date('Y-m-d'))
                ->orderBy('id', 'DESC')
                ->get();
        
        return view('account.sales_report', [
            'sales' => $sales
        ]);
    }
    
    /**
     * List weekly orders from orders tables.
     * 
     * @param null
     * @return \Illuminate\Http\Response
     */
    public function weeklySalesReport()
    {
        $fromDate = \Carbon\Carbon::now()->subDay()->startOfWeek()->toDateString(); // or ->format(..)
        $tillDate = \Carbon\Carbon::now()->toDateString();
        $sales = Order::with('orderDetail', 'invoice', 'payment', 'payment.agent')
                ->whereBetween( \DB::raw('date(created_at)'), [$fromDate, $tillDate] )
                ->orderBy('id', 'DESC')
                ->get();
        
        return view('account.sales_report', [
            'sales' => $sales
        ]);
    }
    
    /**
     * List monthly orders from orders tables.
     * 
     * @param null
     * @return \Illuminate\Http\Response
     */
    public function monthlySalesReport()
    {
        $sales = Order::with('orderDetail', 'invoice', 'payment', 'payment.agent')
            ->whereRaw('MONTH(created_at) = MONTH(NOW())')
                ->whereRaw('Year(created_at) = YEAR(NOW())')
                    ->orderBy('id', 'DESC')->get();
        
        return view('account.sales_report', [
            'sales' => $sales
        ]);
    }
    
    /**
     * List monthly orders from orders tables.
     * 
     * @param null
     * @return \Illuminate\Http\Response
     */
    public function yearlySalesReport()
    {
        $sales = Order::with('orderDetail', 'invoice', 'payment', 'payment.agent')
                ->whereYear('created_at', '=', date('Y'))
                ->orderBy('id', 'DESC')
                ->get();
        //echo "<pre>";print_r($sales);die;
        return view('account.sales_report', [
            'sales' => $sales
        ]);
    }
    
    
}
