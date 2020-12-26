<?php
/**
 * The template for displaying footer.
 *
 * @package HelloElementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$site_name = get_bloginfo( 'name' );
$tagline   = get_bloginfo( 'description', 'display' );
?>
<footer id="site-footer" class="site-footer <?php echo esc_attr( hello_get_footer_layout_class() ); ?>" role="contentinfo">
	<div class="site-branding">
		<?php if ( has_custom_logo() ) : ?>
			<div class="site-logo <?php echo hello_show_or_hide( 'hello_footer_logo_display' ); ?>">
				<?php the_custom_logo(); ?>
			</div>
		<?php  elseif ( $site_name ) : ?>
			<h4 class="site-title <?php echo hello_show_or_hide( 'hello_footer_title_display' ); ?>">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php esc_attr_e( 'Home', 'hello-elementor' ); ?>" rel="home">
					<?php echo esc_html( $site_name ); ?>
				</a>
			</h4>
		<?php endif;

		if ( $tagline ) : ?>
			<p class="site-description <?php echo hello_show_or_hide( 'hello_footer_tagline_display' ); ?>">
				<?php echo esc_html( $tagline ); ?>
			</p>
		<?php endif; ?>
	</div>

	<?php if ( has_nav_menu( 'menu-1' ) ) : ?>
		<nav class="site-navigation <?php echo hello_show_or_hide( 'hello_footer_menu_display' ); ?>" role="navigation">
			<?php wp_nav_menu( array( 'theme_location' => 'menu-1', 'depth' => 1 ) ); ?>
		</nav>
	<?php endif; ?>

	<?php if ( '' !== hello_elementor_get_setting( 'hello_footer_copyright_text' ) ) : ?>
		<div class="copyright <?php echo hello_show_or_hide( 'hello_footer_copyright_display' ); ?>">
			<p><?php echo hello_elementor_get_setting( 'hello_footer_copyright_text' ); ?></p>
		</div>
	<?php endif; ?>
</footer>
