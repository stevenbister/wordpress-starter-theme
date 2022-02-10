<?php
/**
 * Helper to get the post/page id including the posts(blog) page
 *
 * @package underscores
 */
defined( 'ABSPATH' ) || exit; // Exit if accessed directly.

if ( ! function_exists( 'underscores_post_id' ) ) :

  function underscores_post_id() {
    return is_home() ? (int) get_option( 'page_for_posts' ) : get_the_ID();
  }

endif;