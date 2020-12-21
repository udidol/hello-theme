<?php
/**
 * The template for displaying header.
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

<header class="site-header <?php echo esc_attr( hello_get_header_layout_class() ); ?>" role="banner">

	<div class="site-branding">
		<?php
		if ( 'yes' == hello_elementor_get_setting( 'header_logo_display' ) || $is_editor ) {
			if ( has_custom_logo() ) {
				the_custom_logo();
			} elseif ( ( $site_name  && 'yes' == hello_elementor_get_setting( 'header_tagline_display' ) ) || $is_editor  ) {
			?>
				<h1 class="site-title">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php esc_attr_e( 'Home', 'hello-elementor' ); ?>" rel="home">
						<?php echo esc_html( $site_name ); ?>
					</a>
				</h1>
		<?php
			}
		}

		if ( $tagline && 'yes' == hello_elementor_get_setting( 'header_tagline_display' ) || $is_editor ) {
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

	<?php if ( has_nav_menu( 'menu-1' ) ) : ?>
		<nav class="site-navigation" role="navigation">
			<?php wp_nav_menu( array( 'theme_location' => 'menu-1' ) ); ?>
		</nav>
	<?php endif; ?>
</header>
