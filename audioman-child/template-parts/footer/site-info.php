<?php
/**
 * The template used for displaying credits
 *
 * @package Audioman
 */
?>

<?php
/**
 * audioman_credits hook
 * @hooked audioman_footer_content - 10
 */
//do_action( 'audioman_credits' );
?>
<div class="site-info">
	Copyright © <?php echo date("Y"); ?> <?php echo get_bloginfo( 'name' ); ?>
</div>
