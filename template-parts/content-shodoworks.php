<div class="content-team">
    <div class="shodo-works-container">
        <div class="card shodo-works">
        
            <div class="card-body">
                <?php the_title( '<h4 class="card-title shodo-works-title"><a href="' . get_permalink() . '" rel="bookmark">', '</a></h4>' ); ?>
                <img src="<?php  echo get_the_post_thumbnail_url(get_the_ID(), 'thumbnail'); ?>" class="card-img-top shodo-works-image" alt="<?php the_title();?>">
            </div>
        </div>
    </div>
</div>                