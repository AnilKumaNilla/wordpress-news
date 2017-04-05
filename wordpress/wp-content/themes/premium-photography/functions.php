<?php
/* premiumphotography theme functions */
if ( ! function_exists( 'premiumphotography_setup' ) ) :
function premiumphotography_setup() {
	/**
	 * Set up the content width value based on the theme's design.
	 */
	 global $content_width;
	if ( ! isset( $content_width ) ) {
		$content_width = 700;
	}
	/*
	 * Make premiumphotography theme available for translation.
	 *
	 */
	load_theme_textdomain( 'premium-photography',get_template_directory() . '/languages' );
	// This theme styles the visual editor to resemble the theme style.
	add_editor_style( array( 'css/editor-style.css', premiumphotography_font_url() ) );
	// Add RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );
	// Enable support for Post Thumbnails, and declare two sizes.
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-header' );
	set_post_thumbnail_size();
	add_theme_support( "title-tag" );
	add_image_size( 'premiumphotography-full-width', 1038, 576, true );
	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus( array(
		'primary'   => __( 'Main Menu', 'premium-photography' ),		
	) );
	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array('search-form', 'comment-form', 'comment-list') );
	/*
	 * Enable support for Post Formats.
	 */
	// This theme allows users to set a custom background.
	add_theme_support( 'custom-background', apply_filters( 'premium-photography_custom_background_args', array(
		'default-color' => 'f5f5f5',
	) ) );
	// Add support for featured content.
	add_theme_support( 'featured-content', array(
		'featured_content_filter' => 'premium-photography_get_featured_posts',
		'max_posts' => 6,
	) );
	// This theme uses its own gallery styles.
	add_filter( 'use_default_gallery_style', '__return_false' );
}
endif; // premiumphotography_setup
add_action( 'after_setup_theme', 'premiumphotography_setup' );

// Theme option
require_once('theme-options/fasterthemes.php');

//Custom widget
require_once('inc/photo-widgets.php');

//custom header
require_once('inc/custom-header.php');

/*** TGM ***/
require_once('inc/tgm-plugins.php');
/**
 * Register Lato Google font for redpro.
 *
 */
function premiumphotography_font_url() {
	$premiumphotography_font_url = '';
	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Lato, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Lato font: on or off', 'premium-photography' ) ) {
		$premiumphotography_font_url = add_query_arg( 'family', urlencode( 'Lato:300,400,700,900,300italic,400italic,700italic' ), "//fonts.googleapis.com/css" );
	}
	return $premiumphotography_font_url;
}
/**
 * Thumbnail list.
 */
function premiumphotography_thumbnail_image($content) {

    if( has_post_thumbnail() )
         return the_post_thumbnail( 'thumbnail' ); 
}
/**
 * Enqueues scripts and styles for front-end.
 */
function premiumphotography_scripts_styles() {
	wp_enqueue_style('bootstrap', get_template_directory_uri() . '/css/bootstrap.css');
	wp_enqueue_style('style', get_stylesheet_uri());
	wp_enqueue_style('font-awesome', get_template_directory_uri() . '/css/font-awesome.css');
	
	wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/js/bootstrap.js', array('jquery'), '3.0.1');
	wp_enqueue_script( 'custom', get_template_directory_uri() . '/js/custom.js', array('jquery'), '1.0.0');
	
	if ( is_singular() ) wp_enqueue_script( 'comment-reply' );
}
add_action( 'wp_enqueue_scripts', 'premiumphotography_scripts_styles' );

/**
 * Add default menu style if menu is not set from the backend.
 */
function premiumphotography_add_menuid ($page_markup) {
	preg_match('/^<div class=\"([a-z0-9-_]+)\">/i', $page_markup, $premiumphotography_matches);
	$premiumphotography_toreplace = array('<div class="navbar-collapse collapse top-gutter">', '</div>');
	$premiumphotography_replace = array('<div class="navbar-collapse collapse top-gutter ">', '</div>');
	$premiumphotography_new_markup = str_replace($premiumphotography_toreplace,$premiumphotography_replace, $page_markup);
	$premiumphotography_new_markup= preg_replace('/<ul/', '<ul class="navbar-right premiumphotography-menu"', $premiumphotography_new_markup);   
	return $premiumphotography_new_markup; 
	
}
add_filter('wp_page_menu', 'premiumphotography_add_menuid');

/**
 * Add Theme Title.
 */
function premiumphotography_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() ) {
		return $title;
	}
	// Add the site name.
	$title .= get_bloginfo( 'name', 'display' );

	// Add the site description for the home/front page.
	$premiumphotography_site_description = get_bloginfo( 'description', 'display' );
	if ( $premiumphotography_site_description && ( is_home() || is_front_page() ) ) {
		$title = "$title $sep $premiumphotography_site_description";
	}
	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 ) {
		$title = "$title $sep " . sprintf( __( 'Page %s', 'premium-photography' ), max( $paged, $page ) );
	}
	return $title;
}
add_filter( 'wp_title', 'premiumphotography_wp_title', 10, 2 );
if ( ! function_exists( 'premiumphotography_comment' ) ) :
/**
 * Template for comments and pingbacks.
 *
 * To override this walker in a child theme without modifying the comments template
 * simply create your own premiumphotography_comment(), and that function will be used instead.
 *
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 */
function premiumphotography_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
		// Display trackbacks differently than normal comments. ?>
