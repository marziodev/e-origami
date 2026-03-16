<div class="content-team">
    <div class="shodo-card-container card-group">
        <?php
        $users = origami_users_full();
        foreach($users as $user){
                $image = $user['profile_image'];
                $display_name = $user['display_name'];
                $job_title = $user['job_title'];
                $tagline = $user['tagline'];
                $user['ID'] == 3? $lang_attr='lang="ja-jp"' : $lang_attr = '';
                ?>
                <div class="card shodo-card">
                <img src="<?php echo $image; ?>" class="card-img-top origami-card-image" alt="<?php echo $display_name; ?>">
                    <div class="card-body">
                        <h4 class="card-title origami-card-title"><?php echo $display_name; ?></h4>
                        <h5 class="card-subtitle origami-card-subtitle"><?php echo $job_title; ?></h5>
                        <p class="card-text origami-card-text small" <?php echo $lang_attr;?> ><?php echo $tagline; ?></p>
                    </div>
                </div>
                <?php
            }
        ?>

    </div>   

</div>