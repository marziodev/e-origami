 <?php
/**
 * Template part for displaying post content in single.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package e-origami
 */
?>
        <div class="col-md-8 origami-hero">
            <div class="origami-tagline"><h2 class="origami-tagline-text"><?php bloginfo( 'description' ); ?></h2></div>
            <?php echo get_origami_picture($id);  ?>
        </div>
    </div><!-- chiusura row -->
    <div class="row">
        <main class="origami-single-main">
            <article id="<?php echo $id; ?>" class="origami-article">
                <div class="col-lg-6 col-md-9 order-md-3 origami-single">
                    <div class="origami-entry-header">
                    <?php
                        the_title( '<h1 class="origami-entry-title">', '</h1>' );
                        get_template_part('template-parts/content', 'accessibility');
                    ?>
                    <?php echo origami_tag_list(get_the_ID()); ?>
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
                        ?>
                    </div><!-- .entry-footer -->
                </div>
            </article>
        </main>