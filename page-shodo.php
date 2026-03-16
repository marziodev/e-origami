<?php
/**
 * Template Name: Shodo
 * 
 * This is the template for the Shodo page.
 */

if(!defined('ABSPATH')) exit; // Exit if accessed directly

get_header('shodo'); ?>

<div class="col-lg-8 col-md-10 shodo-main" role="heading" aria-level="1">
    <div class="shodo-site-title">
		<h1 class="shodo-site-title-text">
        <?php echo get_bloginfo( 'name' ).' - ' . get_bloginfo( 'description' ); ?>
        </h1>
    </div>
<?php
if ( have_posts() ) :

    /* Start the Loop */
    while ( have_posts() ) :
        the_post();
        ?>
        <main>
            <article class="shodo-article">
                <div class="shodo-hero">
                    <?php echo get_origami_picture($id);  ?>
                </div>        
                <div class="shodo-entry-header">
                <?php
                    the_title( '<h2 class="shodo-entry-title">', '</h2>' );
                    get_template_part('template-parts/content', 'accessibility');
                ?>
                </div><!-- .entry-header -->
                <div class="shodo-entry-content">
                    <?php
                    the_content();
                    ?>
                </div><!-- .entry-content -->
                <div class="entry-footer">
                    <div class="entry-meta">
                        <div class="shodo-entry-meta">
                            <span class="shodo-posted-by"><?php the_author(); ?></span>
                            <span class="shodo-posted-on">Pubblicato:&nbsp;
                                <?php echo get_the_date('d/m/Y'); ?>
                            </span>
                        </div>
                        <div class="shodo-entry-social">
                            <?php the_socialshare(['linkedin','bluesky','x','whatsapp']); ?>
                        </div>
                    </div><!-- .entry-meta -->    
                    <?php
                    edit_post_link( esc_html__( 'Edit', 'e-origami' ), '<span class="edit-link">', '</span>' );
                    ?>
                </div><!-- .entry-footer -->
            </article>
        </main>
        <?php
    endwhile;
else :
    ?>
    <h2 class="shodo-no-post">No posts found.</h2>
    <?php
endif;
?>
 <!-- portfolio -->
<div class="shodo-portfolio">
    <h3 class="shodo-section-title d-sm-none d-md-block">Portfolio</h3>
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
<div class="shodo-stats clearfix">
    <div class="shodo-card-section clearfix">
        <?php
           echo origami_stat_card(56);
        ?>
    </div>
</div>
<div class="shodo-team-card clearfix">
    <h3 class="shodo-section-title d-sm-none d-md-block team-title">Team</h3>
    <?php
      get_template_part( 'template-parts/content', 'shodoteam' );
    ?>
</div>

</div> <!-- .shodo-main -->
<div class="col-lg-1 col-md-6 order-md-2 shodo-blogroll">
    <h3 class="shodo-section-title d-sm-none d-md-block">Pieghe del web</h3>
        <?php
            $args = array(
                'posts_per_page' => 10,
                'post_type' => 'post',
                'category_name' => 'pieghe-del-web',
            );
            $frontroll = new WP_Query( $args );
            if ( $frontroll->have_posts() ) :
                while ( $frontroll->have_posts() ) : $frontroll->the_post();
                    get_template_part( 'template-parts/content', 'shodofrontroll' );
                endwhile;
                wp_reset_postdata();
            endif;
        ?>
</div>

<?php 
get_footer('shodo'); 
?>
