<?php
/**
 * e-origami functions and definitions - Theme support
 */
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Remove Gutenberg functionality.
 */
require_once get_template_directory() . '/inc/gutenberg.php';

/**
 * Include User customization functionalities
 */
require_once get_template_directory() . '/inc/userdata.php';

/**
 * Include Customizer functionality
 */
// require_once get_template_directory() . '/inc/customizer.php';

/**
 * Include Bootstrap 5 navwalker 
 */
require_once get_template_directory() . '/inc/bootstrap-nav-walker.php';

/**
 * Include Bootstrap 5 pagination /srv/www/htdocs/dev/wp-content/themes/e-origami/inc/wp-bootstrap5.0-pagination.php
 */
require_once get_template_directory() . '/inc/wp-bootstrap5.0-pagination.php';

/**
 * Theme setup: Register support for various WordPress features.
 */
function origami_setup(){
    // Add theme support for automatic title tag
    add_theme_support( 'title-tag' );

    // Add theme support for post thumbnails
    add_theme_support( 'post-thumbnails' );

    // Add theme support for custom logo
    add_theme_support( 'custom-logo', array(
        'height' => 100,
        'width' => 100,
        'flex-height' => true,
        'flex-width' => true,
        'header-text' => array( 'site-title', 'site-description' ),
        'unlink-homepage-logo' => false,
    )  );

    // Add theme support for HTML5 markup
    add_theme_support( 'html5', array( 
        'comment-list', 
        'comment-form', 
        'search-form', 
        'gallery', 
        'caption', 
        'style', 
        'script'  
        ) );

    // Add theme support for responsive embedded content
    add_theme_support( 'responsive-embeds' );

    // Add theme support for Widget edit icons in customizer
    add_theme_support( 'customize-selective-refresh-widgets' );

    // Add theme support for menus
    add_theme_support( 'menus' );

    // Register navigation menus
    register_nav_menus(
        array(
            'primary' => __( 'Primary Menu', 'e-origami' ),
            'shodo' => __( 'Shodo Menu', 'e-origami' ),
            'nostalgia' => __( 'Nostalgia Menu', 'e-origami' ),
        )
    );

    // Add theme support for automatic feed links
    add_theme_support( 'automatic-feed-links' );    

    // Adding excerpt for page
    add_post_type_support( 'page', 'excerpt' );
}
add_action( 'after_setup_theme', 'origami_setup' );

/**
 * Enqueue scripts and styles using a singletons pattern.
 */
