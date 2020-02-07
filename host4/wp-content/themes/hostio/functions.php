<?php



$hostio_redux = get_option('hostio_redux');

//Custom fields:

require_once get_template_directory() . '/framework/widget/recent-post.php';

require_once get_template_directory() . '/framework/wp_bootstrap_navwalker.php';

//Define Text Doimain

require_once get_template_directory() . '/visual/shortcodes.php';

require_once get_template_directory() . '/visual/vc_shortcode.php';

//Theme Set up:

function hostio_theme_setup() {

    /*

     * This theme uses a custom image size for featured images, displayed on

     * "standard" posts and pages.

     */

	add_theme_support( 'custom-header' ); 

	add_theme_support( 'custom-background' );

	  $lang = get_template_directory_uri() . '/languages';

    load_theme_textdomain('hostio', $lang);



    add_theme_support( 'post-thumbnails' );

    // Adds RSS feed links to <head> for posts and comments.

    add_theme_support( 'automatic-feed-links' );

    // Switches default core markup for search form, comment form, and comments

    // to output valid HTML5.

    add_theme_support( "title-tag" );

    add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

    //Post formats



    add_post_type_support( 'post', 'post-formats', array( 'audio',  'gallery', 'image', 'video' ) );

    add_post_type_support( 'portfolio', 'post-formats', array( 'gallery', 'image' ) );

    // This theme uses wp_nav_menu() in one location.

	register_nav_menus( array(

		'primary' => esc_html__( 'Primary Navigation Menu: Chosen menu in Home page, single, blog, pages ...', 'hostio' ),

	) );

    // This theme uses its own gallery styles.

	add_filter( 'use_default_gallery_style', '__return_false' );

}

add_action( 'after_setup_theme', 'hostio_theme_setup' );

if ( ! isset( $content_width ) ) $content_width = 900;







function hostio_theme_scripts_styles() {

	$hostio_redux = get_option('hostio_redux');;

	$protocol = is_ssl() ? 'https' : 'http';



        //Template CSS Files

        wp_enqueue_style( 'bootstrap', get_template_directory_uri().'/css/bootstrap.min.css');

        wp_enqueue_style( 'font-awesome', get_template_directory_uri().'/css/font-awesome.min.css');

        wp_enqueue_style( 'google-font', $protocol .'://fonts.googleapis.com/css?family=Palanquin+Dark:400,500');

        wp_enqueue_style( 'montserrat', get_template_directory_uri().'/fonts/montserrat/font.css');

        wp_enqueue_style( 'hostio-css', get_template_directory_uri().'/fonts/hostio.css');

        wp_enqueue_style( 'hostio-style', get_template_directory_uri().'/css/style.css');

        wp_enqueue_style( 'hostio-stylecss', get_stylesheet_uri(), array(), '2016-02-28' );



	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) )

    wp_enqueue_script( 'comment-reply' );

	//Javascript 

    

    wp_enqueue_script("bootstrap", get_template_directory_uri()."/js/bootstrap.min.js",array(),false,true);

    wp_enqueue_script("createjs", get_template_directory_uri()."/js/createjs.min.js",array(),false,true);

    wp_enqueue_script("handanimation", get_template_directory_uri()."/js/handanimation.js",array(),false,true);

    if(is_page_template( 'page-templates/template-home.php' )){

      wp_enqueue_script("animation-start", get_template_directory_uri()."/js/animation-start.js",array(),false,true);

    }

}

add_action( 'wp_enqueue_scripts', 'hostio_theme_scripts_styles' );





//Custom Excerpt Function

function hostio_do_shortcode($content) {

    global $shortcode_tags;

    if (empty($shortcode_tags) || !is_array($shortcode_tags))

        return $content;

    $pattern = get_shortcode_regex();

    return preg_replace_callback( "/$pattern/s", 'do_shortcode_tag', $content );

}

// Widget Sidebar

