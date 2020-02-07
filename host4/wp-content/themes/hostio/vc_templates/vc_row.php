<?php

$output = $el_class = $bg_image = $bg_color = $bg_image_repeat = $font_color = $padding = $margin_bottom = $css = '';

extract(shortcode_atts(array(

    'el_class'        => '',

    'bg_image'        => '',

    //'bg_color'        => '',

    'bg_image_repeat' => '',

    //'font_color'      => '',

    'padding'         => '',

    'margin_bottom'   => '',

    'css' => '',

    'wrap_class'=>'',

    'ses_title'=>'',

    'ses_sub_title'=>'',
    'ses_content'=>'',

    'type_row' => '',

    'number_tes' => '',

    'ses_image' => '',

    'ses_text' => '',

    'ses_link' => '',

    'ses_numbertes' => '',

    'ses_tab1' => '',

    'ses_tab2' => '',

    'ses_tab3' => '',

    'ses_color' => '',

    'ses_iconname' => '',

), $atts));



// wp_enqueue_style( 'js_composer_front' );

wp_enqueue_script( 'wpb_composer_front_js' );

// wp_enqueue_style('js_composer_custom_css');



$el_class = $this->getExtraClass($el_class);

$css_class = apply_filters( VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, ''. ( $this->settings('base')==='vc_row_inner' ? 'vc_inner ' : '' ) . get_row_css_class() . $el_class . vc_shortcode_custom_css_class( $css, ' ' ), $this->settings['base'], $atts );

$style = $this->buildStyle($bg_image, $bg_color, $bg_image_repeat, $font_color, $padding, $margin_bottom);

