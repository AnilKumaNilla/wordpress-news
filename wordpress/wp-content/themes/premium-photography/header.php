<?php
/*
	The Header for our theme
*/
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php $premiumphotography_options = get_option( 'premiumphotography_theme_options' ); 
if(!empty($premiumphotography_options['favicon'])) { ?>
<link rel="shortcut icon" href="<?php echo esc_url($premiumphotography_options['favicon']);?>">
<?php } ?>
<!--[if lt IE 9]>
	<script src="<?php echo get_template_directory_uri(); ?>/js/respond.min.js"></script>
<![endif]-->
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<!-- header -->
<header> 
  <div class="container container-full-premiumphotography">
    <div class="col-md-12 ">
    <?php 
	if(get_custom_header()->url){?>
      <img class="premiumphotography_custom_header" src="<?php header_image(); ?>" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="" />
    <?php }?>
      <div class="col-md-3 no-padding menu-left logo-text"> 
      	 <?php if(empty($premiumphotography_options['logo'])) { ?>
            <a href="<?php echo site_url(); ?>" class="pull-left premiumphotography-site-name logo-center">
                <?php echo '<span>'.get_bloginfo('name').'</span>'; ?>
            </a> 
		 <?php } else { ?>
                    <a href="<?php echo site_url(); ?>" class="pull-left premiumphotography-site-name ">
                        <img src="<?php echo esc_url($premiumphotography_options['logo']); ?>" alt="" class="img-responsive logo-center" />
                    </a> 
         <?php } ?>
      </div>
      <div class="navbar-header">
        <button type="button" class="navbar-toggle navbar-toggle-top sort-menu-icon" data-toggle="collapse" data-target=".navbar-collapse"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar icon-color"></span> <span class="icon-bar icon-color"></span> <span class="icon-bar icon-color"></span> </button>
      </div>  
         <?php $premiumphotography_args = array(
					'theme_location'  => 'primary',
					'menu'            => '',
					'container'       => 'div',
					'container_class' => '',
					'container_id'    => '',
					'menu_class'      => 'navbar-collapse col-md-7  premiumphotography-main-menu collapse pull-left no-padding',
					'menu_id'         => '',
					'echo'            => true,
					'before'          => '',
					'after'           => '',
					'link_before'     => '',
					'link_after'      => '',    
					'items_wrap'      => '<ul id="%1$s" class="collapse navbar-collapse navbar-left premiumphotography-menu">%3$s</ul>',
					'depth'           => 0,
					'walker'            => ''
				   );   
				   wp_nav_menu( $premiumphotography_args );	?>
      <!--/.navbar-collapse --> 
     <div class="col-md-2 pull-right premiumphotography-social">
        <div class="">
          <ul class="list-unstyled nav-pills">
            <?php if(!empty($premiumphotography_options['fburl'])){ ?>
            <li><a href="<?php echo esc_url($premiumphotography_options['fburl']); ?>"><i class="fa fa-facebook-square menu-social"></i></a></li>
            <?php }
            if(!empty($premiumphotography_options['twitter'])){ ?>
            <li><a href="<?php echo esc_url($premiumphotography_options['twitter']); ?>"><i class="fa fa-twitter-square menu-social"></i></a></li>
            <?php }
            if(!empty($premiumphotography_options['google_plus'])){ ?>
            <li><a href="<?php echo esc_url($premiumphotography_options['google_plus']); ?>"><i class="fa fa-google-plus-square menu-social"></i></a></li>
            <?php }
            if(!empty($premiumphotography_options['linkedin'])){ ?>
            <li><a href="<?php echo esc_url($premiumphotography_options['linkedin']); ?>"><i class="fa fa-linkedin-square menu-social"></i></a></li>
            <?php } ?>
          </ul>
        </div>
      </div>
    </div>
    <!--</div>--> 
  </div>
</header>
<?php ?>
<!-- header End -->