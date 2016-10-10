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
    public function saveOrder($cart, $payment_id, $order_unique_id) {   
        
        foreach($cart['category_list'] as $key => $category){
            $order = new Order;
            $order->payment_id = $payment_id;
            $order->order_unique_id = $order_unique_id;
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
        $datas = json_decode($json_data, true);
        //echo "<pre>";print_r($datas);die;
        $error_row = [];
        if(isset($datas['Data']) && !empty($datas['Data']))
        {
            $arr = $datas['Data'];
            $maxTimeStamp = \DB::connection('mysql2')->table('api_data')->max('timestamp');
            foreach($arr as $data)
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
                    $apiData->source_type = 2;
                    $apiData->category = $data['Category'];
                    $apiData->type = ($data['CallDuration'] == '0:00' || $data['CallDuration'] == '') ? 1 : 0;

                    // save data in user table
                    if (!($apiData->save())) {
                        $error_row = $data;
                    }
                }
            }
            if(count($error_row))
            {
                return false;
            }
            else
            {
                return true;
            }
        }
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
        $username = $data->user_name;
        $password = $data->password;

        $method = 'GET';

        $url = $data->api_url;

        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL, $url);
        curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch,CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch,CURLOPT_FOLLOWLOCATION, false);
        curl_setopt($ch,CURLOPT_TIMEOUT, 30);
        curl_setopt($ch,CURLOPT_CONNECTTIMEOUT, 30);
        if($method == 'POST')
        {
            $fieldsData = http_build_query($fields);
            curl_setopt($ch,CURLOPT_POSTFIELDS, $fieldsData);
        }

        curl_setopt($ch, CURLOPT_HEADER, 1);
        $first_response = curl_exec($ch);
        $info = curl_getinfo($ch);

        preg_match('/WWW-Authenticate: Digest (.*)/', $first_response, $matches);

        if(!empty($matches))
        {
            $auth_header = $matches[1];
            $auth_header_array = explode(',', $auth_header);
            $parsed = array();

            foreach ($auth_header_array as $pair)
            {
                $vals = explode('=', $pair);
                $parsed[trim($vals[0])] = trim($vals[1], '" ');
            }

            $response_realm     = (isset($parsed['realm'])) ? $parsed['realm'] : "";
            $response_nonce     = (isset($parsed['nonce'])) ? $parsed['nonce'] : "";
            $response_opaque    = (isset($parsed['opaque'])) ? $parsed['opaque'] : "";

            $authenticate1 = md5($username.":".$response_realm.":".$password);
            $authenticate2 = md5($method.":".$url);

            $authenticate_response = md5($authenticate1.":".$response_nonce.":".$authenticate2);

            $request = sprintf('Authorization: Digest username="%s", realm="%s", nonce="%s", opaque="%s", uri="%s", response="%s"',
            $username, $response_realm, $response_nonce, $response_opaque, $url, $authenticate_response);

            $request_header = array($request);

            $ch = curl_init();
            curl_setopt($ch,CURLOPT_URL, $url);
            curl_setopt($ch,CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch,CURLOPT_SSL_VERIFYHOST, false);
            curl_setopt($ch,CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch,CURLOPT_FOLLOWLOCATION, false);
            curl_setopt($ch,CURLOPT_TIMEOUT, 30);
            curl_setopt($ch,CURLOPT_CONNECTTIMEOUT, 30);

            if($method == 'POST')
            {
                $fieldsData = http_build_query($fields);
                curl_setopt($ch,CURLOPT_POSTFIELDS, $fieldsData);
            }
            curl_setopt($ch, CURLOPT_HTTPHEADER, $request_header);

            $result['response']         = curl_exec($ch);
            $result['info']             = curl_getinfo ($ch);
            $result['info']['errno']    = curl_errno($ch);
            $result['info']['errmsg']   = curl_error($ch); 
            
            return $result['response'];
        } 
    }
}