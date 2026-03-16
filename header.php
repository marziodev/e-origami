<?php
/**
 * The header for our theme
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
<div id="page" class="container">
	<div id="sentinel"></div>
	<div class="row origami-first-row"><!-- first row - will be cosed after site thumbnail -->
			<!-- site-navigation col-md-2 -->
			<div class="col-md-2 col-3">
				<nav class="navbar navbar-expand-sm navbar-light navbar-origami">
					<div class="container-fluid origami-inner-nav">
						<button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
							<span class="navbar-toggler-icon"></span>
						</button>
						<span class="origami-nielsen-label">MENU</span>
						<div class="offcanvas offcanvas-start" tabindex="-1" id="main-menu">
							      <div class="offcanvas-header">
									<h5 class="offcanvas-title" id="offcanvasNavbarLabel">MENU</h5>
									<button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
								</div>
							<?php
							wp_nav_menu(array(
								'theme_location' => 'primary',
								'container' => false,
								'menu_class' => '',
								'fallback_cb' => '__return_false',
								'items_wrap' => '<ul id="%1$s" class="navbar-nav justify-content-start flex-grow-1 ps-3 %2$s">%3$s</ul>',
								'depth' => 2,
								'walker' => new bootstrap_5_wp_nav_menu_walker()
							));
							?>
						</div>
					</div>
				</nav>
			</div>
			<!-- site-branding col-md-2 -->
			<div class="col-md-2 col-9 origami-site-branding" role="banner">
				<div class="origami-site-icon">
					<?php
						if(has_site_icon()){
							?>
							<a class="origami-icon-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
								<img src="<?php echo get_site_icon_url( 150, true ); ?>" alt="<?php echo get_bloginfo( 'name' ).' - '.get_bloginfo( 'description' ) ; ?>" class="origami-site-logo" />
							</a>
							<?php
						}
					?>
				</div>
				<div class="origami-site-title" role="heading" aria-level="1">
						<h1 class="origami-site-title-text">
								<?php bloginfo( 'name' ); ?>
						</h1>
				</div>
			</div><!--  .col-md-2 .origami-site-branding -->
