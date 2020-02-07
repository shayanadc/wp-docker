<?php
defined( 'ABSPATH' ) or die(  'No script kiddies please!' );
if(!class_exists('nusoap_client'))
{
	require_once 'nusoap.php';
}
require_once 'class-cupri-abstract-gateway.php';
require_once 'class-cupri-mellat-gateway.php';
require_once 'class-cupri-zarinpal-gateway.php';
require_once 'class-cupri-payir-gateway.php';
require_once 'class-cupri-irankish-gateway.php';
require_once 'class-cupri-melli-gateway.php';
require_once 'class-cupri-mabna-gateway.php';
require_once 'class-cupri-mabnanew-gateway.php';

// cupri_start_payment
