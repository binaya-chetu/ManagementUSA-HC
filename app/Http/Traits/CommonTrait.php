<?php
namespace App;
namespace App\Http\Traits;
use App\Order;
use App\OrderDetail;
use App\ApiData;
use App\ApiSetting;

trait CommonTrait {
      
    /**
     * Save the order from the makePayment function
     *
     *  */
    public function saveOrder($cart, $payment_id) {   
        
        foreach($cart['category_list'] as $key => $category){
            $order = new Order;
            $order->payment_id = $payment_id;
            $order->category = $category['category'];
            $order->package_type = $category['category_type'];
            $order->price = $cart['original_package_price'][$key];
            $order->discount_price = $cart['package_discount'][$key];
            $order->save();
            /* ---------------START Save the data into the orderdetail table regarding the package order ------- */
            foreach($cart['category_detail_list'][$key] as $product){
                $orderDetail = new OrderDetail;
                $orderDetail->order_id = $order->id;
                $orderDetail->product_sku = $product['sku'];
                $orderDetail->product = $product['product'];
                $orderDetail->quantity = $product['count'];
                $orderDetail->unit_price = $product['original_price'];
                $orderDetail->discount_price = $product['discount_price'];
                $orderDetail->save();   
                unset($orderDetail);
            }
            unset($order);
            /* -------------- END ------------- */
        }        
    }
    
    /**
     * Save the API Data in api_details table under managementusa-hc-api database.
     *
     * return saved status
     *  */
    public function saveApiData($data) {
        //$path = realpath('json.txt');
        //$json_data = file_get_contents($path);
        $json_data = $this->getResponse($data);
        //echo "<pre>";print_r();die;
        $datas = json_decode($json_data, true);
        $status = [];
        $saved = true;
        if(isset($datas['Data']) && !empty($datas['Data']))
        {
            $maxTimeStamp = \DB::connection('mysql2')->table('api_data')->max('timestamp');
            foreach($datas['Data'] as $data)
            {
                $timestamp = preg_replace("/[^0-9]/","",$data['DateTime']);

                if($timestamp > $maxTimeStamp)
                {
                    $apiData = new ApiData;
                    $datatime = date('Y-m-d h:i:s', ($timestamp/1000));

                    $apiData->timestamp = $timestamp;
                    $apiData->date_time = $datatime;
                    $apiData->call_duration = $data['CallDuration'];
                    $apiData->phone_number = $data['PhoneNumber'];
                    $apiData->phone_number_name = $data['PhoneNumberName'];
                    $apiData->call_resolution = $data['CallResolution'];
                    $apiData->msg = $data['MSG'];
                    $apiData->caller_id = $data['CallerId'];
                    $apiData->first_name = $data['FirstName'];
                    $apiData->last_name = $data['LastName'];
                    $apiData->business = $data['Business'];
                    $apiData->address = $data['Address'];
                    $apiData->city = $data['City'];
                    $apiData->state = $data['State'];
                    $apiData->zipcode = $data['ZipCode'];
                    $apiData->phone_number_formatted = $data['PhoneNumberFormatted'];
                    $apiData->page_count = $data['PageCount'];
                    $apiData->group = $data['Group'];
                    $apiData->user = $data['User'];
                    $apiData->call_direction = $data['CallDirection'];
                    $apiData->access = $data['Access'];
                    $apiData->status = $data['Status'];
                    $apiData->npa = $data['NPA'];
                    $apiData->nxxx = $data['NXXX'];
                    $apiData->call_type = $data['CallType'];
                    $apiData->current_url = $data['CurrentURL'];
                    $apiData->widget_name = $data['WidgetName'];
                    $apiData->source_type = $data['SourceType'];
                    $apiData->category = $data['Category'];

                    // save data in user table
                    if (!($apiData->save())) {
                        $status[] = $data;
                        $saved = false;
                    } 
                }
            }
        }
        else
        {
            $saved = false;
        }
        return $saved;
    }
    
    /**
     * Save the API Setting in api_setting table under managementusa-hc-api database.
     *
     * return saved status
     *  */
    public function saveApiSetting($request) {
        if (!($api_setting = ApiSetting::find($request->setting_id))) {
            $this->validate($request, [
                'api_url' => 'required',
                'user_name' => 'required',
                'password' => 'required'
            ]);
        
            $apiSetting = new ApiSetting;
            $apiSetting->api_url = $request->api_url;
            $apiSetting->user_name = $request->user_name;
            $apiSetting->password =  $request->password;
            $saved = $apiSetting->save();
        }
        
        else {
            $this->validate($request, [
                'api_url' => 'required',
                'user_name' => 'required',
                'password' => 'required'
            ]);
            $input = $request->all();
            $saved = $api_setting->fill($input)->save();
        }
        
        return $saved;
    }
    
    /**
     * Function is used to get the response from hosted number API.
     *
     * @return json data
     */
    protected function getResponse($data){
        $service_url = $data->api_url;
        $curl = curl_init($service_url);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_USERPWD, $data->user_name.":".$data->password); //Your credentials goes here
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false); //IMP if the url has https and you don't want to verify source certificate
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); //IMP if the url has https and you don't want to verify source certificate
        curl_setopt($curl, CURLOPT_SSLVERSION,3);

        $curl_response = curl_exec($curl);

        if(!$curl_response){
            
            \Session::flash('error_message', 'Error: "' . curl_error($curl) . '" - Code: ' . curl_errno($curl));
            return redirect('/');
            exit();
            //die('Error: "' . curl_error($curl) . '" - Code: ' . curl_errno($curl));
        }

        curl_close($curl);
        var_dump($curl_response);die;
        return $curl_response;
        
    }
}