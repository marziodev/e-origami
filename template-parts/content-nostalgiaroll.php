<article id="post-<?php the_ID(); ?>" <?php post_class('nostalgia-frontroll'); ?> >
    <div class="nostalgia-frontroll-thumbnail">
    <figure class="nostalgia-frontroll-image">
        <?php echo get_origami_featured(get_the_ID()); ?>
        <figcaption class="nostalgia-frontroll-image-caption">
            <h2 class="nostalgia-frontroll-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
        </figcaption>
    </figure>    
    </div>
    <div class="nostalgia-frontroll-content">
        <div class="nostalgia-frontroll-tags">
            <?php echo origami_tag_list(get_the_ID()); ?>
        </div>
        <div class="nostalgiaroll-entry-content">
            <?php
            echo shodo_excerpt(get_the_ID());
            ?>
        </div><!-- .entry-content -->
        <div class="nostalgia-frontroll-entry-footer">
            <div class="entry-meta">
                <span class="nostalgia-posted-by"><?php the_author(); ?></span>
                <span class="nostalgia-posted-on">Pubblicato:&nbsp;
                    <?php echo get_the_date('d/m/Y'); ?>
                </span>
            </div><!-- .entry-meta -->    
        </div><!-- .entry-footer -->        
    </div>
</article>