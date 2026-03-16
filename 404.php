<?php
/**
 * The template for displaying all single posts
 *
 * @package e-origami
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
?>

<?php
    if ( have_posts() ) :

        /* Start the Loop */
        while ( have_posts() ) :
            the_post();


        get_template_part( 'template-parts/content', 'single' );

        endwhile;

        // the_posts_navigation();

    else :

        get_template_part( 'template-parts/content', 'none' );

    endif;
?>

<div class="col-md-2 order-1 origami-portfolio">
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
<div class="col-md-2 order-md-2 origami-card-section">
    <?php
      get_template_part( 'template-parts/content', 'team' );
    ?>
</div>

<?php
get_footer();