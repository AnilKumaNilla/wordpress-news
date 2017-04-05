<?php
function fasterthemes_options_init(){
 register_setting( 'theme_options', 'premiumphotography_theme_options','theme_options_validate');
} 
add_action( 'admin_init', 'fasterthemes_options_init' );
function theme_options_validate($input)
{
	$input['logo'] = esc_url_raw( $input['logo'] );
	$input['favicon'] = esc_url_raw( $input['favicon'] );
	$input['footertext'] = wp_filter_nohtml_kses( $input['footertext'] );

	$input['fburl'] = esc_url_raw( $input['fburl'] );
	$input['twitter'] = esc_url_raw( $input['twitter'] );
	$input['google_plus'] = esc_url_raw( $input['google_plus'] );
	$input['linkedin'] = esc_url_raw( $input['linkedin'] );
    return $input;
}
function fasterthemes_framework_load_scripts(){
	wp_enqueue_media();
	wp_enqueue_style( 'fasterthemes_framework', get_template_directory_uri(). '/theme-options/css/fasterthemes_framework.css' ,false, '1.0.0');
	wp_enqueue_style( 'fasterthemes_framework' );	
	// Enqueue custom option panel JS
	wp_enqueue_script( 'options-custom', get_template_directory_uri(). '/theme-options/js/fasterthemes-custom.js', array( 'jquery' ) );
	wp_enqueue_script( 'media-uploader', get_template_directory_uri(). '/theme-options/js/media-uploader.js', array( 'jquery') );		
	wp_enqueue_script('media-uploader');
}
add_action( 'admin_enqueue_scripts', 'fasterthemes_framework_load_scripts' );
function fasterthemes_framework_menu_settings() {
	$premiumphotography_menu = array(
				'page_title' => __( 'FasterThemes Options', 'premium-photography'),
				'menu_title' => __('Theme Options', 'premium-photography'),
				'capability' => 'edit_theme_options',
				'menu_slug' => 'fasterthemes_framework',
				'callback' => 'fastertheme_framework_page'
				);
	return apply_filters( 'fasterthemes_framework_menu', $premiumphotography_menu );
}
add_action( 'admin_menu', 'theme_options_add_page' ); 
function theme_options_add_page() {
	$premiumphotography_menu = fasterthemes_framework_menu_settings();
   	add_theme_page($premiumphotography_menu['page_title'],$premiumphotography_menu['menu_title'],$premiumphotography_menu['capability'],$premiumphotography_menu['menu_slug'],$premiumphotography_menu['callback']);
} 
function fastertheme_framework_page(){ 
		global $select_options; 
		if ( ! isset( $_REQUEST['settings-updated'] ) ) 
		$_REQUEST['settings-updated'] = false;		
		$premiumphotography_image=get_template_directory_uri().'/theme-options/images/logo.png'; ?>
<div class="fasterthemes-themes">
	<form method="post" action="options.php" id="form-option" class="theme_option_ft">
  <div class="fasterthemes-header">
    <div class="logo">
      <?php $premiumphotography_image=get_template_directory_uri().'/theme-options/images/logo.png';
		echo "<a href='http://fasterthemes.com' target='_blank'><img src='".$premiumphotography_image."' alt='FasterThemes' /></a>"; ?>
    </div>
    <div class="header-right">
      <?php echo "<h1>". __( 'Theme Options', 'premium-photography' ) . "</h1>";
			echo "<div class='btn-save'><input type='submit' class='button-primary' value='Save Options' /></div>"; ?>
    </div>
  </div>
  <div class="fasterthemes-details">
    <div class="fasterthemes-options">
      <div class="right-box">
        <div class="nav-tab-wrapper">
          <ul>
            <li><a id="options-group-1-tab" class="nav-tab basicsettings-tab" title="Basic Settings" href="#options-group-1"><?php _e('Basic Settings','premium-photography'); ?></a></li>
            <li><a id="options-group-2-tab" class="nav-tab socialsettings-tab" title="Social Settings" href="#options-group-2"><?php _e('Social Settings','premium-photography'); ?></a></li>
            <li><a id="options-group-3-tab" class="nav-tab socialsettings-tab" title="Social Settings" href="#options-group-3"><?php _e('PRO Theme Features','premium-photography'); ?></a></li>
  		  </ul>
        </div>
      </div>
      <div class="right-box-bg"></div>
      <div class="postbox left-box"> 
        <!-- F I N A L - - T H E M E - - O P T I O N -->
          <?php settings_fields( 'theme_options' );
          $premiumphotography_options = get_option( 'premiumphotography_theme_options' ); ?>
            <!-- First group -->
            <div id="options-group-1" class="group faster-inner-tabs">
				<div class="section theme-tabs theme-logo">
            <a class="heading faster-inner-tab active" href="javascript:void(0)"><?php _e('Site Logo','premium-photography'); ?></a>
            <div class="faster-inner-tab-group active">
            	<div class="explain"><?php _e('Size of logo should be exactly 117x43px for best results. Leave blank to use text heading.','premium-photography'); ?></div>
              	<div class="ft-control">
                <input id="logo-img" class="upload" type="text" name="premiumphotography_theme_options[logo]" value="<?php if(!empty($premiumphotography_options['logo'])) { echo esc_url($premiumphotography_options['logo']); } ?>" placeholder="No file chosen" />
                <input id="1upload_image_button" class="upload-button button" type="button" value="Upload" />
                <div class="screenshot" id="logo-image">
                  <?php if(!empty($premiumphotography_options['logo'])) { echo "<img src='".esc_url($premiumphotography_options['logo'])."' /><a class='remove-image'>Remove</a>"; } ?>
                </div>
              </div>
            </div>
          </div>
            	<div class="section theme-tabs theme-favicon">
              <a class="heading faster-inner-tab" href="javascript:void(0)"><?php _e('Favicon','premium-photography'); ?></a>
              <div class="faster-inner-tab-group">
              	<div class="explain"><?php _e('Size of favicon should be exactly 32x32px for best results.','premium-photography'); ?></div>
                <div class="ft-control">
                  <input id="favicon-img" class="upload" type="text" name="premiumphotography_theme_options[favicon]" 
                            value="<?php if(!empty($premiumphotography_options['favicon'])) { echo esc_url($premiumphotography_options['favicon']); } ?>" placeholder="No file chosen" />
                  <input id="upload_image_button1" class="upload-button button" type="button" value="Upload" />
                  <div class="screenshot" id="favicon-image">
                    <?php  if(!empty($premiumphotography_options['favicon'])) { echo "<img src='".esc_url($premiumphotography_options['favicon'])."' /><a class='remove-image'>Remove</a>"; } ?>
                  </div>
                </div>
              </div>
            </div>
            	<div id="section-footertext2" class="section theme-tabs">
            	<a class="heading faster-inner-tab" href="javascript:void(0)"><?php _e('Copyright Text','premium-photography'); ?></a>
              <div class="faster-inner-tab-group">
              	<div class="ft-control">
              		<div class="explain"><?php _e('Some text regarding copyright of your site, you would like to display in the footer.','premium-photography'); ?></div>                
                  	<input type="text" id="footertext2" class="of-input" name="premiumphotography_theme_options[footertext]" size="32"  value="<?php if(!empty($premiumphotography_options['footertext'])) { echo esc_attr($premiumphotography_options['footertext']); } ?>">
                </div>                
              </div>
            </div>  
          	</div>          
          <!-- Second group -->
          <div id="options-group-2" class="group faster-inner-tabs">   
                <div id="section-facebook" class="section theme-tabs">
            	<a class="heading faster-inner-tab active" href="javascript:void(0)"><?php _e('Facebook','premium-photography'); ?></a>
              <div class="faster-inner-tab-group active">
              	<div class="ft-control">
              		<div class="explain">Facebook profile or page URL i.e. http://facebook.com/username/ </div>
                  	<input id="facebook" class="of-input" name="premiumphotography_theme_options[fburl]" size="30" type="text" value="<?php if(!empty($premiumphotography_options['fburl'])) { echo esc_url($premiumphotography_options['fburl']); } ?>" />
                </div>                
              </div>
            </div>
                <div id="section-twitter" class="section theme-tabs">
                    <a class="heading faster-inner-tab" href="javascript:void(0)"><?php _e('Twitter','premium-photography'); ?></a>
                  <div class="faster-inner-tab-group">
                    <div class="ft-control">
                        <div class="explain">Twitter profile or page URL i.e. http://www.twitter.com/username/</div>                
                        <input id="twitter" class="of-input" name="premiumphotography_theme_options[twitter]" type="text" size="30" value="<?php if(!empty($premiumphotography_options['twitter'])) { echo esc_url($premiumphotography_options['twitter']); } ?>" />
                    </div>                
                  </div>
                </div>
                <div id="section-googleplus" class="section theme-tabs">
                    <a class="heading faster-inner-tab" href="javascript:void(0)"><?php _e('Google Plus','premium-photography'); ?></a>
                  <div class="faster-inner-tab-group">
                    <div class="ft-control">
                        <div class="explain">Google Plus profile or page URL i.e. https://plus.google.com/username/</div>                
                        <input id="googleplus" class="of-input" name="premiumphotography_theme_options[google_plus]" type="text" size="30" value="<?php if(!empty($premiumphotography_options['google_plus'])) { echo esc_url($premiumphotography_options['google_plus']); } ?>" />
                    </div>                
                  </div>
                </div>
                <div id="section-pintrest" class="section theme-tabs">
                    <a class="heading faster-inner-tab" href="javascript:void(0)"><?php _e('Linkedin','premium-photography'); ?></a>
                  <div class="faster-inner-tab-group">
                    <div class="ft-control">
                        <div class="explain">Linkedin profile or page URL i.e. https://linkedin.com/username/</div>                
                        <input id="pintrest" class="of-input" name="premiumphotography_theme_options[linkedin]" type="text" size="30" value="<?php if(!empty($premiumphotography_options['linkedin'])) { echo esc_url($premiumphotography_options['linkedin']); } ?>" />
                    </div>                
                  </div>
                </div>           
          </div> 
          <!--  Third group  -->
          <div class="group faster-inner-tabs fasterthemes-pro-image" id="options-group-3">
          	<div class="fasterthemes-pro-header">
              <img class="fasterthemes-pro-logo" src="<?php echo get_template_directory_uri(); ?>/theme-options/images/theme-logo.png">
              <a target="_blank" href="http://fasterthemes.com/wordpress-themes/premiumphotography"><img class="fasterthemes-pro-buynow" src="<?php echo get_template_directory_uri(); ?>/theme-options/images/buy-now.png"></a>
              </div>
          	<img src="<?php echo get_template_directory_uri(); ?>/theme-options/images/pro-featured.png">
          </div>    
        <!--======================== F I N A L - - T H E M E - - O P T I O N S ===================--> 
      </div>
     </div>
	</div>
	<div class="fasterthemes-footer">
      	<ul>
        	<li>&copy; <a href="http://fasterthemes.com" target="_blank">fasterthemes.com</a></li>
            <li><a href="https://www.facebook.com/faster.themes" target="_blank"> <img src="<?php echo get_template_directory_uri(); ?>/theme-options/images/fb.png"/> </a></li>
            <li><a href="https://twitter.com/FasterThemes" target="_blank"> <img src="<?php echo get_template_directory_uri(); ?>/theme-options/images/tw.png"/> </a></li>
            <li class="btn-save"><input type="submit" class="button-primary" value="Save Options" /></li>
        </ul>
    </div>
    </form>    
</div>
<div class="save-options"><h2><?php _e('Options saved successfully.','premium-photography'); ?></h2></div>
<?php } ?>