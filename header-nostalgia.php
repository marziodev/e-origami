<?php
/**
 * The header for the Nostalgia layout
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
        <div class="row nostalgia-header" role="banner">
            <div class="col-md-2 nostalgia-logo">
				<div class="nostalgia-site-icon d-none d-md-block">
					<?php
						if(has_site_icon()){
							?>
							<a class="nostalgia-icon-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
								<img src="<?php echo get_site_icon_url( 150, true ); ?>" alt="<?php echo get_bloginfo( 'name' ).' - '.get_bloginfo( 'description' ) ; ?>" class="nostalgia-site-logo" />
							</a>
							<?php
						}
					?>
				</div>
            </div>
            <div class="col-md-10 nostalgia-branding">
                <div class="nostalgia-tagline">
                    <div class="nostalgia-site-title">
                            <?php echo get_nostalgia_title(); ?>                        
                            <h2 class="nostalgia-site-tagline-text">
                                    <?php bloginfo( 'description' ); ?>
                            </h2>
                    </div>
                </div>
            </div><!-- nostalgia-branding -->
        </div>
        <div class="row nostalgia-main">
            <div class="col-md-2 nostalgia-sidebar-container order-2 order-md-1">
                <div class="nostalgia-navigation">
				<nav class="navbar navbar-expand-sm navbar-light navbar-nostalgia">
					<div class="navbar-container">
						<button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
							<span class="navbar-toggler-icon"></span>
						</button>
						<span class="nostalgia-nielsen-label">MENU</span>
						<div class="offcanvas offcanvas-start" tabindex="-1" id="main-menu">
							      <div class="offcanvas-header">
									<h5 class="offcanvas-title" id="offcanvasNavbarLabel">MENU</h5>
									<button type="button" class="btn-close" data-bs-theme="dark" data-bs-dismiss="offcanvas" aria-label="Close"></button>
								</div>
							<?php
							wp_nav_menu(array(
								'menu' => 'Nostalgia Menu',
								'theme_location' => 'nostalgia', // qui si controlla il menu
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
					<div class="nostalgia-mobile-icon d-block d-md-none">
					<?php
						if(has_site_icon()){
							?>
							<a class="nostalgia-icon-link" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
								<img src="<?php echo get_site_icon_url( 150, true ); ?>" alt="<?php echo get_bloginfo( 'name' ).' - '.get_bloginfo( 'description' ) ; ?>" class="nostalgia-site-logo" />
							</a>
							<?php
						}
					?>
					</div>
				</nav>                    
                </div>
                <div class="nostalgia-sidebar" role="contentinfo">
                    <?php dynamic_sidebar( 'footerfullone' ); ?>
                </div>
            </div>
        
                