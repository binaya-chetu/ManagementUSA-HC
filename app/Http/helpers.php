<?php 

/**
 * Function to find the height variable for the Blade file
 *
 * @return array()
 */
function commonHeight()
{
    $height = ['4.1"' =>'4.1"', '4.2"' => '4.2"', '4.3"' => '4.3"', '4.4"' =>'4.4"', '4.5"' => '4.5"', '4.6"' => '4.6"', '4.7"' =>'4.7"', '4.8"' => '4.8"', '4.9"' => '4.9"', '4.10"' => '4.10"', '4.11"' => '4.11"', 
            '5.0"' => '5.0', '5.1"' => '5.1"', '5.2"' => '5.2"', '5.3"' => '5.3"', '5.4"' => '5.4"', '5.5"' => '5.5"', '5.6"' => '5.6"', '5.7"' => '5.7"', '5.8"' => '5.8"', '5.9"' => '5.9"', '5.10"' => '5.10"', '5.11"' => '5.11"', 
            '6.0"' => '6.0', '6.1"' => '6.1"', '6.2"' => '6.2"', '6.3"' => '6.3"', '6.4"' => '6.4"', '6.5"' => '6.5"', '6.6"' => '6.6"', '6.7"' => '6.7"', '6.8"' => '6.8"', '6.9"' => '6.9"', '6.10"' => '6.10"', '6.11"' => '6.11"', 
            '7.0"' => '7.0', '7.1"' => '7.1"', '7.2"' => '7.2"', '7.3"' => '7.3"', '7.4"' => '7.4"', '7.5"' => '7.5"'
    ];
    return $height;
}

/**
 * Function to find the patient call hour time
 *
 * @return array()
 */
function callHourTime(){
    for($i = 8; $i <= 20; $i++){
        $hour = $i % 12 ? $i % 12 : 12;
        $amp = $i >= 12 ? ' pm' : ' am';
        $hourTime[$i] = $hour.$amp;
    }
    return $hourTime;
}

/**
 * Function to find the Weight variable for the Blade file
 *
 * @return array()
 */
function commonWeight()
{
    $unit = ' lb';
    $i = 80;
    while($i <= 500){
        $weight[$i] = $i.$unit;    
        $i = $i + 10;
    }
    return $weight;
}

/**
 * Function to find the Erection Strength in the ED/PD
 *
 * @return array()
 */
function commonScale()
{
    for ($i = 1; $i <= 10; $i++){
        $strength[$i] = $i; 
    }
    return $strength;
}

/**
 * Function to find the Erection Strength in the ED/PD
 *
 * @return array()
 */
function durationInMonths()
{
    for ($i = 1; $i <= 12; $i++){
        if($i == 1)
        {
            $duration[$i] = $i . " Month"; 
        }
        else
        {
             $duration[$i] = $i . " Months";
        }
    }
    return $duration;
}

/**
 * Function to find the Patient status regarding the Sale
 *
 * @return array()
 */
function patientStatus(){
    $status = ['0' => 'New Patient', '1' => 'Current Patient'];
    return $status;
}

