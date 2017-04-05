<?php
/**
 * Education Base Theme Customizer.
 *
 * @package Acme Themes
 * @subpackage Education Base
 */
/*
* file for upgrade to pro
*/
require education_base_file_directory('acmethemes/customizer/customizer-pro/class-customize.php');
/*
* file for customizer core functions
*/
require education_base_file_directory('acmethemes/customizer/customizer-core.php');
/*
* file for customizer sanitization functions
*/
require education_base_file_directory('acmethemes/customizer/sanitize-functions.php');

/**
 * Adding different options
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function education_base_customize_register( $wp_customize ) {

    $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

    /*saved options*/
    $options  = education_base_get_theme_options();

    /*defaults options*/
    $defaults = education_base_get_default_theme_options();

    require education_base_file_directory('acmethemes/customizer/custom-controls.php');

    /*
     * file for feature panel of home page
     */
    require education_base_file_directory('acmethemes/customizer/feature-section/feature-panel.php');

    /*
    * file for header panel
    */
    require education_base_file_directory('acmethemes/customizer/header-options/header-panel.php');

    /*
    * file for customizer footer section
    */
    require education_base_file_directory('acmethemes/customizer/footer-options/footer-panel.php');

    /*
    * file for design/layout panel
    */
    require education_base_file_directory('acmethemes/customizer/design-options/design-panel.php');

    /*
     * file for options panel
     */
    require education_base_file_directory('acmethemes/customizer/options/options-panel.php');
}
add_action( 'customize_register', 'education_base_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function education_base_customize_preview_js() {
    wp_enqueue_script( 'education-base-customizer', get_template_directory_uri() . '/acmethemes/core/js/customizer.js', array( 'customize-preview' ), '1.1.0', true );
}
add_action( 'customize_preview_init', 'education_base_customize_preview_js' );