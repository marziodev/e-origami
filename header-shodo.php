<?php
/**
 * The header for the Shodo layout
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package e-origami
 */
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
 	<a class="skip-link screen-reader-text" href="#primary"><?php esc_html_e( 'Skip to content', 'resume' ); ?></a>
<div id="page" class="container-fluid">
	<div id="sentinel"></div>
	<div class="row shodo-row"><!-- first row - will be cosed in the footer -->
			<!-- site-navigation col-md-2 -->
			<div class="col-lg-1 col-md-2  order-lg-3 order-md-1 col-5 shodo-navigation">
				<div class="shodo-site-icon">
					<?php
						if(has_site_icon()){
							?>
							<a class="origami-icon-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
								<img src="<?php echo get_site_icon_url( 150, true ); ?>" alt="<?php echo get_bloginfo( 'name' ).' - '.get_bloginfo( 'description' ) ; ?>" class="shodo-site-logo" />
							</a>
							<?php
						}
					?>
				</div>
				<nav class="navbar navbar-expand-sm navbar-light navbar-shodo">
					<div class="container-fluid">
						<button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
							<span class="navbar-toggler-icon"></span>
						</button>
						<span class="shodo-nielsen-label">MENU</span>
						<div class="offcanvas offcanvas-start" tabindex="-1" id="main-menu">
							      <div class="offcanvas-header">
									<h5 class="offcanvas-title" id="offcanvasNavbarLabel">MENU</h5>
									<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
								</div>
							<?php
							wp_nav_menu(array(
								'menu' => 'Shodo Menu',
								'theme_location' => 'shodo', // qui si controlla il menu
								'container' => false,
								'menu_class' => '',
								'fallback_cb' => '__return_false',
								'items_wrap' => '<ul id="%1$s" class="navbar-nav justify-content-start flex-grow-1 %2$s">%3$s</ul>',
								'depth' => 2,
								'walker' => new bootstrap_5_wp_nav_menu_walker()
							));
							?>
						</div>
					</div>
				</nav>
			</div>

