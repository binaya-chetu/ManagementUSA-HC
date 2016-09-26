<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App;
use Session;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;
use PayPal\Api\CreditCard;
use PayPal\Api\FundingInstrument;

class PaymentController extends Controller {

    private $_api_context;

    public function __construct() {
        // setup PayPal api context
        $paypal_conf = config('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_conf['client_id'], $paypal_conf['secret']));
        $this->_api_context->setConfig($paypal_conf['settings']);
    }

    public function postPayment() {

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');

        $item_1 = new Item();
        $item_1->setName('Item 1') // item name
                ->setCurrency('USD')
                ->setQuantity(2)
                ->setPrice('15'); // unit price
// add item to list
        $item_list = new ItemList();
        $item_list->setItems(array($item_1));

        $amount = new Amount();
        $amount->setCurrency('USD')
                ->setTotal(30);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
                ->setItemList($item_list)
                ->setDescription('Your transaction description');

        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(url('payment/status'))
                ->setCancelUrl(url('payment/status'));

        $payment = new Payment();
        $payment->setIntent('Sale')
                ->setPayer($payer)
                ->setRedirectUrls($redirect_urls)
                ->setTransactions(array($transaction));

        try {
            $payment->create($this->_api_context);
        } catch (\PayPal\Exception\PPConnectionException $ex) {
            if (\config('app.debug')) {
                echo "Exception: " . $ex->getMessage() . PHP_EOL;
                $err_data = json_decode($ex->getData(), true);
                die;
                exit;
            } else {
                echo 'wrong';die;
                return redirect('/');
            }
        }
        echo '<pre>'; print_r($payment->toArray()); echo '<br>';
        foreach ($payment->getLinks() as $link) {
            if ($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }

// add payment ID to session
        Session::put('paypal_payment_id', $payment->getId());
        echo $redirect_url;die;
        if (isset($redirect_url)) {
// redirect to paypal
            return redirect($redirect_url);
        }
       echo 'error';die;
        return redirect('/');
    }

    public function getPaymentStatus(Request $request) {
// Get the payment ID before session clear
        $payment_id = Session::get('paypal_payment_id');

// clear the session payment ID
        Session::forget('paypal_payment_id');

        if (empty($request->input('PayerID')) || empty($request->input('token'))) {
            echo 'failed';die;
            return redirect('/');
        }

        $payment = Payment::get($payment_id, $this->_api_context);

// PaymentExecution object includes information necessary
// to execute a PayPal account payment.
// The payer_id is added to the request query parameters
// when the user is redirected from paypal back to your site
        $execution = new PaymentExecution();
        $execution->setPayerId($request->input('PayerID'));

//Execute the payment
        $result = $payment->execute($execution, $this->_api_context);

        /*
         * Get the ID with : $result->id
         * Get the State with $result->state
         * Get the Payer State with $result->payer->payment_method
         * Get The Shipping Address and More Detail like below :- $result->payer->payer_info->shipping_address
         * Get More detail about shipping address like city country name
         */

        echo '<pre>';
        print_r($result); die;
        echo '</pre>';
        exit; // DEBUG RESULT.

        if ($result->getState() == 'approved') { // payment made
            Flash::success('Payment Successful');
            return redirect('home');
        }
        Flash::error('Payment Failed');
        return redirect('/');
    }

    
    public function debit(Request $request ){
        //echo '<pre>'; print_r($request->all());
        $card = new CreditCard();
		$card->setType("visa")
			->setNumber(urlencode($request->number))
			->setExpireMonth(urlencode($request->month))
			->setExpireYear(urlencode($request->year))
			->setCvv2(urlencode($request->cvv))
			->setFirstName(urlencode($request->first_name))
			->setLastName(urlencode($request->last_name));		
				
		$fi = new FundingInstrument();
		$fi->setCreditCard($card);		
		
		$payer = new Payer();
		$payer->setPaymentMethod("credit_card")
			->setFundingInstruments(array($fi));

		$item1 = new Item();
		$item1->setName(urlencode($request->item_name))
			->setDescription(urlencode($request->description))
			->setCurrency('USD')
			->setQuantity(urlencode($request->quantity))
			->setPrice(urlencode($request->price));
			
		$itemList = new ItemList();
		$itemList->setItems(array($item1));
                
		$amount = new Amount();
		$amount->setCurrency("USD")
			->setTotal(3396);
	
		$transaction = new Transaction();
		$transaction->setAmount($amount)
			->setItemList($itemList)
			->setDescription("Payment description")
			->setInvoiceNumber(uniqid());	
	
		$payment = new Payment();
		$payment->setIntent("sale")
			->setPayer($payer)
			->setTransactions(array($transaction));	
        try {
            $payment->create($this->_api_context);
        } catch (\PayPal\Exception\PPConnectionException $ex) {
            if (\config('app.debug')) {
                echo "Exception: " . $ex->getMessage() . PHP_EOL;
                $err_data = json_decode($ex->getData(), true);
                die;
                exit;
            } else {
                echo 'wrong';die;
                return redirect('/');
            }
        }
        echo '<pre>'; print_r($payment->toArray()); echo '<br>';
        foreach ($payment->getLinks() as $link) {
            if ($link->getRel() == 'approval_url') {
                $redirect_url = $link->getHref();
                break;
            }
        }

// add payment ID to session
        Session::put('paypal_payment_id', $payment->getId());
        if (empty($request->input('PayerID')) || empty($request->input('token'))) {
            echo 'failed';die;
            return redirect('/');
        }

        $payment = Payment::get($payment_id, $this->_api_context);

// PaymentExecution object includes information necessary
// to execute a PayPal account payment.
// The payer_id is added to the request query parameters
// when the user is redirected from paypal back to your site
        $execution = new PaymentExecution();
        $execution->setPayerId($request->input('PayerID'));

//Execute the payment
        $result = $payment->execute($execution, $this->_api_context);
        if (isset($redirect_url)) {
// redirect to paypal
            return redirect($redirect_url);
        }
       echo 'error';die;
        return redirect('/');
    }
    
    
    public function test() {
        return view('payment.test');
    }
    
}
