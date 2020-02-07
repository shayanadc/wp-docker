<?php
defined( 'ABSPATH' ) or die(  'No script kiddies please!' );

class cupri_zarinpal_gateway extends cupri_abstract_gateway
{
    static protected $instance = null;
    

    
	function add_settings($settings)
	{
        add_action('cupri_gateways_'.$this->id.'_tabs_contents',array($this,'tab_contents'));


		$settings['merchant'] = 'مرچنت';
		return $settings;
	}

	function start($payment_data)
	{
		$order_id 	= $payment_data['order_id'];
		$price 		= $payment_data['price'];
		$callback_url = add_query_arg(array('order_id'=>$order_id),$this->callback_url);

        $MerchantID = $this->settings['merchant']; //Required
        $Amount = $price; //Amount will be based on Toman - Required
        $Description = 'خرید با شناسه '.$order_id; // Required
        $Email = ''; // Optional
        $Mobile = ''; // Optional
        $CallbackURL = $callback_url; // Required

        try {
            $client = new SoapClient('https://www.zarinpal.com/pg/services/WebGate/wsdl', array('encoding' => 'UTF-8'));
            $result = $client->PaymentRequest(
                array(
                    'MerchantID' => $MerchantID,
                    'Amount' => $Amount,
                    'Description' => $Description,
                    'Email' => $Email,
                    'Mobile' => $Mobile,
                    'CallbackURL' => $CallbackURL,
                    )
                );

            //Redirect to URL You can do it also by creating a form
            if ($result->Status == 100) {
                $zarinGate = isset($this->settings['zaringate'])?$this->settings['zaringate']:0;
                $gt_zarin_zaringate = '';
                 if($zarinGate ==1)
                 {
                     $gt_zarin_zaringate = '/ZarinGate';
                 }
                $to_redirect = 'https://www.zarinpal.com/pg/StartPay/' . $result->Authority.$gt_zarin_zaringate;
                echo cupri_success_msg('در حال انتقال به بانک...');
                echo '<script>window.location.href="' . $to_redirect . '";</script>';
                //برای استفاده از زرین گیت باید ادرس به صورت زیر تغییر کند:
                //Header('Location: https://www.zarinpal.com/pg/StartPay/'.$result->Authority.'/ZarinGate');
            } else {
                echo cupri_failed_msg('خطا در اتصال به بانک: ' . $result->Status);
                // if(is_integer($order_id))
                //     wp_delete_post( $order_id  , true );
            }
        } catch (Exception $ex) {
            echo $Message = $ex->getMessage();
            $Fault = '';
        }


    }
    function end($payment_data)
    {
      $order_id = $_REQUEST['order_id'];
      $MerchantID = $this->settings['merchant']; 
      $Amount = $this->get_price($order_id);
      $Authority = $_GET['Authority'];

      if ($_GET['Status'] == 'OK' ) {

        $client = new SoapClient('https://www.zarinpal.com/pg/services/WebGate/wsdl', array('encoding' => 'UTF-8'));

        $result = $client->PaymentVerification(
            array(
                'MerchantID' => $MerchantID,
                'Authority' => $Authority,
                'Amount' => $Amount,
                )
            );

        if ($result->Status == 100) {

            $this->success($order_id);
            $this->set_res_code($order_id,$result->RefID);
            echo cupri_success_msg('پرداخت شما با موفقیت انجام شد.با تشکر. کد رهگیری:'.$result->RefID,$order_id);





        } else {
            $this->failed($order_id);
            echo cupri_failed_msg('در انجام تراکنش مشکلی رخ داده است،لطفا مجددا تلاش کنید.',$order_id);
        }
    } else {
        $this->failed($order_id);
        echo cupri_failed_msg('در انجام تراکنش مشکلی رخ داده است،لطفا مجددا تلاش کنید.',$order_id);
    }


}

    function tab_contents()
    {
        // add zarin gate gateway option
        $zarinGate = isset($this->settings['zaringate'])?$this->settings['zaringate']:0;

        echo '<p class="fields"><label><strong>'.__('Enable Zarin Gate','cupri').'</strong><br><input type="checkbox" '.(($zarinGate==1)?'checked="checked"':'').' value="1" name="cupri_gateways[zarinpal][zaringate]"></label></p>';
    }

}

cupri_zarinpal_gateway::get_instance('zarinpal','زرین پال');

