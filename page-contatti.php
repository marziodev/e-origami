<?php
/**
 * Template Name: Contatti
 *
 * @package e-origami
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

get_header();
?>

    <div class="col-md-8 origami-hero">
        <div class="origami-tagline"><h2 class="origami-tagline-text"><?php bloginfo( 'description' ); ?></h2></div>
        <?php echo get_origami_picture($id);  ?>
    </div>
</div><!-- chiusura row -->
<div id="primary" class="row">
    <div class="col-lg-6 col-md-9 order-md-3 origami-page" role="main">
        <div class="origami-entry-header">
        <h1 class="origami-entry-title">
                <?php the_title(); ?>
        </h1>
        </div><!-- .entry-header -->
        <div class="origami-entry-content">
            <div class="container origami-contacts">
                <div class="row">
                    <div class="col-md-12 pb-5">
                        <?php the_content(); ?>
                    </div>
                </div>
            </div>
        </div><!-- .entry-content -->
        <div class="origami-entry-footer origami-contacts">
            <button 
                id="contact-modal"
                data-bs-toggle="modal"
                data-bs-target="#contactModal"
                type="button" 
                class="btn btn-outline-dark btn-lg btn-origami-contact">
                Modulo di Contatto
            </button>
        </div><!-- .entry-footer -->
    </div>

<div class="col-lg-2 col-md-3 order-1 origami-portfolio">
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

<!-- Contact Modal BEGIN --> 
    <div id="contactModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="contactModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title" id="contactModalLabelTitle"><?php echo $title; ?></h3>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
        <div class="modal-body">
        <p class="m-3 pb-3">
            <?php echo $content; ?>
        </p>
            <?php echo do_shortcode('[contact-form-7 id="158b0dc" title="Contact form 1"]'); ?>
        </div>
        </div>
        </div>
    </div>
<!-- Contact Modal END -->

<?php
get_footer();