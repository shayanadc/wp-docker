<?php
/**
 * Template Name: Login Register
 */
 $hostio_redux = get_option('hostio_redux');
get_header('login'); ?>
        
      <?php while (have_posts()) : the_post()?>
          <?php the_content(); ?>
        <?php endwhile; ?>
<?php
get_footer('login');
?>