<?php
/**
 * The template for displaying header.
 *
 * @package HelloElementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
$site_name = get_bloginfo( 'name' );
$tagline   = get_bloginfo( 'description', 'display' );
?>

<header class="site-header <?php echo esc_attr( hello_get_header_layout_class() ); ?>" role="banner">

	<div class="site-branding">
		<?php
		if ( has_custom_logo() && 'yes' == hello_elementor_get_setting( 'site_logo_setting' ) ) {
			the_custom_logo();
		} elseif ( $site_name  && 'yes' == hello_elementor_get_setting( 'tagline' ) ) {
			?>
			<h1 class="site-title">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php esc_attr_e( 'Home', 'hello-elementor' ); ?>" rel="home">
					<?php echo esc_html( $site_name ); ?>
				</a>
			</h1>
			<p class="site-description">
				<?php
				if ( $tagline ) {
					echo esc_html( $tagline );
				}
				?>
			</p>
		<?php } ?>
	</div>

	<?php if ( has_nav_menu( 'menu-1' ) ) : ?>
		<nav class="site-navigation" role="navigation">
			<?php wp_nav_menu( array( 'theme_location' => 'menu-1' ) ); ?>
		</nav>
	<?php endif; ?>
</header>
