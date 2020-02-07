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
            $wpcrl_form_settings = get_option('wpcrl_form_settings');
            $form_heading = empty($wpcrl_form_settings['wpcrl_signup_heading']) ? 'Register' : $wpcrl_form_settings['wpcrl_signup_heading'];

            // check if the user already login
            if (!is_user_logged_in()) :

                ?>
                
                <a href="<?php echo esc_url(home_url('/')); ?>">
                    <?php $hostio_redux = get_option('hostio_redux');if(isset($hostio_redux['logo']['url'])){?>
                      <?php  if($hostio_redux['logo']['url'] != ''){ ?>
                      <img src="<?php echo esc_url($hostio_redux['logo']['url']); ?>"  alt="Hostio">
                        <?php }else{ ?>
                      <img class="logo" src="<?php echo get_template_directory_uri();?>/images/logo.png" alt="Hostio">
                      <?php }}else{ ?>
                      <img class="logo" src="<?php echo get_template_directory_uri();?>/images/logo.png" alt="Hostio">
                      <?php }?>
                </a>
                <div class="form-title">ساخت حساب کاربری</div>
                <form name="wpcrlRegisterForm" id="wpcrlRegisterForm" method="post">

                    <div id="wpcrl-reg-loader-info" class="wpcrl-loader" style="display:none;">
                        <img src="<?php echo plugins_url('images/ajax-loader.gif', dirname(__FILE__)); ?>"/>
                        <span><?php _e('لطفا صبر کنید...', $this->plugin_name); ?></span>
                    </div>
                    <div id="wpcrl-register-alert" class="alert alert-danger" role="alert" style="display:none;"></div>
                    <div id="wpcrl-mail-alert" class="alert alert-danger" role="alert" style="display:none;"></div>
                    <?php if ($token_verification): ?>
                        <div class="alert alert-info" role="alert"><?php _e('حساب شما فعال شده است، شما می توانید وارد شوید.', $this->plugin_name); ?></div>
                    <?php endif; ?>
                    <div class="form-group form-text">
                        <input type="text" class="form-control" name="wpcrl_username" id="wpcrl_username" placeholder="نام کاربری">
                    </div>
                    <div class="form-group form-text">
                        <input type="password" class="form-control" name="wpcrl_password" id="wpcrl_password" placeholder="رمز عبور" >
                    </div>
                    <div class="form-group form-text">
                        <input type="password" class="form-control" name="wpcrl_password2" id="wpcrl_password2" placeholder="تایید رمز عبور" >
                    </div>
                    <div class="form-group form-text">
                        <input type="text" class="form-control" name="wpcrl_email" id="wpcrl_email" placeholder="ایمیل">
                    </div>
                    

                    <input type="hidden" name="wpcrl_current_url" id="wpcrl_current_url" value="<?php echo get_permalink(); ?>" />
                    <input type="hidden" name="redirection_url" id="redirection_url" value="<?php echo get_permalink(); ?>" />

                    <?php
                    // this prevent automated script for unwanted spam
                    if (function_exists('wp_nonce_field'))
                        wp_nonce_field('wpcrl_register_action', 'wpcrl_register_nonce');

                    ?>
                    <div class="form-button">
                        <input id="submit" type="submit" value="ساخت حساب کاربری">
                    </div>
                </form>
                <div class="links-holder"><a href="<?php echo get_template_directory_uri();?>/login; ?>">ورود</a> و یا <a href="<?php echo esc_url(home_url('/')); ?>"> بازگشت به صفحه اصلی </a></div>
                <?php
            else:
                $current_user = wp_get_current_user();
                $logout_redirect = (empty($wpcrl_form_settings['wpcrl_logout_redirect']) || $wpcrl_form_settings['wpcrl_logout_redirect'] == '-1') ? '' : $wpcrl_form_settings['wpcrl_logout_redirect'];

                echo 'Logged in as <strong>' . ucfirst($current_user->user_login) . '</strong>. <a href="' . wp_logout_url(get_permalink($logout_redirect)) . '">Log out ? </a>';
            endif;

            ?>
                    </div>
                </div>
        </div>
    </div>
</div>