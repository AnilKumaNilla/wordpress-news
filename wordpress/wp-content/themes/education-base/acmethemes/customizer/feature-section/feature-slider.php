<?php
/*adding sections for category section in front page*/
$wp_customize->add_section( 'education-base-feature-page', array(
    'priority'       => 10,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __( 'Feature Slider Selection', 'education-base' ),
    'panel'          => 'education-base-feature-panel'
) );

/* feature parent page selection */
$wp_customize->add_setting( 'education_base_theme_options[education-base-feature-page]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['education-base-feature-page'],
    'sanitize_callback' => 'education_base_sanitize_number'
) );
$wp_customize->add_control( 'education_base_theme_options[education-base-feature-page]', array(
    'label'		    => __( 'Select Parent Page for Feature Slider', 'education-base' ),
    'description'	=> sprintf( __( 'Recommended to write short title, short content/excerpt and use featured image 1280*610 for the selected page below. If you want to show slider, the page you selected should have %1$s child pages %2$s', 'education-base' ), '<a href="https://www.acmethemes.com/blog/2016/04/how-to-create-child-pages-sub-pages/" target="_blank">','</a>' ),
    'section'       => 'education-base-feature-page',
    'settings'      => 'education_base_theme_options[education-base-feature-page]',
    'type'	  	    => 'dropdown-pages',
    'priority'      => 10
) );

/* number of slider*/
$wp_customize->add_setting( 'education_base_theme_options[education-base-featured-slider-number]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['education-base-featured-slider-number'],
    'sanitize_callback' => 'absint'
) );
$wp_customize->add_control( 'education_base_theme_options[education-base-featured-slider-number]', array(
    'label'		=> __( 'Number Of Slider', 'education-base' ),
    'section'   => 'education-base-feature-page',
    'settings'  => 'education_base_theme_options[education-base-featured-slider-number]',
    'type'	  	=> 'number',
    'priority'  => 20
) );

/*enable animation*/
$wp_customize->add_setting( 'education_base_theme_options[education-base-feature-slider-enable-animation]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['education-base-feature-slider-enable-animation'],
    'sanitize_callback' => 'education_base_sanitize_checkbox'
) );
$wp_customize->add_control( 'education_base_theme_options[education-base-feature-slider-enable-animation]', array(
    'label'		    => __( 'Enable Animation', 'education-base' ),
    'section'       => 'education-base-feature-page',
    'settings'      => 'education_base_theme_options[education-base-feature-slider-enable-animation]',
    'type'	  	    => 'checkbox',
    'priority'      => 30
) );

/*image only*/
$wp_customize->add_setting( 'education_base_theme_options[education-base-feature-slider-image-only]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['education-base-feature-slider-image-only'],
    'sanitize_callback' => 'education_base_sanitize_checkbox'
) );
$wp_customize->add_control( 'education_base_theme_options[education-base-feature-slider-image-only]', array(
    'label'		    => __( 'Display Image Only', 'education-base' ),
    'section'       => 'education-base-feature-page',
    'settings'      => 'education_base_theme_options[education-base-feature-slider-image-only]',
    'type'	  	    => 'checkbox',
    'priority'      => 40
) );

/*know more text*/
$wp_customize->add_setting( 'education_base_theme_options[education-base-slider-know-more-text]', array(
    'capability'		=> 'edit_theme_options',
    'default'			=> $defaults['education-base-slider-know-more-text'],
    'sanitize_callback' => 'sanitize_text_field'
) );
$wp_customize->add_control( 'education_base_theme_options[education-base-slider-know-more-text]', array(
    'label'		    => __( 'Slider Button Text', 'education-base' ),
    'description'   => __( 'Left empty to disable slider button ', 'education-base' ),
    'section'       => 'education-base-feature-page',
    'settings'      => 'education_base_theme_options[education-base-slider-know-more-text]',
    'type'	  	    => 'text',
    'priority'      => 220
) );