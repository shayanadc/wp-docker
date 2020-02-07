<?php


if (!class_exists("Redux_Framework_sample_config")) {

    class Redux_Framework_sample_config {

        public $args = array(); 
        public $sections = array();
        public $theme;
        public $ReduxFramework;

        public function __construct() {
            // This is needed. Bah WordPress bugs.  ;)
            if ( defined('TEMPLATEPATH') && strpos( Redux_Helpers::cleanFilePath( __FILE__ ), Redux_Helpers::cleanFilePath( TEMPLATEPATH ) ) !== false) {
                $this->initSettings();
            } else {
                add_action('plugins_loaded', array($this, 'initSettings'), 10);    
            }
        }

        public function initSettings() {

            if ( !class_exists("ReduxFramework" ) ) {
                return;
            }       
            
            // Just for demo purposes. Not needed per say.
            $this->theme = wp_get_theme();

            // Set the default arguments
            $this->setArguments();

            // Set a few help tabs so you can see how it's done
            $this->setHelpTabs();

            // Create the sections and fields
            $this->setSections();

            if (!isset($this->args['opt_name'])) { // No errors please
                return;
            }

            // If Redux is running as a plugin, this will remove the demo notice and links
            //add_action( 'redux/plugin/hooks', array( $this, 'remove_demo' ) );
            // Function to test the compiler hook and demo CSS output.
            //add_filter('redux/options/'.$this->args['opt_name'].'/compiler', array( $this, 'compiler_action' ), 10, 2); 
            // Above 10 is a priority, but 2 in necessary to include the dynamically generated CSS to be sent to the function.
            // Change the arguments after they've been declared, but before the panel is created
            //add_filter('redux/options/'.$this->args['opt_name'].'/args', array( $this, 'change_arguments' ) );
            // Change the default value of a field after it's been set, but before it's been useds
            //add_filter('redux/options/'.$this->args['opt_name'].'/defaults', array( $this,'change_defaults' ) );
            // Dynamically add a section. Can be also used to modify sections/fields
            add_filter('redux/options/' . $this->args['opt_name'] . '/sections', array($this, 'dynamic_section'));

            $this->ReduxFramework = new ReduxFramework($this->sections, $this->args);
        }

        function compiler_action($options, $css) {
            //echo "<h1>The compiler hook has run!";
            //print_r($options); //Option values
            //print_r($css); // Compiler selector CSS values  compiler => array( CSS SELECTORS )

            /*
              // Demo of how to use the dynamic CSS and write your own static CSS file
              $filename = dirname(__FILE__) . '/style' . '.css';
              global $wp_filesystem;
              if( empty( $wp_filesystem ) ) {
              require_once( ABSPATH .'/wp-admin/includes/file.php' );
              WP_Filesystem();
              }

              if( $wp_filesystem ) {
              $wp_filesystem->put_contents(
              $filename,
              $css,
              FS_CHMOD_FILE // predefined mode settings for WP files
              );
              }
             */
        }

        function dynamic_section($sections) {
            //$sections = array();
            $sections[] = array(
                'title' => esc_html__('Section via hook', 'redux-framework-demo'),
                'desc' => esc_html__('<p class="description">This is a section created by adding a filter to the sections array. Can be used by child themes to add/remove sections from the options.</p>', 'redux-framework-demo'),
                'icon' => 'el-icon-paper-clip',
                // Leave this as a blank section, no options just some intro text set above.
                'fields' => array()
            );

            return $sections;
        }

        function change_arguments($args) {
            //$args['dev_mode'] = true;

            return $args;
        }


        function change_defaults($defaults) {
            $defaults['str_replace'] = "Testing filter hook!";

            return $defaults;
        }

        // Remove the demo link and the notice of integrated demo from the redux-framework plugin
        function remove_demo() {

            // Used to hide the demo mode link from the plugin page. Only used when Redux is a plugin.
            if (class_exists('ReduxFrameworkPlugin')) {
                remove_filter('plugin_row_meta', array(ReduxFrameworkPlugin::get_instance(), 'plugin_meta_demo_mode_link'), null, 2);
            }

            // Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
            remove_action('admin_notices', array(ReduxFrameworkPlugin::get_instance(), 'admin_notices'));
        }

        public function setSections() {

            // Background Patterns Reader
            $sample_patterns_path = ReduxFramework::$_dir . '../sample/patterns/';
            $sample_patterns_url = ReduxFramework::$_url . '../sample/patterns/';
            $sample_patterns = array();

            if (is_dir($sample_patterns_path)) :

                if ($sample_patterns_dir = opendir($sample_patterns_path)) :
                    $sample_patterns = array();

                    while (( $sample_patterns_file = readdir($sample_patterns_dir) ) !== false) {

                        if (stristr($sample_patterns_file, '.png') !== false || stristr($sample_patterns_file, '.jpg') !== false) {
                            $name = explode(".", $sample_patterns_file);
                            $name = str_replace('.' . end($name), '', $sample_patterns_file);
                            $sample_patterns[] = array('alt' => $name, 'img' => $sample_patterns_url . $sample_patterns_file);
                        }
                    }
                endif;
            endif;

            ob_start();

            $ct = wp_get_theme();
            $this->theme = $ct;
            $item_name = $this->theme->get('Name');
            $tags = $this->theme->Tags;
            $screenshot = $this->theme->get_screenshot();
            $class = $screenshot ? 'has-screenshot' : '';

            $customize_title = sprintf(__('Customize &#8220;%s&#8221;', 'redux-framework-demo'), $this->theme->display('Name'));
            ?>
            <div id="current-theme" class="<?php echo esc_attr($class); ?>">
            <?php if ($screenshot) : ?>
                <?php if (current_user_can('edit_theme_options')) : ?>
                        <a href="<?php echo wp_customize_url(); ?>" class="load-customize hide-if-no-customize" title="<?php echo esc_attr($customize_title); ?>">
                            <img src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_html_e('Current theme preview', 'pontus'); ?>" />
                        </a>
                <?php endif; ?>
                    <img class="hide-if-customize" src="<?php echo esc_url($screenshot); ?>" alt="<?php esc_html_e('Current theme preview', 'pontus'); ?>" />
            <?php endif; ?>

                <h4>
            <?php echo $this->theme->display('Name'); ?>
                </h4>

                <div>
                    <ul class="theme-info">
                        <li><?php printf(__('By %s', 'redux-framework-demo'), $this->theme->display('Author')); ?></li>
                        <li><?php printf(__('Version %s', 'redux-framework-demo'), $this->theme->display('Version')); ?></li>
                        <li><?php echo '<strong>' . esc_html__('Tags', 'redux-framework-demo') . ':</strong> '; ?><?php printf($this->theme->display('Tags')); ?></li>
                    </ul>
                    <p class="theme-description"><?php echo $this->theme->display('Description'); ?></p>
                <?php
                if ($this->theme->parent()) {
                    printf(' <p class="howto">' . esc_html__('This <a href="%1$s">child theme</a> requires its parent theme, %2$s.', 'pontus') . '</p>', esc_html__('http://codex.wordpress.org/Child_Themes', 'redux-framework-demo'), $this->theme->parent()->display('Name'));
                }
                ?>

                </div>

            </div>

            <?php
            $item_info = ob_get_contents();

            ob_end_clean();

            $sampleHTML = '';
            if (file_exists(dirname(__FILE__) . '/info-html.html')) {
                /** @global WP_Filesystem_Direct $wp_filesystem  */
                global $wp_filesystem;
                if (empty($wp_filesystem)) {
                    require_once(ABSPATH . '/wp-admin/includes/file.php');
                    WP_Filesystem();
                }
                $sampleHTML = $wp_filesystem->get_contents(dirname(__FILE__) . '/info-html.html');
            }
            
            // ACTUAL DECLARATION OF SECTIONS          

            $this->sections[] = array(
                'icon' => 'el-icon-cogs',
                'title' => __('  عمومی', 'hostio'),
                'fields' => array(                  
                    array(
                        'id' => 'author_content',
                        'type' => 'textarea',
                        'title' => __('Author content', 'hostio'),
                        'subtitle1' => __('', 'hostio'),
                        'desc' => __('', 'hostio'),
                        'default' => 'Vergatheme'
                    ),
                    array(
                        'id' => 'description_content',
                        'type' => 'textarea',
                        'title' => __('Description content', 'hostio'),
                        'subtitle1' => __('', 'hostio'),
                        'desc' => __('', 'hostio'),
                        'default' => 'Country Holidays - Premium site template for a country accommodation.'
                    ),
                    array(
                        'id' => 'keywords_content',
                        'type' => 'textarea',
                        'title' => __('توضیحات سایت', 'hostio'),
                        'subtitle1' => __('', 'hostio'),
                        'desc' => __('', 'hostio'),
                        'default' => 'farm activities, itineraries, farm holidays, country holidays, bed and breakfast, hotel, country hotel'
                    ),
                    array(
                        'id' => 'viewport_content',
                        'type' => 'textarea',
                        'title' => __('Viewport content', 'hostio'),
                        'subtitle1' => __('', 'hostio'),
                        'desc' => __('', 'hostio'),
                        'default' => 'width=device-width, initial-scale=1'
                    ),
                    array(
                        'id' => 'seo_des',
                        'type' => 'textarea',
                        'title' => __('توضیحات سایت', 'hostio'),
                        'subtitle1' => __('', 'hostio'),
                        'desc' => __('', 'hostio'),
                        'default' => ''
                    ),
                    array(
                        'id' => 'seo_key',
                        'type' => 'textarea',
                        'title' => __('کلمات کلیدی', 'hostio'),
                        'subtitle1' => __('', 'hostio'),
                        'desc' => __('', 'hostio'),
                        'default' => ''
                    ), 
                )
            );
            
            $this->sections[] = array(
                'icon' => ' el-icon-picture',
                'title' => __('لوگو و فاویکون', 'hostio'),
                'fields' => array(      
                    array(
                        'id' => 'favicon',
                        'type' => 'media',
                        'url' => true,
                        'title' => __('فاویکون', 'hostio'),
                        'compiler' => 'true',
                        //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'desc' => __('Upload your Favicon.', 'hostio'),
                        'subtitle1' => __('', 'hostio'),
                        'default' => ''
                    ),
                    array(
                        'id' => 'logo',
                        'type' => 'media',
                        'url' => true,
                        'title' => __('لوگو', 'hostio'),
                        'compiler' => 'true',
                        //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'desc' => __('', 'hostio'),
                        'subt
                        itle' => __('Upload your logo.', 'hostio'),
                        'default' => ''
                    ),
                    
                    array(
                        'id' => 'logo_footer',
                        'type' => 'media',
                        'url' => true,
                        'title' => __('لوگو فوتر', 'hostio'),
                        'compiler' => 'true',
                        //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'desc' => __('', 'hostio'),
                        'subtitle1' => __('Upload your logo footer.', 'hostio'),
                        'default' => ''
                    ),  
                    array(
                        'id' => 'logo_preload',
                        'type' => 'media',
                        'url' => true,
                        'title' => __('Image Preload', 'hostio'),
                        'compiler' => 'true',
                        //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'desc' => __('', 'hostio'),
                        'subtitle1' => __('Upload your image preload.', 'hostio'),
                        'default' => ''
                    ),
                    array(
                        'id' => 'header_background',
                        'type' => 'media',
                        'url' => true,
                        'title' => __('پس زمینه هدر', 'hostio'),
                        'compiler' => 'true',
                        //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'desc' => __('', 'hostio'),
                        'subtitle1' => __('Upload your image پس زمینه هدر.', 'hostio'),
                        'default' => ''
                    ),  
                )
            );
            
            $this->sections[] = array(
                'icon' => 'el-icon-list',
                'title' => __('وبلاگ', 'hostio'),
                'fields' => array(
                    array(
                        'id' => 'blog_title',
                        'type' => 'text',
                        'title' => __('عنوان وبلاگ', 'hostio'),
                        'subtitle1' => __('Input عنوان وبلاگ', 'hostio'),
                        'desc' => __('', 'hostio'),
                        'default' => 'Blog'
                    ),  
                    array(
                        'id' => 'blog_excerpt',
                        'type' => 'text',
                        'title' => __('تعداد کلمه پیش نمایش مطلب', 'hostio'),
                        'subtitle1' => __('Input تعداد کلمه پیش نمایش مطلب', 'hostio'),
                        'desc' => __('', 'hostio'),
                        'default' => '30'
                    ),
                    array(
                        'id' => 'read_more',
                        'type' => 'text',
                        'title' => __('متن دکمه ادامه مطلب', 'hostio'),
                        'subtitle1' => __('Input Button Text', 'hostio'),
                        'desc' => __('', 'hostio'),
                        'default' => 'Read more'
                    ),
                    array(
                        'id' => 'blog_in',
                        'type' => 'text',
                        'title' => __('متن در', 'hostio'),
                        'subtitle1' => __('text in', 'hostio'),
                        'desc' => __('', 'hostio'),
                        'default' => 'In'
                    ),
                    array(
                        'id' => 'blog_on',
                        'type' => 'text',
                        'title' => __('Text on', 'hostio'),
                        'subtitle1' => __('text on', 'hostio'),
                        'desc' => __('', 'hostio'),
                        'default' => 'On'
                    ),
                    array(
                        'id' => 'blog_by',
                        'type' => 'text',
                        'title' => __('متن توسط', 'hostio'),
                        'subtitle1' => __('text By', 'hostio'),
                        'desc' => __('', 'hostio'),
                        'default' => 'By'
                    ),
                 )
            );
            $this->sections[] = array(
                'icon' => 'el-icon-list',
                'title' => __('  برگه', 'hostio'),
                'fields' => array(
                    
                    array(
                        'id' => 'page_image',
                        'type' => 'media',
                        'url' => true,
                        'title' => __('تصویر پس زمینه برگه', 'hostio'),
                        'compiler' => 'true',
                        //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                        'desc' => __('', 'hostio'),
                        'subtitle1' => __('Upload page background image.', 'hostio'),
                        'default' => ''
                    ),
                    array(
                        'id' => 'page_sendmail',
                        'type' => 'text',
                        'title' => __('Page send mail', 'hostio'),
                        'subtitle1' => __('برگه ارسال ایمیل', 'hostio'),
                        'desc' => __('', 'hostio'),
                        'default' => ''
                    ),  
                    array(
                        'id' => 'page_review',
                        'type' => 'text',
                        'title' => __('Page review mail', 'hostio'),
                        'subtitle1' => __('برگه پیش نمایش ایمیل', 'hostio'),
                        'desc' => __('', 'hostio'),
                        'default' => ''
                    ), 
                    array(
                        'id' => 'page_contact',
                        'type' => 'text',
                        'title' => __('برگه ارسال ایمیل تماس با ما', 'hostio'),
                        'subtitle1' => __('برگه ارسال ایمیل تماس با ما', 'hostio'),
                        'desc' => __('', 'hostio'),
                        'default' => ''
                    ),
                 )
            );

               
            $this->sections[] = array(
                'icon' => 'el-icon-graph',
                'title' => __('  404', 'hostio'),
                'fields' => array(
                     array(
                        'id' => '404_title',
                        'type' => 'text',
                        'title' => __('عنوان 404', 'hostio'),
                        'subtitle1' => __('Input عنوان 404', 'hostio'),
                        'desc' => __('', 'hostio'),
                        'default' => '404 Page'
                    ),  
                    
                    array(
                        'id' => '404_desc',
                        'type' => 'text',
                        'title' => __('توضیحات 404', 'hostio'),
                        'subtitle1' => __('Input توضیحات 404', 'hostio'),
                        'desc' => __('', 'hostio'),
                        'default' => 'Oops!! Page not found'
                    ), 
                    array(
                        'id' => '404_subtitle',
                        'title' => __('زیرعنوان 404', 'hostio'),
                        'desc' => __('', 'hostio'),
                        'default' => ' '
                    ), 
                    array(
                        'id' => '404_text',
                        'title' => __('متن دکمه 404', 'hostio'),
                        'desc' => __('', 'hostio'),
                        'default' => 'Go to Home'
                    ),  
                               
                 )
            );
            $this->sections[] = array(
                'icon' => 'el-icon-graph',
                'title' => __('فرم', 'hostio'),
                'fields' => array(
                     array(
                        'id' => 'form_email',
                        'type' => 'text',
                        'title' => __('فرم ایمیل', 'hostio'),
                        'subtitle1' => __('فرم ایمیل', 'hostio'),
                        'desc' => __('', 'hostio'),
                        'default' => 'info@domain.com'
                    ),                 
                 )
            );
            $this->sections[] = array(
                'icon' => 'el-icon-graph',
                'title' => __('  آنلاین', 'hostio'),
                'fields' => array(
                     array(
                        'id' => 'apply_email',
                        'type' => 'text',
                        'title' => __('ایمیل دریافت', 'hostio'),
                        'subtitle1' => __('ایمیل دریافت', 'hostio'),
                        'desc' => __('', 'hostio'),
                        'default' => 'info@domain.com'
                    ), 
                     array(
                        'id' => 'apply_pagesend',
                        'type' => 'text',
                        'title' => __('برگه ارسال', 'hostio'),
                        'subtitle1' => __('ایمیل ارسال ', 'hostio'),
                        'desc' => __('', 'hostio'),
                        'default' => '#'
                    ), 
                    array(
                        'id' => 'apply_template',
                        'type' => 'editor',
                        'title' => __('انتخاب قالب', 'hostio'),
                        'subtitle1' => __('انتخاب قالب', 'hostio'),
                        'default' => '',
                    ),                     
                 )
            );
            
            $this->sections[] = array(
                'icon' => ' el-icon-credit-card',
                'title' => __('  هدر', 'hostio'),
                'fields' => array(
                    array(
                        'id' => 'header_icon_phone',
                        'title' => __('آیکون تلفن', 'hostio'),
                        'subtitle1' => __('آیکون تلفن', 'hostio'),
                        'default' => 'fa fa-phone',
                    ),
                    array(
                        'id' => 'header_number',
                        'title' => __('شماره تماس', 'hostio'),
                        'subtitle1' => __('شماره تماس', 'hostio'),
                        'default' => '+149 75 23 222 35',
                    ),
                    array(
                        'id' => 'header_icon_mail',
                        'title' => __('آیکون ایمیل', 'hostio'),
                        'subtitle1' => __('آیکون ایمیل', 'hostio'),
                        'default' => 'fa fa-envelope',
                    ),
                    array(
                        'id' => 'header_mail',
                        'type' => 'text',
                        'title' => __('آدرس ایمیل', 'hostio'),
                        'subtitle1' => __('آدرس ایمیل', 'hostio'),
                        'default' => 'hostio@mail.com',
                    ),
                    
                )
            );
            $this->sections[] = array(
                'icon' => ' el-icon-credit-card',
                'title' => __('شبکه های اجتماعی', 'hostio'),
                'fields' => array(                      
                    array(
                        'id' => 'link_face',
                        'type' => 'text',
                        'title' => __('لینک فیس بوک', 'hostio'),
                        'subtitle1' => __('لینک فیس بوک', 'hostio'),
                        'default' => '#',
                    ),
                    array(
                        'id' => 'icon_face',
                        'type' => 'text',
                        'title' => __('آیکون دلخواه', 'hostio'),
                        'subtitle1' => __('آیکون دلخواه', 'hostio'),
                        'default' => 'facebook',
                    ),
                    array(
                        'id' => 'link_twitter',
                        'type' => 'text',
                        'title' => __('لینک توییتر', 'hostio'),
                        'subtitle1' => __('لینک توییتر', 'hostio'),
                        'default' => '#',
                    ),
                    array(
                        'id' => 'icon_twitter',
                        'type' => 'text',
                        'title' => __('آیکون دلخواه', 'hostio'),
                        'subtitle1' => __('آیکون دلخواه', 'hostio'),
                        'default' => 'twitter',
                    ),
                    array(
                        'id' => 'link_instagram',
                        'type' => 'text',
                        'title' => __('لینک اینستاگرام', 'hostio'),
                        'subtitle1' => __('لینک اینستاگرام', 'hostio'),
                        'default' => '#',
                    ),
                    array(
                        'id' => 'icon_instagram',
                        'type' => 'text',
                        'title' => __('آیکون دلخواه', 'hostio'),
                        'subtitle1' => __('آیکون دلخواه', 'hostio'),
                        'default' => 'instagram',
                    ),
                    array(
                        'id' => 'link_skype',
                        'type' => 'text',
                        'title' => __('لینک اسکایپ', 'hostio'),
                        'subtitle1' => __('لینک اسکایپ', 'hostio'),
                        'default' => '#',
                    ),
                    array(
                        'id' => 'icon_skype',
                        'type' => 'text',
                        'title' => __('آیکون دلخواه', 'hostio'),
                        'subtitle1' => __('آیکون دلخواه', 'hostio'),
                        'default' => 'skype',
                    ),
                    array(
                        'id' => 'link_google',
                        'type' => 'text',
                        'title' => __('لینک گوگل', 'hostio'),
                        'subtitle1' => __('لینک گوگل', 'hostio'),
                        'default' => '#',
                    ),
                    array(
                        'id' => 'icon_google',
                        'type' => 'text',
                        'title' => __('آیکون دلخواه', 'hostio'),
                        'subtitle1' => __('آیکون دلخواه', 'hostio'),
                        'default' => 'google',
                    ),
                    array(
                        'id' => 'link_youtube',
                        'type' => 'text',
                        'title' => __('لینک تلگرام', 'hostio'),
                        'subtitle1' => __('لینک تلگرام', 'hostio'),
                        'default' => '#',
                    ),
                    array(
                        'id' => 'icon_youtube',
                        'type' => 'text',
                        'title' => __('آیکون تلگرام', 'hostio'),
                        'subtitle1' => __('آیکون تلگرام', 'hostio'),
                        'default' => 'youtube',
                    ),
                    array(
                        'id' => 'link_linkedin',
                        'type' => 'text',
                        'title' => __('لینک لینکداین', 'hostio'),
                        'subtitle1' => __('لینک لینکداین', 'hostio'),
                        'default' => '#',
                    ),
                    array(
                        'id' => 'icon_linkedin',
                        'type' => 'text',
                        'title' => __('آیکون دلخواه', 'hostio'),
                        'subtitle1' => __('آیکون دلخواه', 'hostio'),
                        'default' => 'linkedin',
                    ),
                    
                )
            );
            $this->sections[] = array(
                'icon' => ' el-icon-credit-card',
                'title' => __('فوتر', 'hostio'),
                'fields' => array(
                    array(
                        'id' => 'footer_template',
                        'type' => 'editor',
                        'title' => __('قالب فوتر', 'hostio'),
                        'subtitle1' => __('Template footer', 'hostio'),
                        'default' => '',
                    ),
                    array(
                        'id' => '',
                        'title' => __('متن کپی رایت', 'hostio'),
                        'subtitle1' => __('Copyright Text', 'hostio'),
                        'default' => '© 2016 All Rights Reserved',
                    ),
                )
                
            );
            $this->sections[] = array(
                'icon' => 'el-icon-website',
                'title' => __('تنظیمات استایل', 'hostio'),
                'fields' => array(
                    array(
                            'id' => 'header_bg',
                            'url' => true,
                            'title' => __('پس زمینه هدر', 'hostio'),
                            'compiler' => 'true',
                            //'mode' => false, // Can be set to false to allow any media type, or can also be set to any mime type.
                            'desc' => __('', 'hostio'),
                            'subtitle1' => __('Upload your background header.', 'hostio'),
                            'default' => ''
                        ),
                    array(
                        'id' => 'rtl',
                        'title' => __('اختصاصی های شاپ - RTL', 'hostio'),
                        'subtitle1' => '',
                        'desc' => '',
                        'default' => '0'// 1 = on | 0 = off
                    ),
                    array(
                        'id' => 'chosen-color',
                        'title' => __('فعالسازی ویرایش رنگ', 'hostio'),
                        'subtitle1' => '',
                        'desc' => '',
                        'default' => '0'// 1 = on | 0 = off
                    ),
                    array(
                        'id' => 'main-color-1',
                        'title' => __('رنگ اصلی قالب', 'hostio'),
                        'subtitle1' => __('Pick the main color for the theme (default: #ffe79b).', 'hostio'),
                        'default' => '#86b535',
                        'validate' => 'color',
                    ),
                    array(
                        'id' => 'menu-primary-color',
                        'title' => __('رنگ اصلی فهرست', 'hostio'),
                        'subtitle1' => __('Pick the menu color for the theme ', 'hostio'),
                        'default' => '#6091ba',
                        'validate' => 'color',
                    ),
                    array(
                        'id' => 'menu-child-color',
                        'title' => __('رنگ مکمل فهرست', 'hostio'),
                        'subtitle1' => __('Pick the menu child color for the theme ', 'hostio'),
                        'default' => '#2f506c',
                        'validate' => 'color',
                    ),
                    array(
                        'id' => 'menu-hover-color',
                        'title' => __('رنگ هاور فهرست', 'hostio'),
                        'subtitle1' => __('Pick the hover color for the theme ', 'hostio'),
                        'default' => '#4678a1',
                        'validate' => 'color',
                    ),
                    array(
                        'id' => 'animation-home-color-1',
                        'title' => __('رنگ اینمیشن یک قالب', 'hostio'),
                        'subtitle1' => __('Pick the animation color for the theme ', 'hostio'),
                        'default' => 'rgba(96, 145, 186, 0.8)',
                        'validate' => 'color',
                    ),
                    array(
                        'id' => 'animation-home-color-2',
                        'title' => __('رنگ اینمیشن دو قالب', 'hostio'),
                        'subtitle1' => __('Pick the animation color for the theme ', 'hostio'),
                        'default' => 'rgba(7, 10, 12, 0.8)',
                        'validate' => 'color',
                    ),
                    array(
                        'id' => 'title-color',
                        'title' => __('رنگ عنوان های قالب', 'hostio'),
                        'subtitle1' => __('Pick the title color for the theme ', 'hostio'),
                        'default' => '#6091ba',
                        'validate' => 'color',
                    ),
                    
                    
                    array(
                        'id' => 'body-font2',
                        'output' => array('body'),
                        'title' => __('فونت اصلی', 'hostio'),
                        'subtitle1' => __('Specify the body font properties.', 'hostio'),
                        'google' => true,
                        'default' => array(
                            'color' => '#989898',
                            'font-size' => '14px',
                            'font-weight' => '300',
                            'font-family' => '"Roboto Slab", serif',
                        ),
                    ),
                     array(
                        'id' => 'custom-css',
                        'type' => 'ace_editor',
                        'title' => __('کدهای CSS', 'hostio'),
                        'subtitle1' => __('Paste your CSS code here.', 'hostio'),
                        'mode' => 'css',
                        'theme' => 'monokai',
                        'desc' => 'Possible modes can be found at <a href="http://ace.c9.io" target="_blank">http://ace.c9.io/</a>.',
                        'default' => "#header{\nmargin: 0 auto;\n}"
                    ),
                )
            );

        }

        public function setHelpTabs() {

            // Custom page help tabs, displayed using the help API. Tabs are shown in order of definition.
            $this->args['help_tabs'][] = array(
                'id' => 'redux-opts-1',
                'title' => esc_html__('Theme Information 1', 'pontus'),
                'content' => esc_html__('<p>This is the tab content, HTML is allowed.</p>', 'pontus')
            );

            $this->args['help_tabs'][] = array(
                'id' => 'redux-opts-2',
                'title' => esc_html__('Theme Information 2', 'pontus'),
                'content' => esc_html__('<p>This is the tab content, HTML is allowed.</p>', 'pontus')
            );

            // Set the help sidebar
            $this->args['help_sidebar'] = esc_html__('<p>This is the sidebar content, HTML is allowed.</p>', 'pontus');
        }

        public function setArguments() {

            $theme = wp_get_theme(); // For use with some settings. Not necessary.

            $this->args = array(
                // TYPICAL -> Change these values as you need/desire
                'opt_name' => 'hostio_redux', // This is where your data is stored in the database and also becomes your global variable name.
                'display_name' => $theme->get('Name'), // Name that appears at the top of your panel
                'display_version' => $theme->get('Version'), // Version that appears at the top of your panel
                'menu_type' => 'menu', //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
                'allow_sub_menu' => true, // Show the sections below the admin menu item or not
                'menu_title' => esc_html__('hostio Options', 'pontus'),
                'page' => esc_html__('hostio Options', 'pontus'),
                // You will need to generate a Google API key to use this feature.
                // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
                'google_api_key' => 'AIzaSyBM9vxebWLN3bq4Urobnr6tEtn7zM06rEw', // Must be defined to add google fonts to the typography module
                //'admin_bar' => false, // Show the panel pages on the admin bar
                'global_variable' => '', // Set a different name for your global variable other than the opt_name
                'dev_mode' => true, // Show the time the page took to load, etc
                'customizer' => true, // Enable basic customizer support
                // OPTIONAL -> Give you extra features
                'page_priority' => null, // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
                'page_parent' => 'themes.php', // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
                'page_permissions' => 'manage_options', // Permissions needed to access the options panel.
                'menu_icon' => '', // Specify a custom URL to an icon
                'last_tab' => '', // Force your panel to always open to a specific tab (by id)
                'page_icon' => 'icon-themes', // Icon displayed in the admin panel next to your menu_title
                'page_slug' => '_options', // Page slug used to denote the panel
                'save_defaults' => true, // On load save the defaults to DB before user clicks save or not
                'default_show' => false, // If true, shows the default value next to each field that is not the default value.
                'default_mark' => '', // What to print by the field's title if the value shown is default. Suggested: *
                // CAREFUL -> These options are for advanced use only
                'transient_time' => 60 * MINUTE_IN_SECONDS,
                'output' => true, // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
                'output_tag' => true, // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
                //'domain'              => 'redux-framework', // Translation domain key. Don't change this unless you want to retranslate all of Redux.
                //'footer_credit'       => '', // Disable the footer credit of Redux. Please leave if you can help it.
                // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
                'database' => '', // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!
                'show_import_export' => true, // REMOVE
                'system_info' => false, // REMOVE
                'help_tabs' => array(),
                'help_sidebar' => '', // esc_html__( '', $this->args['domain'] );            
            );


            // SOCIAL ICONS -> Setup custom links in the footer for quick links in your panel footer icons.     
            $this->args['share_icons'][] = array(
                'url' => 'https://github.com/ReduxFramework/ReduxFramework',
                'title' => 'Visit us on GitHub',
                'icon' => 'el-icon-github'
                    // 'img' => '', // You can use icon OR img. IMG needs to be a full URL.
            );
            $this->args['share_icons'][] = array(
                'url' => 'https://www.facebook.com/pages/Redux-Framework/243141545850368',
                'title' => 'Like us on Facebook',
                'icon' => 'el-icon-facebook'
            );
            $this->args['share_icons'][] = array(
                'url' => 'http://twitter.com/reduxframework',
                'title' => 'Follow us on Twitter',
                'icon' => 'el-icon-twitter'
            );
            $this->args['share_icons'][] = array(
                'url' => 'http://www.linkedin.com/company/redux-framework',
                'title' => 'Find us on LinkedIn',
                'icon' => 'el-icon-linkedin'
            );



            // Panel Intro text -> before the form
            if (!isset($this->args['global_variable']) || $this->args['global_variable'] !== false) {
                if (!empty($this->args['global_variable'])) {
                    $v = $this->args['global_variable'];
                } else {
                    $v = str_replace("-", "_", $this->args['opt_name']);
                }
                $this->args['intro_text'] = sprintf(__('', 'pontus'), $v);
            } else {
                $this->args['intro_text'] = esc_html__('<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>', 'pontus');
            }

            // Add content after the form.
            $this->args['footer_text'] = esc_html__('', 'pontus');
        }

    }

    new Redux_Framework_sample_config();
}


if (!function_exists('redux_my_custom_field')):

    function redux_my_custom_field($field, $value) {
        print_r($field);
        print_r($value);
    }

endif;

if (!function_exists('redux_validate_callback_function')):

    function redux_validate_callback_function($field, $value, $existing_value) {
        $error = false;
        $value = 'just testing';
        /*
          do your validation

          if(something) {
          $value = $value;
          } elseif(something else) {
          $error = true;
          $value = $existing_value;
          $field['msg'] = 'your custom error message';
          }
         */

        $return['value'] = $value;
        if ($error == true) {
            $return['error'] = $field;
        }
        return $return;
    }


endif;