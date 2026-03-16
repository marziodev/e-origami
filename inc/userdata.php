<?php
/**
 * Custom User Profile Fields
 * Adds Profile Image, Job Title, and Tagline to user profiles
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Enqueue WordPress media uploader scripts and styles
function origami_enqueue_admin_scripts($hook) {
    if ('profile.php' !== $hook && 'user-edit.php' !== $hook) {
        return;
    }

    wp_enqueue_media();
    wp_enqueue_script('jquery');
}
add_action('admin_enqueue_scripts', 'origami_enqueue_admin_scripts');

// Add custom fields to user profile
function origami_add_custom_user_profile_fields($user) {
    $attachment_id = (int) get_user_meta($user->ID, 'profile_image', true);
    $job_title     = get_user_meta($user->ID, 'job_title', true);
    $tagline       = get_user_meta($user->ID, 'tagline', true);
    ?>
    <h3>Custom Profile Information</h3>
    <table class="form-table">
        <!-- Profile Image -->
        <tr>
            <th><label for="profile_image">Profile Image</label></th>
            <td>
                <input type="hidden" name="profile_image" id="profile_image" value="<?php echo esc_attr($attachment_id); ?>" />
                <div id="profile_image_preview" style="margin-top: 10px;">
                    <?php if ($attachment_id): ?>
                        <?php echo wp_get_attachment_image($attachment_id, 'thumbnail', false, array('style' => 'max-width: 150px; height: auto;')); ?>
                    <?php endif; ?>
                </div>
                <p>
                    <button type="button" class="button" id="upload_image_button">Upload Image</button>
                    <button type="button" class="button" id="remove_image_button">Remove Image</button>
                </p>
            </td>
        </tr>

        <!-- Job Title -->
        <tr>
            <th><label for="job_title">Job Title</label></th>
            <td>
                <input type="text" name="job_title" id="job_title" value="<?php echo esc_attr($job_title); ?>" class="regular-text" />
            </td>
        </tr>

        <!-- Tagline -->
        <tr>
            <th><label for="tagline">Tagline</label></th>
            <td>
                <input type="text" name="tagline" id="tagline" value="<?php echo esc_attr($tagline); ?>" class="regular-text" />
            </td>
        </tr>
    </table>

    <script type="text/javascript">
    jQuery(document).ready(function($) {
        let file_frame;

        // Handle image upload
        $('#upload_image_button').on('click', function(e) {
            e.preventDefault();

            if (file_frame) {
                file_frame.open();
                return;
            }

            file_frame = wp.media.frames.file_frame = wp.media({
                title: 'Select or Upload Image',
                button: {
                    text: 'Use This Image'
                },
                multiple: false
            });

            file_frame.on('select', function() {
                const attachment = file_frame.state().get('selection').first().toJSON();
                $('#profile_image').val(attachment.id);
                $('#profile_image_preview').html('<img src="' + attachment.sizes.thumbnail.url + '" style="max-width: 150px; height: auto;" />');
            });

            file_frame.open();
        });

        // Handle image removal
        $('#remove_image_button').on('click', function() {
            $('#profile_image').val('');
            $('#profile_image_preview').html('');
        });
    });
    </script>
    <?php
}
add_action('show_user_profile', 'origami_add_custom_user_profile_fields');
add_action('edit_user_profile', 'origami_add_custom_user_profile_fields');

// Save custom profile fields
function origami_save_custom_user_profile_fields($user_id) {
    // Verify user capability
    if (!current_user_can('edit_user', $user_id)) {
        return false;
    }

    // Save profile image (attachment ID)
    if (isset($_POST['profile_image'])) {
        update_user_meta($user_id, 'profile_image', (int) $_POST['profile_image']);
    }

    // Save job title
    if (isset($_POST['job_title'])) {
        update_user_meta($user_id, 'job_title', sanitize_text_field($_POST['job_title']));
    }

    // Save tagline
    if (isset($_POST['tagline'])) {
        update_user_meta($user_id, 'tagline', sanitize_text_field($_POST['tagline']));
    }

}
add_action('personal_options_update', 'origami_save_custom_user_profile_fields');
add_action('edit_user_profile_update', 'origami_save_custom_user_profile_fields');  