<?php
defined( 'ABSPATH' ) or die(  'No script kiddies please!' );
?>
<?php 
	wp_enqueue_style( 'wp-color-picker' );
	wp_enqueue_script( 'wp-color-picker' );
 ?>
<div class="wrap">
	<style type="text/css">
		.admin_fields{margin: 40px 0;}
		.cupri_gateways {
			border: 1px dotted #ddd;
			padding: 10px;
			margin: 5px;

		}
		.cupri_gateways .fields{}
	</style>
	<h2></h2>
	<?php 
	if(isset($_POST['cupri_general']) && !empty($_POST['cupri_general']) && wp_verify_nonce( $_REQUEST['_wpnonce'], 'cupri_general_settings_form' ))
	{	
		foreach ($_POST['cupri_general'] as $key => $value) {
			switch ($key) {
				case 'mobiles':{
					if(isset($_POST['cupri_general']['mobile']))
					{
						$_POST['cupri_general']['mobile'] = sanitize_text_field($_POST['cupri_general']['mobile']);
						$_POST['cupri_general']['mobile'] = esc_sql($_POST['cupri_general']['mobile']);
						$_POST['cupri_general']['mobile'] = esc_html($_POST['cupri_general']['mobile']);
					}
				}break;
				case 'active_sms_notification':
				{
					$_POST['cupri_general']['active_sms_notification'] = (int) ($_POST['cupri_general']['active_sms_notification']);
					if($_POST['cupri_general']['active_sms_notification'] > 1)
					{
						$_POST['cupri_general']['active_sms_notification'] = 1;
					}

				}break;
				case 'active_email_notification':
				{
					$_POST['cupri_general']['active_email_notification'] = (int) ($_POST['cupri_general']['active_email_notification']);
					if($_POST['cupri_general']['active_email_notification'] > 1)
					{
						$_POST['cupri_general']['active_email_notification'] = 1;
					}

				}break;
				case 'admin_sms_format':
				{
					$_POST['cupri_general']['admin_sms_format'] = sanitize_text_field($_POST['cupri_general']['admin_sms_format']);

				}break;
				case 'admin_email_format':
				{
					$_POST['cupri_general']['admin_email_format'] = esc_sql($_POST['cupri_general']['admin_sms_format']);

				}break;
				case 'form_color':
				{
					$_POST['cupri_general']['form_color'] = sanitize_text_field($_POST['cupri_general']['form_color']);
					$_POST['cupri_general']['form_color'] = esc_sql($_POST['cupri_general']['form_color']);
					$_POST['cupri_general']['form_color'] = esc_html($_POST['cupri_general']['form_color']);

				}break;
			}
		}

		if(!isset($_POST['cupri_general']['disable_default_style']))
		{
			$_POST['cupri_general']['disable_default_style'] = 0;
		}
		if(!isset($_POST['cupri_general']['active_sms_notification']))
		{
			$_POST['cupri_general']['active_sms_notification'] = 0;
		}

		// $_POST['cupri_general'] = array_map('sanitize_text_field', $_POST['cupri_general']);
		update_option( 'cupri_general_settings', $_POST['cupri_general'] );
	}
	$cupri_general = get_option('cupri_general_settings', array('admin_sms_format'=>__("New pay:\n {price} \n {mobile}",'cupri'),'form_color'=>'#51cbee','admin_email_format'=>__("New pay:\n {price} \n {mobile}",'cupri'),'emails'=>get_option('admin_email'),'active_email_notification'=>1));

	 ?>
	 <h1><?php _e('General Settings','cupri'); ?></h1>
	 <hr>
	<form method="post">
	<?php 
	wp_nonce_field( 'cupri_general_settings_form' );
	 ?>
	<div class="cupri_gateways">
		<h2> :: <?php _e('Notifications','cupri'); ?></h2>
		<h5><?php _e('SMS Notifications' , 'cupri'); ?></h5>
		<p class="admin_fields">
			<strong><?php _e('Admin Mobile(s)','cupri') ?></strong><br>
			<input value="<?php echo $cupri_general['mobiles']; ?>" type="text" name="cupri_general[mobiles]">
			<span class="desc"><?php _e('Seperate more mobiles with ,','cupri') ?></span>
		</p>
		<p class="admin_fields">
			<strong><?php _e('Active notification with sms ?','cupri') ?></strong><br>
			<input <?php checked( $cupri_general['active_sms_notification'], 1, true ); ?> type="checkbox" value="1" name="cupri_general[active_sms_notification]">
			<span class="desc"><?php _e('You need to install and configure this plugin:','cupri'); ?>  <a href="https://wordpress.org/plugins/wp-sms/" target="_blank">wp-sms</a></span>
		</p>
		<p class="admin_fields">
			<strong><?php _e('SMS format','cupri') ?></strong><br>
			<textarea name="cupri_general[admin_sms_format]" rows="3"><?php echo $cupri_general['admin_sms_format']; ?></textarea>
			<span class="desc"><?php _e('Possible formats {price} , {mobile}  : ','cupri'); ?></span>
		</p>
		<h5><?php _e('Email Notifications' , 'cupri'); ?></h5>
		<p class="admin_fields">
			<strong><?php _e('Admin Email(s)','cupri') ?></strong><br>
			<input value="<?php echo $cupri_general['emails']; ?>" type="text" name="cupri_general[emails]">
			<span class="desc"><?php _e('Seperate more emails with ,','cupri') ?></span>
		</p>
		<p class="admin_fields">
			<strong><?php _e('Active notification with email ?','cupri') ?></strong><br>
			<input <?php checked( $cupri_general['active_email_notification'], 1, true ); ?> type="checkbox" value="1" name="cupri_general[active_email_notification]">
			<span class="desc"></span>
		</p>
		<p class="admin_fields">
			<strong><?php _e('Email format','cupri') ?></strong><br>
			<textarea name="cupri_general[admin_email_format]" rows="3"><?php echo $cupri_general['admin_email_format']; ?></textarea>
			<span class="desc"><?php _e('Possible formats {price} , {mobile}  : ','cupri'); ?></span>
		</p>
	</div>
	<div class="cupri_gateways">
		<h2> :: <?php _e('Form','cupri'); ?></h2>
		<p class="admin_fields">
			<strong><?php _e('change form color','cupri') ?></strong><br>
			<input  type="text" data-default-color="#51cbee" value="<?php echo $cupri_general['form_color']; ?>" name="cupri_general[form_color]" id="cupri_general_form_color">
			<span class="desc"></span>
		</p>
		<p class="admin_fields">
			<strong><?php _e('Disable default style?','cupri') ?></strong><br>
			<input <?php checked( $cupri_general['disable_default_style'], 1, true ); ?> type="checkbox" value="1" name="cupri_general[disable_default_style]">
			<span class="desc"></span>
		</p>
		<p class="admin_fields">
			<strong><?php _e('Submit button text','cupri') ?></strong><br>
			<input  type="text"  value="<?php echo isset($cupri_general['submit_button_text'])?$cupri_general['submit_button_text']:''; ?>" name="cupri_general[submit_button_text]" >
			<span class="desc"></span>
		</p>
		<p class="admin_fields">
			<strong><?php _e('Success redirect page','cupri') ?></strong><br>
			<input  type="text"  value="<?php echo isset($cupri_general['success_redirect_page'])?$cupri_general['success_redirect_page']:''; ?>" name="cupri_general[success_redirect_page]" >
			<span class="desc"><?php _e('If payment was successful user redirect to this url , to disable leave it empty','cupri') ?></span>
		</p>	
		<p class="admin_fields">
			<strong><?php _e('Fail redirect page','cupri') ?></strong><br>
			<input  type="text"  value="<?php echo isset($cupri_general['failed_redirect_page'])?$cupri_general['failed_redirect_page']:'';  ?>" name="cupri_general[failed_redirect_page]" >
			<span class="desc"><?php _e('If payment was not successful user redirect to this url , to disable leave it empty','cupri') ?></span>
		</p>
		<p class="admin_fields">
			<strong><?php _e('Coutdown value','cupri') ?></strong><br>
			<input  type="number"  value="<?php echo isset($cupri_general['coutdown_value'])?$cupri_general['coutdown_value']:''; ?>" name="cupri_general[coutdown_value]" >
			<span class="desc"></span>
		</p>

	</div>
	<button class="button-primary"><?php _e('Save'); ?></button>
 	</form>

</div>
<script type="text/javascript">
	jQuery(document).ready(function($){
	    $('#cupri_general_form_color').wpColorPicker({defaultColor:"#51cbee"});
	});
</script>
