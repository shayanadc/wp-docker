<?php 
$textdoimain = 'hostio';
global $pre_text;

$pre_text = 'VG ';


// add


//domain
if(function_exists('vc_map')){
   vc_map( array(
   "name" => __($pre_text."domain", 'hostio'),
   "base" => "domain",
   "class" => "",
   "icon" => "icon-st",
   "category" => 'Content',
   "params" => array(
   array(
         'type' => 'attach_image',
         'heading' => __( 'Image', 'js_composer' ),
         'param_name' => 'image',
         'value' => '',
         'description' => __( 'Select image background from media library to do your signature.', 'js_composer' )
      ),
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Icon 1", 'hostio'),
      "param_name" => "icon1",
      "value" => "",
      "description" => __("Icon 1 user icon boostrap, font-awesome", 'hostio')
   ),
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Link 1", 'hostio'),
      "param_name" => "link1",
      "value" => "",
      "description" => __("Link 1 ", 'hostio')
   ),
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Icon 2", 'hostio'),
      "param_name" => "icon2",
      "value" => "",
      "description" => __("Icon 2 user icon boostrap, font-awesome", 'hostio')
   ),
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Link 2", 'hostio'),
      "param_name" => "link2",
      "value" => "",
      "description" => __("Link 2 ", 'hostio')
   ),
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Icon 3", 'hostio'),
      "param_name" => "icon3",
      "value" => "",
      "description" => __("Icon 3 user icon boostrap, font-awesome", 'hostio')
   ),
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Link 3", 'hostio'),
      "param_name" => "link3",
      "value" => "",
      "description" => __("Link 3 ", 'hostio')
   ),
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Icon 4", 'hostio'),
      "param_name" => "icon4",
      "value" => "",
      "description" => __("Icon 4 user icon boostrap, font-awesome", 'hostio')
   ),
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Link 4", 'hostio'),
      "param_name" => "link4",
      "value" => "",
      "description" => __("Link 4 ", 'hostio')
   ),
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Icon 5", 'hostio'),
      "param_name" => "icon5",
      "value" => "",
      "description" => __("Icon 5 user icon boostrap, font-awesome", 'hostio')
   ),
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Link 5", 'hostio'),
      "param_name" => "link5",
      "value" => "",
      "description" => __("Link 5 ", 'hostio')
   ),
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Icon 6", 'hostio'),
      "param_name" => "icon6",
      "value" => "",
      "description" => __("Icon 6 user icon boostrap, font-awesome", 'hostio')
   ),
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Link 6", 'hostio'),
      "param_name" => "link6",
      "value" => "",
      "description" => __("Link 6 ", 'hostio')
   ),
    )));
}

// add
 


//hosting
if(function_exists('vc_map')){
   vc_map( array(
   "name" => __($pre_text."hosting", 'hostio'),
   "base" => "hosting",
   "class" => "",
   "icon" => "icon-st",
   "category" => 'Content',
   "params" => array(
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Icon ", 'hostio'),
      "param_name" => "icon",
      "value" => "",
      "description" => __("Icon  user icon boostrap, font-awesome", 'hostio')
   ),
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Title ", 'hostio'),
      "param_name" => "title",
      "value" => "",
      "description" => __("Title  ", 'hostio')
   ),
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Description ", 'hostio'),
      "param_name" => "desc",
      "value" => "",
      "description" => __("Description  ", 'hostio')
   ),
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Button Name ", 'hostio'),
      "param_name" => "btn_name",
      "value" => "",
      "description" => __("Button Name  ", 'hostio')
   ),
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Button Link ", 'hostio'),
      "param_name" => "btn_link",
      "value" => "",
      "description" => __("Button Link  ", 'hostio')
   ),
   array(
         'type' => 'dropdown',
         'heading' => __( 'Chosen active', 'js_composer' ),
         'param_name' => 'chosen',
         'value' => array(
            __( 'No', 'js_composer' ) => 'no',
            __( 'Yes', 'js_composer' ) => 'yes',
         ),
         'description' => __( 'Chosen active. Only 1 active', 'js_composer' )
      ),
    )));
}
// add
 


