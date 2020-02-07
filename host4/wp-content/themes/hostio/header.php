<!DOCTYPE html>

<html <?php language_attributes(); ?>>





    <head>

        <meta charset="<?php bloginfo( 'charset' ); ?>">

        <meta name="viewport" content="width=device-width, initial-scale=1,maximum-scale=1, user-scalable=no">

        <?php wp_head(); ?>

<link rel='stylesheet' id='hi-shop-rtl' href='<?php bloginfo('template_directory'); ?>/css/bootstrap-rtl.min.css' type='text/css' media='all' />



    </head> 

    <body <?php body_class(); ?>>

        <nav id="mainNav" class="navbar navbar-default navbar-full" data-offset-top="0" data-spy="affix">

            <div class="container container-nav">

                <div class="navbar-header">

                    <button aria-expanded="false" type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs">

                        <span class="icon-bar"></span>

                        <span class="icon-bar"></span>

                        <span class="icon-bar"></span>

                    </button>

                    <a class="navbar-brand page-scroll" href="<?php echo esc_url(home_url('/')); ?>">

                        <?php $hostio_redux = get_option('hostio_redux');if(isset($hostio_redux['logo']['url'])){?>



						

                          <?php  if($hostio_redux['logo']['url'] != ''){ ?>

                          <img src="<?php echo esc_url($hostio_redux['logo']['url']); ?>">

                            <?php }else{ ?>

                          <img class="logo" src="<?php echo get_template_directory_uri();?>/images/logo.png">

                          <?php }?>

                          <?php }else{ ?>

                          <img class="logo" src="<?php echo get_template_directory_uri();?>/images/logo.png">

                          <?php }?>

                    </a>

                </div>

                <div role="main" aria-expanded="false" class="navbar-collapse collapse" id="bs">

                    <?php 

                      wp_nav_menu( 

                      array( 

                            'theme_location' => 'primary',

                            'container' => '',

                            'menu_class' => '', 

                            'menu_id' => '',

                            'menu'            => '',

                            'container_class' => '',

                            'container_id'    => '',

                            'echo'            => true,

                             'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',

                             'walker'            => new hostio_wp_bootstrap_navwalker(),

                            'before'          => '',

                            'after'           => '',

                            'link_before'     => '',

                            'link_after'      => '',

                            'items_wrap'      => '<ul class="nav navbar-nav navbar-right fa-hi-shop %2$s">%3$s</ul>',

                            'depth'           => 0,        

                        )

                     ); ?>

                </div>

            </div>

        </nav> 