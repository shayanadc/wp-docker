<?php
defined( 'ABSPATH' ) or die(  'No script kiddies please!' );

/**
 * Credits : https://github.com/mihandev/mellatbak/blob/master/mellatbank.php
 */
class cupri_mellatbank {
    /**
     * @var integer
     */
    private $_terminal;
    
    /**
     * @var string
     */
    private $_username;
    
    /**
     * @var string
     */
    private $_password;
    
    /**
     * @var integer
     */
    private $_orderid;
    
    /**
     * @var object
     */
    private $_client;
    /**
     * @var string (url)
     */
    private $_webservice = 'https://bpm.shaparak.ir/pgwchannel/services/pgw?wsdl';
    
    /**
     * @var boolean
     */
    private $_fault = true;
    
    /**
     * currency must be "rial" or "toman"
     * @var string
     */
    protected $_currency;
    /**
     * @var integer
     */
    protected $_amount;
    
    /**
     * @var string (url)
     */
    protected $_callBackUrl;
    
    /**
     * Create a new object
     * @param array $params
     */
    public function __construct($params, $fault = true) {
    	$this->_terminal = isset($params['terminal']) ? $params['terminal'] : null;
    	$this->_username = isset($params['username']) ? $params['username'] : null;
        $this->_orderid = isset($params['_orderid']) ? $params['_orderid'] : null;
    	$this->_password = isset($params['password']) ? $params['password'] : null;
    	$this->_currency = isset($params['currency']) ? $params['currency'] : 'rial';
    	$this->_fault = $fault;
    }
    
    /**
     * Create a new payment request
     * You can use it by $object->startPayment((int)$amount, 'http://example.com/callback')
     * 
     * @param integer $amount
     * @param string $callBackUrl
     * @param integer $orderid
     * @return mixed
     * @throws Exception
     */
    public function startPayment($amount, $callBackUrl, $orderid = null) {
    	if(class_exists('nusoap_client', true)) {
    		$this->_client = new nusoap_client($this->_webservice);
    		if ($this->_client->getError() && $this->_fault) {
    			echo '<h2>Constructor error</h2><pre>' . $this->_client->getError() . '</pre>';
    			die();
    		}

            // set the parameters
    		$this->_amount = ($this->_currency == 'rial')? $amount : ($amount * 10);
    		$this->_callBackUrl = $callBackUrl;
    		$this->_orderid = isset($orderid)? $orderid : rand(10000, 99999);
    		$parameters = array(
    			'terminalId' => $this->_terminal,
    			'userName' => $this->_username,
    			'userPassword' => $this->_password,
    			'orderId' => $this->_orderid,
    			'amount' => $this->_amount,
    			'localDate' => date('ymj'),
    			'localTime' => date('His'),
    			'additionalData' => '',
    			'callBackUrl' => $this->_callBackUrl,
    			'payerId' => 0
    			);
            // call to the webservice
    		$results = $this->_client->call('bpPayRequest', $parameters, 'http://interfaces.core.sw.bps.com/');
    		if ($this->_client->fault && $this->_fault) {
    			echo '<h2>Fault</h2><pre>';
    			print_r($results);
    			echo '</pre>';
    			die();
    		} else {
    			$resultStr  = $results;
    			if ($this->_client->getError()) {
    				echo '<h2>Error</h2><pre>' . $this->_client->getError() . '</pre>';
    				die();
    			} 
    			else {
    				$res = explode (',',$resultStr);
    				echo '<div style="display:none;">Pay Response is : ' . $resultStr . '</div>';
    				$ResCode = $res[0];	
    				if ($ResCode == "0") {
    					return $this->postRefId($res[1]);
    				} 
    				else {
                        // get error by response code
    					return $this->error((int)$ResCode);
    				}
    			}
    		}
    	} else {
    		throw new Exception('nusoap class not found!');
    	}
    }
    
