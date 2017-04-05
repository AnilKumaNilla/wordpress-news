<?php
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function education_base_widgets_init() {
    register_sidebar( array(
        'name'          => esc_html__( 'Sidebar', 'education-base' ),
        'id'            => 'education-base-sidebar',
        'description'   => '',
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h2 class="widget-title">',
        'after_title'   => '</h2><div class="line"><span></span></div>',
    ) );
    if ( is_customize_preview() ) {
        $education_base_home_description = sprintf( __( 'Displays widgets on home page main content area.%1$s Note : Please go to %2$s "Static Front Page"%3$s setting, Select "A static page" then "Front page" and "Posts page" to show added widgets', 'education-base' ), '<br />','<b>','</b>' );
    }
    else{
        $education_base_home_description = __( 'Displays widgets on Front/Home page. Note : Please go to Setting => Reading, Select "A static page" then "Front page" and "Posts page" to show added widgets', 'education-base' );
    }
    register_sidebar(array(
        'name' => __('Home Main Content Area', 'education-base'),
        'id'   => 'education-base-home',
        'description'	=> $education_base_home_description,
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h2 class="widget-title"><span>',
        'after_title' => '</span></h2><div class="line"><span></span></div>',
    ));

    register_sidebar(array(
        'name' => __('Footer Column One', 'education-base'),
        'id' => 'footer-col-one',
        'description' => __('Displays items on top footer section.', 'education-base'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title"><span>',
        'after_title' => '</span></h3><div class="line"><span></span></div>',
    ));

    register_sidebar(array(
        'name' => __('Footer Column Two', 'education-base'),
        'id' => 'footer-col-two',
        'description' => __('Displays items on top footer section.', 'education-base'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title"><span>',
        'after_title' => '</span></h3><div class="line"><span></span></div>',
    ));

    register_sidebar(array(
        'name' => __('Footer Column Three', 'education-base'),
        'id' => 'footer-col-three',
        'description' => __('Displays items on top footer section.', 'education-base'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title"><span>',
        'after_title' => '</span></h3><div class="line"><span></span></div>',
    ));

    register_sidebar(array(
        'name' => __('Footer Column Four', 'education-base'),
        'id' => 'footer-col-four',
        'description' => __('Displays items on top footer section.', 'education-base'),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title"><span>',
        'after_title' => '</span></h3><div class="line"><span></span></div>',
    ));

}
add_action( 'widgets_init', 'education_base_widgets_init' );