//pricing
if(function_exists('vc_map')){
   vc_map( array(
   "name" => __($pre_text."pricing", 'hostio'),
   "base" => "pricing",
   "class" => "",
   "icon" => "icon-st",
   "category" => 'Content',
   "params" => array(
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Icon ", 'hostio'),
      "param_name" => "icon",
      "value" => "",
      "description" => __("Icon  user icon boostrap, font-awesome", 'hostio')
   ),
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Title ", 'hostio'),
      "param_name" => "title",
      "value" => "",
      "description" => __("Title  ", 'hostio')
   ),
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Description ", 'hostio'),
      "param_name" => "desc",
      "value" => "",
      "description" => __("Description  ", 'hostio')
   ),
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Sub title ", 'hostio'),
      "param_name" => "sub_title",
      "value" => "",
      "description" => __("Sub title  ", 'hostio')
   ),
      array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("amount", 'hostio'),
      "param_name" => "amount",
      "value" => "",
      "description" => __("amount", 'hostio')
   ),
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("currency ", 'hostio'),
      "param_name" => "currency",
      "value" => "",
      "description" => __("currency  ", 'hostio')
   ),

   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("duration", 'hostio'),
      "param_name" => "duration",
      "value" => "",
      "description" => __("duration", 'hostio')
   ),
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Button Name ", 'hostio'),
      "param_name" => "btn_name",
      "value" => "",
      "description" => __("Button Name  ", 'hostio')
   ),
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Button Link ", 'hostio'),
      "param_name" => "btn_link",
      "value" => "",
      "description" => __("Button Link  ", 'hostio')
   ),
   array(
         'type' => 'dropdown',
         'heading' => __( 'Chosen Color', 'js_composer' ),
         'param_name' => 'chosencolor',
         'value' => array(
            __( 'Green', 'js_composer' ) => '1',
            __( 'Pink', 'js_composer' ) => '2',
            __( 'Purple', 'js_composer' ) => '3',
         ),
         'description' => __( 'Chosen Green. Only 1 Green', 'js_composer' )
      ),
   array(
         'type' => 'dropdown',
         'heading' => __( 'Chosen active', 'js_composer' ),
         'param_name' => 'chosen',
         'value' => array(
            __( 'No', 'js_composer' ) => 'no',
            __( 'Yes', 'js_composer' ) => 'yes',
         ),
         'description' => __( 'Chosen active. Only 1 active', 'js_composer' )
      ),
    )));
}

//pricing
if(function_exists('vc_map')){
   vc_map( array(
   "name" => __($pre_text."info", 'hostio'),
   "base" => "info",
   "class" => "",
   "icon" => "icon-st",
   "category" => 'Content',
   "params" => array(
   array(
         'type' => 'attach_image',
         'heading' => __( 'Image', 'js_composer' ),
         'param_name' => 'image',
         'value' => '',
         'description' => __( 'Select image background from media library to do your signature.', 'js_composer' )
      ),
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Title ", 'hostio'),
      "param_name" => "title",
      "value" => "",
      "description" => __("Title  ", 'hostio')
   ),
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Description ", 'hostio'),
      "param_name" => "desc",
      "value" => "",
      "description" => __("Description  ", 'hostio')
   ),
   array(
         'type' => 'dropdown',
         'heading' => __( 'Chosen active', 'js_composer' ),
         'param_name' => 'chosen',
         'value' => array(
            __( 'No', 'js_composer' ) => 'no',
            __( 'Yes', 'js_composer' ) => 'yes',
         ),
         'description' => __( 'Chosen active. Only 1 active', 'js_composer' )
      ),
    )));
}
//More info
if(function_exists('vc_map')){
   vc_map( array(
   "name" => __($pre_text."moreinfo", 'hostio'),
   "base" => "moreinfo",
   "class" => "",
   "icon" => "icon-st",
   "category" => 'Content',
   "params" => array(
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Title ", 'hostio'),
      "param_name" => "title",
      "value" => "",
      "description" => __("Title  ", 'hostio')
   ),
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Description ", 'hostio'),
      "param_name" => "desc",
      "value" => "",
      "description" => __("Description  ", 'hostio')
   ),
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Button Name ", 'hostio'),
      "param_name" => "btn_name",
      "value" => "",
      "description" => __("Button Name  ", 'hostio')
   ),
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Button Link ", 'hostio'),
      "param_name" => "btn_link",
      "value" => "",
      "description" => __("Button Link  ", 'hostio')
   ),
    )));
}