function hostio_widgets_init() {

	register_sidebar( array(

        'name'          => esc_html__( 'Primary Sidebar', 'hostio' ),

        'id'            => 'sidebar-1',        

		'description'   => esc_html__( 'Appears in the sidebar section of the site.', 'hostio' ),        

		'before_widget' => '<div id="%1$s" class="widget %2$s">',        

		'after_widget'  => '</div>',        

		'before_title'  => '<h3 class="widget-title">',        

		'after_title'   => '</h3>'

    ) );

    register_sidebar( array(

        'name'          => esc_html__( 'Sidebar Other', 'hostio' ),

        'id'            => 'sidebar-other',        

        'description'   => esc_html__( 'Appears in the sidebar section of the site.', 'hostio' ),        

        'before_widget' => '<div id="%1$s" class="tags %2$s">',        

        'after_widget'  => '</div>',        

    ) );



    register_sidebar( array(

		'name'          => esc_html__( 'Footer One Widget Area', 'hostio' ),

		'id'            => 'footer-area-1',

		'description'   => esc_html__( 'Footer Widget that appears on the Footer.', 'hostio' ),

		'before_widget' => '<div id="%1$s">',

		'after_widget'  => '</div>',

	) );

	

	register_sidebar( array(

		'name'          => esc_html__( 'Footer Two Widget Area', 'hostio' ),

		'id'            => 'footer-area-2',

		'description'   => esc_html__( 'Footer Widget that appears on the Footer.', 'hostio' ),

		'before_widget' => '<div id="%1$s"',

		'after_widget'  => '</div>',

	) );

	

}

add_action( 'widgets_init', 'hostio_widgets_init' );

function hostio_add_class_previous($format){

  $format = str_replace('href=', 'class="icon-left-open-big" href=', $format);

  return $format;

}

function hostio_add_class_next($format){

  $format = str_replace('href=', 'class="icon-right-open-big" href=', $format);

  return $format;

}

add_filter('next_post_link', 'hostio_add_class_next');

add_filter('previous_post_link', 'hostio_add_class_previous');

//function tag widgets

function hostio_tag_cloud_widget($args) {

	$args['number'] = 0; //adding a 0 will display all tags

	$args['largest'] = 18; //largest tag

	$args['smallest'] = 11; //smallest tag

	$args['unit'] = 'px'; //tag font unit

	$args['format'] = 'list'; //ul with a class of wp-tag-cloud

	$args['exclude'] = array(20, 80, 92); //exclude tags by ID

	return $args;

}

add_filter( 'widget_tag_cloud_args', 'hostio_tag_cloud_widget' );

function hostio_excerpt() {

  $hostio_redux = get_option('hostio_redux');;

  if(isset($hostio_redux['blog_excerpt'])){

    $limit = $hostio_redux['blog_excerpt'];

  }else{

    $limit = 40;

  }

  $excerpt = explode(' ', get_the_excerpt(), $limit);

  if (count($excerpt)>=$limit) {

    array_pop($excerpt);

    $excerpt = implode(" ",$excerpt).'...';

  } else {

    $excerpt = implode(" ",$excerpt);

  }

  $excerpt = preg_replace('`[[^]]*]`','',$excerpt);

  return $excerpt;

}





function hostio_news_excerpt() {

  $hostio_redux = get_option('hostio_redux');;

  if(isset($hostio_redux['news_excerpt'])){

    $limit = $hostio_redux['news_excerpt'];

  }else{

    $limit = 40;

  }

  $excerpt = explode(' ', get_the_excerpt(), $limit);

  if (count($excerpt)>=$limit) {

    array_pop($excerpt);

    $excerpt = implode(" ",$excerpt).'';

  } else {

    $excerpt = implode(" ",$excerpt);

  }

  $excerpt = preg_replace('`[[^]]*]`','',$excerpt);

  return $excerpt;

}



if ( !function_exists('hostio_pagination') ) {

function hostio_pagination($prev = '<span aria-hidden="true">Prev</span>', $next = '<span aria-hidden="true">Next</span>', $pages='') {

    global $wp_query, $wp_rewrite;

    $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;

    if($pages==''){

        global $wp_query;

         $pages = $wp_query->max_num_pages;

         if(!$pages)

         {

             $pages = 1;

         }

    }

    $pagination = array(

        'base'          => str_replace( 999999999, '%#%', get_pagenum_link( 999999999 ) ),

        'format'        => '',

        'current'       => max( 1, get_query_var('paged') ),

        'total'         => $pages,

        'prev_text' => $prev,

        'next_text' => $next,       

        'type'          => 'list',

        'end_size'      => 5,

        'mid_size'      => 5

);

    $return =  paginate_links( $pagination );

    echo str_replace( "<ul class='page-numbers'>", '<ul class="pagination">', $return );

}

}



//Get thumbnail url

function hostio_thumbnail_url($size){

    global $post;

    if($size==''){

        $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );

         return $url;

    }else{

        $url = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), $size);

         return $url[0];

    }

}

