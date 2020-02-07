<?php
/**
 * Include and setup custom metaboxes and fields.
 *
 * @category YourThemeOrPlugin
 * @package  Metaboxes
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/jaredatch/Custom-Metaboxes-and-Fields-for-WordPress
 */

add_filter( 'cmb_meta_boxes', 'cmb_sample_metaboxes' );
/**
 * Define the metabox and field configurations.
 *
 * @param  array $meta_boxes
 * @return array
 */
$textdomain = "hostio";
function cmb_sample_metaboxes( array $meta_boxes ) {

	// Start with an underscore to hide fields from custom fields list
	$prefix = '_cmb_';
	
    $meta_boxes[] = array(
        'id'         => 'page_setting',
        'title'      => 'Page Setting',
        'pages'      => array('page'), // Post type
        'context'    => 'normal',
        'priority'   => 'high',
        'show_names' => true, // Show field names on the left
        //'show_on'    => array( 'key' => 'id', 'value' => array( 2, ), ), // Specific post IDs to display this metabox
        'fields' => array(
            array(
                'name' => 'Page Description',
                'desc' => 'Set Page Description',
                'id'   => $prefix . 'page_description',
                'type'    => 'text',
            ),  
            array(
                'name' => 'Page Sub Title',
                'desc' => 'Set Page Sub Title',
                'id'   => $prefix . 'page_sub_title',
                'type'    => 'text',
            ),  
            array(
                'name' => 'Selected Sidebar or Full Width',
                'desc' => 'Sidebar or Full Width',
                'id'   => $prefix . 'sidebar_page',
                'type'    => 'select',
                'options' => array(
                    array( 'name' => 'Sidebar', 'value' => 'sidebar', ),
                    array( 'name' => 'Full Width', 'value' => 'fullwidth', ),
                    ),
                'default' => 'sidebar',
            ),           
        )
    );

	
	return $meta_boxes;
}

add_action( 'init', 'cmb_initialize_cmb_meta_boxes', 9999 );
/**
 * Initialize the metabox class.
 */
function cmb_initialize_cmb_meta_boxes() {

	if ( ! class_exists( 'cmb_Meta_Box' ) )
		require_once 'init.php';

}
