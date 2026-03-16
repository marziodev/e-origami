<div class="content-team">
    <h3 class="origami-section-title">Team</h3>
    <div class="origami-card-container">
        <?php
        $users = origami_users_full();
        foreach($users as $user){
                $image = $user['profile_image'];
                $display_name = $user['display_name'];
                $job_title = $user['job_title'];
                $tagline = $user['tagline'];
                $user['ID'] == 3? $lang_attr='lang="ja-jp"' : $lang_attr = '';
                ?>
                <div class="card origami-card">
                <img src="<?php echo $image; ?>" class="card-img-top origami-card-image" alt="<?php echo $display_name; ?>">
                    <div class="card-body">
                        <h5 class="card-title origami-card-title"><?php echo $display_name; ?></h5>
                        <h6 class="card-subtitle origami-card-subtitle"><?php echo $job_title; ?></h6>
                        <p class="card-text origami-card-text small" <?php echo $lang_attr;?> ><?php echo $tagline; ?></p>
                    </div>
                </div>
                <?php
            }
        ?>

    </div>   

</div>