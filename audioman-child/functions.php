<?php
/**
 * Child theme functions
 *
 * Functions file for child theme, enqueues parent and child stylesheets by default.
 *
 * @since	1.0.0
 * @package aa
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'aa_enqueue_styles' ) ) {
	// Add enqueue function to the desired action.
	add_action( 'wp_enqueue_scripts', 'aa_enqueue_styles' );

	/**
	 * Enqueue Styles.
	 *
	 * Enqueue parent style and child styles where parent are the dependency
	 * for child styles so that parent styles always get enqueued first.
	 *
	 * @since 1.0.0
	 */
	function aa_enqueue_styles() {
		// Parent style variable.
		$parent_style = 'audioman-style';

		// Enqueue Parent theme's stylesheet.
		wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css?v=02' );

		// Enqueue Child theme's stylesheet.
		// Setting 'parent-style' as a dependency will ensure that the child theme stylesheet loads after it.
		wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css?v=06', array( $parent_style ) );

		// Enqueue font stylesheet.
		// Setting 'parent-style' as a dependency will ensure that the child theme stylesheet loads after it.
		wp_enqueue_style( 'trueno-font', get_stylesheet_directory_uri() . '/fonts/trueno.css', array( $parent_style ) );

		// Setting 'parent-style' as a dependency will ensure that the child theme stylesheet loads after it.
		wp_enqueue_style( 'magnific', get_stylesheet_directory_uri() . '/lib/magnific/magnific-popup.css', array( $parent_style ) );

		wp_enqueue_style( 'slick', get_stylesheet_directory_uri() . '/lib/slick/slick.css', array( $parent_style ) );
	}






	/**
	 * Enqueue scripts and styles.
	 */

	function theme_js() {
		wp_enqueue_script( 'child-scripts', get_stylesheet_directory_uri() . '/lib/child-scripts.js?v=02', array( 'jquery' ), '1.0', true );

    wp_enqueue_script( 'magnific', get_stylesheet_directory_uri() . '/lib/magnific/jquery.magnific-popup.min.js', array( 'jquery' ), '1.0', true );

		wp_enqueue_script( 'slick', get_stylesheet_directory_uri() . '/lib/slick/slick.min.js', array( 'jquery' ), '1.0', true );
	}

	add_action('wp_enqueue_scripts', 'theme_js');


	// function audioman_child_scripts() {
  //
	// 	wp_register_script( 'child-scripts', trailingslashit( esc_url ( get_stylesheet_directory_uri() ) ) . 'lib/child-scripts.js', array( 'jquery' ),  true );
  //
	// 	wp_register_script( 'magnific', trailingslashit( esc_url ( get_stylesheet_directory_uri() ) ) . 'lib/magnific/jquery.magnific-popup.min.js', array( 'jquery' ),  true );
  //
  //
	// }
	// add_action( 'wp_enqueue_scripts', 'audioman_child_scripts' );






}
