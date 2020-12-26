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
		<?php if ( has_custom_logo() ) : ?>
			<div class="site-logo <?php echo hello_show_or_hide( 'hello_header_logo_display' ); ?>">
				<?php the_custom_logo(); ?>
			</div>
		<?php elseif ( $site_name ) : ?>
			<h1 class="site-title <?php echo hello_show_or_hide( 'hello_header_title_display' ); ?>">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php esc_attr_e( 'Home', 'hello-elementor' ); ?>" rel="home">
					<?php echo esc_html( $site_name ); ?>
				</a>
			</h1>
		<?php endif;

		if ( $tagline ) : ?>
			<p class="site-description <?php echo hello_show_or_hide( 'hello_header_tagline_display' ); ?> ">
				<?php echo esc_html( $tagline ); ?>
			</p>
		<?php endif; ?>
	</div>

	<?php if ( has_nav_menu( 'menu-1' ) ) : ?>
		<nav class="site-navigation <?php echo hello_show_or_hide( 'hello_header_menu_display' ); ?>" role="navigation">
			<?php wp_nav_menu( array( 'theme_location' => 'menu-1' ) ); ?>
		</nav>
		<div class="site-navigation-toggle-holder">
			<div class="site-navigation-toggle">
				<i class="eicon-menu-bar"></i>
				<span class="elementor-screen-only">Menu</span>
			</div>
		</div>
		<nav class="site-navigation-dropdown <?php echo hello_show_or_hide( 'hello_header_menu_display' ); ?>" role="navigation">
			<?php wp_nav_menu( array( 'theme_location' => 'menu-1' ) ); ?>
		</nav>
	<?php endif; ?>
</header>
