<?php
/**
 * Displays the custom logo if one is set in the customizer, otherwise show the fallback
 *
 * @package underscores
 */

defined( 'ABSPATH' ) || exit; // Exit if accessed directly.

if ( ! function_exists( 'underscores_custom_logo' ) ) :
  function underscores_custom_logo() {
    if ( ! empty( the_custom_logo() ) ) {

      the_custom_logo();

    } else {

      $home_url = esc_url( get_home_url( '/' ) );
      $blog_name = get_bloginfo( 'name' );
      $aria_current_page = is_front_page() ? 'aria-current=page' : '';

      echo "<a href='{$home_url}' rel='home' ${aria_current_page}>{$blog_name}</a>";

    }
  }
endif;