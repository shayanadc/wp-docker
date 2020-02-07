<?php
/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       http://www.daffodilsw.com/
 * @since      1.0.0
 *
 * @package    Wp_Custom_Register_Login
 * @subpackage Wp_Custom_Register_Login/public/partials
 */

?>

<div class="container-fluid" id="wpcrlLoginSection">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="signin-signup-form"> 
            <?php
            $wpcrl_redirect_settings = get_option('wpcrl_redirect_settings');
            $wpcrl_form_settings = get_option('wpcrl_form_settings');

            // check if the user already login
            if (!is_user_logged_in()) :
                
                $form_heading = empty($wpcrl_form_settings['wpcrl_signin_heading']) ? 'Login' : $wpcrl_form_settings['wpcrl_signin_heading'];
                $submit_button_text = empty($wpcrl_form_settings['wpcrl_signin_button_text']) ? 'Login' : $wpcrl_form_settings['wpcrl_signin_button_text'];
                $forgotpassword_button_text = empty($wpcrl_form_settings['wpcrl_forgot_password_button_text']) ? 'Forgot Password' : $wpcrl_form_settings['wpcrl_forgot_password_button_text'];
                $is_url_has_token = $_GET['wpcrl_reset_password_token'];
                ?>

                <a href="<?php echo esc_url(home_url('/')); ?>">
                    <?php $hostio_redux_demo = get_option('hostio_redux_demo');if(isset($hostio_redux_demo['logo']['url'])){?>
                      <?php  if($hostio_redux_demo['logo']['url'] != ''){ ?>
                      <img src="<?php echo esc_url($hostio_redux_demo['logo']['url']); ?>"  alt="Hostio">
                        <?php }else{ ?>
                      <img class="logo" src="<?php echo get_template_directory_uri();?>/images/logo.png" alt="Hostio">
                      <?php }}else{ ?>
                      <img class="logo" src="<?php echo get_template_directory_uri();?>/images/logo.png" alt="Hostio">
                      <?php }?>
                </a>
                <div class="form-title">ورود به حساب کاربری</div>
                <form name="wpcrlLoginForm" id="wpcrlLoginForm" method="post" class="<?php echo empty($is_url_has_token) ? '' : 'hidden' ?>">
                    <div id="wpcrl-login-loader-info" class="wpcrl-loader" style="display:none;">
                        <img src="<?php echo plugins_url('images/ajax-loader.gif', dirname(__FILE__)); ?>"/>
                        <span><?php _e('لطفا صبر کنید...', $this->plugin_name); ?></span>
                    </div>
                    <div id="wpcrl-login-alert" class="alert alert-danger" role="alert" style="display:none;"></div>

                    <div class="form-group form-text">
                        <input type="text" class="form-control" name="wpcrl_username" id="wpcrl_username" placeholder="نام کاربری">
                    </div>
                    <div class="form-group form-text">
                        <input type="password" class="form-control" name="wpcrl_password" id="wpcrl_password" placeholder="رمز عبور" >
                    </div>
                    <?php
                    $login_redirect = (empty($wpcrl_redirect_settings['wpcrl_login_redirect']) || $wpcrl_redirect_settings['wpcrl_login_redirect'] == '-1') ? '' : $wpcrl_redirect_settings['wpcrl_login_redirect'];
                    
                    ?>
                    <input type="hidden" name="redirection_url" id="redirection_url" value="<?php echo get_permalink($login_redirect); ?>" />

                    <?php
                    // this prevent automated script for unwanted spam
                    if (function_exists('wp_nonce_field'))
                        wp_nonce_field('wpcrl_login_action', 'wpcrl_login_nonce');

                    ?>
                    <div class="form-button">
                        <input id="submit" type="submit" value="<?php _e($submit_button_text, $this->plugin_name); ?>">
                    </div>
                </form>
                <div class="links-holder"><a href="<?php echo get_template_directory_uri();?>/register; ?>"> ایجاد حساب کاربری</a> و یا <a href="<?php echo esc_url(home_url('/')); ?>">بازگشت به صفحه اصلی</a></div>
                <?php
                    //render the reset password form
                    if($wpcrl_form_settings['wpcrl_enable_forgot_password']){
                        do_shortcode('[wpcrl_resetpassword_form]');
                    }
                ?>
                
                <?php
                    //render the reset password form
                    if($wpcrl_form_settings['wpcrl_enable_forgot_password']){
                        do_shortcode('[wpcrl_resetpassword_form]');
                    }
                ?>
            
                <?php
            else:
                $current_user = wp_get_current_user();
                $logout_redirect = (empty($wpcrl_redirect_settings['wpcrl_logout_redirect']) || $wpcrl_redirect_settings['wpcrl_logout_redirect'] == '-1') ? '' : $wpcrl_redirect_settings['wpcrl_logout_redirect'];
                
                echo 'وارد شده با حساب کاربری <strong>' . ucfirst($current_user->user_login) . '</strong>. <a href="' . wp_logout_url(get_permalink($logout_redirect)) . '">خروج از حساب کاربری </a>';

            endif;

            ?>
                </div>
            </div>
        </div>
    </div>
</div>