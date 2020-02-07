<?php 
$textdoimain = 'hostio';
global $pre_text;

$pre_text = 'VG ';


//add
//domain
add_shortcode('domain', 'domain_func');
function domain_func($atts, $content = null){
    extract(shortcode_atts(array(
        'image' => '',
        'icon1' => '',
        'link1' => '',
        'icon2' => '',
        'link2' => '',
        'icon3' => '',
        'link3' => '',
        'icon4' => '',
        'link4' => '',
        'icon5' => '',
        'link5' => '',
        'icon6' => '',
        'link6' => '',
    ), $atts));
    ob_start(); 
    $images = wp_get_attachment_image_src($image,'');
    ?>
    <div class="animation">
        <img src="<?php echo esc_url($images[0]);?>"/>
        <ul class="icons-list">
            <li><a href="<?php echo esc_attr($link1);?>"><i class="<?php echo esc_attr($icon1);?>"></i></a></li>
            <li><a href="<?php echo esc_attr($link2);?>"><i class="<?php echo esc_attr($icon2);?>"></i></a></li>
            <li><a href="<?php echo esc_attr($link3);?>"><i class="<?php echo esc_attr($icon3);?>"></i></a></li>
            <li><a href="<?php echo esc_attr($link4);?>"><i class="<?php echo esc_attr($icon4);?>"></i></a></li>
            <li><a href="<?php echo esc_attr($link5);?>"><i class="<?php echo esc_attr($icon5);?>"></i></a></li>
            <li><a href="<?php echo esc_attr($link6);?>"><i class="<?php echo esc_attr($icon6);?>"></i></a></li>
        </ul>
        <canvas id="hand-animation"></canvas>
    </div>
<?php  return ob_get_clean();
}

