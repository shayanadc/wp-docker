<?php
/**
 * Template Name: Other Page
 */
 $hostio_redux = get_option('hostio_redux');;
 $textdoimain = 'hostio';
get_header(''); ?>
<?php if (have_posts()){ ?>
    
                        <?php while (have_posts()) : the_post()?>

            <!-- Inner Banner Wrapper Start -->
<div class="inner-banner">
                <div class="container">
                  <div class="col-sm-12">
                    <h2><?php the_title();?></h2>
                  </div>
                  <div class="col-sm-12 inner-breadcrumb">
                    <ul>
                      <li><a href="<?php echo esc_url(home_url('/')); ?>"><?php echo esc_html__( 'Home', 'hostio' ); ?></a></li>
                      <li><?php the_title();?></li>
                    </ul>
                  </div>
                </div>
              </div>
            <!-- Inner Banner Wrapper End -->

                        
                            <?php the_content(); ?>
                        <?php endwhile; ?>
                    
                    <?php }else {
                        echo esc_html__( 'Page Canvas For Page Builder', 'hostio' ); 
                    }?>

                    

<?php
get_footer();
?>