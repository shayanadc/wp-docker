<?php
/**
 * The Template for displaying all single posts
 */ 
 $hostio_redux = get_option('hostio_redux');
get_header(); ?>
<div id="top-content" class="container-fluid inner-page">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="page-title"><?php the_title();?></div>
                <div class="page-subtitle"></div>
            </div>
        </div>
    </div>
</div>
<div id="page-content" class="container-fluid">
    <div class="container">
        <div id="post-body" class="row">
            <div id="post-holder" class="col-md-9">
              <?php
                while ( have_posts() ) : the_post();
                $i =0;
                $i++;
                ?>
                <div id="post-<?php echo esc_attr($i); ?>" class="post">
                    <div class="post-thumbnail">
                        <?php if ( has_post_thumbnail() ) { ?>
                            <img src="<?php echo wp_get_attachment_url(get_post_thumbnail_id());?>">
                        <?php }?>  
                    </div>
                    <?php if ( is_sticky() )
     echo '<span class="featured-post">' . esc_html__( 'Sticky Template', 'hostio' ) . '</span>';
     ?>
                    <ul class="cate">
                  <?php the_category(', '); ?>
                              </ul>    
                    <div class="meta">
                        <span class="comment"><?php comments_popup_link( esc_html__(' 0 comment', 'hostio'), esc_html__(' 1 comment', 'hostio'), ' % comments'.__('', 'hostio')); ?> </span>
                    </div>
                    <div class="post-content">
                        <p><?php the_content();?></p>
                        <?php wp_link_pages(  ); ?>
                    </div>
                </div>
                <?php endwhile; ?>
                <div class="post-author">
                    <?php comments_template();?>
                    <?php paginate_comments_links(); ?>
                </div>
            </div>
            <div id="sidebar" class="col-md-3">
                <div class="widget-area">
                    <?php get_sidebar();?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php if(isset($hostio_redux['footer_template'])){echo do_shortcode(esc_attr($hostio_redux['footer_template']));}?>
<?php
get_footer();
?>