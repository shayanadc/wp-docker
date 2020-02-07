<?php
defined('ABSPATH') or die('No script kiddies please!');
/**
 * Base Abstract Class for gateways
 */
abstract class cupri_abstract_gateway {
	public $settings;
	public $callback_url;

	// Force Extending class to define this method
	abstract protected function start($payment_data);
	abstract protected function end($payment_data);


	public static function get_instance($id, $name) {
		$class = get_called_class();
		if (!isset($class::$instance)) {
			$class::$instance = new $class($id, $name);
		}

		return $class::$instance;
	}

	function __construct($id, $name) {
		// error_reporting(E_ALL);
		// ini_set('display_errors','on');
		$this->id = $id;
		$this->name = $name;
		/**
		 * Fetch settings
		 * @var array
		 */	
		$cupri_gateways_settings = get_option('cupri_gateways_settings');
		$this->settings = isset($cupri_gateways_settings[$this->id])?$cupri_gateways_settings[$this->id]:array();
		/**
		 * callback url
		 */
		$this->callback_url = get_bloginfo('url' ).'/?cupri_listen=true&cupri_gateway='.$this->id;

		$this->add_gateway();
		$this->_add_settings();
		$this->_start();
		$this->_end();
	}

	function add_gateway() {
		add_filter('cupri_gateways', array($this, 'cupri_gateways'));
	}

	function cupri_gateways($gateways) {
		$gateways[$this->id] = $this->name;
		return $gateways;
	}

	function _add_settings() {
		add_filter('cupri_gateways_' . $this->id . '_settings', array($this, 'add_settings'));
	}
	function _start() {
		add_action('cupri_start_payment_' . $this->id, array($this, 'start'));
	}
	function _end() {
		if(isset($_REQUEST['order_id']))
		{
			if(get_post_status($_REQUEST['order_id'] ) == 'cupri_paid')
			{
				$completed_msg = __('This order is completed already','cupri');
				echo cupri_failed_msg($completed_msg);
				die();
			}else{
				add_action('cupri_end_payment_' . $this->id, array($this, 'end'));					
			}
		}

	}

	function failed($order_id) {
		$success = false;
		$this->after_payment($success , $order_id);
		add_action('cupri_failed_payment',$order_id);
		return $this->update_status($order_id, 'cupri_failed');
	}
	function success($order_id) {
		$success = true;
		$this->after_payment($success,$order_id);
		add_action('cupri_success_payment',$order_id);
		$this->notification($order_id);
		return $this->update_status($order_id, 'cupri_paid');
	}
	function after_payment($success,$order_id)
	{

		$cupri_general = get_option('cupri_general_settings' , array('admin_sms_format'=>__("New pay:\n {price} \n {mobile}",'cupri'),'admin_email_format'=>__("New pay:\n {price} \n {mobile}",'cupri'),'emails'=>get_option('admin_email'),'active_email_notification'=>1));

		//redirect to another URL if set
		$to_redirect = '';
		#success redirect
		if($success && isset($cupri_general['success_redirect_page']) && !empty($cupri_general['success_redirect_page'])){
			$to_redirect = $cupri_general['success_redirect_page'];
		}

		#failed redirect
		if(!$success && isset($cupri_general['failed_redirect_page']) && !empty($cupri_general['failed_redirect_page'])){
			$to_redirect = $cupri_general['failed_redirect_page'];
		}

		if(!empty($to_redirect))
		{
			$coutdown_value=10;
			if(isset($cupri_general['coutdown_value']) && !empty($cupri_general['coutdown_value']))
			{
					$coutdown_value=$cupri_general['coutdown_value'];
			}
			$coutdown_value = (int)$coutdown_value;
			$to_redirect = trim($to_redirect);
			$to_redirect = add_query_arg(array('order_id'=>$order_id),$to_redirect);
			echo '<p style="text-align: center; font-style: oblique; display: block; margin: auto; font-size: 0.9em; background: #f3f3f3; padding: 5px; border-bottom: 2px solid #bbb; border-top: 2px solid #bbb;" class="cupri_redirect_counter">شما تا <span id="cupri_counter" style="font-weight: bold;">'.$coutdown_value.'</span> ثانیه دیگر منتقل خواهید شد.</p>
			<script type="text/javascript">
			function cupri_js_countdown() {
			    var i = document.getElementById("cupri_counter");
			    if (parseInt(i.innerHTML)<=0) {
			        location.href = "'.$to_redirect.'";
			        clearInterval(redirectInterval);
			    }else{
			    i.innerHTML = parseInt(i.innerHTML)-1;
			    }
			}
			var redirectInterval = setInterval(function(){ cupri_js_countdown(); },1000);
			</script>';
		}

	}
	