function hostio_post_nav() {

    global $post;

    // Don't print empty markup if there's nowhere to navigate.

    $previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );

    $next     = get_adjacent_post( false, '', false );

    if ( ! $next && ! $previous )

        return;

    ?>

	<ul class="pager clearfix">

	  <li class="previous">

		<?php previous_post_link( '%link', _x( ' &larr; Older Item', 'Previous post link', 'hostio' ) ); ?>

	  </li>

	  <li class="next">

		<?php next_post_link( '%link', _x( 'Newer Item &rarr;', 'Next post link', 'hostio' ) ); ?>

	  </li>

	</ul>   

<?php

}

function hostio_search_form( $form ) {

    $form = '

        <div class="row">

          <div id="custom-search-input">

            <form class="input-group col-md-12" action="' . esc_url(home_url( '/' )) . '" method="post">

              <input type="text" class="form-control input-lg" placeholder="'.esc_html__('Search...', 'hostio').'" name="s" value="' . get_search_query() . '"/>

              <span class="input-group-btn">

              <button class="btn btn-info btn-lg" type="submit"> <i class="glyphicon glyphicon-search"></i> </button>

              </span> </form>

          </div>

        </div>';

    return $form;

}

add_filter( 'get_search_form', 'hostio_search_form' );

//Custom comment List:



function hostio_theme_comment($comment, $args, $depth) {

    //echo 's';

   $GLOBALS['comment'] = $comment; ?>

        <div class="row item-comment">

          <div class="col-sm-2"> 

          <a class="hover-img" href="javascript:void(0)"> 

          <?php echo get_avatar($comment,$size='100' ); ?>

          </a> </div>

          <div class="col-sm-10 meta-info">

            <h3><?php printf(__('%s','hostio'), get_comment_author_link()) ?></h3>

            <p><?php comment_text() ?></p>

            <span class="reply"><?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?></span>

          </div>

        </div>





<?php

}



//Code Visual Composer

function hostio_custom_css_classes_for_vc_row_and_vc_column($class_string, $tag) {

    if($tag=='vc_row' || $tag=='vc_row_inner') {

        $class_string = str_replace('vc_row-fluid', '', $class_string);

    }

    if($tag=='vc_column' || $tag=='vc_column_inner') {

    $class_string = preg_replace('/vc_col-sm-12/', 'col-md-12', $class_string);

    $class_string = preg_replace('/vc_col-sm-6/', 'col-md-6', $class_string);

    $class_string = preg_replace('/vc_col-sm-4/', 'col-md-4', $class_string);

    $class_string = preg_replace('/vc_col-sm-3/', 'col-md-3', $class_string);

    $class_string = preg_replace('/vc_col-sm-5/', 'col-md-5', $class_string);

    $class_string = preg_replace('/vc_col-sm-7/', 'col-md-7', $class_string);

    $class_string = preg_replace('/vc_col-sm-8/', 'col-md-8', $class_string);

    $class_string = preg_replace('/vc_col-sm-9/', 'col-md-9', $class_string);

    $class_string = preg_replace('/vc_col-sm-10/', 'col-md-10', $class_string);

    $class_string = preg_replace('/vc_col-sm-11/', 'col-md-11', $class_string);

    $class_string = preg_replace('/vc_col-sm-1/', 'col-md-1', $class_string);

    $class_string = preg_replace('/vc_col-sm-2/', 'col-md-2', $class_string);

    }

    return $class_string;

}

// Filter to Replace default css class for vc_row shortcode and vc_column

add_filter('vc_shortcodes_css_class', 'hostio_custom_css_classes_for_vc_row_and_vc_column', 10, 2); 

// Add new Param in Row