if($type_row == 'type2'){

    $output .= wpb_js_remove_wpautop($content);

    $output .= $this->endBlockComment('row');


}elseif($type_row == 'domain'){
        
    $output .='<div id="top-content" class="container-fluid">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <div class="big-title">'.$ses_title.'</div>
                            <div class="sub-title">'.$ses_sub_title.'</div>';

     $output .= wpb_js_remove_wpautop($content);

    $output .=''.$this->endBlockComment('row');                   

     $output .='</div>
                  </div>
                    </div>
                      </div>';

}elseif($type_row == 'hosting'){
        
    $output .='<div id="features" class="container-fluid">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row-title">'.$ses_title.'</div>
                            <div class="row-subtitle">'.$ses_sub_title.'</div>
                        </div>
                    </div>
                    <div class="row">';

     $output .= wpb_js_remove_wpautop($content);

    $output .=''.$this->endBlockComment('row');                   

     $output .='</div>
                  </div>
                    </div>';

}elseif($type_row == 'pricing'){
        
    $output .='<div id="pricing" class="container-fluid">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row-title">'.$ses_title.'</div>
                            <div class="row-subtitle">'.$ses_sub_title.'</div>
                        </div>
                    </div>
                    <div class="row">';

     $output .= wpb_js_remove_wpautop($content);

    $output .=''.$this->endBlockComment('row');                   

     $output .='</div>
                  </div>
                    </div>';

}elseif($type_row == 'info'){
        
    $output .='<div id="info" class="container-fluid">
                <div class="container">';

     $output .= wpb_js_remove_wpautop($content);

    $output .=''.$this->endBlockComment('row');                   

     $output .='</div>
                  </div>';

}elseif($type_row == 'moreinfo'){
        
    $output .='<div id="more-info" class="container-fluid">
                <div class="container">';

     $output .= wpb_js_remove_wpautop($content);

    $output .=''.$this->endBlockComment('row');                   

     $output .='</div>
                  </div>';

}elseif($type_row == 'morefeatures'){
        
    $output .='<div id="more-features" class="container-fluid">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row-title">'.$ses_title.'</div>
                <div class="row-subtitle">'.$ses_sub_title.'</div>
            </div>
        </div>
        <div class="row">';

     $output .= wpb_js_remove_wpautop($content);

    $output .=''.$this->endBlockComment('row');                   

     $output .='</div>
                  </div>
                    </div>';

}elseif($type_row == 'testimonials'){
        
    $output .='<div id="testimonials" class="container-fluid">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row-title">'.$ses_title.'</div>
                            <div class="row-subtitle">'.$ses_sub_title.'</div>
                        </div>
                    </div>
                    <div class="row">';

     $output .= wpb_js_remove_wpautop($content);

    $output .=''.$this->endBlockComment('row');                   

     $output .='</div>
                  </div>
                    </div>';

}elseif($type_row == 'services'){
        
    $output .='<div id="services" class="container-fluid">
                  <div class="container">
                      <div class="row">
                          <div class="col-md-12">
                              <div class="row-title">'.$ses_title.'</div>
                              <div class="row-subtitle">'.$ses_sub_title.'</div>
                          </div>
                      </div>
                      <div class="row">';
                    
     $output .= wpb_js_remove_wpautop($content);

    $output .=''.$this->endBlockComment('row');                   

     $output .='</div>
                  <div class="row">
                      <div class="col-md-12">
                          <a href="'.$ses_link.'" class="more-details-button">'.$ses_text.'</a>
                      </div>
                  </div>
                    </div>
                      </div>';

}elseif($type_row == 'team'){
        
    $output .='<div id="team" class="container-fluid">
                <div class="image-bg"></div>
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row-title">'.$ses_title.'</div>
                        </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                          <h3>'.$ses_sub_title.'</h3>
                          <p>'.$ses_content.'</p>
                      </div>
                  </div>';
                    
     $output .= wpb_js_remove_wpautop($content);

    $output .=''.$this->endBlockComment('row');                   

     $output .='<div class="row">
                  <div class="col-md-12">
                      <a href="'.$ses_link.'" class="get-started-button">'.$ses_text.'</a>
                  </div>
                    </div>
                      </div>
                        </div>';

}elseif($type_row == 'pricing2'){
        
    $output .='<div id="pricing" class="container-fluid">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <p>'.$ses_title.'</p>
                        </div>
                    </div>
                    <div class="row">';
                    
     $output .= wpb_js_remove_wpautop($content);

    $output .=''.$this->endBlockComment('row');                   

     $output .='</div>
                    </div>
                      </div>';

}elseif($type_row == 'pricing3'){
        
    $output .='<div id="sub-pricing" class="container-fluid">
                  <div class="hosting-icon '.$ses_color.'-color"><i class="'.$ses_iconname.'"></i></div>
                  <div class="container '.$ses_color.'-accent">
                      <div class="row">';
                    
     $output .= wpb_js_remove_wpautop($content);

    $output .=''.$this->endBlockComment('row');                   

     $output .='</div>
                    </div>
                      </div>';

}elseif($type_row == 'platforms'){
        
    $output .='<div id="platforms" class="container-fluid">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="text">'.$ses_title.'
            </div>
                        </div>
                    </div>
                    <div class="row">';
                    
     $output .= wpb_js_remove_wpautop($content);

    $output .=''.$this->endBlockComment('row');                   

     $output .='</div>
                    </div>
                      </div>';

}elseif($type_row == 'help'){
        
    $output .='<div id="details" class="container-fluid">
                <div class="container" id="faq-questions">';
                    
     $output .= wpb_js_remove_wpautop($content);

    $output .=''.$this->endBlockComment('row');                   

     $output .='</div>
                    </div>';

}elseif($type_row == 'searchholder'){
        
    $output .='<div id="search-text" class="container-fluid">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="text-search-holder">';
                    
     $output .= wpb_js_remove_wpautop($content);

    $output .=''.$this->endBlockComment('row');                   

     $output .='</div>
                  </div>
                    </div>
                      </div>
                        </div>';

}else{

    $output .= wpb_js_remove_wpautop($content);

    $output .= $this->endBlockComment('row');



}

echo $output;



