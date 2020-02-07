<?php
$url = 'https://plugins.appchar.com/?action=download&slug=appchar-woocommerce';

$appchar_slug   = 'appchar-woocommerce/appchar-woocommerce.php';
$appchar_plugin = str_replace( 'persian-woocommerce', $appchar_slug, dirname( PW()->file_dir ) );
$appchar_url    = site_url( 'appchar/get_options_v2' );

$step_1 = file_exists( $appchar_plugin );
$step_2 = in_array( $appchar_slug, apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) );

$response = wp_remote_get( $appchar_url, array( 'redirection' => 0 ) );

$step_3 = $response['response']['code'] == 200;

$appropriate_structure = ! empty( get_option( 'permalink_structure' ) );

if ( ! $step_3 && $appropriate_structure ) {

	flush_rewrite_rules();

	$response = wp_remote_get( $appchar_url, array( 'redirection' => 0 ) );

	$step_3 = $response['response']['code'] == 200;
}

$can_submit = $step_1 && $step_2 && $step_3;

?>
<div class="wrap about-wrap">
    <h1>به دنیای ووکامرس فارسی خوش آمدید!</h1>
    <div class="about-text">همین الان اپلیکیشن فروشگاه خود را ایجاد کنید و به دنیای موبایل وارد شوید.
    </div>

    <div class="wp-badge"
         style="background-color:#d8bfd8 !important;background-image:url('<?php echo PW()->plugin_url( 'assets/images/about.png' ); ?>') !important;background-position: center center;background-size: 167px auto !important;"></div>

    <h2 class="nav-tab-wrapper">
        <a class="nav-tab nav-tab-active" href="https://woocommerce.ir" target="_blank">اپلیکیشن ووکامرس</a>
        <a class="nav-tab" href="https://woocommerce.ir/product-category/plugins/" target="_blank">افزونه ها</a>
        <a href="https://woocommerce.ir/product-category/themes/" class="nav-tab" target="_blank">پوسته ها</a>
        <a href="https://woocommerce.ir/market/" class="nav-tab" target="_blank">فروشگاه</a>
    </h2>

    <div class="changelog">

        <div class="feature-section col three-col">

            <form method="post" id="app-form" enctype="multipart/form-data" style="color: gray">

                <table class="form-table">

                    <tbody>

                    <tr valign="top">
                        <th scope="row" class="titledesc">نصب و فعالسازی افزونه<span style="color:red">*</span></th>
                        <td class="forminp forminp-checkbox">


                            <ol>
                                <li style="color: <?php echo $step_1 ? 'green' : 'red'; ?>;">نصب افزونه اپچار
                                    <p style="color: gray; display: <?php echo $step_1 ? 'none' : 'block' ?>">
                                        جهت استفاده از اپلیکیشن اپچار باید افزونه آن را از <a href="<?php echo $url; ?>"
                                                                                              target="_blank">اینجا</a>
                                        دانلود، نصب و فعالسازی کنید. </p>
                                </li>
                                <li style="color: <?php echo $step_2 ? 'green' : 'red'; ?>;">فعالسازی افزونه اپچار
                                    <p style="color: gray; display: <?php echo $step_2 ? 'none' : 'block' ?>">
                                        برای فعالسازی افزونه اپچار از منو
                                        <a href="<?php echo admin_url( 'plugins.php' ); ?>"
                                           target="_blank">افزونه ها</a> افزونه 'Appchar Woocommerce Mobile App Manager'
                                        را فعال نمایید.
                                    </p>
                                </li>
                                <li style="color: <?php echo $step_3 ? 'green' : 'red'; ?>;">بررسی وب سرویس های اپچار
                                    <p style="color: gray; display: <?php echo $appropriate_structure ? 'none' : 'block' ?>">
                                        جهت رفع خطا این قسمت، لطفا از منو
                                        <a href="<?php echo admin_url( 'options-permalink.php' ); ?>"
                                           target="_blank">تنظیمات
                                            > پیوندهای یکتا</a>، قسمت تنظیمات عمومی
                                        را روی گزینه ای بجز "ساده" قرار دهید.
                                    </p>
                                </li>
                                <li style="color: <?php echo $can_submit ? 'green' : 'red'; ?>;">
                                    ثبت درخواست اپلیکیشن
                                    <p style="color: gray; display: <?php echo $can_submit ? 'none' : 'block' ?>">
                                        برای ثبت درخواست ایجاد اپلیکیشن فروشگاه شما بصورت آنلاین، لطفا مراحل قبل را
                                        تکمیل نمایید.
                                    </p>
                                </li>
                            </ol>

                        </td>
                    </tr>

                    <tr valign="top">
                        <th scope="row" class="titledesc">انتخاب رنگ بندی</th>
                        <td class="forminp forminp-checkbox">
                            <fieldset>
                                <legend class="screen-reader-text"><span>انتخاب رنگ بندی</span></legend>

                                <img id="app-preview" style="width: 50%;"
                                     src="<?php echo PW()->plugin_url(); ?>/assets/images/app/red-2.png"/>

                                <br><br>

                                <select name="colorname" id="colorname"
                                        style="width:50%; min-width:300px;" <?php echo $can_submit ? '' : 'disabled'; ?>>
                                    <option value="red" data-img="red-2.png" selected>قرمز</option>
                                    <option value="pink" data-img="pink-2.png">صورتی</option>
                                    <option value="purple" data-img="purple.png">بنفش</option>
                                    <option value="deep purple" data-img="deep-purple.png">بنفش تیره</option>
                                    <option value="indigo" data-img="indigo.png">نیلی</option>
                                    <option value="blue" data-img="blue.png">آبی</option>
                                    <option value="light blue" data-img="light-blue.png">آبی روشن</option>
                                    <option value="cyan" data-img="cyan.png">سبز آبی</option>
                                    <option value="teal" data-img="teal.png">سبز دودی</option>
                                    <option value="green" data-img="green.png"> سبز</option>
                                    <option value="light green" data-img="light-green.png">سبز روشن</option>
                                    <option value="lime" data-img="lime.png"> مغز پسته ای</option>
                                    <option value="yellow" data-img="yellow.png">زرد</option>
                                    <option value="amber" data-img="amber.png">کهربایی</option>
                                    <option value="orange" data-img="orange.png">نارنجی</option>
                                    <option value="deep orange" data-img="deep-orange.png">نارنجی تیره</option>
                                    <option value="brown" data-img="brown.png"> قهوه ای</option>
                                    <option value="grey" data-img="grey.png"> خاکستری</option>
                                    <option value="blue grey" data-img="blue_grey.png">آبی خاکستری</option>
                                </select>
                        </td>
                    </tr>

                    <tr valign="top">
                        <th scope="row" class="titledesc">آیکون برنامه<span style="color:red">*</span></th>
                        <td class="forminp forminp-checkbox">
                            <fieldset>
                                <legend class="screen-reader-text"><span>آیکون برنامه</span></legend>

                                <input name="icon" style="width:50%;min-width:300px;"
                                       id="icon" type="file" <?php echo $can_submit ? '' : 'disabled'; ?>>
                        </td>
                    </tr>

                    <tr valign="top">
                        <th scope="row" class="titledesc">لوگو برنامه<span style="color:red">*</span></th>
                        <td class="forminp forminp-checkbox">
                            <fieldset>
                                <legend class="screen-reader-text"><span>لوگو برنامه</span></legend>

                                <input name="logo" style="width:50%;min-width:300px;" onchange="readURL(this);"
                                       id="logo" type="file" <?php echo $can_submit ? '' : 'disabled'; ?>>
                        </td>
                    </tr>

                    <tr valign="top">
                        <th scope="row" class="titledesc">شعار</th>
                        <td class="forminp forminp-checkbox">
                            <fieldset>
                                <legend class="screen-reader-text"><span>شعار</span></legend>

                                <input name="slogan" style="width:50%;min-width:300px;" maxlength="35"
                                       onkeyup="changePreview(this)"
                                       id="slogan" type="text"
                                       value="<?php bloginfo( 'description' ); ?>"
									<?php echo $can_submit ? '' : 'disabled'; ?>>
                        </td>
                    </tr>

                    <tr valign="top">
                        <th scope="row" class="titledesc">شعار فرعی</th>
                        <td class="forminp forminp-checkbox">
                            <fieldset>
                                <legend class="screen-reader-text"><span>شعار فرعی</span></legend>

                                <input name="subslogan" style="width:50%;min-width:300px;" maxlength="50"
                                       onkeyup="changePreview(this)"
                                       id="subslogan" type="text" <?php echo $can_submit ? '' : 'disabled'; ?>>
                        </td>
                    </tr>

                    <tr valign="top">
                        <th scope="row" class="titledesc">پیشنمایش</th>
                        <td class="forminp forminp-checkbox">
                            <div class="device iphone">
                                <div class="sidebt bt1"></div>
                                <div class="sidebt bt2"></div>
                                <div class="pwrbt"></div>
                                <div class="border">
                                    <div class="case">
                                        <div class="screen">
                                            <div class="splashScreen_logo logoPreview">
                                                <img src="<?php echo PW()->plugin_url('/assets/images/Nopic.png'); ?>"
                                                     id="Content_splashScreen_logo" width="100" height="100">
                                            </div>
                                            <div class="splashScreen-slogan">
                                                <span id="slogan-preview">شعار</span>
                                            </div>
                                            <div class="splashScreen-subSlogan">
                                                <span id="subslogan-preview">شعار فرعی</span>
                                            </div>
                                        </div>
                                        <div class="notch"></div>
                                        <div class="camera"></div>
                                        <div class="camera-highlight"></div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>

                    <tr valign="top" style="display: none;">
                        <th scope="row" class="titledesc">ایمیل</th>
                        <td class="forminp forminp-checkbox">
                            <fieldset>
                                <legend class="screen-reader-text"><span>ایمیل</span></legend>

                                <input name="email" style="width:50%;min-width:300px;"
                                       id="email" type="text" value="<?php bloginfo( 'admin_email' ); ?>"
									<?php echo $can_submit ? '' : 'disabled'; ?>>
                        </td>
                    </tr>

                    <tr valign="top">
                        <th scope="row" class="titledesc">تلفن تماس<span style="color:red">*</span></th>
                        <td class="forminp forminp-checkbox">
                            <fieldset>
                                <legend class="screen-reader-text"><span>تلفن تماس</span></legend>

                                <input name="phone" style="width:50%;min-width:300px;"
                                       id="phone" type="text"
									<?php echo $can_submit ? '' : 'disabled'; ?>>
                        </td>
                    </tr>

                    <tr valign="top">
                        <th scope="row" class="titledesc">نام و نام خانوادگی<span style="color:red">*</span></th>
                        <td class="forminp forminp-checkbox">
                            <fieldset>
                                <legend class="screen-reader-text"><span>نام و نام خانوادگی</span></legend>

                                <input name="fullname" style="width:50%;min-width:300px;"
                                       id="fullname" type="text"
									<?php echo $can_submit ? '' : 'disabled'; ?>>
                        </td>
                    </tr>

                    <tr valign="top">
                        <th scope="row" class="titledesc">نام اپلیکیشن</th>
                        <td class="forminp forminp-checkbox">
                            <fieldset>
                                <legend class="screen-reader-text"><span>نام اپلیکیشن</span></legend>

                                <input name="appname" style="width:50%;min-width:300px;"
                                       id="appname" type="text" value="<?php bloginfo( 'name' ); ?>"
									<?php echo $can_submit ? '' : 'disabled'; ?>>
                        </td>
                    </tr>

                    </tbody>
                </table>

                <div class="statusMsg" style="background: white;padding: 10px;margin: 10px 0; font-size:18px;"></div>

                <input name="templateid" id="templateid" type="hidden" value="12">
                <input name="discount" id="discount" type="hidden">
                <input name="domain" id="domain" type="hidden" value="">
                <input name="contactus" id="contactus" type="hidden">
                <input name="aboutus" id="aboutus" type="hidden" value="<?php bloginfo( 'description' ); ?>">
                <input name="siteurl" id="siteurl" type="hidden" value="<?php echo site_url(); ?>">

                <input type="submit" name="Submit" class="button-primary"
                       value="ثبت" <?php echo $can_submit ? '' : 'disabled'; ?>>

            </form>

            <script>
				function readURL( input ) {
					if( input.files && input.files[ 0 ] ) {
						var reader = new FileReader();

						reader.onload = function ( e ) {
							jQuery('#Content_splashScreen_logo')
							.attr('src', e.target.result);
						};

						reader.readAsDataURL(input.files[ 0 ]);
					}
				}

				function changePreview( el ) {
					console.log(jQuery(el).val());
					jQuery('#' + jQuery(el).attr('id') + '-preview').html(jQuery(el).val());
				}

				jQuery(document).ready(function ( $ ) {

					var pw_plugin_url = '<?php echo PW()->plugin_url(); ?>';

					$('#colorname').change(function () {
						let url = pw_plugin_url + '/assets/images/app/' + $(this).find(':selected').data('img');
						$('#app-preview').attr('src', url);
					});

					$("#app-form").on('submit', function ( e ) {
						e.preventDefault();
						$.ajax({
							type: 'POST',
							url: 'http://appchar.com/RegisterOrder.ashx',
							data: new FormData(this),
							contentType: false,
							cache: false,
							processData: false,
							beforeSend: function () {
								$('input[type=submit]').attr("disabled", "disabled");
								$('#app-form').css("opacity", ".5");
								$('.statusMsg').html('');
							},
							success: function ( msg ) {
								if( msg.Status == true ) {
									$('#app-form')[ 0 ].reset();
									let message = '<p>اپلیکیشن فروشگاهی شما با موفقیت ثبت شد. <a href="'
										+ msg.RedirectUrl +
										'" target="_blank">جهت دانلود اپلیکیشن اینجا کلیک کنید.</a></p>';

									$('.statusMsg').html('<span style="color:#34A853">' + message + '</span>');
								} else {
									$('.statusMsg').html('<span style="color:#EA4335">' + msg.Message + '</span>');
								}
							},
							error: function ( msg ) {
								$('.statusMsg').html('<span style="color:#EA4335">خطایی در ارتباط با سرور رخ داده است. لطفا دوباره تلاش کنید.</span>');
							},
							complete: function () {
								$('#app-form').css("opacity", "");
								$("input[type=submit]").removeAttr("disabled");
							}
						});
					});

					//file type validation
					$("[type=file]").change(function () {
						var file = this.files[ 0 ];
						var imagefile = file.type;
						var match = [ "image/jpeg", "image/png", "image/jpg" ];
						if( !((imagefile == match[ 0 ]) || (imagefile == match[ 1 ]) || (imagefile == match[ 2 ])) ) {
							alert('لطفا یک فایل تصویر معتبر انتخاب نمایید.');
							$(this).val('');
							return false;
						}
					});
				});
            </script>

            <style>
                @import url(http://awebfont.ir/css?id=1554);

                @font-face {
                    font-family: 'irsans bold';
                    src: url('<?php echo PW()->plugin_url(); ?>/assets/fonts/app/irsans_bold.ttf') format('truetype');
                }

                @font-face {
                    font-family: 'irsans regular';
                    src: url('<?php echo PW()->plugin_url(); ?>/assets/fonts/app/irsans_regular.ttf') format('truetype');
                }

                span#slogan-preview {
                    font-family: 'irsans bold' !important;
                }

                span#subslogan-preview {
                    font-family: 'irsans regular' !important;
                }

                .device {
                    display: inline-block;
                    float: none;
                    position: relative;
                }

                .mobile-website {
                    position: absolute;
                }

                .img {
                    padding: 0;
                    margin: 0;
                    vertical-align: bottom
                }

                .notch {
                    width: 25px;
                    height: 27px;
                    position: absolute;
                    left: 187px;
                    margin-left: -46px;
                    top: 4px;
                    display: block;
                    border-radius: 0 0 16px 16px;
                    background: #2b2b2b;
                    /* border: 4px solid #000; */
                }

                .iphone .screen {
                    width: 290px;
                    height: 580px;
                    margin: 8px 8px 8px;
                    text-align: center;
                }

                .splashScreen-background {

                    display: inline;
                    width: 1000px;
                    height: 1000px;
                    position: absolute;
                    line-height: inherit;

                    text-align: center;
                }

                .splashScreen_logo {
                    max-width: 100px;
                    max-height: 100px;
                    margin: 70% 30% 4% 30%;
                }

                .splashScreen-slogan {
                    direction: rtl;
                    white-space: nowrap;
                    overflow: hidden;
                    text-overflow: ellipsis;
                    max-width: 35ch;
                    color: #212121;
                    font-size: 18px;
                    font-weight: bold;
                    font-family: 'Iranian Sans', tahoma, Arial;
                    text-align: center;
                }

                .splashScreen-subSlogan {
                    direction: rtl;
                    white-space: nowrap;
                    overflow: hidden;
                    text-overflow: ellipsis;
                    max-width: 50ch;
                    color: #212121;
                    font-size: 13px;
                    margin-top: 8px;
                    font-weight: bold;
                    font-family: 'Iranian Sans', tahoma, Arial;
                }

                .screen {
                    border: 2px solid #000;
                    border-radius: 15px;
                    margin: 22px;
                    background: #FFFFFF;
                    clear: both;
                    position: relative;
                    overflow-y: hidden;
                    overflow-x: hidden;
                }

                .camera {
                    position: absolute;
                    left: 153.5px;
                    margin-left: -9px;
                    top: 8px;
                    width: 18px;
                    height: 18px;
                    display: block;
                    border-radius: 8px;
                    background: #383838;
                    /* border: 4px solid #000; */
                }

                .camera-highlight {
                    width: 6px;
                    height: 16px;
                    position: absolute;
                    top: 9px;
                    left: 156px;
                    border-radius: 0 8px 8px 0;
                    background: #444444;
                    /* display: none; */
                }

                .case {
                    background: #2b2b2b;
                    position: relative;
                    border-radius: 25px;
                    box-shadow: 0px 0px 3px 1px #000 inset;
                    border: 2px solid #4a4a4a;
                }

                .border {
                    border: 5px solid #efefef;
                    border-radius: 51px;
                    box-shadow: 2px 2px 12px 2;
                }

                .iphone .pwrbt {
                    position: absolute;
                    top: 166px;
                    right: -1px;
                    background: #4d4d4d;
                    border: 1px solid #3e3e3e;
                    border: 1px solid #3e3e3e;
                    border-radius: 0 3px 3px 0;
                    /* border-top-right-radius: 3px; */
                    width: 3px;
                    height: 59px;
                }

                .iphone .sidebt {
                    position: absolute;
                    width: 3px;
                    height: 42px;
                    background: #4d4d4d;
                    border: 1px solid #3e3e3e;
                    left: -1px;
                    border-top-left-radius: 3px;
                    border-bottom-left-radius: 3px;
                }

                .bt2 {
                    top: 200px;
                }

                .bt1 {
                    top: 141px;
                    height: 33px;
                }
            </style>

        </div>
    </div>

</div>