if(function_exists('vc_add_param')){



vc_add_param('vc_row',array(

                              "type" => "textfield",

                              "heading" => esc_html__('Section Big Title', 'hostio'),

                              "param_name" => "ses_title",

                              "value" => "",

                              "description" => esc_html__("Big Title of Section, Leave a blank do not show frontend.", "hostio"),   

    ));

vc_add_param('vc_row',array(

                              "type" => "textfield",

                              "heading" => esc_html__('Section Sub Title', 'hostio'),

                              "param_name" => "ses_sub_title",

                              "value" => "",

                              "description" => esc_html__("Section Sub Title, Leave a blank do not show frontend.", "hostio"),   

    ));

vc_add_param('vc_row',array(

                             'type' => 'dropdown',

                             'heading' => esc_html__( 'Chosen type row', 'hostio' ),

                             'param_name' => 'type_row',

                             'value' => array(

                                esc_html__( 'None Section', 'hostio' ) => 'type2',

                                esc_html__( 'Domain', 'hostio' ) => 'domain',

                                esc_html__( 'Hosting', 'hostio' ) => 'hosting',

                                esc_html__( 'Pricing', 'hostio' ) => 'pricing',

                                esc_html__( 'Infomation', 'hostio' ) => 'info',

                                esc_html__( 'Infomation More', 'hostio' ) => 'moreinfo',

                                esc_html__( 'Features More', 'hostio' ) => 'morefeatures',

                                esc_html__( 'Testimonials', 'hostio' ) => 'testimonials',

                                esc_html__( 'Services', 'hostio' ) => 'services',

                                esc_html__( 'Team', 'hostio' ) => 'team',

                                esc_html__( 'Pricing one title', 'hostio' ) => 'pricing2',

                                esc_html__( 'Pricing detail hosting', 'hostio' ) => 'pricing3',

                                esc_html__( 'Platforms', 'hostio' ) => 'platforms',

                                esc_html__( 'Help', 'hostio' ) => 'help',

                                esc_html__( 'Searchholder', 'hostio' ) => 'searchholder',

                                esc_html__( 'Login', 'hostio' ) => 'login',



                             ),

                             'description' => esc_html__( 'Select type row', 'hostio' )

      )); 



vc_add_param('vc_row',array(

                              "type" => "textarea_html",

                              "heading" => esc_html__('Section Content', 'hostio'),

                              "param_name" => "ses_content",

                              "value" => "",

                              "description" => esc_html__("Section Content, Leave a blank do not show frontend.", "hostio"),   

    ));

vc_add_param('vc_row',array(

                              "type" => "textfield",

                              "heading" => esc_html__('Section Text', 'hostio'),

                              "param_name" => "ses_text",

                              "value" => "",

                              "description" => esc_html__("Text button with block: focus", "hostio"),   

    )); 

vc_add_param('vc_row',array(

                              "type" => "textfield",

                              "heading" => esc_html__('Section Link', 'hostio'),

                              "param_name" => "ses_link",

                              "value" => "",

                              "description" => esc_html__("Link button with block: focus", "hostio"),   

    )); 

vc_add_param('vc_row',array(

                             'type' => 'attach_image',

                             'heading' => esc_html__( 'Image Background', 'hostio' ),

                             'param_name' => 'ses_image',

                             'value' => '',

                             'description' => esc_html__( 'Select image from media library to do your signature.', 'hostio' )

      ));

vc_add_param('vc_row',array(

                              "type" => "textfield",

                              "heading" => esc_html__('Section Color', 'hostio'),

                              "param_name" => "ses_color",

                              "value" => "",

                              "description" => esc_html__("Link Color(green , pink , purple)", "hostio"),

    ));

vc_add_param('vc_row',array(

                              "type" => "textfield",

                              "heading" => esc_html__('Section Icon Name', 'hostio'),

                              "param_name" => "ses_iconname",

                              "value" => "",

                              "description" => esc_html__("Link Icon Name", "hostio"),

    ));

// Add new Param in Column  



}



/**

 * This file represents an example of the code that themes would use to register

 * the required plugins.

 *

 * It is expected that theme authors would copy and paste this code into their

 * functions.php file, and amend to suit.

 *

 * @package    TGM-Plugin-Activation

 * @subpackage Example

 * @version    2.6.1

 * @author     Thomas Griffin <thomasgriffinmedia.com>

 * @author     Gary Jones <gamajo.com>

 * @copyright  Copyright (c) 2014, Thomas Griffin

 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later

 * @link       https://github.com/thomasgriffin/TGM-Plugin-Activation

 */

/**

 * Include the TGM_Plugin_Activation class.

 */

require_once get_template_directory() . '/framework/class-tgm-plugin-activation.php';

add_action( 'tgmpa_register', 'hostio_theme_register_required_plugins' );

/**

 * Register the required plugins for this theme.

 *

 * In this example, we register two plugins - one included with the hostio library

 * and one from the .org repo.

 *

 * The variable passed to hostio_register_plugins() should be an array of plugin

 * arrays.

 *

 * This function is hooked into hostio_init, which is fired within the

 * TGM_Plugin_Activation class constructor.

 */

 

 