//More features
if(function_exists('vc_map')){
   vc_map( array(
   "name" => __($pre_text."morefeatures", 'hostio'),
   "base" => "morefeatures",
   "class" => "",
   "icon" => "icon-st",
   "category" => 'Content',
   "params" => array(
   array(
         'type' => 'attach_image',
         'heading' => __( 'Image', 'js_composer' ),
         'param_name' => 'image',
         'value' => '',
         'description' => __( 'Select image background from media library to do your signature.', 'js_composer' )
      ),
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Icon  ", 'hostio'),
      "param_name" => "icon",
      "value" => "",
      "description" => __("Icon user icon boostrap, font-awesome", 'hostio')
   ),
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Title ", 'hostio'),
      "param_name" => "title",
      "value" => "",
      "description" => __("Title  ", 'hostio')
   ),
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Description ", 'hostio'),
      "param_name" => "desc",
      "value" => "",
      "description" => __("Description  ", 'hostio')
   ),
    )));
}
//testimonials
if(function_exists('vc_map')){
   vc_map( array(
   "name" => __($pre_text."testimonials", 'hostio'),
   "base" => "testimonials",
   "class" => "",
   "icon" => "icon-st",
   "category" => 'Content',
   "params" => array(
   array(
         'type' => 'attach_image',
         'heading' => __( 'Image', 'js_composer' ),
         'param_name' => 'image',
         'value' => '',
         'description' => __( 'Select image background from media library to do your signature.', 'js_composer' )
      ),
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Title ", 'hostio'),
      "param_name" => "title",
      "value" => "",
      "description" => __("Title  ", 'hostio')
   ),
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Description ", 'hostio'),
      "param_name" => "desc",
      "value" => "",
      "description" => __("Description  ", 'hostio')
   ),
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Name ", 'hostio'),
      "param_name" => "name",
      "value" => "",
      "description" => __("Name  ", 'hostio')
   ),
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Job ", 'hostio'),
      "param_name" => "job",
      "value" => "",
      "description" => __("Job  ", 'hostio')
   ),
    )));
}
//started
if(function_exists('vc_map')){
   vc_map( array(
   "name" => __($pre_text."started", 'hostio'),
   "base" => "started",
   "class" => "",
   "icon" => "icon-st",
   "category" => 'Content',
   "params" => array(
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Title ", 'hostio'),
      "param_name" => "title",
      "value" => "",
      "description" => __("Title  ", 'hostio')
   ),
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Button Name ", 'hostio'),
      "param_name" => "btn_name",
      "value" => "",
      "description" => __("Button Name  ", 'hostio')
   ),
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Button Link ", 'hostio'),
      "param_name" => "btn_link",
      "value" => "",
      "description" => __("Button Link  ", 'hostio')
   ),
    )));
}
//text about
if(function_exists('vc_map')){
   vc_map( array(
   "name" => __($pre_text."textabout", 'hostio'),
   "base" => "textabout",
   "class" => "",
   "icon" => "icon-st",
   "category" => 'Content',
   "params" => array(
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Title ", 'hostio'),
      "param_name" => "title",
      "value" => "",
      "description" => __("Title  ", 'hostio')
   ),
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Description ", 'hostio'),
      "param_name" => "desc",
      "value" => "",
      "description" => __("Description", 'hostio')
   ),
    )));
}
//brief
if(function_exists('vc_map')){
   vc_map( array(
   "name" => __($pre_text."brief", 'hostio'),
   "base" => "brief",
   "class" => "",
   "icon" => "icon-st",
   "category" => 'Content',
   "params" => array(
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Title ", 'hostio'),
      "param_name" => "title",
      "value" => "",
      "description" => __("Title  ", 'hostio')
   ),
    )));
}
//message
if(function_exists('vc_map')){
   vc_map( array(
   "name" => __($pre_text."message", 'hostio'),
   "base" => "message",
   "class" => "",
   "icon" => "icon-st",
   "category" => 'Content',
   "params" => array(
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Title 1", 'hostio'),
      "param_name" => "title1",
      "value" => "",
      "description" => __("Title  1", 'hostio')
   ),
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Desc 1", 'hostio'),
      "param_name" => "desc1",
      "value" => "",
      "description" => __("Desc  1", 'hostio')
   ),
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Title 2", 'hostio'),
      "param_name" => "title2",
      "value" => "",
      "description" => __("Title  2", 'hostio')
   ),
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Desc 2", 'hostio'),
      "param_name" => "desc2",
      "value" => "",
      "description" => __("Desc  2", 'hostio')
   ),
    )));
}
//story
if(function_exists('vc_map')){
   vc_map( array(
   "name" => __($pre_text."story", 'hostio'),
   "base" => "story",
   "class" => "",
   "icon" => "icon-st",
   "category" => 'Content',
   "params" => array(
   array(
         'type' => 'attach_image',
         'heading' => __( 'Image', 'js_composer' ),
         'param_name' => 'image',
         'value' => '',
         'description' => __( 'Select image background from media library to do your signature.', 'js_composer' )
      ),
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Title ", 'hostio'),
      "param_name" => "title",
      "value" => "",
      "description" => __("Title  ", 'hostio')
   ),
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Desc ", 'hostio'),
      "param_name" => "desc",
      "value" => "",
      "description" => __("Desc  ", 'hostio')
   ),
    )));
}
//services
if(function_exists('vc_map')){
   vc_map( array(
   "name" => __($pre_text."services", 'hostio'),
   "base" => "services",
   "class" => "",
   "icon" => "icon-st",
   "category" => 'Content',
   "params" => array(
   array(
         'type' => 'attach_image',
         'heading' => __( 'Image', 'js_composer' ),
         'param_name' => 'image',
         'value' => '',
         'description' => __( 'Select image background from media library to do your signature.', 'js_composer' )
      ),
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Icon  ", 'hostio'),
      "param_name" => "icon",
      "value" => "",
      "description" => __("Icon user icon boostrap, font-awesome", 'hostio')
   ),
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Title ", 'hostio'),
      "param_name" => "title",
      "value" => "",
      "description" => __("Title  ", 'hostio')
   ),
    )));
}
//texttitle
if(function_exists('vc_map')){
   vc_map( array(
   "name" => __($pre_text."texttitle", 'hostio'),
   "base" => "texttitle",
   "class" => "",
   "icon" => "icon-st",
   "category" => 'Content',
   "params" => array(
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Title ", 'hostio'),
      "param_name" => "title",
      "value" => "",
      "description" => __("Title  ", 'hostio')
   ),
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Desc ", 'hostio'),
      "param_name" => "desc",
      "value" => "",
      "description" => __("Desc  ", 'hostio')
   ),
    )));
}