	function set_res_code($order_id,$res_code)
	{
		update_post_meta( $order_id, '_cupri_result_code', $res_code );
	}
	function waiting($order_id) {
		return $this->update_status($order_id, 'cupri_waiting');
	}
	function update_status($order_id, $state) {
		if (!$order_id || empty($state)) {
			return;
		}
		$att = array(
			'ID' => $order_id,
			'post_status' => $state,
			);

		return wp_update_post($att);
	}

	function get_price($order_id)
	{
		return get_post_meta( $order_id, '_cupri_fprice', true );
	}

	function get_mobile($order_id)
	{
		return get_post_meta( $order_id, '_cupri_fmobile', true );
	}
	function get_email($order_id)
	{
		return get_post_meta( $order_id, '_cupri_femail', true );
	}
	function notification($order_id)
	{

		$cupri_general = get_option('cupri_general_settings' , array('admin_sms_format'=>__("New pay:\n {price} \n {mobile}",'cupri'),'admin_email_format'=>__("New pay:\n {price} \n {mobile}",'cupri'),'emails'=>get_option('admin_email'),'active_email_notification'=>1));
		//sms
		if(isset($cupri_general['active_sms_notification'],$cupri_general['mobiles']) && $cupri_general['active_sms_notification']==1 && !empty($cupri_general['mobiles']))
		{
			if(function_exists('wp_sms_send'))
			{
				$messgae = $cupri_general['admin_sms_format'];
				$messgae = str_replace(array('{price}','{mobile}'), array($this->get_price($order_id).'<small>('.cupri_get_currency().')</small>',$this->get_mobile($order_id)), $messgae);

				$mobiles = trim($cupri_general['mobiles']);
				$mobiles = str_replace(array('-','،','+',' '),',',$mobiles);
				$mobiles = explode(',', $mobiles);

				// global $sms;
				// $sms->to = $mobiles;
				// $sms->msg = $messgae;
				// $sms->SendSMS();

				$to = $mobiles;
				$msg = $messgae;
				$is_flash = false;
				$log = wp_sms_send( $to, $msg, $is_flash );



			}
		}
		//email
		if(isset($cupri_general['active_email_notification'],$cupri_general['emails']) && $cupri_general['active_email_notification']==1 && !empty($cupri_general['emails']))
		{
				$messgae = $cupri_general['admin_email_format'];
				$messgae = str_replace(array('{price}','{mobile}'), array($this->get_price($order_id),$this->get_mobile($order_id)), $messgae);

				$emails = trim($cupri_general['emails']);
				$emails = explode(',', $emails);

				$to =$emails;
				$subject =__('New payment ','cupri').' - '.get_bloginfo('name');
				$title=__('New payment ','cupri');
				$msg= $messgae;
				$msg = wpautop($msg);

				cupri_mail($to , $subject , $title , $msg);
		}

	}

	function add_meta($order_id , $meta_key , $meta_value)
	{
		return update_post_meta( $this->id.'_'.$order_id, $meta_key, $meta_value );	
	}
	function get_meta($order_id , $meta_key )
	{
		return get_post_meta( $this->id.'_'.$order_id, $meta_key, true );
	}

}



