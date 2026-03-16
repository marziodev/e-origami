<article id="post-<?php the_ID(); ?>" <?php post_class('origami-frontroll'); ?>>
    <div class="origami-frontroll-thumbnail">
    <?php echo get_origami_featured(get_the_ID()); ?>
    </div>
    <div class="origami-frontroll-content">
        <h2 class="origami-frontroll-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        <div class="origami-frontroll-tags">
            <?php echo origami_tag_list(get_the_ID()); ?>
        </div>
        <div class="origamiroll-entry-content">
            <?php
            the_excerpt();
            ?>
        </div><!-- .entry-content -->
        <div class="entry-footer">
            <div class="entry-meta">
                <span class="origami-posted-by"><?php the_author(); ?></span>
                <span class="origami-posted-on">Pubblicato:&nbsp;
                    <?php echo get_the_date('d/m/Y'); ?>
                </span>
            </div><!-- .entry-meta -->    
        </div><!-- .entry-footer -->        
    </div>
</article>