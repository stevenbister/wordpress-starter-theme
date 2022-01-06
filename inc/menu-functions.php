<?php
/**
 * Handles creating and setting menu areas
 *
 * @link https://developer.wordpress.org/themes/functionality/navigation-menus/
 *
 * @package underscores
 */

defined( 'ABSPATH' ) || exit; // Exit if accessed directly.

require get_template_directory() . '/classes/class-underscores-walker-nav-menu.php';

/**
 * Register the menus to sit in the site header
 */
function underscores_primary_menu() {
  $location = 'primary';

	wp_nav_menu(
		array(
			'theme_location'  => $location,
			'menu_id'         => $location . '-menu',
			'menu_class'      => 'md:flex md:flex-wrap',
      'container'       => 'ul',
			'items_wrap'      => '<ul id="%1$s" class="%2$s" role="list" x-bind:class="open ? \'\' : \'hidden\'">%3$s</ul>',
      'walker'          => new Menu_Walker(),
		)
	);
}

/**
 * Register the menus to sit in the site footer
 */
function underscores_footer_menu() {
  $location = 'footer';

	wp_nav_menu(
		array(
			'theme_location'  => $location,
			'menu_id'         => $location . '-menu',
			'menu_class'      => '',
      'container'       => 'ul',
			'items_wrap'      => '<ul id="%1$s" class="%2$s" role="list">%3$s</ul>',
		)
	);
}

/**
 * Register navs
 */
register_nav_menus(
	array(
		'primary'   => esc_html__( 'Primary', 'underscores' ),
		'footer'  => esc_html__( 'Footer', 'underscores' ),
	)
);