/**
* Show the items in cart.
*
* @return \resource\view\cart\cart
*/
function showCart($id){
    $patientId = base64_decode($id);
    $category_list = [];
    $category_detail_list = [];

    $original_package_price = [];
    $discouonted_package_price = [];
    $package_discount = [];		

    $cart = App\Cart::with('patient', 'user', 'categoryTypes', 'categories', 'categories.packages', 'categories.packages.Product')->where('patient_id', $patientId)->get();

        foreach($cart as $i => $v){

            $original_package_price[$v->id] = 0;
            $discouonted_package_price[$v->id] = 0;

            $category_list[$v->id] = [
                'category_id' => $v->category_id, 
                'category' => $v->categories->cat_name, 
                'duration' => $v->categories->duration_months, 
                'user_id' => $v->user_id, 
                'user' => $v->user->first_name.' '.$v->user->last_name, 
                'patient_id' => $v->patient_id, 
                'patient' => $v->patient->first_name.' '.$v->patient->last_name,
                'category_type_id' => $v->category_type_id,
                'category_type' => $v->categoryTypes->name
            ]; 

            $category_detail_list[$v->id] = [];
            foreach($v->categories->packages as $ind => $val){
                $category_detail_list[$v->id][$ind]['product_id'] = $val->product_id;
                $category_detail_list[$v->id][$ind]['sku'] = $val->product->sku;
                $category_detail_list[$v->id][$ind]['product'] = $val->product->name;
                $category_detail_list[$v->id][$ind]['count'] = $val->product_count;
                $category_detail_list[$v->id][$ind]['discount_price'] = $val->product_price;
                $category_detail_list[$v->id][$ind]['original_price'] = $val->product->price;
                $category_detail_list[$v->id][$ind]['unit_of_measurement'] = $val->product->unit_of_measurement;

                $original_package_price[$v->id] +=  $val->product_count * $val->product->price;
                $discouonted_package_price[$v->id] +=  $val->product_price;
            }
            $package_discount[$v->id] =  $original_package_price[$v->id] - $discouonted_package_price[$v->id];
        }	
        $data = ['category_list' => $category_list, 'category_detail_list' => $category_detail_list, 'original_package_price' => $original_package_price, 'discouonted_package_price' => $discouonted_package_price, 'package_discount' => $package_discount];
      //  return view('cart.cart',['category_list' => $category_list, 'category_detail_list' => $category_detail_list, 'original_package_price' => $original_package_price, 'discouonted_package_price' => $discouonted_package_price, 'package_discount' => $package_discount]);
        return $data;
}

/**
 * Function to find the amount of medicine  for the Blade file
 *
 * @return array()
 */
function dropDownAmount()
{
    $amount = ['0.0125' =>'0.0125', '0.0375' => '0.0375', '0.0625' => '0.0625', '0.0875' =>'0.0875', '0.1125' => '0.1125', '0.1375' => '0.1375', '0.1625' =>'0.1625', '0.1875' => '0.1875', '0.2125' => '0.2125', '0.2375' => '0.2375', '0.2625' => '0.2625', 
            '0.2875' => '0.2875', '0.3125' => '0.3125', '0.3375' => '0.3375', '0.3625' => '0.3625', '0.3875' => '0.3875', '0.4125' => '0.4125', '0.4375' => '0.4375', '0.4625' => '0.4625', '0.4875' => '0.4875', '0.5125' => '0.5125', '0.5375' => '0.5375', '0.5625' => '0.5625', 
            '0.5875' => '0.5875', '0.6125"' => '0.6125', '0.6375' => '0.6375', '0.6625' => '0.6625', '0.6875' => '0.6875', '0.7125' => '0.7125', '0.7375' => '0.7375', '0.7625' => '0.7625', '0.7875' => '0.7875', '0.8125' => '0.8125', '0.8375' => '0.8375', '0.8625' => '0.8625', 
            '0.8875' => '0.8875', '0.9125' => '0.9125'
    ];
    return $amount;
}
/**
 * Function to find the medication of Drop Downs 
 *
 * @return array()
 */
function dropDownMedication()
{
    $medication = ['T101' =>'T101', 'T105' => 'T105', 'T106' => 'T106', 'ST1' =>'ST1', 'ST9A' => 'ST9A', 'ST9E' => 'ST9E', 'BM1' =>'BM1', 'BM3' => 'BM3', 'BM6' => 'BM6', 'QUAD4' => 'QUAD4'];
    return $medication;
}
/**
 * Function to find the DropDown 9
 *
 * @return array()
 */
function dropDown9()
{
    $dd9 = ['MD - Wesley Pope' =>'MD - Wesley Pope', 'MD - Kisha Farrell' => 'MD - Kisha Farrell', 'ANP - Justin Henson' => 'ANP - Justin Henson', 'ANP - Steven Scholen' =>'ANP - Steven Scholen'];
    return $dd9;
}

                                                   
