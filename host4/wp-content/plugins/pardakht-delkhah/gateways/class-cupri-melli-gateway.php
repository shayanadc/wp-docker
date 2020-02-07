<?php
defined('ABSPATH') or die('No script kiddies please!');

class cupri_melli_gateway extends cupri_abstract_gateway {
	static protected $instance = null;

	function add_settings($settings) {
		$settings['merchant'] = 'کد پذیرنده';
		$settings['terminal'] = 'کد ترمینال';
		$settings['password'] = 'پسورد(کلید)';
		return $settings;
	}

	function start($payment_data) {

		$OrderId = $order_id = $payment_data['order_id'];
		$price = $payment_data['price'];
		$callback_url = add_query_arg(array('order_id' => $order_id), $this->callback_url);

		$MerchantId = $merchant = trim($this->settings['merchant']); //Required
		$TerminalId = $terminal = trim($this->settings['terminal']); //Required
		$key = $password = trim($this->settings['password']); //Required
		$Amount = $price * 10; //Rial
		$Description = 'خرید با شناسه ' . $order_id; // Required
		$Email = ''; // Optional
		$Mobile = ''; // Optional
		$ReturnUrl = $CallbackURL = $callback_url; // Required
		$LocalDateTime = date("m/d/Y g:i:s a");

		try {
			$SignData = $this->encrypt_pkcs7("$TerminalId;$OrderId;$Amount", "$key");
			$data = array('TerminalId' => $TerminalId,
				'MerchantId' => $MerchantId,
				'Amount' => $Amount,
				'SignData' => $SignData,
				'ReturnUrl' => $ReturnUrl,
				'LocalDateTime' => $LocalDateTime,
				'OrderId' => $OrderId);
			$str_data = json_encode($data);
			$res = $this->CallAPI('https://sadad.shaparak.ir/vpg/api/v0/Request/PaymentRequest', $str_data);
			$arrres = json_decode($res);
			if ($arrres->ResCode == 0) {
				$Token = $arrres->Token;
				$to_redirect = "https://sadad.shaparak.ir/VPG/Purchase?Token=$Token";
				echo cupri_success_msg('در حال انتقال به بانک...');
				echo '<script>window.location.href="' . $to_redirect . '";</script>';
			} else {
				echo cupri_failed_msg('خطا :' . $arrres->Description);

			}

		} catch (Exception $e) {
			echo cupri_failed_msg('خطا در اتصال به بانک: ' . $e->getMessage());
		}

	}
	function end($payment_data) {
		$OrderId = $order_id = $res_id = $_REQUEST['order_id'];
		$Amount = $this->get_price($order_id);
		$MerchantId = $merchant = trim($this->settings['merchant']); //Required
		$TerminalId = $terminal = trim($this->settings['terminal']); //Required
		$key = $password = trim($this->settings['password']); //Required
		$Token = $_POST["token"];
		$ResCode = $_POST["ResCode"];

		if ($ResCode == 0) {
			$verifyData = array('Token' => $Token, 'SignData' => $this->encrypt_pkcs7($Token, $key));
			$str_data = json_encode($verifyData);
			$res = $this->CallAPI('https://sadad.shaparak.ir/vpg/api/v0/Advice/Verify', $str_data);
			$arrres = json_decode($res);
		}
		if ($arrres->ResCode != -1 && $ResCode == 0) {
			$this->success($order_id);
			$this->set_res_code($order_id, $arrres->SystemTraceNo);
			echo cupri_success_msg('پرداخت شما با موفقیت انجام شد.با تشکر. کد رهگیری:' . $arrres->SystemTraceNo, $order_id);
			//Save $arrres->RetrivalRefNo,$arrres->SystemTraceNo,$arrres->OrderId to DataBase

		} else {
			$this->failed($order_id);
			echo cupri_failed_msg('در انجام تراکنش مشکلی رخ داده است،لطفا مجددا تلاش کنید.', $order_id);

		}

	}

	//Create sign data(Tripledes(ECB,PKCS7))
	function encrypt_pkcs7($str, $key) {
		// new version
		$key = base64_decode($key);
		$method = 'DES-EDE3';
		$iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length($method));
		$encrypted = openssl_encrypt($str, $method, $key, 0, $iv);
		return $encrypted;

		// old version
		/*$key = base64_decode($key);
		$block = mcrypt_get_block_size("tripledes", "ecb");
		$pad = $block - (strlen($str) % $block);
		$str .= str_repeat(chr($pad), $pad);
		$ciphertext = mcrypt_encrypt("tripledes", $key, $str,"ecb");
		return base64_encode($ciphertext);*/
	}
	//Send Data
	function CallAPI($url, $data = false) {
		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
		curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Content-Length: ' . strlen($data)));
		$result = curl_exec($curl);
		curl_close($curl);
		return $result;
	}

}

cupri_melli_gateway::get_instance('melli', 'ملی(جدید)');
