<?php
/**
 * Prints HTML with meta information for the current author.
 *
 * @package underscores
 */

defined( 'ABSPATH' ) || exit; // Exit if accessed directly.

if ( ! function_exists( 'underscores_posted_by' ) ) :
	function underscores_posted_by() {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'by %s', 'post author', 'underscores' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline"> ' . $byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

	}
endif;