Class Origami_Enqueue {
    private static $instance = null;

    public static function get_instance() {
        if ( null == self::$instance ) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    private function __construct() {
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_styles' ) );
    }

    public function enqueue_scripts() {
        // Enqueue main script
        wp_enqueue_script( 'mein-script', get_template_directory_uri() . '/js/main.js', array( 'jquery' ), '1.0', true );

        // Bootstrap functionality
        wp_enqueue_script( 'bootstrap', get_template_directory_uri() . '/assets/bootstrap/js/bootstrap.bundle.min.js', array( 'jquery' ), '5.3.7', true );
    }

    public function enqueue_styles() {
        // Bootstrap stylesheet
        wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/bootstrap/css/bootstrap.min.css', array(), '5.3.7' );

        // Font Awesome stylesheet
        wp_enqueue_style( 'font-awesome', get_template_directory_uri().'/assets/fontawesome/css/all.min.css' );

        // Enqueue main stylesheet
        wp_enqueue_style( 'e-origami-style', get_stylesheet_uri() );
        
        // Enqueue custom stylesheet if template name is 'Shodo'
        if (is_page_template( 'page-shodo.php' ) ) {
            wp_enqueue_style( 'shodo-style', get_template_directory_uri().'/style-shodo.css' );
        }

        // Enqueue custom stylesheet if template name is 'Nostalgi'
        if (is_page_template( 'page-nostalgia.php' ) ) {
            wp_enqueue_style( 'nostalgia-style', get_template_directory_uri().'/style-nostalgia.css' );
        }        

    }
}
Origami_Enqueue::get_instance();

// Disables Emojis scripts & Styles to reduce page load
remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
remove_action( 'wp_print_styles', 'print_emoji_styles' );

// Removes comments feed
add_filter('feed_links_show_comments_feed', '__return_false');   

/**
 * function origami_users_full(): retrieves user full data from
 * get_users(), get_user_meta() and get_userdata() functions.
 */
function origami_users_full(){
    global $wpdb;
    $users = get_users(array( 'fields' => array( 'ID' ) ));
    $user_data = array();
    foreach($users as $user){
        $meta = get_user_meta($user->ID);
        $image = wp_get_attachment_image_src($meta['profile_image'][0], 'medium', 'false');
        $user_data[$user->ID] = array(
            'ID' => $user->ID,
            'display_name' => get_userdata($user->ID)->display_name,
            'profile_image' => $image[0],
            'job_title' => get_user_meta($user->ID)['job_title'][0],
            'tagline' => get_user_meta($user->ID)['tagline'][0],
        );
    }
    asort($user_data);
    return $user_data;
}

/*
 * Aggiunge i meta fields (custom fields) alla response REST
 * https://developer.wordpress.org/rest-api/extending-the-rest-api/modifying-responses/#post-type-specific-meta
 *
 */
function origami_register_meta(){
    register_meta( 'post', 'ict', array(
        'show_in_rest' => true,
        'single'       => true,
        'type'         => 'string',
    ) );
    register_meta( 'post', 'opensource', array(
        'show_in_rest' => true,
        'single'       => true,
        'type'         => 'string',
    ) );
    register_meta( 'post', 'webdev', array(
        'show_in_rest' => true,
        'single'       => true,
        'type'         => 'string',
    ) );
    register_meta( 'post', 'wordpress', array(
        'show_in_rest' => true,
        'single'       => true,
        'type'         => 'string',
    ) );
    
}
add_action( 'init', 'origami_register_meta' );

/**
 * Image sizes for responsive design and art direction with PICTURE tag
 * See: https://www.w3schools.com/tags/tag_picture.asp
 * 
 * hero-xl: desktop                     ≥1200px
 * hero: tablet landscape               ≥768px
 * hero-tb: tablet portrait             ≥576px
 * hero-md: average phones              ≥380px
 * hero-sm: small phones                <380px
 * 
 */

add_image_size( 'hero-xl', 1000, 1000, array('center', 'center') );
add_image_size( 'hero', 640, 1130, array('center', 'center') );
add_image_size( 'hero-tb', 480, 600, array('center', 'center') );
add_image_size( 'hero-md', 415, 900, array('center', 'center') );
add_image_size( 'hero-sm', 360, 640, array('center', 'center') );


/**
 * Function get_origami_picture($post_id): returns picture tag with srcset attribute
 * for responsive image:
 * 1. takes the post_id
 * 2. checks if the post has a featured image
 * 3. if no uses the home page post_id as fallback
 * 4 if yes uses the different image sizes as set in "add_image_size()" functions and uses them to feed the srcset attribute
 * 5. returns the picture tag with srcset attribute.
 * 
 * @param int $post_id
 * @return string $picture_tag
 */
function get_origami_picture($post_id){
    $picture_tag = '<picture>';
    $hasit = has_post_thumbnail($post_id);
    if(!$hasit){
        $post_id = '56';
    }
    $alt = get_the_title($post_id);
    $image_sizes = array(
        'hero-xl' => 'min-width: 1200px',
        'hero' => 'min-width: 760px',
        'hero-tb' => 'min-width: 576px', 
        'hero-md' => 'min-width: 380px', 
        'hero-sm' => 'max-width: 379px' );        
    $image_sizes = array_filter($image_sizes);

        foreach($image_sizes as $key => $value){ // $key
            $image_url = get_the_post_thumbnail_url($post_id, $key); // $key
            $picture_tag .= '<source srcset="' . $image_url . '" media="(' . $value . ')">';
        }
        $picture_tag .= '<img src="' . get_the_post_thumbnail_url($post_id, 'hero-sm') . '" alt="'.$alt.'" class="img-fluid">';
        $picture_tag .= '</picture>';

    return $picture_tag;
}

/**
 * function get_origami_featured($post_id, $size = 'medium'): returns the featured image url
 * for the post preview in blogroll, archive and SERP. It defaults to 'medium' size.
 * if there is no featured image, gets the ID from the home page and uses that as fallback.
 */
function get_origami_featured($post_id, $size = 'medium') {
    $post_id = has_post_thumbnail($post_id) ? $post_id : $post_id = '56';
    $image_url = get_the_post_thumbnail_url($post_id, $size);
    $full_tag = '<img src="' . $image_url . '" alt="' . get_the_title($post_id) . '" class="img-fluid blogroll" />';

    return $full_tag;
}

/**
 * FORSE NON NECESSARIO
 * function get_origami_thumbnail($post_id, $size = 'thumbnail'): returns the featured image url
 * for the post preview in blogroll of the front page. It defaults to 'thumbnail' size.
 * if there is no featured image, gets the ID from the home page and uses that as fallback.
 */
function get_origami_thumbnail($post_id, $size = 'thumbnail') {
    $post_id = has_post_thumbnail($post_id) ? $post_id : $post_id = '2';
    $image_url = get_the_post_thumbnail_url($post_id, $size);
    $full_tag = '<img src="' . $image_url . '" alt="' . get_the_title($post_id) . '" class="img-fluid" />';

    return $full_tag;
}

/**
 * initializing theme widgets
 */
function origami_widgets_init() {
    register_sidebar( array(
        'name'          => esc_html__( 'Footer Full one', 'e-origami' ),
        'id'            => 'footerfullone',
        'description'   => esc_html__( 'Add widgets here.', 'e-origami' ),
        'before_widget' => '<div id="%1$s" class="footer-widget %2$s dynamic-classes origami-footer-widget">',
        'after_widget'  => '</div><!-- .footer-widget -->',
        'before_title'  => '<h3 class="origami-widget-title">',
        'after_title'   => '</h3>',
        ) 
    );
    register_sidebar(
        array(
            'name'          => __( 'Footer Not Found', 'e-origami' ),
            'id'            => 'footernotfound',
            'description'   => __( 'Full sized footer widget with dynamic grid', 'e-origami' ),
            'before_widget' => '<div id="%1$s" class="origami-notfound-widget %2$s dynamic-classes origami-notfound-widget">',
            'after_widget'  => '</div><!-- .footer-widget -->',
            'before_title'  => '<h2 class="origami-widget-title">',
            'after_title'   => '</h2>',
        )
    );
}
add_action( 'widgets_init', 'origami_widgets_init' );

/**
 * function origami_tag_list($post_id): takes the post id and returns the tags list for the post
 */
function origami_tag_list($post_id) {
    $tags = get_the_tags($post_id);
    $tag_list = '';
    if ($tags) {
        $tag_list = '<ul class="origami-tags-list">';
        foreach ($tags as $post_tag) {
            $tag_link = get_tag_link($post_tag->term_id);
            if ($tag_link) {
               // printf('<li><a href="%s" title="%s">%s</a></li>', esc_url($tag_link), esc_attr($post_tag->name), esc_html($post_tag->name));
                $tag_list .= '<li><a href="' . $tag_link . '" title="' . esc_attr($post_tag->name) . '">' . esc_html($post_tag->name) . '</a></li>';
            }
        }
        $tag_list .= '</ul>';
    }
    return $tag_list;
}

/**
 * function origami_custom_title(): returns the custom title for the index.php page
 *
 */
function origami_custom_title() {
    $title = '';

    if (is_search()) {
        $title = 'Risultati per "' . get_search_query() . '"';
    } elseif (is_category()) {
        $title = single_cat_title('', false);
    } elseif (is_tag()) {
        $title = 'Tag: ' . single_tag_title('', false);
    } elseif (is_archive()) {
        $title = 'Archivio: ' . get_the_archive_title();
    } else {
        $title = 'Blogroll';
    }

    return $title;
}

/**
 * WordPress Social Media Shortcode Function
 * Creates a flexible shortcode for displaying social media links
 * 
 * Usage: [social_media name="Facebook" url="https://facebook.com/yourpage" description="Follow us on Facebook"]
 * 
 * @param array $atts Shortcode attributes
 * @return string HTML output for the social media link
 */
function social_media_shortcode($atts) {
    // Set default attributes
    $atts = shortcode_atts(array(
        'name' => '',
        'url' => '',
        'description' => '',
        'class' => 'social-link',
        'target' => '_blank',
        'rel' => 'noopener noreferrer'
    ), $atts, 'social_media');
    
    // Validate required attributes
    if (empty($atts['name']) || empty($atts['url'])) {
        return '<span class="social-media-error">Error: Social media name and URL are required.</span>';
    }
    
    // Sanitize inputs
    $name = sanitize_text_field($atts['name']);
    $url = esc_url($atts['url']);
    $description = !empty($atts['description']) ? sanitize_text_field($atts['description']) : "Visit our $name page";
    $custom_class = sanitize_html_class($atts['class']);
    $target = sanitize_text_field($atts['target']);
    $rel = sanitize_text_field($atts['rel']);
    
    // Transform name for FontAwesome icon class
    $icon_name = strtolower($name);
    // Handle special cases for FontAwesome icon names
    $icon_mapping = array(
        'instagram' => 'instagram',
        'bluesky' => 'bluesky',
        'linkedin' => 'linkedin',
        'twitter' => 'x-twitter'
    );
    
    // Use mapped icon name if available, otherwise use the lowercased name
    $fa_icon_name = isset($icon_mapping[$icon_name]) ? $icon_mapping[$icon_name] : $icon_name;
    
    $html = '<a 
    href="'.$url.'" 
    class="'.$custom_class.'" 
    title="'.esc_attr($description).'" 
    target="'.$target.'" 
    rel="'.$rel.'" 
    role="link"
    aria-label="'.esc_attr($description).'"
    data-social="'.esc_attr($icon_name).'" 
    data-icon="fa-brands fa-'.esc_attr($fa_icon_name).'"><i class="fab fa-'.esc_attr($fa_icon_name).'"></i>
    </a>';

    return $html;
}

// Register the shortcode
add_shortcode('social_media', 'social_media_shortcode');


/**
 *  Custom excerpt length + more link
*/
function origami_excerpt_length($length) {
    return 45;
}
add_filter('excerpt_length', 'origami_excerpt_length', 999);


function origami_excerpt_more( $more ) {
    return '... <a href="' . get_permalink( get_the_ID() ) . '">Continua a leggere</a>';
}
add_filter( 'excerpt_more', 'origami_excerpt_more' );

function shodo_excerpt($post_id, $excerpt_length = 25, $read_more_text = 'Continua a leggere') {
    // Get the post object
    $post = get_post($post_id);

    // Get the post content
    $content = $post->post_content;

    // Create the excerpt
    $excerpt = wp_trim_words($content, $excerpt_length, '...');

    // Create the "Read More" link
    $read_more_link = get_permalink($post_id);

    // Output the excerpt and the "Read More" link
    return $excerpt . ' <a href="' . $read_more_link . '">' . $read_more_text . '</a>';
}

/**
 * function origami_stat_card($post_id): takes the post ID an retrieves the custom fields keys and values.
 * The risult is filtered by the array of the custom fields inserted by the user, the result is then splitted 
 * by the separator charachter into an array used to feed the card template.
 * @param $post_id
 * @return string
 */
function origami_stat_card($post_id) {
    $result = '';
    //$post_id = $post_id ?? 56;
    $custom_fields = get_post_custom($post_id);
    $labels = array('ict','webdev','wordpress','opensource');
    $separator = "|";
    foreach ($labels as $label) {
        if(array_key_exists($label,$custom_fields)){
            foreach ($custom_fields[$label] as $custom_field) {
                $parts = explode($separator, $custom_field);
                    $result .= '<div class="origami-stat-card">';
                    $result .= '<div class="stat-card-icona">'.$parts[3].'</div>';
                    $result .= '<div class="stat-data-container">'; 
                    $result .= '    <span class="stat-data-numero big counter" data-count="'.$parts[0].'">0</span>';
                    $result .= '    <span class="stat-data-dato big">'.$parts[1].'</span>';
                    $result .= '    <span class="stat-data-spec">'.$parts[2].'</span>';
                    $result .= '</div> <!-- stat-data-container -->';
                    $result .= '</div> <!-- origami-stat-card -->';
            }
        }
    }
    
    return $result;
}


/**
 * Add categories to pages (optionally tags)
 */
function add_categories_to_pages() {
    register_taxonomy_for_object_type('category', 'page');
    // register_taxonomy_for_object_type('post_tag', 'page');
}
add_action('init', 'add_categories_to_pages');


/**
 * function get_nostalgia_title(): takes the title and returns the title splitted in
 * styleable SPAN elements.
 * 
 * str_split()
 * 
 */
function get_nostalgia_title() {
    $hone = get_bloginfo( 'name' );
    $title = str_split($hone);
    $result = '<h1 class="nostalgia-site-title-text" role="heading" aria-level="1" aria-label="'.$hone.'">';
    foreach ($title as $letter) {
        $result .= '<span class="nostalgia-letter">'.$letter.'</span>';
    }
    $result .= '</h1>';
    return $result;
}


/**
 * Origami Document Download Widget
 * 
 *  The widget creates a download link in this format:
 *   <a download="[filename.extension]" href="[document_link]" title="[filename]" class="[class]">[text]</a>
 *  The parameters of the widget are:
 *    "Documento": it's the link to the document itself, obtained by accessing the site's media library, and it is the "document_link" in the example above.
 *    "File e estensione": it's the "filename.extension" in the example above, the default is the title of "post_type: attachment" that contains the file followed by the extension, but the user can modify it.
 *    "Tipo" (radio: "Bottone"/"Link"): the user can choose between a plain link ("Link") or a button ("Bottone") and this will affect the "class" parameter.
 *        Option "Bottone": class="btn btn-outline-dark btn-lg btn-block".
 *        Option "Link": class="origami-doc-link".
 *    "Testo": free text to insert into the the link ("text" in the example above).
 *    The "title" attribute: to be filled with the title of "post_type: attachment" that contains the file chosen (this is automatically filled).
 */
class Origami_Document_Download_Widget extends WP_Widget {

    public function __construct() {
        parent::__construct(
            'origami_document_download_widget',
            __('Origami Document Download', 'e-origami'),
            array('description' => __('Crea un link di download a un documento della Media Library', 'e-origami'))
        );
    }

    public function widget($args, $instance) {
        echo $args['before_widget'];

        $document_id = !empty($instance['document']) ? intval($instance['document']) : 0;
        $type        = !empty($instance['type']) ? $instance['type'] : 'link';
        $text        = !empty($instance['text']) ? $instance['text'] : '';
        $filename    = !empty($instance['filename']) ? $instance['filename'] : '';

        if ($document_id) {
            $document_url   = wp_get_attachment_url($document_id);
            $document_title = get_the_title($document_id);

            if (empty($filename)) {
                $file_info = pathinfo(get_attached_file($document_id));
                $filename  = $file_info['basename'];
            }

            $class = ($type === 'button')
                ? 'btn btn-outline-dark btn-lg btn-block'
                : 'origami-doc-link';

            printf(
                '<a download="%s" href="%s" title="%s" class="%s">%s</a>',
                esc_attr($filename),
                esc_url($document_url),
                esc_attr($document_title),
                esc_attr($class),
                esc_html($text)
            );
        }

        echo $args['after_widget'];
    }

    public function form($instance) {
        $document_id = !empty($instance['document']) ? intval($instance['document']) : '';
        $type        = !empty($instance['type']) ? $instance['type'] : 'link';
        $text        = !empty($instance['text']) ? $instance['text'] : '';
        $filename    = !empty($instance['filename']) ? $instance['filename'] : '';
        ?>
        <p>
            <label for="<?php echo $this->get_field_id('document'); ?>"><?php _e('Documento:', 'e-origami'); ?></label>
            <input type="hidden" class="widefat origami-doc-id" id="<?php echo $this->get_field_id('document'); ?>" name="<?php echo $this->get_field_name('document'); ?>" value="<?php echo esc_attr($document_id); ?>">
            <button class="button origami-upload-media"><?php _e('Seleziona dalla Media Library', 'e-origami'); ?></button>
            <span class="origami-doc-preview"><?php echo $document_id ? esc_html(get_the_title($document_id)) : ''; ?></span>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('filename'); ?>"><?php _e('File e estensione:', 'e-origami'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('filename'); ?>" name="<?php echo $this->get_field_name('filename'); ?>" type="text" value="<?php echo esc_attr($filename); ?>">
        </p>
        <p>
            <label><?php _e('Tipo:', 'e-origami'); ?></label><br>
            <label><input type="radio" name="<?php echo $this->get_field_name('type'); ?>" value="link" <?php checked($type, 'link'); ?>> <?php _e('Link', 'e-origami'); ?></label><br>
            <label><input type="radio" name="<?php echo $this->get_field_name('type'); ?>" value="button" <?php checked($type, 'button'); ?>> <?php _e('Bottone', 'e-origami'); ?></label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id('text'); ?>"><?php _e('Testo:', 'e-origami'); ?></label>
            <input class="widefat" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>" type="text" value="<?php echo esc_attr($text); ?>">
        </p>
        <?php
    }

    public function update($new_instance, $old_instance) {
        $instance              = array();
        $instance['document']  = !empty($new_instance['document']) ? intval($new_instance['document']) : '';
        $instance['filename']  = !empty($new_instance['filename']) ? sanitize_text_field($new_instance['filename']) : '';
        $instance['type']      = !empty($new_instance['type']) ? sanitize_text_field($new_instance['type']) : 'link';
        $instance['text']      = !empty($new_instance['text']) ? sanitize_text_field($new_instance['text']) : '';
        return $instance;
    }
}

// Registra il widget
add_action('widgets_init', function() {
    register_widget('Origami_Document_Download_Widget');
});

// Aggiunge lo script per aprire la Media Library nell’admin
add_action('admin_footer-widgets.php', function() {
    ?>
    <script type="text/javascript">
    jQuery(document).ready(function($) {
        function initMediaSelector(button) {
            var frame;
            button.on('click', function(e) {
                e.preventDefault();
                if (frame) {
                    frame.open();
                    return;
                }
                frame = wp.media({
                    title: 'Seleziona un documento',
                    button: { text: 'Usa questo documento' },
                    multiple: false
                });
                frame.on('select', function() {
                    var attachment = frame.state().get('selection').first().toJSON();
                    button.siblings('.origami-doc-id').val(attachment.id).trigger('change');
                    button.siblings('.origami-doc-preview').text(attachment.title);
                });
                frame.open();
            });
        }
        $('.origami-upload-media').each(function() {
            initMediaSelector($(this));
        });
    });
    </script>
    <?php
});


/*
 * the_socialshare(): stampa direttamente i pulsanti di condivisione utilizzando 
 * la funzione get_socialshare() e utilizzando gli stessi parametri
 * Uso:
 *   <?php the_socialshare(['linkedin','bluesky','x']); ?>
 */
function the_socialshare($platforms = ['linkedin', 'x', 'whatsapp']) {
	echo get_socialshare($platforms);
}

/*
 * get_socialshare(): prende come parametri gli "slug" (nomi "database-friendly") dei social network
 * sottoforma di array, e restituisce l'HTML dei pulsanti basati su FontAwesome.
 * RICHIEDE FontAwesome versione > 6.6.
 * La classe "show-mobile" (presente solo nel link per WhatsApp) può essere usata per nascondere
 * il pulsante su desktop
 * 
 * Uso:
 *  <?php echo get_socialshare(['linkedin','bluesky','x']); ?>
 */
function get_socialshare($platforms = ['linkedin', 'x', 'whatsapp']) {
	$title     = rawurlencode(get_the_title());
	$permalink = rawurlencode(get_the_permalink());

	$out = '<span class="share-on-click hide">';

	foreach ($platforms as $p) {
		switch (strtolower($p)) {
			case 'linkedin':
				$out .= '<a class="ln" href="https://www.linkedin.com/shareArticle?mini=true&url=' . $permalink . '&title=' . $title . '" target="_blank" rel="noopener noreferrer" title="Condividi su LinkedIn" aria-label="Condividi questo articolo su LinkedIn">
				<i class="fa-brands fa-linkedin"></i>
				</a>';
		break;

			case 'x':
				$out .= '<a class="x" href="https://twitter.com/intent/tweet?url=' . $permalink . '&text=' . $title . '" target="_blank" rel="noopener noreferrer" title="Condividi su X (Twitter)" aria-label="Condividi questo articolo su X (Twitter)">
				<i class="fab fa-x-twitter"></i>
				</a>';
		break;

			case 'bluesky':
				$out .= '<a class="bs" href="https://bsky.app/intent/compose?text=' . $title . '%20' . $permalink . '" target="_blank" rel="noopener noreferrer" title="Condividi su Bluesky" aria-label="Condividi questo articolo su Bluesky">
				<i class="fab fa-bluesky"></i>
				</a>';
		break;

			case 'whatsapp':
				$out .= '<a class="wa show-mobile" href="https://api.whatsapp.com/send?text=' . $title . '%20–%20' . $permalink . '" target="_blank" rel="noopener noreferrer" title="Condividi su WhatsApp" aria-label="Condividi questo articolo su WhatsApp">
				<i class="fab fa-whatsapp"></i>
				</a>';
		break;

			case 'mastodon':
				$out .= '<a class="ma" href="https://mastodon.social/share?text=' . $title . '%20' . $permalink . '" target="_blank" rel="noopener noreferrer" title="Condividi su Mastodon" aria-label="Condividi questo articolo su Mastodon">
				<i class="fab fa-mastodon"></i>
				</a>';
		break;
		}
	}

	$out .= '</span>';
	return $out;
}


/**
 * SICUREZZA:
 * - origami_login_error_message()
 * - origami_custom_login_url()
 * - origami_custom_login_redirect()
 * - origami_custom_login_action()
 * - origami_custom_login_redirect()
 * - origami_protect_default_login()
 * - disabilito XML-RPC
 * 
 * Aggiungere a .htaccess: 
 *  <Files xmlrpc.php>
 *      Require all denied
 *  </Files>
 */

/**
 * function origami_login_error_message(): cambio il messaggio di errore per il login: 
 * i default sono PERICOLOSI
 */
function origami_login_error_message() {
    return '<strong>YOU SHALL NOT PASS</strong><br /> Per favore, controlla il tuo account o smetti di fare il furbo.';
}
add_filter('login_errors', 'origami_login_error_message');


/**
 * function origami_custom_login_url(): cambio la pagina di login
 *
 */
function origami_custom_login_url() {
    return site_url('/wp-origami.php', 'login');
}
add_filter('login_url', 'origami_custom_login_url', 10, 3);


/**
 * Cambio anche la "login form action" per puntare al file custom di login (wp-origami.php)
 * 
 */
function origami_custom_login_action($login_post) {
    return site_url('/wp-origami.php', 'login_post');
}
add_filter('login_post_url', 'origami_custom_login_action', 10, 2);


/**
 * function origami_custom_login_redirect(): rendo la URL di login inaccessibile 
 * dal redirect da wp-admin se l'utente non è loggato
 *
 */
function origami_custom_login_redirect() {
    if (strpos($_SERVER['REQUEST_URI'], 'wp-admin') !== false && !is_user_logged_in()) {
        wp_safe_redirect(home_url('/pagina-non-trovata'));
        exit;
    }
}
add_action('init', 'origami_custom_login_redirect');


/**
 * function origami_protect_default_login(): protegge l'accesso diretto a wp-login.php 
 * reindirizzando alla home
 * 
 * Impedisco l'accesso non autorizzato al login standard di WordPress,
 * forzando l'utilizzo del login personalizzato (wp-origami.php).
 * 
 * Casi gestiti:
 * - Blocca GET a wp-login.php (scanner, bot, accessi diretti)
 * - Permette POST per l'invio del form di login da wp-origami.php
 * - Permette accesso se l'utente è già autenticato (per redirect interni WP)
 * - Permette logout standard di WordPress
 * - Non blocca wp-origami.php (login personalizzato)
 * 
 * Note per manutenzione:
 * - Se aggiungi funzionalità come "password dimenticata", verifica le action:
 *   'lostpassword', 'rp', 'resetpass', 'register'
 * - Se usi plugin che accedono a wp-login.php, potrebbero servire ulteriori eccezioni
 * - Il redirect alla home è silenzioso (no 404) per non rivelare URL validi ai bot
 * 
 * @hook login_init (priorità 1 - esegue prima di altri hook di login)
 * @see origami_custom_login_url() per la definizione dell'URL personalizzato
 * 
 */
function origami_protect_default_login() {
    global $pagenow;
    
    if ($pagenow === 'wp-login.php' && 
        $_SERVER['REQUEST_METHOD'] !== 'POST' &&    // Permetti POST per form login
        !is_user_logged_in() &&                     // Permetti se già autenticato
        strpos($_SERVER['REQUEST_URI'], 'wp-origami.php') === false && // Permetti login custom
        (!isset($_GET['action']) || $_GET['action'] !== 'logout')) { // Permetti logout
        
        wp_safe_redirect(home_url());
        exit;
    }
}
add_action('login_init', 'origami_protect_default_login', 1);


/**
 * Disabilito XML-RPC per evitare attacchi
 */
add_filter('xmlrpc_enabled', '__return_false');

add_filter('request', 'remove_xy_from_search');
function remove_xy_from_search($query_vars) {
    unset($query_vars['x'], $query_vars['y']);
    return $query_vars;
}