    <div class="col-md-8 origami-hero">
        <div class="origami-tagline"><h2 class="origami-tagline-text"><?php bloginfo( 'description' ); ?></h2></div>
        <?php echo get_origami_picture($id);  ?>
    </div>
</div><!-- chiusura row -->
<div id="post-<?php the_ID(); ?>" class="row"  role="main">
    <div class="col-md-6 order-md-3">
        <div class="origami-entry-header">
        <h1 class="origami-entry-title">
                La Pagina é Scomparsa (Ma il resto del sito è qui!)
        </h1>
        </div><!-- .entry-header -->
        <div class="origami-entry-content">
            <div class="container origami-notfound">
                <div class="row">
                    <div class="col-md-6 offset-md-3 pb-5 text-center">
                        <?php dynamic_sidebar( 'footernotfound' ); ?>
                    </div>
                </div>
            </div>
        </div><!-- .entry-content -->
        <div class="origami-entry-footer">
            <?php get_search_form(array('aria_label' => 'search-form')); ?>
        </div><!-- .entry-footer -->
    </div>