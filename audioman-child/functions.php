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
		wp_enqueue_style( $parent_style, get_template_directory_uri() . '/style.css?v=2102082' );

		// Enqueue Child theme's stylesheet.
		// Setting 'parent-style' as a dependency will ensure that the child theme stylesheet loads after it.
		wp_enqueue_style( 'child-style', get_stylesheet_directory_uri() . '/style.css?v=2102082', array( $parent_style ) );

		// Enqueue font stylesheet.
		// Setting 'parent-style' as a dependency will ensure that the child theme stylesheet loads after it.
		wp_enqueue_style( 'trueno-font', get_stylesheet_directory_uri() . '/fonts/trueno.css', array( $parent_style ) );

		// Setting 'parent-style' as a dependency will ensure that the child theme stylesheet loads after it.
		wp_enqueue_style( 'magnific', get_stylesheet_directory_uri() . '/lib/magnific/magnific-popup.css', array( $parent_style ) );

		wp_enqueue_style( 'slick', get_stylesheet_directory_uri() . '/lib/slick/slick.css', array( $parent_style ) );
	}

	/* Google Fonts */
	function wpb_add_google_fonts() {

		wp_enqueue_style( 'wpb-google-fonts', 'https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,500;0,600;1,500;1,600&display=swap', false );
	}
	add_action( 'wp_enqueue_scripts', 'wpb_add_google_fonts' );



	/**
	 * Enqueue scripts and styles.
	 */

	function theme_js() {
		wp_enqueue_script( 'child-scripts', get_stylesheet_directory_uri() . '/lib/child-scripts.js?v=02', array( 'jquery' ), '1.0', true );

    wp_enqueue_script( 'magnific', get_stylesheet_directory_uri() . '/lib/magnific/jquery.magnific-popup.min.js', array( 'jquery' ), '1.0', true );

		wp_enqueue_script( 'slick', get_stylesheet_directory_uri() . '/lib/slick/slick.min.js', array( 'jquery' ), '1.0', true );
	}

	add_action('wp_enqueue_scripts', 'theme_js');

}

	// function audioman_child_scripts() {
  //
	// 	wp_register_script( 'child-scripts', trailingslashit( esc_url ( get_stylesheet_directory_uri() ) ) . 'lib/child-scripts.js', array( 'jquery' ),  true );
  //
	// 	wp_register_script( 'magnific', trailingslashit( esc_url ( get_stylesheet_directory_uri() ) ) . 'lib/magnific/jquery.magnific-popup.min.js', array( 'jquery' ),  true );
  //
  //
	// }
	// add_action( 'wp_enqueue_scripts', 'audioman_child_scripts' );



/* Background Image Grid */
add_action('wp_footer', 'background_images');
function background_images(){

	// maximum images needed
	$maxImages = 32;

	// get the background image page
	$bg_query = new WP_Query( 'page_id=31405' );
  while ( $bg_query->have_posts() ) : $bg_query->the_post();

			// set the content markup as var
      $content = apply_filters('the_content', get_the_content());

			// create new DomDocument to use getElementsByTagName and get all img tags
			$document = new DOMDocument();
			$document->loadHTML($content);
			$images = $document->getElementsByTagName('img');

			// convert element srcs into array to randomize order
			$imgArray = array();
			foreach($images as $node){
			    $imgArray[] = $node->getAttribute('src');
			}
			shuffle($imgArray);

			// limit max number of images
			$cutArray = array_slice($imgArray, 0, $maxImages);
			$fullArray = array_merge($cutArray, $cutArray, $cutArray);

			// create the markup
			$markup = '<div class="background-images">';
			foreach ($fullArray as $imageSrc){
				$markup .= '<div class="background-grid-image"><img src="';
				$markup .= $imageSrc;
				$markup .= '"></div>';
			}
			$markup .= '</div>';

			// put it on the page
			echo $markup;

  endwhile;
  // reset post data (important!)
  wp_reset_postdata();
};



/**
 * Returns all img tags in a HTML string with the option to include img tag attributes
 *
 * @author   Joshua Baker
 *
 * @example  $post_images[0]->html = <img src="example.jpg">
 *           $post_images[0]->attr->width = 500
 *
 * @param    $html_string  string   The HTML string
 * @param    $get_attrs    boolean  If TRUE all of the img tag attributes will be returned
 * @return   $post_images  array    An array of objects
 */
function get_images($html_string, $get_attrs = FALSE)
{
    $post_images = array();

    // Get all images
		preg_match_all('/<img[^>]+>/i',$html_string, $image_matches);
    // preg_match_all('/<img (.+)>/', $html_string, $image_matches, PREG_SET_ORDER);

    // Loop the images and add the raw img html tag to $post_images
    foreach ($image_matches as $image_match)
    {
        $post_image->html = $image_match[0];

        // If attributes have been requested get them and add them to the $post_image
        if ($get_attrs == TRUE)
        {
            preg_match_all('/\s+?(.+)="([^"]*)"/U', $image_match[0], $image_attr_matches, PREG_SET_ORDER);

            foreach ($image_attr_matches as $image_attr)
            {
                $post_image->attr->{$image_attr[1]} = $image_attr[2];
            }
        }

        $post_images[] = $post_image;
    }

    return $post_images;
}
