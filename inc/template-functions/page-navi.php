<?php
/**
 * Display pagination wihtin a nav element.
 *
 * @link https://developer.wordpress.org/reference/functions/paginate_links/
 */

defined( 'ABSPATH' ) || exit; // Exit if accessed directly.

if ( ! function_exists( 'underscores_page_navi' ) ) :
  function underscores_page_navi() {

    $paginate_links = paginate_links( array(
      'mid_size' => 2, // How many numbers to either side of the current pages.
      'prev_next' => true, // Show previous / next links
      'prev_text' => 'Previous',
      'next_text' => 'Next',
      'type'  => 'array',
    ) );

    // Display the pagination if more than one page is found.
    if ( is_array( $paginate_links ) ) {
      echo '<nav class="pagination" aria-label="pagination">';
        echo '<ul class="flex" role="list">';
          foreach ( $paginate_links as $link ) {
            echo "<li>{$link}</li>";
          }
        echo '</ul>';
      echo '</nav><!--// end .pagination -->';
    }
  }
endif;