
<?php
/**
 * The header for nostalgia theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package e-origami
 */
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;
?>

        </div> <!-- nostalgia-main -->
    </div> <!-- #page -->

    <!-- Modal BEGIN -->
    <div class="modal fade" id="searchModal" tabindex="-1" aria-labelledby="searchModalLabel" aria-hidden="true">
      <div class="modal-dialog  modal-lg modal-dialog-centered">
        <div class="modal-content nostalgia-search-modal">
          <div class="modal-body">
            <?php get_search_form(); ?>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal END -->
    <!-- Back to Top button -->
    <button id="backToTop" class="btn btn-primary rounded-circle" aria-label="Torna all'inizio della pagina">
      <i class="fa-solid fa-hand-pointer" aria-hidden="true"></i>
    </button>
    <?php wp_footer(); ?>
  </body>
</html>