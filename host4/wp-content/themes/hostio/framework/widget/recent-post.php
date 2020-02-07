<?php
/**
 * Recent_Posts widget class
 *
 * @since 2.8.0
 */
class hostio_widget_newss extends WP_Widget {

    function __construct() {
        $widget_ops = array('classname' => 'widget_news', 'description' => esc_html__( "The most recent posts on your site", 'hostio') );
        parent::__construct('recent-posts', esc_html__('hostio Recent Posts', 'hostio'), $widget_ops);
        $this->alt_option_name = 'widget_news';

    }

    function widget($args, $instance) {
        $cache = wp_cache_get('hostio_widget_newss', 'widget');

        if ( !is_array($cache) )
            $cache = array();

        if ( ! isset( $args['widget_id'] ) )
            $args['widget_id'] = $this->id;

        if ( isset( $cache[ $args['widget_id'] ] ) ) {
            echo $cache[ $args['widget_id'] ];
            return;
        }

        ob_start();
        extract($args);

        $title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : esc_html__( 'Recent Posts', 'hostio' );
        $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );
        $number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 10;
        if ( ! $number )
            $number = 10;
        $show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;

        $r = new WP_Query( apply_filters( 'widget_posts_args', array( 'posts_per_page' => $number, 'no_found_rows' => true, 'post_status' => 'publish', 'ignore_sticky_posts' => true ) ) );
        if ($r->have_posts()) :
?>
        <div id="popular-posts" class="widget">
        <?php if ( $title ) echo $before_title . esc_attr($title) . $after_title; ?>
        <?php while ( $r->have_posts() ) : $r->the_post(); ?>
            <div class="item row">
                <div class="info col-xs-12">
                    <span class="date"><?php the_time('j F,Y');?></span>
                    <span class="title">
                        <a href="<?php the_permalink() ?>"><?php echo get_the_title() ? get_the_title() : get_the_ID(); ?></a>
                    </span>
                </div>
            </div>
        <?php endwhile; ?>
        
       </div>
<?php
        // Reset the global $the_post as this query will have stomped on it
        wp_reset_postdata();

        endif;

        $cache[$args['widget_id']] = ob_get_flush();
        wp_cache_set('hostio_widget_newss', $cache, 'widget');
    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['number'] = (int) $new_instance['number'];
        $instance['show_date'] = (bool) $new_instance['show_date'];
        

        $alloptions = wp_cache_get( 'alloptions', 'options' );
        if ( isset($alloptions['widget_news']) )
            delete_option('widget_news');

        return $instance;
    }

    

    function form( $instance ) {
        $title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
        $number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
        $show_date = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;
?>
        <p><label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e( 'Title:', 'hostio' ); ?></label>
        <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

        <p><label for="<?php echo esc_attr($this->get_field_id( 'number' )); ?>"><?php esc_html_e( 'Number of posts to show:', 'hostio' ); ?></label>
        <input id="<?php echo esc_attr($this->get_field_id( 'number' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'number' )); ?>" type="text" value="<?php echo esc_attr($number); ?>" size="3" /></p>

        <p><input class="checkbox" type="checkbox" <?php checked( $show_date ); ?> id="<?php echo esc_attr($this->get_field_id( 'show_date' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'show_date' )); ?>" />
        <label for="<?php echo esc_attr($this->get_field_id( 'show_date' )); ?>"><?php esc_html_e( 'Display post date?', 'hostio' ); ?></label></p>
<?php
    }
}









class hostio_widget_search extends WP_Widget {

    function __construct() {
        $widget_ops = array('classname' => 'widget_search', 'description' => esc_html__( "Search on your site", 'hostio') );
        parent::__construct('search', esc_html__('hostio Search', 'hostio'), $widget_ops);
        $this->alt_option_name = 'widget_search';

        
    }

    function widget($args, $instance) {
        $cache = wp_cache_get('hostio_widget_search', 'widget');

        if ( !is_array($cache) )
            $cache = array();

        if ( ! isset( $args['widget_id'] ) )
            $args['widget_id'] = $this->id;

        if ( isset( $cache[ $args['widget_id'] ] ) ) {
            echo $cache[ $args['widget_id'] ];
            return;
        }

        ob_start();
        extract($args);

        $title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : esc_html__( 'Search', 'hostio' );
        $title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

        ?>

        <div class="row">
          <div id="custom-search-input">
            <form class="input-group col-md-12" action="<?php echo esc_url(home_url('/')) ?>" method="post">
              <input type="text" class="form-control input-lg" placeholder="<?php echo esc_html__( 'Search...', 'hostio' );?>" name="s"/>
              <span class="input-group-btn">
              <button class="btn btn-info btn-lg" type="submit"> <i class="glyphicon glyphicon-search"></i> </button>
              </span> </form>
          </div>
        </div>
<?php
        // Reset the global $the_post as this query will have stomped on it
   

        $cache[$args['widget_id']] = ob_get_flush();
        wp_cache_set('hostio_widget_search', $cache, 'widget');
    }

    function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        

        $alloptions = wp_cache_get( 'alloptions', 'options' );
        if ( isset($alloptions['widget_search']) )
            delete_option('widget_search');

        return $instance;
    }

    

    function form( $instance ) {
        $title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
?>
        <p><label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php esc_html_e( 'Title:', 'hostio' ); ?></label>
        <input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr($title); ?>" /></p>

      
<?php
    }
}


function hostio_register_custom_widgets() {
    register_widget( 'hostio_widget_search' );
    register_widget( 'hostio_widget_newss' );
}
add_action( 'widgets_init', 'hostio_register_custom_widgets' );    