    /**
     * Verify the payment
     * @param array $params
     * @return boolean
     */
    public function verify($params) {
    	$this->_client = new nusoap_client($this->_webservice);

        // if client has error
    	if($this->_client->getError() && $this->_fault) {
    		echo '<h2>Constructor error</h2><pre>' . $this->_client->getError() . '</pre>';
    		die();
    	}

        // set the parameters
    	$parameters = array(
    		'terminalId'=> $this->_terminal, 
    		'userName'=> $this->_username, 
    		'userPassword'=> $this->_password, 
    		'orderId' => $this->_orderid,
    		'saleOrderId' => isset($params['SaleOrderId'])? $params['SaleOrderId'] : null,
    		'saleReferenceId' => isset($params['SaleReferenceId'])? $params['SaleReferenceId'] : null,
    		);

        // call to webservice
    	$result = $this->_client->call('bpVerifyRequest', $parameters, 'http://interfaces.core.sw.bps.com/');
    	if ($this->_client->fault && $this->_fault) {
    		echo '<h2>Fault</h2><pre>';
    		print_r($result);
    		echo '</pre>';
    		die();
    	} else {
    		$resultStr = $result;	
    		if ($this->_client->getError() && $this->_fault) {
    			echo '<h2>Error</h2><pre>' . $this->_client->getError() . '</pre>';
    			die();
    		} 
    		elseif($result == '0') {
                // the payment verified!
    			return true;
    		}
    	}

    	return false;
    }
    
    /**
     * Settle the payment
     * @param array $params
     * @return boolean
     */
    protected function settle($params) {
    	$this->_client = new nusoap_client($this->_webservice);

        // if client has error
    	if($this->_client->getError() && $this->_fault) {
    		echo '<h2>Constructor error</h2><pre>' . $this->_client->getError() . '</pre>';
    		die();
    	}

        // set the parameters
    	$parameters = array(
    		'terminalId'=> $this->_terminal, 
    		'userName'=> $this->_username, 
    		'userPassword'=> $this->_password, 
    		'orderId' => $this->_orderid,
    		'saleOrderId' => isset($params['SaleOrderId'])? $params['SaleOrderId'] : null,
    		'saleReferenceId' => isset($params['SaleReferenceId'])? $params['SaleReferenceId'] : null,
    		);

        // call to webservice
    	$result = $this->_client->call('bpSettleRequest', $parameters, 'http://interfaces.core.sw.bps.com/');
    	if ($this->_client->fault && $this->_fault) {
    		echo '<h2>Fault</h2><pre>';
    		print_r($result);
    		echo '</pre>';
    		die();
    	} 
    	else {
            // if have error
    		if ($this->_client->getError() && $this->_fault) {
    			echo '<h2>Error</h2><pre>' . $this->_client->getError() . '</pre>';
    			die();
    		} 
    		else {
                // settle is successfull
    			if($result == '0') return true;
    		}
    	}

    	return false;
    }
    
    /**
     * Check if payment is successfull
     * 
     * @param array $params
     * @return array
     * @throws Exception
     */
    public function check($params) {
    	if(isset($params["ResCode"])) {
    		if($params["ResCode"] == 0 && $this->verify($params) && $this->settle($params))
    		{
                // success payment
    			return array(
    				'status' => 'success',
    				'transactionCode' => $params["SaleReferenceId"],
    				);
    		}
    	} else {
    		throw new Exception('parameter "ResCode" dont exist!');
    	}
    }	

    /**
     * @param string $refIdValue
     */
    protected function postRefId($refIdValue) 
    {
          echo cupri_success_msg('در حال انتقال به بانک...');
    	echo '<script language="javascript" type="text/javascript"> 
    	function postRefId (refIdValue) {
    		var form = document.createElement("form");
    		form.setAttribute("method", "POST");
    		form.setAttribute("action", "https://bpm.shaparak.ir/pgwchannel/startpay.mellat");         
    		form.setAttribute("target", "_self");
    		var hiddenField = document.createElement("input");              
    		hiddenField.setAttribute("name", "RefId");
    		hiddenField.setAttribute("value", refIdValue);
    		form.appendChild(hiddenField);
    		document.body.appendChild(form);         
    		form.submit();
    		document.body.removeChild(form);
    	}
    	postRefId("' . $refIdValue . '");
    </script>';
}

