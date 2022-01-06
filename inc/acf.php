<?php
/**
 * Functions which expand and enable ACF features
 *
 * @package underscores
 */

defined( 'ABSPATH' ) || exit; // Exit if accessed directly.

/**
 * Hide the custom fields menu from users except the developers
 */
function underscores_acf_show_admin( $show ) {
  $current_user = wp_get_current_user();

  if ( stripos( $current_user->user_login, '-dev' ) === false ) {
    $show = false;
  }

  return $show;
}
add_filter('acf/settings/show_admin', 'underscores_acf_show_admin');

/**
 * Init ACF options pages
 *
 * @package underscores
 */
function underscores_options_init() {
  if( function_exists( 'acf_add_options_page' ) ) {

    acf_add_options_page( array(
      'page_title' 	=> 'Theme Settings',
      'menu_title'	=> 'Theme Settings',
      'menu_slug' 	=> 'theme-settings',
      'capability'	=> 'edit_posts',
      'redirect'		=> false
      ) );

  }
}
add_action('acf/init', 'underscores_options_init');

/**
 * Adds custom block categories
 *
 * @package underscores
 */
function underscores_block_categories( $categories ) {
	return array_merge(
		$categories,
		[
			[
				'slug'  => 'custom-blocks',
				'title' => __( 'Custom Blocks', 'underscores' ),
			],
		]
	);
}
add_action( 'block_categories_all', 'underscores_block_categories', 10, 2 );

/**
 * Init ACF blocks
 *
 * @package underscores
 */
function underscores_acf_blocks_init() {
  require get_template_directory() . '/inc/acf-blocks/register-testimonial-block.php';
}
add_action('acf/init', 'underscores_acf_blocks_init');

/**
 * Fixes persistent issue where acf fields do not show up in the preview when Gutenberg is enabled
 *
 * https://github.com/AdvancedCustomFields/acf/issues/186
 */
function underscores_preview_acf_fields ($value, $id, $field) {
  if ( ! is_preview()) {
      return $value;
  }

  static $tested = [];
  if (in_array($field['name'] . $id, $tested)) {
      return $value;
  }
  $tested[] = $field['name'] . $id;
  if (empty($value) && ($parentId = wp_get_post_parent_id($id))) {
      add_filter('acf/pre_load_post_id', function ($id, $passed) use ($parentId) {
          if ($id !== null) {
              return $id;
          }

          return $parentId === $passed ? $parentId : $id;
      }, 10, 2);
      $parentVal = get_field($field['name'], $parentId);

      return empty($parentVal) ? $value : $parentVal;
  }

  if ( ! empty($value)) {
      $children = get_children([
          'post_type'   => 'revision',
          'post_parent' => $id,
      ]);
      /** @var WP_Post $child */
      $child = reset($children);

      if (empty($child)) {
          return $value;
      }

      if (get_post_modified_time($child->ID) > get_post_modified_time($id)) {
          $childVal = acf_get_value($child->ID, $field);

          return empty($childVal) ? $value : $childVal;
      }
  }

  return $value;
}

add_filter('acf/load_value', 'underscores_preview_acf_fields', 10, 3);