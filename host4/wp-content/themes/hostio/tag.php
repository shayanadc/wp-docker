<?php
 $hostio_redux = get_option('hostio_redux');
get_header(); ?>
<div id="top-content" class="container-fluid inner-page">
    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">
                <div class="page-title"><?php if(isset($hostio_redux['blog_title'])){?>
                    <?php echo htmlspecialchars_decode(esc_attr($hostio_redux['blog_title']));?>
                    <?php }else{?>
                    <?php echo esc_html__( 'Tags', 'hostio' );
                    }
                    ?></div>
                <div class="page-subtitle"></div>
            </div>
        </div>
    </div>
</div>
<div id="page-content" class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-md-9">
              <?php 
                  while (have_posts()): the_post();
                  $i = 0;
                  $i++; 
                ?>
                <div id="post-<?php echo esc_attr($i); ?>" class="post">
                    <div class="row">
                        <?php if ( has_post_thumbnail() ) { ?>
                        <div class="col-md-12">
                            <div class="post-thumbnail">
                                <a href="<?php the_permalink();?>">
                                  <img class="post-image" src="<?php echo wp_get_attachment_url(get_post_thumbnail_id());?>" >
                                </a>
                            </div>
                        </div>
                        <?php }?>
                        <div class="col-md-12">
                            <div class="post-entry">
                                <div class="date-published"><?php the_time(get_option( 'date_format' ));?></div>
                                <?php if ( is_sticky() )
     echo '<span class="featured-post">' . esc_html__( 'Sticky Template', 'hostio' ) . '</span>';
     ?>
                                <a href="<?php the_permalink();?>"><h3 class="post-title"><?php the_title();?></h3></a>
                                <p>
                                    <?php if(isset($hostio_redux['blog_excerpt'])){?>
                                            <?php echo esc_attr(hostio_excerpt($hostio_redux['blog_excerpt'])); ?>
                                            <?php }else{?>
                                            <?php echo esc_attr(hostio_excerpt(50)); 
                                            }
                                            ?>
                                </p>
                                <a href="<?php the_permalink();?>" class="button readmore"><?php if(isset($hostio_redux['read_more'])){?>
                                    <?php echo esc_attr($hostio_redux['read_more']);?>
                                    <?php }else{?>
                                    <?php echo esc_html__( 'Read more', 'hostio' );
                                    }
                                    ?></a>
                                <div class="meta">
                                    <span class="comment"><?php comments_popup_link( esc_html__(' 0 comment', 'hostio'), esc_html__(' 1 comment', 'hostio'), ' % comments'.__('', 'hostio')); ?></span>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <?php endwhile;
                  ?>
                <div class="pagination">
                    <?php hostio_pagination();?>
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