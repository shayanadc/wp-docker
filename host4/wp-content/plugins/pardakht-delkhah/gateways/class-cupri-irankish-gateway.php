<?php
defined('ABSPATH') or die('No script kiddies please!');

class cupri_irankish_gateway extends cupri_abstract_gateway {
	static protected $instance = null;

	function add_settings($settings) {
		$settings['merchant_id'] = 'کد مرچنت';
		$settings['sha1Key'] = 'sha1Key';
		return $settings;
	}

	function start($payment_data) {
		$order_id = $payment_data['order_id'];
		$price = $payment_data['price'];
		$callback_url = add_query_arg(array('order_id' => $order_id), $this->callback_url);

		$merchant_id = $this->settings['merchant_id']; //Required
		$sha1Key = $this->settings['sha1Key']; //Required

		$Amount = $price; //Amount will be based on Toman - Required
		$Description = 'خرید با شناسه ' . $order_id; // Required
		$Email = ''; // Optional
		$Mobile = ''; // Optional
		$CallbackURL = $callback_url; // Required

		$client = new SoapClient('https://ikc.shaparak.ir/XToken/Tokens.xml', array('soap_version' => SOAP_1_1));

		$params['amount'] = $Amount * 10; // to rial
		$params['merchantId'] = $merchant_id;
		$params['invoiceNo'] = $order_id;
		$params['paymentId'] = $order_id;
		$params['specialPaymentId'] = time();
		$params['revertURL'] = $CallbackURL;
		$params['description'] = $Description;
		$result = $client->__soapCall("MakeToken", array($params));
		$token = $result->MakeTokenResult->token;

        $this->add_meta($order_id,'token' , $token) ;
		$data['token'] = $token;
		$data['merchantId'] = $merchant_id;
		echo cupri_success_msg('در حال انتقال به بانک...');
		$this->redirect_post('https://ikc.shaparak.ir/TPayment/Payment/index', $data);

	}
	function end($payment_data) {
		$order_id = $_REQUEST['order_id'];
        $merchant_id = $this->settings['merchant_id']; //Required
        $sha1Key = $this->settings['sha1Key']; //Required
		$Amount = $this->get_price($order_id);


            if($order_id != '')
            {

                    $resultCode = $_POST['resultCode'];
                    $referenceId = isset($_POST['referenceId']) ? $_POST['referenceId'] : 0;
                    $paymentId = isset($_POST["paymentId"]) ? $_POST['paymentId'] : 0;
                    if ($resultCode == '100')
                    {
                        
                        $amount = $Amount * 10;

                        
                        $client = new SoapClient('https://ikc.shaparak.ir/XVerify/Verify.xml', array('soap_version'   => SOAP_1_1));
                        $params['token'] = $this->get_meta($order_id,'token' ) ;
                        $params['merchantId'] = $merchant_id;
                        $params['referenceNumber'] = $referenceId;
                        $params['sha1Key'] = $sha1Key;
                        $result = $client->__soapCall("KicccPaymentsVerification", array($params));
                        $result = ($result->KicccPaymentsVerificationResult);
                    
                        if( floatval($result) == floatval($amount) )
                        {
                          $this->success($order_id);
                          $this->set_res_code($order_id,$referenceId);
                            echo cupri_success_msg('پرداخت شما با موفقیت انجام شد.با تشکر. کد رهگیری:'.$referenceId,$order_id);
                        }
                        else
                        {
                            $this->failed($order_id);
                            echo cupri_failed_msg('در انجام تراکنش مشکلی رخ داده است،لطفا مجددا تلاش کنید.',$order_id);

                        }
                    }
                    else
                    {
                        switch ($resultCode) 
                        {
                        case 110:
                                $res = " انصراف دارنده کارت";
                            break;
                        case 120:
                            $res ="   موجودی کافی نیست";
                            break;
                        case 130:
                        case 131:
                        case 160:
                            $res ="   اطلاعات کارت اشتباه است";
                            break;
                        case 132:
                        case 133:
                            $res ="   کارت مسدود یا منقضی می باشد";
                            break;
                        case 140:
                            $res =" زمان مورد نظر به پایان رسیده است";
                            break;
                        case 200:
                        case 201:
                        case 202:
                            $res =" مبلغ بیش از سقف مجاز";
                            break;
                        case 166:
                            $res =" بانک صادر کننده مجوز انجام  تراکنش را صادر نکرده";
                            break;
                        case 150:
                        default:
                            $res =" خطا بانک  $resultCode";
                        break;
                        }
                        echo cupri_failed_msg('خظا:'.$res);
                    }

            }


	}

	function redirect_post($url, array $data) {

		echo '<form name="redirectpost" id="redirectpost" method="post" action="' . $url . '">';

		if (!is_null($data)) {
			foreach ($data as $k => $v) {
				echo '<input type="hidden" name="' . $k . '" value="' . $v . '"> ';
			}
		}

		echo ' </form><div id="main">
                 <script type="text/javascript">

                                document.getElementById("redirectpost").submit();

                        </script>
                    </body>
                    </html>';

		exit;
	}
}

cupri_irankish_gateway::get_instance('irankish', 'ایران کیش');
