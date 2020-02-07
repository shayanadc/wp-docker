<?php
defined('ABSPATH') or die('No script kiddies please!');

class cupri_mabnanew_gateway extends cupri_abstract_gateway {
	static protected $instance = null;

	function add_settings($settings) {
		$settings['terminal'] = 'terminal';
		return $settings;
	}

	function start($payment_data) {
		$order_id = $payment_data['order_id'];
		//create unique order id and prevent duplicate order id error
		$rand_order_id = $order_id . mt_rand(11111, 99999);

		$this->add_meta($order_id, 'rand_order_id', $rand_order_id);

		$price = $payment_data['price']*10; // this gateway based on rial
		$callback_url = add_query_arg(array('order_id' => $order_id), $this->callback_url);

		$terminal = trim($this->settings['terminal']); //Required

		echo cupri_success_msg('در حال انتقال به بانک...');

		echo '<center><form id="pardakht_delkhah_mabna2" action="https://mabna.shaparak.ir:8080" method="POST">
			<input type="hidden" id="TerminalID" name="TerminalID" value="' . $terminal . '">
			<input type="hidden" id="Amount" name="Amount" value="' . $price . '">
			<input type="hidden" id="callbackURL" name="callbackURL" value="' . $callback_url . '">
			<input type="hidden" id="InvoiceID" name="InvoiceID" value="' . $rand_order_id . '">
			<input type="hidden" id="Payload" name="Payload" value="">
			<input type="submit" value="در صورت عدم هدایت به درگاه کلیک کنید" class="submit" />
			</form><center><script>
			window.onload=function(){document.getElementById("pardakht_delkhah_mabna2").submit();}; </script>';

	}
	function end($payment_data) {
		$order_id = $_REQUEST['order_id'];
		$terminal = $this->settings['terminal']; //Required
		$Amount = $amount = $this->get_price($order_id);
		$Amount = $Amount * 10; // convert to toman
		$digitalreceipt = isset($_POST['digitalreceipt'])?$_POST['digitalreceipt']:'';

		if (isset($_POST['respcode']) && $_POST['respcode'] == '0') {
			if ($this->digitalreceipt_is_valid($digitalreceipt)) {
				$params = 'digitalreceipt=' . $digitalreceipt . '&Tid=' . $terminal;
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, 'https://mabna.shaparak.ir:8081/V1/PeymentApi/Advice');
				curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
				curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				$res = curl_exec($ch);
				curl_close($ch);
				$result = json_decode($res, true);
				if (strtoupper($result['Status']) == 'OK') {

					if (floatval($result['ReturnId']) == floatval($Amount)) {
						//success
						//save $digitalreceipt for prevent duplicate use
						update_post_meta($order_id, '_mabna2_digitalreceipt', $digitalreceipt);

						$referenceId = $digitalreceipt;

						$this->msg['message'] = "پرداخت شما با موفقیت انجام شد<br/> کد ارجاع : $referenceId";
						$this->msg['class'] = 'success';
						$this->success($order_id);
						$this->set_res_code($order_id, $referenceId);
						echo cupri_success_msg($this->msg['message'] , $order_id);
						return;
					} else {
						$res = 'مبلغ واریز با قیمت محصول برابر نیست ، مبلغ واریزی :' . $result['ReturnId'];
					}

				} else {
					switch ($result['ReturnId']) {
					case '-1':$res = 'تراکنش پیدا نشد';
						break;
					case '-2':$res = 'تراکنش قبلا Reverse شده است';
						break;
					case '-3':$res = 'خطا عمومی';
						break;
					case '-4':$res = 'امکان انجام درخواست برای این تراکنش وجود ندارد';
						break;
					case '-5':$res = 'آدرس IP پذیرنده نامعتبر است';
						break;
					default:$res = 'خطای ناشناس : ' . $result['ReturnId'];
						break;

					}
				}
			} else {
				$res = 'رسید قبلا استفاده شده است';
			}
		} else {
			$res = 'برگشت نا موفق از درگاه';
		}
		$this->msg['message'] = $res;
		//failed
		$this->failed($order_id);
		echo cupri_failed_msg($this->msg['message'], $order_id);

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
	public function digitalreceipt_is_valid($digitalreceipt) {
		$meta_key = '_mabna2_digitalreceipt';
		$meta_value = $digitalreceipt;
		$args = array(
			'post_type' => 'cupri_pay',
			'post_status' => 'any',
			'meta_query' => array(
				array(
					'key' => $meta_key,
					'value' => $meta_value,
					'compare' => '=',
				),
			),
		);
		$query = new WP_Query($args);
		if ($query->have_posts()) {
			return false;

		}

		return true;
	}
}

cupri_mabnanew_gateway::get_instance('mabnanew', 'مبنا(جدید)');
