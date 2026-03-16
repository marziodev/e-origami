<?php
/**
 * Template Name: Test Page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package e-origami
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

get_header();
?>

            <div class="col-md-8">
                <?php
                // $args = array(
                // 'role__not_in' => 'Subscriber',
                // 'fields' => 'all'
                //     );
                // // The Query
                // $user_query = new WP_User_Query( $args );
                // $data = $user_query->get_results();
                ?>
                <pre></pre> 
                    <?php
                    // $users = get_users( array( 'fields' => array( 'ID' ) ) );
                    // echo "<b>users</b><br>";
                    // print_r($users);
                    // echo "<br>########<br>";
                    // foreach($users as $user){
                    //         print_r(get_user_meta ( $user->ID));
                    //         echo "<br>------<br>";
                    //         print_r(get_userdata($user->ID ));
                    //         echo "<br>------<br>";
                    //         $userdata = get_userdata( $user->ID);
                    //         $display_name = $userdata->display_name;
                    //         echo "<b>".$display_name."</b><br>";
                    //     }
                    // echo "<hr>";
                    // print_r(origami_users_full());
                    $menus = wp_get_nav_menus();
                    echo "<pre";
                    print_r( $menus );
                    echo "</pre>";
                    if ( have_posts() ): while ( have_posts() ) : the_post(); 
                    ?>
                    <h1>HELLO!</h1>
                    <?php echo get_origami_picture($id);  ?>
                    <h2>Fine trasmissione</h2>
                    <?php
                        endwhile;
                    endif;
                    ?>
            </div>
            <?php
                echo 'lo shortcode è qui sotto';
                echo do_shortcode('[social_media name="Twitter" url="https://x.com/MarcioBize/" description="Twitter/X: Marzio Bonfanti"]');
            ?>
            <i class="fab fa-linkedin"></i>
        </div><!-- chiusura row -->
        <div class="row">
            <div class="col-md-6 order-md-3">
                MAIN
                <article>
                    <div class="origami-entry-header">
                        <h1 class="origami-entry-ttle">MAIN</h1>
                      <!-- Accessibility Controls - BEGIN -->
                        <div class="accessibility-controls" role="group" aria-label="Impostazioni di leggibilità">

                        <!-- Controllo dimensione testo -->
                        <div class="font-size-controls" role="group" aria-label="Dimensione testo">
                            <span 
                            class="font-ctrl normal-size magnified" 
                            role="button" tabindex="0"
                            aria-label="Dimensione testo normale" aria-pressed="true">
                                <i class="fa-solid fa-font"></i>
                            </span>
                            <span 
                            class="font-ctrl big-size" 
                            role="button" tabindex="0"
                            aria-label="Dimensione testo grande" aria-pressed="false">
                                <i class="fa-solid fa-font"></i>
                            </span>
                            <span 
                            class="font-ctrl bigger-size" 
                            role="button" tabindex="0"
                            aria-label="Dimensione testo molto grande" aria-pressed="false">
                                <i class="fa-solid fa-font"></i>
                            </span>
                        </div>
                        </div>
                        <!-- Accessibility Controls - END -->
                    </div>
                    <div class="origami-entry-content">
Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas nibh nulla, viverra vel viverra euismod, maximus vel nulla. Mauris at augue sit amet nunc consectetur luctus. Nunc et mauris nec justo mollis ultrices. Nunc fringilla leo id tellus blandit, congue euismod neque interdum. Praesent porttitor cursus bibendum. Nam pulvinar enim ac eros consectetur varius. Integer efficitur metus id ligula rutrum suscipit. Sed maximus nisl elit, quis suscipit ipsum eleifend ultrices. Pellentesque mauris orci, lobortis id congue sed, tristique at ligula. Nunc fringilla, justo ut lacinia porttitor, enim massa tincidunt libero, quis facilisis risus erat nec felis.

Nam sagittis odio sed vestibulum bibendum. Pellentesque sit amet vehicula lectus. Curabitur posuere elit augue, eget dapibus orci fringilla vestibulum. Cras venenatis ligula sed varius vestibulum. Ut imperdiet tincidunt est eu convallis. Maecenas magna dolor, venenatis et enim ac, eleifend vestibulum felis. Nam non massa eget nulla aliquet elementum. Nam erat est, imperdiet in velit ut, mattis scelerisque dolor. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia curae; Vivamus blandit mi quis tortor tristique, vel fringilla massa pretium. Duis id egestas augue, sed sollicitudin ante. Cras pharetra odio eu dolor aliquam posuere id quis nisi. Duis quis dui ac nisl iaculis congue. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Nunc nunc sapien, cursus a magna nec, aliquet egestas enim. Nullam ultrices auctor ligula eget tincidunt.

Vivamus ac felis tempus, auctor purus ut, viverra mi. Nunc semper nisl in felis euismod lobortis. Quisque vitae metus vitae neque cursus ullamcorper. Vivamus quam nisi, ornare vel semper sit amet, pulvinar finibus diam. Aliquam nec nulla eget quam iaculis consectetur pretium efficitur tortor. Nulla aliquet nunc neque, convallis porta magna aliquet at. In nec ornare eros. Aenean non faucibus risus, quis finibus neque. Curabitur efficitur purus lacus, sit amet cursus enim elementum vitae.

Nulla sed lectus vitae mauris pretium consequat. Praesent et hendrerit ipsum. Integer mollis mauris lorem, ut ullamcorper ipsum dignissim ut. Curabitur ullamcorper sed risus id dapibus. Nullam quam elit, pellentesque in est aliquet, condimentum hendrerit felis. Duis quis fringilla risus. Phasellus nec pretium arcu, eu molestie risus. Pellentesque id ligula pretium, hendrerit elit in, rhoncus felis. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam fermentum sodales tempus. Nulla ullamcorper tellus eu tristique porttitor. Nunc porta purus non arcu varius aliquam. Etiam hendrerit odio nec quam aliquet vehicula quis nec sapien. Donec mauris turpis, posuere et ornare ac, congue non felis. Quisque vehicula massa ut sapien viverra viverra.

Quisque turpis nunc, placerat in fermentum et, bibendum ut erat. Nullam sodales, ante sit amet volutpat dignissim, elit enim fringilla diam, eget consequat massa lectus vitae diam. Proin vitae malesuada dolor. Maecenas volutpat porttitor velit eu egestas. Sed euismod sollicitudin velit id gravida. Ut et euismod felis. Curabitur eget convallis leo. Nam ac lorem mollis, cursus velit in, fermentum sem. Aliquam varius eros sem, vulputate rhoncus nulla egestas a. Vestibulum gravida tempus diam, eget consequat tellus egestas ut. Suspendisse potenti. Ut in libero magna. Sed tellus est, tempor et velit eget, euismod imperdiet turpis. Fusce a vulputate mauris. Nam vulputate at orci tincidunt iaculis. Phasellus id nisl ac purus sagittis congue ac pellentesque ligula.
                    </div>
                </article>
            </div>    

 
<div class="col-md-2 order-1">
    SIDEBAR
</div>
<div class="col-md-2 order-md-2">
    TEAM
</div>




<?php
get_footer();