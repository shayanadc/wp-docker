<?php
defined('ABSPATH') or die('No script kiddies please!');

class cupri_mabna_gateway extends cupri_abstract_gateway {
	static protected $instance = null;

	function add_settings($settings) {
		$settings['merchant_id'] = 'کد مرچنت';
		$settings['terminal'] = 'terminal';
		$settings['public_key'] = 'public key';
		$settings['private_key'] = 'private key';
		return $settings;
	}

	function start($payment_data) {
		$order_id = $payment_data['order_id'];
		//create unique order id and prevent duplicate order id error
		$rand_order_id = $order_id.mt_rand(11111,99999);

		$this->add_meta($order_id , 'rand_order_id',$rand_order_id);

		$price = $payment_data['price'];
		$callback_url = add_query_arg(array('order_id' => $order_id), $this->callback_url);

		$merchant_id = trim($this->settings['merchant_id']); //Required
		$terminal = trim($this->settings['terminal']); //Required
		$pub_key = trim($public_key = $this->settings['public_key']); //Required
		$key = trim($private_key = $this->settings['private_key']); //Required

		$amount = $Amount = $price; //Amount will be based on Toman - Required
		$Description = 'خرید با شناسه ' . $order_id; // Required
		$Email = ''; // Optional
		$Mobile = ''; // Optional
		$redirect_url = $CallbackURL = $callback_url; // Required

		$amount = trim($amount);
		$client = new nusoap_client("https://mabna.shaparak.ir/TokenService?wsdl", 'wsdl');
		$invoiceNumber = $rand_order_id;
		$invoiceNumber = trim($invoiceNumber);
		$merchant = $merchant_id;
		$redirectAddress = $redirect_url;
		$amount = $amount * 10; // to rial
		$source = $amount . $invoiceNumber . $merchant . $redirectAddress . $terminal;
		if (strpos($pub_key, '-----BEGIN PUBLIC KEY-----') === false) {
			$pub_key = "-----BEGIN PUBLIC KEY-----\n" . $pub_key;
		}

		if (strpos($pub_key, '-----END PUBLIC KEY-----') === false) {
			$pub_key .= "\n-----END PUBLIC KEY-----";
		}

		$key_resource = openssl_get_publickey($pub_key);

		// Amount
		openssl_public_encrypt($amount, $crypttext, $key_resource);
		$Amount = base64_encode($crypttext);

		// CRN
		openssl_public_encrypt($invoiceNumber, $crypttext, $key_resource);
		$CRN = base64_encode($crypttext);

		// MID
		openssl_public_encrypt($merchant, $crypttext, $key_resource);
		$MID = base64_encode($crypttext);

		// TID
		openssl_public_encrypt($terminal, $crypttext, $key_resource);
		$TID = base64_encode($crypttext);

		// TID
		openssl_public_encrypt($redirectAddress, $crypttext, $key_resource);
		$referal = base64_encode($crypttext);

		if (strpos($key, '-----BEGIN PRIVATE KEY-----') === false) {
			$key = "-----BEGIN PRIVATE KEY-----\n" . $key;
		}

		if (strpos($key, '-----END PRIVATE KEY-----') === false) {
			$key .= "\n-----END PRIVATE KEY-----";
		}

		$priv_key = openssl_pkey_get_private($key);
		$signature = '';

		openssl_sign($source, $signature, $priv_key, OPENSSL_ALGO_SHA1);
		$inputArray = array("Token_param" => array("AMOUNT" => $Amount, "CRN" => $CRN, "MID" => $MID,
			"REFERALADRESS" => $referal, "SIGNATURE" => base64_encode($signature), "TID" => $TID));

		$WSResult = $client->call("reservation", $inputArray);
		$signature = base64_decode($WSResult['return']['signature']);
		$ok = openssl_verify($WSResult["return"]["token"], $signature, $key_resource);
		openssl_free_key($key_resource);

		if ($ok == 1 && $WSResult['return']['result'] == 0) {
			echo cupri_success_msg('در حال انتقال به بانک...');
			$to_post = 'https://mabna.shaparak.ir';
			$post_data = array(
				'TOKEN' => $WSResult["return"]["token"],
			);
			$this->redirect_post($to_post, $post_data);
			return;
		} else {
			echo cupri_failed_msg($WSResult["return"]["token"]);
		}

	}
	function end($payment_data) {
		$order_id = $_REQUEST['order_id'];
		$merchant_id = $this->settings['merchant_id']; //Required
		$terminal = $this->settings['terminal']; //Required
		$Amount = $amount = $this->get_price($order_id);

		if ($order_id != '') {

			if (isset($_POST['CRN']) && isset($_POST['TRN']) && isset($_POST['RESCODE']) && $_POST['RESCODE'] == '00') {

				$amount = $amount * 10;

				$merchant = trim($this->settings['merchant_id']); //Required
				$terminal = trim($this->settings['terminal']); //Required
				$pub_key = trim($public_key = $this->settings['public_key']); //Required
				$key = trim($private_key = $this->settings['private_key']); //Required

				$client = new nusoap_client("https://mabna.shaparak.ir/TransactionReference/TransactionReference?wsdl", 'wsdl');
				$error = $client->getError();

				if (strpos($pub_key, '-----BEGIN PUBLIC KEY-----') === false) {
					$pub_key = "-----BEGIN PUBLIC KEY-----\n" . $pub_key;
				}

				if (strpos($pub_key, '-----END PUBLIC KEY-----') === false) {
					$pub_key .= "\n-----END PUBLIC KEY-----";
				}

				$key_resource = openssl_get_publickey($pub_key);

				openssl_public_encrypt($_POST["TRN"], $crypttext, $key_resource);
				$TRN = base64_encode($crypttext);

				// CRN
				openssl_public_encrypt($_POST["CRN"], $crypttext, $key_resource);
				$CRN = base64_encode($crypttext);

				// MID
				openssl_public_encrypt($merchant, $crypttext, $key_resource);
				$MID = base64_encode($crypttext);

				// Sign data
				$source = $merchant . $_POST["TRN"] . $_POST["CRN"];

				if (strpos($key, '-----BEGIN PRIVATE KEY-----') === false) {
					$key = "-----BEGIN PRIVATE KEY-----\n" . $key;
				}

				if (strpos($key, '-----END PRIVATE KEY-----') === false) {
					$key .= "\n-----END PRIVATE KEY-----";
				}

				$priv_key = openssl_pkey_get_private($key);
				$signature = '';
				openssl_sign($source, $signature, $priv_key, OPENSSL_ALGO_SHA1);
				$inputArray = array("SaleConf_req" => array("MID" => $MID,
					"CRN" => $CRN,
					"TRN" => $TRN,
					"SIGNATURE" => base64_encode($signature)));
				$WSResult = $client->call("sendConfirmation", $inputArray);
				$error = $client->getError();
				$signature = base64_decode($WSResult["return"]["SIGNATURE"]);
				$data = $WSResult["return"]["RESCODE"] . $WSResult["return"]["REPETETIVE"] . $WSResult["return"]["AMOUNT"] . $WSResult["return"]["DATE"] . $WSResult["return"]["TIME"] . $WSResult["return"]["TRN"] . $WSResult["return"]["STAN"];

				// state whether signature is okay or not
				$ok = openssl_verify($data, $signature, $key_resource);
				if ($ok == 1) {
					if (($WSResult['return']['RESCODE'] == '00') && ($WSResult['return']['successful'] == true)) {
						if (floatval($WSResult["return"]["AMOUNT"]) == floatval($amount)) {
							$referenceId = $WSResult["return"]["TRN"];
							$this->msg['message'] = "پرداخت شما با موفقیت انجام شد<br/> کد ارجاع : $referenceId";
							$this->msg['class'] = 'success';
							$this->success($order_id);
							$this->set_res_code($order_id, $referenceId);
							echo cupri_success_msg($this->msg['message'] . $referenceId);
							return;
						} else {
							$this->msg['class'] = 'error';
							$this->msg['message'] = "مبلغ پرداختی صحیح نیست";
						}
					} else {
						$this->msg['class'] = 'error';
						$this->msg['message'] = "پرداخت با موفقيت انجام نشد";
					}
				} else {
					$this->msg['class'] = 'error';
					$this->msg['message'] = 'اطلاعات نامعتبر است';
				}

			} else {
				$this->msg['class'] = 'error';
				$this->msg['message'] = 'پرداخت ناموفق بود';
			}

			//failed
			$this->failed($order_id);
			echo cupri_failed_msg($this->msg['message'], $order_id);

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

cupri_mabna_gateway::get_instance('mabna', 'مبنا');