//add
//hosting
add_shortcode('hosting', 'hosting_func');
function hosting_func($atts, $content = null){
    extract(shortcode_atts(array(
        'icon' => '',
        'title' => '',
        'desc' => '',
        'btn_name' => '',
        'btn_link' => '',
        'chosen' => 'no',
    ), $atts));
    ob_start();
    ?>
    <div class="col-md-4">
        <div class="feature-box <?php if($chosen=='yes'){echo 'active';}?>">
            <div class="box-bg"></div>
            <div class="feature-icon"><i class="<?php echo esc_attr($icon);?>"></i></div>
            <div class="feature-title"><?php echo esc_attr($title);?></div>
            <div class="feature-details"><?php echo esc_attr($desc);?></div>
            <div class="feature-button">
                <a class="all-feature-button" href="<?php echo esc_attr($btn_link);?>"><?php echo esc_attr($btn_name);?></a>
            </div>
        </div>
    </div>
<?php  return ob_get_clean();
}
//add
//pricing
add_shortcode('pricing', 'pricing_func');
function pricing_func($atts, $content = null){
    extract(shortcode_atts(array(
        'icon' => '',
        'title' => '',
        'desc' => '',
        'sub_title' => '',
        'currency' => '',
        'amount' => '',
        'duration' => '',
        'btn_name' => '',
        'btn_link' => '',
        'chosencolor' => '1',
        'chosen' => 'no',
    ), $atts));
    ob_start();
    ?>
    <div class="col-sm-6 col-md-4">
        <div class="pricing-box <?php if($chosencolor=='2'){echo 'pink-after';}else if($chosencolor=='3'){echo 'purple-after';}else{echo 'green-after';} ?> <?php if($chosen=='yes'){echo 'best-seller';}?>">
            <div class="pricing-icon <?php if($chosencolor=='2'){echo 'pink-color';}else if($chosencolor=='3'){echo 'purple-color';}else{echo 'green-color';} ?>"><i class="<?php echo esc_attr($icon);?>"></i></div>
            <div class="pricing-title"><?php echo esc_attr($title);?></div>
            <div class="pricing-details">
                <ul>
                    <li><?php echo esc_attr($desc);?></li>
                </ul>
            </div>
            <div class="pricing-amount">
                <div><?php echo esc_attr($sub_title);?></div>
                <div class="price">
                    <span class="currency"><?php echo esc_attr($currency);?></span>
                    <span class="amount"><?php echo esc_attr($amount);?></span>
                    <span class="duration"> / <?php echo esc_attr($duration);?></span>
                </div>
            </div>
            <div class="pricing-button"><a href="<?php echo esc_attr($btn_link);?>" class="<?php if($chosencolor=='2'){echo 'pink-button';}else if($chosencolor=='3'){echo 'purple-button';}else{echo 'green-button';} ?>"><?php echo esc_attr($btn_name);?></a></div>
        </div>
    </div>
<?php  return ob_get_clean();
}
//add
//info
add_shortcode('info', 'info_func');
function info_func($atts, $content = null){
    extract(shortcode_atts(array(
        'image' => '',
        'title' => '',
        'desc' => '',
        'chosen' => 'no',
    ), $atts));
    $images = wp_get_attachment_image_src($image,'');
    ob_start();
    ?>
    <div class="row <?php if($chosen=='no'){echo 'rtl-cols';}?>">
        <div class="col-sm-4 col-md-4 info-img-holder">
            <img class="info-img" src="<?php echo esc_url($images[0]);?>" alt="info" />
        </div>
        <div class="col-sm-8 col-md-8 info-text-holder">
            <h3><?php echo esc_attr($title);?></h3>
            <p><?php echo esc_attr($desc);?></p>
        </div>
    </div>
<?php  return ob_get_clean();
}
//add
//more info
add_shortcode('moreinfo', 'moreinfo_func');
function moreinfo_func($atts, $content = null){
    extract(shortcode_atts(array(
        'image' => '',
        'title' => '',
        'desc' => '',
        'btn_name' => '',
        'btn_link' => '',
    ), $atts));
    $images = wp_get_attachment_image_src($image,'');
    ob_start();
    ?>
    <div class="row">
        <div class="col-md-12">
            <div class="row-title"><?php echo esc_attr($title);?></div>
            <div class="row-subtitle"><?php echo esc_attr($desc);?></div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <a href="<?php echo esc_attr($btn_link);?>" class="get-started-button"><?php echo esc_attr($btn_name);?></a>
        </div>
    </div>
<?php  return ob_get_clean();
}
//add
//morefeatures
add_shortcode('morefeatures', 'morefeatures_func');
function morefeatures_func($atts, $content = null){
    extract(shortcode_atts(array(
        'image' => '',
        'icon' => '',
        'title' => '',
        'desc' => '',
    ), $atts));
    $images = wp_get_attachment_image_src($image,'');
    ob_start();
    ?>
    <div class="col-md-4">
        <div class="mfeature-box">
            <div class="mfeature-icon">
                <div class="icon-bg"><img src="<?php echo esc_url($images[0]);?>" /></div>
                <i class="<?php echo esc_attr($icon);?>"></i>
            </div>
            <div class="mfeature-title"><?php echo esc_attr($title);?></div>
            <div class="mfeature-details"><?php echo esc_attr($desc);?></div>
        </div>
    </div>
<?php  return ob_get_clean();
}
//add
//testimonials
add_shortcode('testimonials', 'testimonials_func');
function testimonials_func($atts, $content = null){
    extract(shortcode_atts(array(
        'image' => '',
        'title' => '',
        'desc' => '',
        'name' => '',
        'job' => '',
    ), $atts));
    $images = wp_get_attachment_image_src($image,'');
    ob_start();
    ?>
    <div class="col-sm-6 col-md-4">
        <div class="testimonial-box">
            <div class="testimonial-image"><img src="<?php echo esc_url($images[0]);?>" alt="person" /></div>
            <div class="testimonial-title"><?php echo esc_attr($title);?></div>
            <div class="testimonial-details"><?php echo esc_attr($desc);?></div>
            <div class="testimonial-info"><span class="name"><?php echo esc_attr($name);?></span> - <?php echo esc_attr($job);?></div>
        </div>
    </div>
<?php  return ob_get_clean();
}
//add
//started
add_shortcode('started', 'started_func');
function started_func($atts, $content = null){
    extract(shortcode_atts(array(
        'title' => '',
        'btn_link' => '',
        'btn_name' => '',
    ), $atts));
    ob_start();
    ?>
    <div id="get-started" class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="text"><?php echo esc_attr($title);?></div>
                    <a href="<?php echo esc_attr($btn_link);?>" class="gstart"><?php echo esc_attr($btn_name);?></a>
                </div>
            </div>
        </div>
    </div>
<?php  return ob_get_clean();
}
//add
//text about
add_shortcode('textabout', 'textabout_func');
function textabout_func($atts, $content = null){
    extract(shortcode_atts(array(
        'title' => '',
        'desc' => '',
    ), $atts));
    ob_start();
    ?>
    <div id="top-content" class="container-fluid inner-page">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="page-title"><?php echo esc_attr($title);?></div>
                    <div class="page-subtitle"><?php echo esc_attr($desc);?></div>
                </div>
            </div>
        </div>
    </div>
<?php  return ob_get_clean();
}
//add
//brief
add_shortcode('brief', 'brief_func');
function brief_func($atts, $content = null){
    extract(shortcode_atts(array(
        'title' => '',
    ), $atts));
    ob_start();
    ?>
    <div id="brief" class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <p><?php echo esc_attr($title);?></p>
                </div>
            </div>
        </div>
    </div>
<?php  return ob_get_clean();
}
//message
add_shortcode('message', 'message_func');
function message_func($atts, $content = null){
    extract(shortcode_atts(array(
        'title1' => '',
        'title2' => '',
        'desc1' => '',
        'desc2' => '',
    ), $atts));
    ob_start();
    ?>
    <div id="message" class="container-fluid">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h3><?php echo esc_attr($title1);?></h3>
                    <p><?php echo esc_attr($desc1);?></p>
                </div>
                <div class="col-md-6">
                    <h3><?php echo esc_attr($title2);?></h3>
                    <p><?php echo esc_attr($desc2);?></p>
                </div>
            </div>
        </div>
    </div>
<?php  return ob_get_clean();
}
//story
add_shortcode('story', 'story_func');
function story_func($atts, $content = null){
    extract(shortcode_atts(array(
        'image' => '',
        'title' => '',
        'desc' => '',
    ), $atts));
    $images = wp_get_attachment_image_src($image,'');
    ob_start();
    ?>
    <div id="story" class="container-fluid">
        <div class="row">
            <div class="col-md-6 img-col">
                <div class="image-holder"></div>
            </div>
            <div class="col-md-6 txt-col">
                <h3><?php echo esc_attr($title);?></h3>
                <p><?php echo esc_attr($desc);?></p>
            </div>
        </div>
    </div>
<?php  return ob_get_clean();
}
//add
//services
add_shortcode('services', 'services_func');
function services_func($atts, $content = null){
    extract(shortcode_atts(array(
        'image' => '',
        'icon' => '',
        'title' => '',
    ), $atts));
    $images = wp_get_attachment_image_src($image,'');
    ob_start();
    ?>
    <div class="col-md-4">
        <div class="service-box">
            <div class="service-icon">
                <div class="icon-bg"><img src="<?php echo esc_url($images[0]);?>" /></div>
                <i class="<?php echo esc_attr($icon);?>"></i>
            </div>
            <div class="service-title"><?php echo esc_attr($title);?></div>
        </div>
    </div>
<?php  return ob_get_clean();
}
//add
//texttitle
add_shortcode('texttitle', 'texttitle_func');
function texttitle_func($atts, $content = null){
    extract(shortcode_atts(array(
        'title' => '',
        'desc' => '',
    ), $atts));
    ob_start();
    ?>
    <div id="top-content" class="container-fluid inner-page">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="page-title"><?php echo esc_attr($title);?></div>
                    <div class="page-subtitle"><?php echo esc_attr($desc);?></div>
                </div>
            </div>
        </div>
    </div>
<?php  return ob_get_clean();
}
//add
//host pricing
add_shortcode('hostpricing', 'hostpricing_func');
function hostpricing_func($atts, $content = null){
    extract(shortcode_atts(array(
        'title' => '',
        'currency' => '',
        'amount' => '',
        'duration' => '',
        'detail1' => '',
        'chosen1' => 'no',
        'detail2' => '',
        'chosen2' => 'no',
        'detail3' => '',
        'chosen3' => 'no',
        'detail4' => '',
        'chosen4' => 'no',
        'detail5' => '',
        'chosen5' => 'no',
        'detail6' => '',
        'chosen6' => 'no',
        'detail7' => '',
        'chosen7' => 'no',
        'detail8' => '',
        'chosen8' => 'no',
        'detail9' => '',
        'chosen9' => 'no',
        'detail10' => '',
        'chosen10' => 'no',
        'detail11' => '',
        'chosen11' => 'no',
        'detail12' => '',
        'chosen12' => 'no',
        'btn_name' => '',
        'btn_link' => '',
        'chosen13' => 'no',
        
    ), $atts));
    ob_start();
    ?>
    <div class="col-sm-6 col-md-4">
        <div class="pricing-box blue-after <?php if($chosen13 =='yes'){echo 'best-seller';}?>">
            <div class="pricing-icon"></div>
            <div class="pricing-title"><?php echo esc_attr($title);?></div>
            <div class="pricing-amount">
                <div class="price">
                    <span class="currency"><?php echo esc_attr($currency);?></span>
                    <span class="amount"><?php echo esc_attr($amount);?></span>
                    <span class="duration">/<?php echo esc_attr($duration);?></span>
                </div>
            </div>
            <div class="pricing-details">
                <ul>
                    <li class="<?php if($chosen1 =='no'){echo 'not-supported';}?>"><?php echo esc_attr($detail1);?></li>
                    <li class="<?php if($chosen2 =='no'){echo 'not-supported';}?>"><?php echo esc_attr($detail2);?></li>
                    <li class="<?php if($chosen3 =='no'){echo 'not-supported';}?>"><?php echo esc_attr($detail3);?></li>
                    <li class="<?php if($chosen4 =='no'){echo 'not-supported';}?>"><?php echo esc_attr($detail4);?></li>
                    <li class="<?php if($chosen5 =='no'){echo 'not-supported';}?>"><?php echo esc_attr($detail5);?></li>
                    <li class="<?php if($chosen6 =='no'){echo 'not-supported';}?>"><?php echo esc_attr($detail6);?></li>
                    <li class="<?php if($chosen7 =='no'){echo 'not-supported';}?>"><?php echo esc_attr($detail7);?></li>
                    <li class="<?php if($chosen8 =='no'){echo 'not-supported';}?>"><?php echo esc_attr($detail8);?></li>
                    <li class="<?php if($chosen9 =='no'){echo 'not-supported';}?>"><?php echo esc_attr($detail9);?></li>
                    <li class="<?php if($chosen10 =='no'){echo 'not-supported';}?>"><?php echo esc_attr($detail10);?></li>
                    <li class="<?php if($chosen11 =='no'){echo 'not-supported';}?>"><?php echo esc_attr($detail11);?></li>
                    <li class="<?php if($chosen12 =='no'){echo 'not-supported';}?>"><?php echo esc_attr($detail12);?></li>
                </ul>
            </div>
            <div class="pricing-button"><a href="<?php echo esc_attr($btn_link);?>" class="blue-button"><?php echo esc_attr($btn_name);?></a></div>
        </div>
    </div>
<?php  return ob_get_clean();
}
//add
//leftplatforms
add_shortcode('leftplatforms', 'leftplatforms_func');
function leftplatforms_func($atts, $content = null){
    extract(shortcode_atts(array(
        'title1' => '',
        'id1' => '',
        'image1' => '',
        'title2' => '',
        'id2' => '',
        'image2' => '',
        'title3' => '',
        'id3' => '',
        'image3' => '',
    ), $atts));
    $images1 = wp_get_attachment_image_src($image1,'');
    $images2 = wp_get_attachment_image_src($image2,'');
    $images3 = wp_get_attachment_image_src($image3,'');
    ob_start();
    ?>
    <div class="col-md-3">
        <ul class="platforms-list left-list">
            <li>
                <div class="platform-link active" data-pid="<?php echo esc_attr($id1);?>">
                    <div class="tool-tip"><?php echo esc_attr($title1);?></div>
                    <img src="<?php echo esc_url($images1[0]);?>" alt="unbounce" />
                </div>
            </li>
            <li>
                <div class="platform-link" data-pid="<?php echo esc_attr($id2);?>">
                    <div class="tool-tip"><?php echo esc_attr($title2);?></div>
                    <img src="<?php echo esc_url($images2[0]);?>" alt="wordpress" />
                </div>
            </li>
            <li>
                <div class="platform-link" data-pid="<?php echo esc_attr($id3);?>">
                    <div class="tool-tip"><?php echo esc_attr($title3);?></div>
                    <img src="<?php echo esc_url($images3[0]);?>" alt="drupal" />
                </div>
            </li>
        </ul>
    </div>
<?php  return ob_get_clean();
}
//add
//centerplatforms
add_shortcode('centerplatforms', 'centerplatforms_func');
function centerplatforms_func($atts, $content = null){
    extract(shortcode_atts(array(
        'id1' => '',
        'image1' => '',
        'id2' => '',
        'image2' => '',
        'id3' => '',
        'image3' => '',
        'id4' => '',
        'image4' => '',
        'id5' => '',
        'image5' => '',
        'id6' => '',
        'image6' => '',
    ), $atts));
    $images1 = wp_get_attachment_image_src($image1,'');
    $images2 = wp_get_attachment_image_src($image2,'');
    $images3 = wp_get_attachment_image_src($image3,'');
    $images4 = wp_get_attachment_image_src($image4,'');
    $images5 = wp_get_attachment_image_src($image5,'');
    $images6 = wp_get_attachment_image_src($image6,'');
    ob_start();
    ?>
    <div class="col-md-6">
        <div id="browser">
            <div class="webpage">
                <img id="<?php echo esc_attr($id1);?>" class="active" src="<?php echo esc_url($images1[0]);?>"/>
                <img id="<?php echo esc_attr($id2);?>" src="<?php echo esc_url($images2[0]);?>"/>
                <img id="<?php echo esc_attr($id3);?>" src="<?php echo esc_url($images3[0]);?>"/>
                <img id="<?php echo esc_attr($id4);?>" src="<?php echo esc_url($images4[0]);?>"/>
                <img id="<?php echo esc_attr($id5);?>" src="<?php echo esc_url($images5[0]);?>"/>
                <img id="<?php echo esc_attr($id6);?>" src="<?php echo esc_url($images6[0]);?>"/>
            </div>
        </div>
    </div>
<?php  return ob_get_clean();
}
//add
//rightplatforms
add_shortcode('rightplatforms', 'rightplatforms_func');
function rightplatforms_func($atts, $content = null){
    extract(shortcode_atts(array(
        'title1' => '',
        'id1' => '',
        'image1' => '',
        'title2' => '',
        'id2' => '',
        'image2' => '',
        'title3' => '',
        'id3' => '',
        'image3' => '',
    ), $atts));
    $images1 = wp_get_attachment_image_src($image1,'');
    $images2 = wp_get_attachment_image_src($image2,'');
    $images3 = wp_get_attachment_image_src($image3,'');
    ob_start();
    ?>
    <div class="col-md-3">
        <ul class="platforms-list right-list">
            <li>
                <div class="platform-link" data-pid="<?php echo esc_attr($id1);?>">
                    <div class="tool-tip"><?php echo esc_attr($title1);?></div>
                    <img src="<?php echo esc_url($images1[0]);?>" alt="unbounce" />
                </div>
            </li>
            <li>
                <div class="platform-link" data-pid="<?php echo esc_attr($id2);?>">
                    <div class="tool-tip"><?php echo esc_attr($title2);?></div>
                    <img src="<?php echo esc_url($images2[0]);?>" alt="wordpress" />
                </div>
            </li>
            <li>
                <div class="platform-link" data-pid="<?php echo esc_attr($id3);?>">
                    <div class="tool-tip"><?php echo esc_attr($title3);?></div>
                    <img src="<?php echo esc_url($images3[0]);?>" alt="drupal" />
                </div>
            </li>
        </ul>
    </div>
<?php  return ob_get_clean();
}
//add
//texttitlelink
add_shortcode('texttitlelink', 'texttitlelink_func');
function texttitlelink_func($atts, $content = null){
    extract(shortcode_atts(array(
        'title' => '',
        'desc1' => '',
        'link' => '',
        'value' => '',
        'desc2' => '',
    ), $atts));
    ob_start();
    ?>
    <div id="top-content" class="container-fluid inner-page">
        <div class="container">
            <div class="row">
                <div class="col-md-12 text-center">
                    <div class="page-title"><?php echo esc_attr($title);?></div>
                    <div class="page-subtitle"><?php echo esc_attr($desc1);?> <a href="<?php echo esc_attr($link);?>"><?php echo esc_attr($value);?></a> <?php echo esc_attr($desc2);?></div>
                </div>
            </div>
        </div>
    </div>
<?php  return ob_get_clean();
}
//add
//col7info1
add_shortcode('col7info1', 'col7info1_func');
function col7info1_func($atts, $content = null){
    extract(shortcode_atts(array(
        'title' => '',
        'image' => '',
    ), $atts));
    $images = wp_get_attachment_image_src($image,'');
    ob_start();
    ?>
    <div class="col-title-blue"><?php echo esc_attr($title);?></div>
    <div class="help-image-holder"><img class="help" src="<?php echo esc_url($images[0]);?>" alt="help" /></div>
<?php  return ob_get_clean();
}
//add
//col5title
add_shortcode('col5title', 'col5title_func');
function col5title_func($atts, $content = null){
    extract(shortcode_atts(array(
        'title' => '',
    ), $atts));
    ob_start();
    ?>
    <div class="col-title"><?php echo esc_attr($title);?></div>
<?php  return ob_get_clean();
}
//add
//col5info1
add_shortcode('col5info1', 'col5info1_func');
function col5info1_func($atts, $content = null){
    extract(shortcode_atts(array(
        'icon' => '',
        'title' => '',
        'desc' => '',
        'chosencolor' => '1',
        'link' => '',
    ), $atts));
    ob_start();
    ?>
    <div class="support-box <?php if($chosencolor=='2'){echo 'yellow';}else if($chosencolor=='3'){echo 'purple';}else{echo 'green';} ?>-support-box">
        <div class="support-box-title"><i class="<?php echo esc_attr($icon);?>" aria-hidden="true"></i><a href="<?php echo esc_attr($link);?>"><?php echo esc_attr($title);?></a></div>
        <div class="support-box-details">
            <?php echo esc_attr($desc);?>
        </div>
    </div>
<?php  return ob_get_clean();
}
//add
//col7info2
add_shortcode('col7info2', 'col7info2_func');
function col7info2_func($atts, $content = null){
    extract(shortcode_atts(array(
        'title' => '',
        'desc' => '',
        'chosen' => 'no',
    ), $atts));
    ob_start();
    ?>
    <div class="faq-question-holder <?php if($chosen=='yes'){echo 'active';}?>">
        <div class="faq-question">
            <?php echo esc_attr($title);?>
        </div>
        <div class="faq-answer">
            <?php echo esc_attr($desc);?>
        </div>
    </div>
<?php  return ob_get_clean();
}
//add
//col5info2
add_shortcode('col5info2', 'col5info2_func');
function col5info2_func($atts, $content = null){
    extract(shortcode_atts(array(
        'title' => '',
        'desc' => '',
        'link' => '',
    ), $atts));
    ob_start();
    ?>
    <a href="<?php echo esc_attr($link);?>"><h4><?php echo esc_attr($title);?></h4></a>
                <p><?php echo esc_attr($desc);?></p>
<?php  return ob_get_clean();
}
//add
//col5info3
add_shortcode('col5info3', 'col5info3_func');
function col5info3_func($atts, $content = null){
    extract(shortcode_atts(array(
        'title' => '',
        'desc' => '',
    ), $atts));
    ob_start();
    ?>
    <h4><?php echo esc_attr($title);?></h4>
    <p><?php echo esc_attr($desc);?></p>
<?php  return ob_get_clean();
}
//add
//col5link
add_shortcode('col5link', 'col5link_func');
function col5link_func($atts, $content = null){
    extract(shortcode_atts(array(
        'title' => '',
        'desc' => '',
        'icon' => '',
        'link' => '',
    ), $atts));
    ob_start();
    ?>
    <a class="lg-link" href="<?php echo esc_attr($link);?>"><?php echo esc_attr($title);?> <i class="<?php echo esc_attr($icon);?>" aria-hidden="true"></i></a>
                <p><?php echo esc_attr($desc);?></p>
<?php  return ob_get_clean();
}