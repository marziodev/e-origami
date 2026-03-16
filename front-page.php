<?php
/**
 * Template Name: Front Page
 *
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package e-origami
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

get_header();
?>

<?php
if ( have_posts() ) :

    /* Start the Loop */
    while ( have_posts() ) :
        the_post();
        ?>
            <div class="col-md-8 origami-hero">
                <div class="origami-tagline"><h2 class="origami-tagline-text"><?php bloginfo( 'description' ); ?></h2></div>
                <?php echo get_origami_picture($id);  ?>
            </div>
        </div><!-- chiusura row front-page -->
        <div id="primary" class="row">
            <div class="col-lg-6 col-md-9 order-md-3 origami-page" role="main">
                <!-- QUESTA NON E' UNA TEMPLATE PART! -->
                <article id="post-<?php the_ID(); ?>" <?php post_class('origami-frontmain'); ?>>
                    <div class="origami-entry-header">
                    <?php
                        the_title( '<h1 class="origami-entry-title">', '</h1>' );
                        get_template_part('template-parts/content', 'accessibility');
                    ?>
                    </div><!-- .entry-header -->
                    <div class="origami-entry-content">
                        <?php
                        the_content();
                        ?>
                    </div><!-- .entry-content -->
                    <div class="entry-footer">
                        <div class="entry-meta">
                            <div class="origami-entry-meta">
                                <span class="origami-posted-by"><?php the_author(); ?></span>
                                <span class="origami-posted-on">Pubblicato:&nbsp;
                                    <a href="<?php the_permalink(); ?>" class="origami-permalink">
                                    <?php echo get_the_date('d/m/Y'); ?>
                                    </a>
                                </span>
                            </div>
                            <div class="origami-entry-social">
                                <?php the_socialshare(['linkedin','bluesky','x','whatsapp']); ?>
                            </div>
                        </div><!-- .entry-meta -->    
                        <?php
                        edit_post_link( esc_html__( 'Edit', 'e-origami' ), '<span class="edit-link">', '</span>' );
                        endwhile;
                        else :
                            get_template_part( 'template-parts/content', 'none' );
                        endif;
                        wp_reset_postdata();
                        ?>
                    </div><!-- .entry-footer -->
                </article>
                <div class="row origami-service">
                    <div class="col-lg-4 col-md-12 origami-stats">
                        <h3 class="origami-section-title">Stats</h3>
                        <?php
                            echo origami_stat_card($id);
                        ?>
                    </div>
                    <div class="col-lg-8 col-md-12 origami-front-roll">
                        <h3 class="origami-section-title">Pieghe del web</h3>
                        <?php
                            $args = array(
                                'posts_per_page' => 5,
                                'post_type' => 'post',
                                'category_name' => 'pieghe-del-web',
                            );
                            $frontroll = new WP_Query( $args );
                            if ( $frontroll->have_posts() ) :
                                while ( $frontroll->have_posts() ) : $frontroll->the_post();
                                    get_template_part( 'template-parts/content', 'frontroll' );
                                endwhile;
                                wp_reset_postdata();
                            endif;

                        ?>
                    </div>
                </div>
            </div> <!-- .origami-page role="article" -->
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