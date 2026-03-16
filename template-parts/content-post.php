<article id="post-<?php the_ID(); ?>" <?php post_class('origami-blogroll'); ?>>
    <div class="origami-entry-thumbnail">
        <?php
        echo get_origami_featured(get_the_ID());
        ?>
    </div>
    <div class="origami-post-body">
        <div class="origami-entry-header">
            <a href="<?php the_permalink(); ?>" class="origami-permalink">   
            <?php the_title( '<h2 class="origami-entry-title">', '</h2>' ); ?>
        </a>
        <?php echo origami_tag_list(get_the_ID()); ?>
        </div><!-- .entry-header  role="article" -->
        <div class="origamiroll-entry-content">
            <?php
            the_excerpt();
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
            </div><!-- .entry-meta -->    
            <?php
            edit_post_link( esc_html__( 'Edit', 'e-origami' ), '<span class="edit-link">', '</span>' );
            ?>
        </div><!-- .entry-footer -->
    </div><!-- .origami-post-body -->
</article>   
           