    /**
     * Echo error by number
     * @param integer $number
     */
    protected function error($number) {
    	$err = $this->response($number);
    	// echo '<!doctype html><html><head><meta charset="utf-8"><title>خطا</title></head><body dir="rtl">';
    	echo '<style>div.error{direction:rtl;background:#A80202;float:right;text-align:right;color:#fff;';
    	echo 'font-family:tahoma;font-size:13px;padding:3px 10px}</style>';
    	echo '<div class="error"><strong>خطا</strong> : ' . $err . '</div>';
    	die() ;
    }	

    /**
     * Get cupri_mellatbank response by code
     * 
     * @param integer $resNumber
     * @return string
     */
    protected function response($resNumber) 
    {
    	switch((int)$resNumber) {
    		case 31 : $err = "پاسخ نامعتبر است!"; break;
    		case 17 : $err = "کاربر از انجام تراکنش منصرف شده است!"; break;
    		case 21 : $err = "پذیرنده نامعتبر است!"; break;
    		case 25 : $err = "مبلغ نامعتبر است!"; break;
    		case 34 : $err = "خطای سیستمی!"; break;
    		case 41 : $err = "شماره درخواست تکراری است!"; break;
    		case 421 : $err = "ای پی نامعتبر است!"; break;
    		case 412 : $err = "شناسه قبض نادرست است!"; break;
    		case 418: $err = "اشكال در تعريف اطلاعات مشتري"; break;
    		case 45 : $err = "تراکنش از قبل ستل شده است"; break;
    		case 46 : $err = "تراکنش ستل شده است"; break;
    		case 35 : $err = "تاریخ نامعتبر است"; break;
    		case 32 : $err = "فرمت اطلاعات وارد شده صحیح نمیباشد"; break;
    		case 43 : $err = "درخواست verify قبلا صادر شده است"; break;
    		case 24 : $err = "اطلاعات كاربري پذيرنده نامعتبر است"; break;
    	}

    	return isset($err)? $err : $resNumber ;
    }
}



class cupri_mellat_gateway extends cupri_abstract_gateway
{
    static protected $instance = null;
	function add_settings($settings)
	{
		$settings['terminal'] = 'ترمینال آی دی';
		$settings['username'] = 'نام کاربری';
		$settings['password'] = 'رمز';
		return $settings;
	}

	function start($payment_data)
	{
		$order_id 	= $payment_data['order_id'];
		$price 		= $payment_data['price'];
		$callback_url = add_query_arg(array('order_id'=>$order_id),$this->callback_url);

		$mellatbank = new cupri_mellatbank(array('terminal'=>$this->settings['terminal'],'username'=>$this->settings['username'],'password'=>$this->settings['password'],'currency'=>'IRT'),false);
		$mellatbank->startPayment($price, $callback_url, $order_id );
	}
	function end($payment_data)
	{
		$order_id = $_REQUEST['order_id'];
		$mellatbank = new cupri_mellatbank(array('_orderid'=>$order_id,'terminal'=>$this->settings['terminal'],'username'=>$this->settings['username'],'password'=>$this->settings['password'],'currency'=>'IRT'),false);
		if($mellatbank->check($_POST))
		{
			$this->success($order_id);
            $this->set_res_code($order_id,esc_html($_POST['SaleReferenceId'] ));
			echo cupri_success_msg('پرداخت شما با موفقیت انجام شد.با تشکر ، کد تراکنش : '.esc_html($_POST['SaleReferenceId'] ),$order_id);
		}else{
			$this->failed($order_id);
			echo cupri_failed_msg('در انجام تراکنش مشکلی رخ داده است،لطفا مجددا تلاش کنید.',$order_id);
		}
		
	}

}

cupri_mellat_gateway::get_instance('mellat','درگاه بانک ملت');

