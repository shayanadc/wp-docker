<?php
/**
 * The template for displaying 404 pages (Not Found)
 */
$hostio_redux = get_option('hostio_redux'); 
get_header(); ?>

        <!-- Inner Banner Wrapper End -->
        <div id="top-content" class="container-fluid inner-page">
          <div class="container">
              <div class="row">
                  <div class="col-md-12 text-center">
                    <h1><?php if(isset($hostio_redux['404_title'])){?>
                                        <?php echo htmlspecialchars_decode(esc_attr($hostio_redux['404_title']));?>
                                        <?php }else{?>
                                        <?php echo esc_html__( '404', 'hostio' );
                                        }
                                        ?></h1>
                    <h2><?php if(isset($hostio_redux['404_desc'])){?>
                                        <?php echo htmlspecialchars_decode(esc_attr($hostio_redux['404_desc']));?>
                                        <?php }else{?>
                                        <?php echo esc_html__( 'Oops!! Page not found', 'hostio' );
                                        }
                                        ?></h2>
                    <p><?php echo esc_html__( 'Make sure that you have typed the correct URL', 'hostio' );?></p>
                    <a href="<?php echo esc_url(home_url('/')); ?>"><?php echo esc_html__( 'Back to home page', 'hostio' );?></a>
                  </div>
            </div>
          </div>
        </div>
<?php if(isset($hostio_redux['footer_template'])){echo do_shortcode(esc_attr($hostio_redux['footer_template']));}?>
   <?php
get_footer();

?>