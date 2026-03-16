<article id="post-<?php the_ID(); ?>" <?php post_class('shodo-frontroll'); ?>>
    <div class="shodo-frontroll-thumbnail">
        <a href="<?php the_permalink(); ?>">
           <?php echo get_origami_featured(get_the_ID(),'thumbnail'); ?>
        </a>
    </div>
    <h2 class="shodo-frontroll-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
</article>