<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
  <p>
    <?php _e( 'Pingback:', 'premium-photography' );
    	comment_author_link();
    	edit_comment_link( __( '(Edit)', 'premium-photography' ), '<span class="edit-link">', '</span>' ); ?>
  </p>
</li>
<?php break;
		default :
		// Proceed with normal comments.
		if($comment->comment_approved==1)
		{
		global $post; ?>
<li <?php comment_class('col-md-12 comments-post-blog'); ?> id="li-comment-<?php comment_ID(); ?>">
    <div class="comment-col-1"> <a href="#"><?php echo get_avatar( get_the_author_meta('ID'), '60'); ?></a> </div>
    <div class="comment-col-2"> <span><?php echo get_comment_author_link();?></span>
          <p><?php comment_text(); ?></p>
          <div>
            <a href="#" class="reply pull-right"><?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'premium-photography' ), 'after' => '', 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) )?></a>
          </div>
        </div>
    <!-- .txt-holder --> 
  <!-- #comment-## -->
  <?php
		}
		break;
	endswitch; // end comment_type check
}
endif;
/**
 * Register premiumphotography widget areas.
 *
 */
function premiumphotography_widgets_init() {
	register_sidebar( array(
		'name'          => __( 'Main Sidebar', 'premium-photography' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Additional sidebar that appears on the right.', 'premium-photography' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<div class="sidebar-title"><h1 class="widget-title">',
		'after_title'   => '</h1></div>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Sidebar 2', 'premium-photography' ),
		'id' => 'sidebar-2',
		'description' => __( 'Appears on footer side', 'premium-photography' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h6>',
		'after_title' => '</h6>',
	) );
}
add_action( 'widgets_init', 'premiumphotography_widgets_init' );
/**
 * Add new excerpt to theme
 *
 */
function premiumphotography_excerpt_more( ) {
	return ' ... ';
}
add_filter( 'excerpt_more', 'premiumphotography_excerpt_more' );
if ( ! function_exists( 'premiumphotography_entry_meta' ) ) :
/**
 * Set up post entry meta.
 *
 * Meta information for current post: categories, tags, permalink, author, and date.
 **/
function premiumphotography_entry_meta() {
	$premiumphotography_category_list = get_the_category_list( __( ', ', 'premium-photography' ) );
	$premiumphotography_tag_list = get_the_tag_list( '', __( ', ', 'premium-photography' ) );
	$premiumphotography_date = sprintf( '<time datetime="%3$s">%4$s</time>',
		esc_url( get_permalink() ),
		esc_attr( get_the_time() ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);
	$premiumphotography_author = sprintf( '<span><a href="%1$s" title="%2$s" >%3$s</a></span>',
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'premium-photography' ), get_the_author() ) ),
		get_the_author()
	);
	if ( $premiumphotography_tag_list ) {
		$premiumphotography_utility_text = __( '<p> <span class="glyphicon glyphicon-calendar" ></span>&nbsp; Posted in %1$s  on %3$s </p>
          <p> <samp class="glyphicon glyphicon-user"></samp>&nbsp; by %4$s </p><p><i class="fa fa-tag"></i>&nbsp; %2$s</p>', 'premium-photography' );
	} elseif ( $premiumphotography_category_list ) {
		$premiumphotography_utility_text = __( '<p> <span class="glyphicon glyphicon-calendar" ></span>&nbsp; Posted in %1$s  on %3$s </p>
          <p> <samp class="glyphicon glyphicon-user"></samp>&nbsp; by %4$s </p>', 'premium-photography' );
	} else {
		$premiumphotography_utility_text = __( '<p> <span class="glyphicon glyphicon-calendar" ></span>&nbsp; Posted on %3$s </p>
          <p> <samp class="glyphicon glyphicon-user"></samp>&nbsp; by %4$s </p>', 'premium-photography' );
	}
	printf(
		$premiumphotography_utility_text,
		$premiumphotography_category_list,
		$premiumphotography_tag_list,
		$premiumphotography_date,
		$premiumphotography_author
	);
}
endif;

/**
 * To display titles in website.
 *
 */
function premiumphotography_title() {
	echo '<div class="banner-bg">
			 <div class="container container-premiumphotography">
				<h1 class="banner-text">';
	if(is_home())
		if(get_option('page_for_posts')) {
			echo 'Blog';
		} else {
			echo 'Home';
		}
	elseif(is_category()){
		$premiumphotography_category = get_category( get_query_var( 'cat' ) );
		$premiumphotography_category_name = '';
		if($premiumphotography_category->category_parent!=0){
			$premiumphotography_category_name .= get_cat_name($premiumphotography_category->category_parent).'/';
		}
		$premiumphotography_category_name .= $premiumphotography_category->name;
		echo 'Category: '.$premiumphotography_category_name;
	}
	elseif(is_tag())
		echo 'Tag: '.get_query_var('tag');	
	elseif (is_single())
		the_title();
	elseif (is_page()) 
	  	the_title();
	elseif (is_search()){
	   	echo 'Search Results for: ';
		the_search_query();
	}
	elseif(is_author())
		echo 'Author: '.get_the_author();	
	elseif(is_archive())
		echo 'Archive: '.get_the_date('M-Y');	
	
	echo '		</h1>
			 </div>
		 </div>';
} ?>