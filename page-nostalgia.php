<?php
/**
 * Template Name: Nostalgia 
 * 
 * This is the template for the Shodo page.
 */

if(!defined('ABSPATH')) exit; // Exit if accessed directly

get_header('nostalgia'); ?>
    
    <div id="primary" class="col-md-10 nostalgia-content order-1 order-md-2" role="main">
        <div class="nostalgia-nagel-wires"></div>
        <?php
        if ( have_posts() ) :

            /* Start the Loop */
            while ( have_posts() ) :
                the_post();
        ?>
        <article id="post-<?php the_ID(); ?>" <?php post_class('nostalgia-main-article'); ?>>
            <div class="nostalgia-hero">
                <?php echo get_origami_picture($id);  ?>
            </div>        
            <div class="nostalgia-entry-header px-3">
            <?php
                get_template_part('template-parts/content', 'accessibility');
                $subtitle = get_post_meta($id,'subtitle','true');
                the_title( '<h1 class="nostalgia-entry-title">', '&nbsp;'.$subtitle.'</h1>' );
            ?>
            </div><!-- .entry-header -->
            <div class="nostalgia-entry-content px-3">
                <?php
                the_content();
                ?>
            </div><!-- .entry-content -->
            <div class="entry-footer px-3">
                <div class="entry-meta">
                    <div class="nostalgia-entry-meta">
                        <span class="nostalgia-posted-by"><?php the_author(); ?></span>
                        <span class="nostalgia-posted-on">Pubblicato:&nbsp;
                            <a href="<?php the_permalink(); ?>" class="nostalgia-permalink">
                            <?php echo get_the_date('d/m/Y'); ?>
                            </a>
                        </span>
                    </div>
                    <div class="nostalgia-entry-social">
                        <?php the_socialshare(['linkedin','bluesky','x','whatsapp']); ?>
                    </div>                   
                </div><!-- .entry-meta -->    
                <?php
                edit_post_link( esc_html__( 'Edit', 'e-origami' ), '<span class="edit-link">', '</span>' );
                ?>
            </div><!-- .entry-footer -->
        </article><!-- #post-## -->             
        <?php
            endwhile;
        else :
            ?>
            <h2 class="nostalgia-no-post">No posts found.</h2>
            <?php
        endif;
        ?>
        <!-- portfolio -->
        <div class="nostalgia-portfolio">
            <h2 class="nostalgia-section-title">Portfolio</h2>
            <div class="card-group">
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
        </div>
        <!-- team -->
        <div class="nostalgia-team-card clearfix">
            <h3 class="nostalgia-section-title d-md-none">Team</h3>
            <?php
            get_template_part( 'template-parts/content', 'shodoteam' );
            ?>
        </div>
        <!-- stats -->
         <div class="nostalgia-stats clearfix">
            <div class="nostalgia-card-section clearfix">
                <?php
                    echo origami_stat_card(56);
                ?>
            </div>
        </div>
        <!-- blogroll -->
        <div class="nostalgia-blogroll">
            <h3 class="nostalgia-section-title d-md-none blogroll-title">Pieghe del web</h3>
            <?php
                $args = array(
                    'posts_per_page' => 6,
                    'post_type' => 'post',
                    'category_name' => 'pieghe-del-web',
                );
                $frontroll = new WP_Query( $args );
                if ( $frontroll->have_posts() ) :
                    while ( $frontroll->have_posts() ) : $frontroll->the_post();
                        get_template_part( 'template-parts/content', 'nostalgiaroll' );
                    endwhile;
                    wp_reset_postdata();
                endif;
            ?>
        </div> 

    </div><!-- nostalgia-content - main -->


<?php 
get_footer('nostalgia'); 
?>