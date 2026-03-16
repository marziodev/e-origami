<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Electronic Origami
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

get_header();
?>

            <div class="col-md-8 origami-hero">
                <div class="origami-tagline"><h2 class="origami-tagline-text"><?php bloginfo( 'description' ); ?></h2></div>
                <?php echo get_origami_picture($id);  ?>
            </div>
        </div><!-- chiusura row index.php -->
        <div id="primary" class="row">
            <div class="col-lg-6 col-md-9 order-md-3 origami-page" role="main">
                <h1 class="origami-blogroll-title"><?php echo origami_custom_title(); ?></h1>
<?php
if ( have_posts() ) :

    /* Start the Loop */
    while ( have_posts() ) :
        the_post();
        /*
         * Include the Post-Type-specific template for the content.
         * If you want to override this in a child theme, then include a file
         * called content-___.php (where ___ is the Post Type name) and that will be used instead.
         */
        get_template_part( 'template-parts/content', 'post' );

    endwhile;

    // the_posts_navigation();
    echo bootstrap_pagination();

else :
// TODO:Trasferire blocco row + col-md-8 
    get_template_part( 'template-parts/content', 'none' );

endif;
?>
 </div> <!-- .origami-blogroll-container EMD index page -->
<div class="col-lg-2 col-md-3 order-1">
    <h3 class="origami-section-title">Portfolio</h3>
    <?php
    // I'm getting the page ID of the current page BECAUSE this is a page itself.
    $page_id = get_the_ID();
    $args = array(
        'post_type' => 'page',
        'post__not_in' => array($page_id),
        'category_name' => 'portfolio',
        'orderby' => 'rand',
        'order' => 'ASC'
    );
    $query = new WP_Query( $args );
    if ( $query->have_posts() ) :
        while ( $query->have_posts() ) : $query->the_post();
            
            get_template_part( 'template-parts/content', 'works' );
        endwhile;
        wp_reset_postdata();
    endif;
    ?>
</div>
<div class="col-lg-2 col-md-12 order-lg-2 order-md-3 origami-card-section">
    <?php
      get_template_part( 'template-parts/content', 'team' );
    ?>
</div>

<?php
get_footer();
