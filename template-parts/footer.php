<?php
/**
 * The template for displaying footer.
 *
 * @package HelloElementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$is_editor = ( class_exists('Elementor') && \Elementor\Plugin::$instance->editor->is_edit_mode() );
$site_name = get_bloginfo( 'name' );
$tagline   = get_bloginfo( 'description', 'display' );
?>
<footer id="site-footer" class="site-footer <?php echo esc_attr( hello_get_footer_layout_class() ); ?>" role="contentinfo">
	<div class="site-branding">
		<?php
		if ( 'yes' == hello_elementor_get_setting( 'footer_logo_display' ) ) {
			if ( has_custom_logo() ) {
				the_custom_logo();
			} elseif ( ( $site_name  && 'yes' === hello_elementor_get_setting( 'footer_title_display' ) ) || $is_editor  ) {
		?>
			<h4 class="site-title">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php esc_attr_e( 'Home', 'hello-elementor' ); ?>" rel="home">
					<?php echo esc_html( $site_name ); ?>
				</a>
			</h4>
		<?php
			}
		}

		if ( ( $tagline && 'yes' == hello_elementor_get_setting( 'footer_tagline_display' ) ) || $is_editor  ) {
		?>
			<p class="site-description">
				<?php 
					echo esc_html( $tagline );
				?>
			</p>
		<?php
		}
		?>
	</div>

	<?php if ( has_nav_menu( 'menu-1' ) || $is_editor  ) : ?>
		<nav class="site-navigation" role="navigation">
			<?php wp_nav_menu( array( 'theme_location' => 'menu-1', 'depth' => 1 ) ); ?>
		</nav>
	<?php endif; ?>

	<?php if ( ( '' !== hello_elementor_get_setting( 'footer_copyright_text' ) && 'yes' === hello_elementor_get_setting( 'footer_copyright_display' ) ) || $is_editor ) :
		?>
		<div class="copyright">
			<p><?php echo hello_elementor_get_setting( 'footer_copyright_text' ); ?></p>
		</div>
	<?php endif; ?>
</footer>