//hosting pricing
if(function_exists('vc_map')){
   vc_map( array(
   "name" => __($pre_text."hostpricing", 'hostio'),
   "base" => "hostpricing",
   "class" => "",
   "icon" => "icon-st",
   "category" => 'Content',
   "params" => array(
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Title ", 'hostio'),
      "param_name" => "title",
      "value" => "",
      "description" => __("Title  ", 'hostio')
   ),
      array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("amount", 'hostio'),
      "param_name" => "amount",
      "value" => "",
      "description" => __("amount", 'hostio')
   ),
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("currency ", 'hostio'),
      "param_name" => "currency",
      "value" => "",
      "description" => __("currency  ", 'hostio')
   ),

   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("duration", 'hostio'),
      "param_name" => "duration",
      "value" => "",
      "description" => __("duration", 'hostio')
   ),
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Detail 1", 'hostio'),
      "param_name" => "detail1",
      "value" => "",
      "description" => __("Detail 1", 'hostio')
   ),
   array(
         'type' => 'dropdown',
         'heading' => __( 'Chosen support', 'js_composer' ),
         'param_name' => 'chosen1',
         'value' => array(
            __( 'No', 'js_composer' ) => 'no',
            __( 'Yes', 'js_composer' ) => 'yes',
         ),
         'description' => __( 'Chosen support', 'js_composer' )
      ),
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Detail 2", 'hostio'),
      "param_name" => "detail2",
      "value" => "",
      "description" => __("Detail 2", 'hostio')
   ),
   array(
         'type' => 'dropdown',
         'heading' => __( 'Chosen support', 'js_composer' ),
         'param_name' => 'chosen2',
         'value' => array(
            __( 'No', 'js_composer' ) => 'no',
            __( 'Yes', 'js_composer' ) => 'yes',
         ),
         'description' => __( 'Chosen support', 'js_composer' )
      ),
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Detail 3", 'hostio'),
      "param_name" => "detail3",
      "value" => "",
      "description" => __("Detail 3", 'hostio')
   ),
   array(
         'type' => 'dropdown',
         'heading' => __( 'Chosen support', 'js_composer' ),
         'param_name' => 'chosen3',
         'value' => array(
            __( 'No', 'js_composer' ) => 'no',
            __( 'Yes', 'js_composer' ) => 'yes',
         ),
         'description' => __( 'Chosen support', 'js_composer' )
      ),
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Detail 4", 'hostio'),
      "param_name" => "detail4",
      "value" => "",
      "description" => __("Detail 4", 'hostio')
   ),
   array(
         'type' => 'dropdown',
         'heading' => __( 'Chosen support', 'js_composer' ),
         'param_name' => 'chosen4',
         'value' => array(
            __( 'No', 'js_composer' ) => 'no',
            __( 'Yes', 'js_composer' ) => 'yes',
         ),
         'description' => __( 'Chosen support', 'js_composer' )
      ),
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Detail 5", 'hostio'),
      "param_name" => "detail5",
      "value" => "",
      "description" => __("Detail 5", 'hostio')
   ),
   array(
         'type' => 'dropdown',
         'heading' => __( 'Chosen support', 'js_composer' ),
         'param_name' => 'chosen5',
         'value' => array(
            __( 'No', 'js_composer' ) => 'no',
            __( 'Yes', 'js_composer' ) => 'yes',
         ),
         'description' => __( 'Chosen support', 'js_composer' )
      ),
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Detail 6", 'hostio'),
      "param_name" => "detail6",
      "value" => "",
      "description" => __("Detail 6", 'hostio')
   ),
   array(
         'type' => 'dropdown',
         'heading' => __( 'Chosen support', 'js_composer' ),
         'param_name' => 'chosen6',
         'value' => array(
            __( 'No', 'js_composer' ) => 'no',
            __( 'Yes', 'js_composer' ) => 'yes',
         ),
         'description' => __( 'Chosen support', 'js_composer' )
      ),
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Detail 7", 'hostio'),
      "param_name" => "detail7",
      "value" => "",
      "description" => __("Detail 7", 'hostio')
   ),
   array(
         'type' => 'dropdown',
         'heading' => __( 'Chosen support', 'js_composer' ),
         'param_name' => 'chosen7',
         'value' => array(
            __( 'No', 'js_composer' ) => 'no',
            __( 'Yes', 'js_composer' ) => 'yes',
         ),
         'description' => __( 'Chosen support', 'js_composer' )
      ),
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Detail 8", 'hostio'),
      "param_name" => "detail8",
      "value" => "",
      "description" => __("Detail 8", 'hostio')
   ),
   array(
         'type' => 'dropdown',
         'heading' => __( 'Chosen support', 'js_composer' ),
         'param_name' => 'chosen8',
         'value' => array(
            __( 'No', 'js_composer' ) => 'no',
            __( 'Yes', 'js_composer' ) => 'yes',
         ),
         'description' => __( 'Chosen support', 'js_composer' )
      ),
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Detail 9", 'hostio'),
      "param_name" => "detail9",
      "value" => "",
      "description" => __("Detail 9", 'hostio')
   ),
   array(
         'type' => 'dropdown',
         'heading' => __( 'Chosen support', 'js_composer' ),
         'param_name' => 'chosen9',
         'value' => array(
            __( 'No', 'js_composer' ) => 'no',
            __( 'Yes', 'js_composer' ) => 'yes',
         ),
         'description' => __( 'Chosen support', 'js_composer' )
      ),
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Detail 10", 'hostio'),
      "param_name" => "detail10",
      "value" => "",
      "description" => __("Detail 10", 'hostio')
   ),
   array(
         'type' => 'dropdown',
         'heading' => __( 'Chosen support', 'js_composer' ),
         'param_name' => 'chosen10',
         'value' => array(
            __( 'No', 'js_composer' ) => 'no',
            __( 'Yes', 'js_composer' ) => 'yes',
         ),
         'description' => __( 'Chosen support', 'js_composer' )
      ),
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Detail 11", 'hostio'),
      "param_name" => "detail11",
      "value" => "",
      "description" => __("Detail 11", 'hostio')
   ),
   array(
         'type' => 'dropdown',
         'heading' => __( 'Chosen support', 'js_composer' ),
         'param_name' => 'chosen11',
         'value' => array(
            __( 'No', 'js_composer' ) => 'no',
            __( 'Yes', 'js_composer' ) => 'yes',
         ),
         'description' => __( 'Chosen support', 'js_composer' )
      ),
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Detail 12", 'hostio'),
      "param_name" => "detail12",
      "value" => "",
      "description" => __("Detail 12", 'hostio')
   ),
   array(
         'type' => 'dropdown',
         'heading' => __( 'Chosen support', 'js_composer' ),
         'param_name' => 'chosen12',
         'value' => array(
            __( 'No', 'js_composer' ) => 'no',
            __( 'Yes', 'js_composer' ) => 'yes',
         ),
         'description' => __( 'Chosen support', 'js_composer' )
      ),
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Button Name ", 'hostio'),
      "param_name" => "btn_name",
      "value" => "",
      "description" => __("Button Name  ", 'hostio')
   ),
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Button Link ", 'hostio'),
      "param_name" => "btn_link",
      "value" => "",
      "description" => __("Button Link  ", 'hostio')
   ),
   array(
         'type' => 'dropdown',
         'heading' => __( 'Chosen active', 'js_composer' ),
         'param_name' => 'chosen13',
         'value' => array(
            __( 'No', 'js_composer' ) => 'no',
            __( 'Yes', 'js_composer' ) => 'yes',
         ),
         'description' => __( 'Chosen active', 'js_composer' )
      ),
    )));
}
//leftplatforms
if(function_exists('vc_map')){
   vc_map( array(
   "name" => __($pre_text."leftplatforms", 'hostio'),
   "base" => "leftplatforms",
   "class" => "",
   "icon" => "icon-st",
   "category" => 'Content',
   "params" => array(
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Title 1", 'hostio'),
      "param_name" => "title1",
      "value" => "",
      "description" => __("Title  1", 'hostio')
   ),
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Id 1", 'hostio'),
      "param_name" => "id1",
      "value" => "",
      "description" => __("Id  1", 'hostio')
   ),
   array(
         'type' => 'attach_image',
         'heading' => __( 'Image 1', 'js_composer' ),
         'param_name' => 'image1',
         'value' => '',
         'description' => __( 'Select image background from media library to do your signature.', 'js_composer' )
      ),
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Title 2", 'hostio'),
      "param_name" => "title2",
      "value" => "",
      "description" => __("Title  2", 'hostio')
   ),
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Id 2", 'hostio'),
      "param_name" => "id2",
      "value" => "",
      "description" => __("Id  2", 'hostio')
   ),
   array(
         'type' => 'attach_image',
         'heading' => __( 'Image 2', 'js_composer' ),
         'param_name' => 'image2',
         'value' => '',
         'description' => __( 'Select image background from media library to do your signature.', 'js_composer' )
      ),
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Title 3", 'hostio'),
      "param_name" => "title3",
      "value" => "",
      "description" => __("Title  3", 'hostio')
   ),
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Id 3", 'hostio'),
      "param_name" => "id3",
      "value" => "",
      "description" => __("Id  3", 'hostio')
   ),
   array(
         'type' => 'attach_image',
         'heading' => __( 'Image 3', 'js_composer' ),
         'param_name' => 'image3',
         'value' => '',
         'description' => __( 'Select image background from media library to do your signature.', 'js_composer' )
      ),
    )));
}
//centerplatforms
if(function_exists('vc_map')){
   vc_map( array(
   "name" => __($pre_text."centerplatforms", 'hostio'),
   "base" => "centerplatforms",
   "class" => "",
   "icon" => "icon-st",
   "category" => 'Content',
   "params" => array(
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Id 1", 'hostio'),
      "param_name" => "id1",
      "value" => "",
      "description" => __("Id  1", 'hostio')
   ),
   array(
         'type' => 'attach_image',
         'heading' => __( 'Image 1', 'js_composer' ),
         'param_name' => 'image1',
         'value' => '',
         'description' => __( 'Select image background from media library to do your signature.', 'js_composer' )
      ),
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Id 2", 'hostio'),
      "param_name" => "id2",
      "value" => "",
      "description" => __("Id  2", 'hostio')
   ),
   array(
         'type' => 'attach_image',
         'heading' => __( 'Image 2', 'js_composer' ),
         'param_name' => 'image2',
         'value' => '',
         'description' => __( 'Select image background from media library to do your signature.', 'js_composer' )
      ),
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Id 3", 'hostio'),
      "param_name" => "id3",
      "value" => "",
      "description" => __("Id  3", 'hostio')
   ),
   array(
         'type' => 'attach_image',
         'heading' => __( 'Image 3', 'js_composer' ),
         'param_name' => 'image3',
         'value' => '',
         'description' => __( 'Select image background from media library to do your signature.', 'js_composer' )
      ),
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Id 4", 'hostio'),
      "param_name" => "id4",
      "value" => "",
      "description" => __("Id  4", 'hostio')
   ),
   array(
         'type' => 'attach_image',
         'heading' => __( 'Image 4', 'js_composer' ),
         'param_name' => 'image4',
         'value' => '',
         'description' => __( 'Select image background from media library to do your signature.', 'js_composer' )
      ),
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Id 5", 'hostio'),
      "param_name" => "id5",
      "value" => "",
      "description" => __("Id  5", 'hostio')
   ),
   array(
         'type' => 'attach_image',
         'heading' => __( 'Image 5', 'js_composer' ),
         'param_name' => 'image5',
         'value' => '',
         'description' => __( 'Select image background from media library to do your signature.', 'js_composer' )
      ),
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Id 6", 'hostio'),
      "param_name" => "id6",
      "value" => "",
      "description" => __("Id  6", 'hostio')
   ),
   array(
         'type' => 'attach_image',
         'heading' => __( 'Image 6', 'js_composer' ),
         'param_name' => 'image6',
         'value' => '',
         'description' => __( 'Select image background from media library to do your signature.', 'js_composer' )
      ),
    )));
}
//rightplatforms
if(function_exists('vc_map')){
   vc_map( array(
   "name" => __($pre_text."rightplatforms", 'hostio'),
   "base" => "rightplatforms",
   "class" => "",
   "icon" => "icon-st",
   "category" => 'Content',
   "params" => array(
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Title 1", 'hostio'),
      "param_name" => "title1",
      "value" => "",
      "description" => __("Title  1", 'hostio')
   ),
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Id 1", 'hostio'),
      "param_name" => "id1",
      "value" => "",
      "description" => __("Id  1", 'hostio')
   ),
   array(
         'type' => 'attach_image',
         'heading' => __( 'Image 1', 'js_composer' ),
         'param_name' => 'image1',
         'value' => '',
         'description' => __( 'Select image background from media library to do your signature.', 'js_composer' )
      ),
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Title 2", 'hostio'),
      "param_name" => "title2",
      "value" => "",
      "description" => __("Title  2", 'hostio')
   ),
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Id 2", 'hostio'),
      "param_name" => "id2",
      "value" => "",
      "description" => __("Id  2", 'hostio')
   ),
   array(
         'type' => 'attach_image',
         'heading' => __( 'Image 2', 'js_composer' ),
         'param_name' => 'image2',
         'value' => '',
         'description' => __( 'Select image background from media library to do your signature.', 'js_composer' )
      ),
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Title 3", 'hostio'),
      "param_name" => "title3",
      "value" => "",
      "description" => __("Title  3", 'hostio')
   ),
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Id 3", 'hostio'),
      "param_name" => "id3",
      "value" => "",
      "description" => __("Id  3", 'hostio')
   ),
   array(
         'type' => 'attach_image',
         'heading' => __( 'Image 3', 'js_composer' ),
         'param_name' => 'image3',
         'value' => '',
         'description' => __( 'Select image background from media library to do your signature.', 'js_composer' )
      ),
    )));
}
//texttitlelink
if(function_exists('vc_map')){
   vc_map( array(
   "name" => __($pre_text."texttitlelink", 'hostio'),
   "base" => "texttitlelink",
   "class" => "",
   "icon" => "icon-st",
   "category" => 'Content',
   "params" => array(
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Title ", 'hostio'),
      "param_name" => "title",
      "value" => "",
      "description" => __("Title  ", 'hostio')
   ),
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Desc 1", 'hostio'),
      "param_name" => "desc1",
      "value" => "",
      "description" => __("Desc 1 ", 'hostio')
   ),
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Link", 'hostio'),
      "param_name" => "link",
      "value" => "",
      "description" => __("Link ", 'hostio')
   ),
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Value", 'hostio'),
      "param_name" => "value",
      "value" => "",
      "description" => __("Value ", 'hostio')
   ),
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Desc 2", 'hostio'),
      "param_name" => "desc2",
      "value" => "",
      "description" => __("Desc 2 ", 'hostio')
   ),
    )));
}
//col7info1
if(function_exists('vc_map')){
   vc_map( array(
   "name" => __($pre_text."col7info1", 'hostio'),
   "base" => "col7info1",
   "class" => "",
   "icon" => "icon-st",
   "category" => 'Content',
   "params" => array(
   array(
         'type' => 'attach_image',
         'heading' => __( 'Image', 'js_composer' ),
         'param_name' => 'image',
         'value' => '',
         'description' => __( 'Select image background from media library to do your signature.', 'js_composer' )
      ),
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Title ", 'hostio'),
      "param_name" => "title",
      "value" => "",
      "description" => __("Title  ", 'hostio')
   ),
    )));
}
//col5title
if(function_exists('vc_map')){
   vc_map( array(
   "name" => __($pre_text."col5title", 'hostio'),
   "base" => "col5title",
   "class" => "",
   "icon" => "icon-st",
   "category" => 'Content',
   "params" => array(
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Title ", 'hostio'),
      "param_name" => "title",
      "value" => "",
      "description" => __("Title  ", 'hostio')
   ),
    )));
}
//col5info1
if(function_exists('vc_map')){
   vc_map( array(
   "name" => __($pre_text."col5info1", 'hostio'),
   "base" => "col5info1",
   "class" => "",
   "icon" => "icon-st",
   "category" => 'Content',
   "params" => array(
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Title ", 'hostio'),
      "param_name" => "title",
      "value" => "",
      "description" => __("Title  ", 'hostio')
   ),
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Desc ", 'hostio'),
      "param_name" => "desc",
      "value" => "",
      "description" => __("Desc  ", 'hostio')
   ),
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Icon name ", 'hostio'),
      "param_name" => "icon",
      "value" => "",
      "description" => __("Icon name  ", 'hostio')
   ),
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Link ", 'hostio'),
      "param_name" => "link",
      "value" => "",
      "description" => __("Link  ", 'hostio')
   ),
   array(
         'type' => 'dropdown',
         'heading' => __( 'Chosen Color', 'js_composer' ),
         'param_name' => 'chosencolor',
         'value' => array(
            __( 'Green', 'js_composer' ) => '1',
            __( 'Yellow', 'js_composer' ) => '2',
            __( 'Purple', 'js_composer' ) => '3',
         ),
         'description' => __( 'Chosen Green. Only 1 Green', 'js_composer' )
      ),
    )));
}
//col7info2
if(function_exists('vc_map')){
   vc_map( array(
   "name" => __($pre_text."col7info2", 'hostio'),
   "base" => "col7info2",
   "class" => "",
   "icon" => "icon-st",
   "category" => 'Content',
   "params" => array(
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Title ", 'hostio'),
      "param_name" => "title",
      "value" => "",
      "description" => __("Title  ", 'hostio')
   ),
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Desc ", 'hostio'),
      "param_name" => "desc",
      "value" => "",
      "description" => __("Desc  ", 'hostio')
   ),
   array(
         'type' => 'dropdown',
         'heading' => __( 'Chosen active', 'js_composer' ),
         'param_name' => 'chosen',
         'value' => array(
            __( 'No', 'js_composer' ) => 'no',
            __( 'Yes', 'js_composer' ) => 'yes',
         ),
         'description' => __( 'Chosen active. Only 1 active', 'js_composer' )
      ),
    )));
}
//col5info2
if(function_exists('vc_map')){
   vc_map( array(
   "name" => __($pre_text."col5info2", 'hostio'),
   "base" => "col5info2",
   "class" => "",
   "icon" => "icon-st",
   "category" => 'Content',
   "params" => array(
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Title ", 'hostio'),
      "param_name" => "title",
      "value" => "",
      "description" => __("Title  ", 'hostio')
   ),
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Desc ", 'hostio'),
      "param_name" => "desc",
      "value" => "",
      "description" => __("Desc  ", 'hostio')
   ),
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Link ", 'hostio'),
      "param_name" => "link",
      "value" => "",
      "description" => __("Link  ", 'hostio')
   ),
    )));
}
//col5info3
if(function_exists('vc_map')){
   vc_map( array(
   "name" => __($pre_text."col5info3", 'hostio'),
   "base" => "col5info3",
   "class" => "",
   "icon" => "icon-st",
   "category" => 'Content',
   "params" => array(
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Title ", 'hostio'),
      "param_name" => "title",
      "value" => "",
      "description" => __("Title  ", 'hostio')
   ),
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Desc ", 'hostio'),
      "param_name" => "desc",
      "value" => "",
      "description" => __("Desc  ", 'hostio')
   ),
    )));
}
//col5link
if(function_exists('vc_map')){
   vc_map( array(
   "name" => __($pre_text."col5link", 'hostio'),
   "base" => "col5link",
   "class" => "",
   "icon" => "icon-st",
   "category" => 'Content',
   "params" => array(
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Title ", 'hostio'),
      "param_name" => "title",
      "value" => "",
      "description" => __("Title  ", 'hostio')
   ),
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Desc ", 'hostio'),
      "param_name" => "desc",
      "value" => "",
      "description" => __("Desc  ", 'hostio')
   ),
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Icon ", 'hostio'),
      "param_name" => "icon",
      "value" => "",
      "description" => __("Icon  ", 'hostio')
   ),
   array(
      "type" => "textarea",
      "holder" => "div",
      "class" => "",
      "heading" => __("Link ", 'hostio'),
      "param_name" => "link",
      "value" => "",
      "description" => __("Link  ", 'hostio')
   ),
    )));
}