function hostio_theme_register_required_plugins() {

    /**

     * Array of plugin arrays. Required keys are name and slug.

     * If the source is NOT from the .org repo, then source is also required.

     */

    $plugins = array(

             // This is an example of how to include a plugin from a private repo in your theme.

    

		array(

            'name'      => esc_html__( 'Contact Form 7', 'hostio' ),

            'slug'      => esc_html__( 'contact-form-7', 'hostio' ),

            'required'  => true,

        ),

    array(

            'name'               => esc_html__( 'WPBakery Visual Composer', 'hostio' ), // The plugin name.

            'slug'               => esc_html__( 'visualcomposer', 'hostio' ), // The plugin slug (typically the folder name).

            'source'             => get_template_directory_uri() . '/framework/plugins/js_composer.zip', // The plugin source.

            'required'           => true, // If false, the plugin is only 'recommended' instead of required.

        ),     

    array(

            'name'      => 'One Click Demo Import',

            'slug'      => 'one-click-demo-import',

            'required'  => true,

        ), 

    array(

            'name'               => esc_html__( 'WP Custom Register Login', 'hostio' ), // The plugin name.

            'slug'               => esc_html__( 'wp-custom-register-login', 'hostio' ), // The plugin slug (typically the folder name).

            'source'             => get_template_directory_uri() . '/framework/plugins/wp-custom-register-login.zip', // The plugin source.

            'required'           => true, // If false, the plugin is only 'recommended' instead of required.

        ),  

    array(

        'name'                     => esc_html__( 'Hostio Common', 'hostio' ),

        'slug'                     => esc_html__( 'hostio-common', 'hostio' ),

        'required'                 => true,

        'source'                   => get_template_directory() . '/framework/plugins/hostio-common.zip',

    )

    );

    /**

     * Array of configuration settings. Amend each line as needed.

     * If you want the default strings to be available under your own theme domain,

     * leave the strings uncommented.

     * Some of the strings are added into a sprintf, so see the comments at the

     * end of each line for what each argument will be.

     */

     $config = array(

        'default_path' => '',                      // Default absolute path to pre-packaged plugins.

        'menu'         => 'tgmpa-install-plugins', // Menu slug.

        'has_notices'  => true,                    // Show admin notices or not.

        'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.

        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.

        'is_automatic' => false,                   // Automatically activate plugins after installation or not.

        'message'      => '',                      // Message to output right before the plugins table.

        'strings'      => array(

            'page_title'                      => esc_html__( 'Install Required Plugins', 'hostio' ),

            'menu_title'                      => esc_html__( 'Install Plugins', 'hostio' ),

            'installing'                      => esc_html__( 'Installing Plugin: %s', 'hostio' ), // %s = plugin name.

            'oops'                            => esc_html__( 'Something went wrong with the plugin API.', 'hostio' ),

            'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'hostio' ), // %1$s = plugin name(s).

            'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'hostio' ), // %1$s = plugin name(s).

            'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'hostio' ), // %1$s = plugin name(s).

            'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'hostio' ), // %1$s = plugin name(s).

            'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'hostio' ), // %1$s = plugin name(s).

            'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'hostio' ), // %1$s = plugin name(s).

            'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'hostio' ), // %1$s = plugin name(s).

            'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'hostio' ), // %1$s = plugin name(s).

            'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'hostio' ),

            'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins', 'hostio' ),

            'return'                          => esc_html__( 'Return to Required Plugins Installer', 'hostio' ),

            'plugin_activated'                => esc_html__( 'Plugin activated successfully.', 'hostio' ),

            'complete'                        => esc_html__( 'All plugins installed and activated successfully. %s', 'hostio' ), // %s = dashboard link.

            'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.

        )

    );

    tgmpa( $plugins, $config );

}



function hostio_import_files() {

    return array(

        array(

            'import_file_name'           => 'Demo Import Hostio',

            'import_file_url'            => 'http://shtheme.com/import/hostio/content.xml',

            'import_widget_file_url'     => 'http://shtheme.com/import/hostio/widgets.json',

            'import_preview_image_url'   => 'http://shtheme.com/import/hostio/Image-Preview.jpg',

            'import_notice'              => esc_html__( 'Import data example hostio', 'hostio' ),

        ),

    );

}

add_filter( 'pt-ocdi/import_files', 'hostio_import_files' );









function hostio_after_import_setup() {

    // Assign menus to their locations.

    $main_menu = get_term_by( 'name', 'Menu 1', 'primary' );



    set_theme_mod( 'nav_menu_locations', array(

            'primary' => $main_menu->term_id,

        )

    );



    // Assign front page and posts page (blog page).

    $front_page_id = get_page_by_title( 'home-page' );

    $blog_page_id  = get_page_by_title( 'Blog' );



    update_option( 'show_on_front', 'page' );

    update_option( 'page_on_front', $front_page_id->ID );

    update_option( 'page_for_posts', $blog_page_id->ID );



}

add_action( 'pt-ocdi/after_import', 'hostio_after_import_setup' );







?>
