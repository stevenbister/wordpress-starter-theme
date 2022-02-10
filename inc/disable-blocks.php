<?php
/**
 * Disables Blocks within the block editor
 *
 * @package underscore
**/

defined( 'ABSPATH' ) || exit; // Exit if accessed directly.
/**
 * Limit which block types are available
 */
function underscores_allowed_block_types( $allowed_block_types, $post ) {
  $blocks = array(
    'acf/testimonial',
    'core/paragraph',
    'core/image',
    'core/heading',
    'core/gallery',
    'core/list',
    'core/quote',
    'core/shortcode',
    'core/archives',
    'core/audio',
    'core/button',
    'core/buttons',
    'core/calendar',
    'core/categories',
    'core/code',
    'core/columns',
    'core/column',
    'core/cover',
    'core/embed',
    'core/file',
    'core/group',
    'core/freeform',
    'core/html',
    'core/media-text',
    'core/latest-comments',
    'core/latest-posts',
    'core/missing',
    'core/more',
    'core/nextpage',
    'core/page-list',
    'core/preformatted',
    'core/pullquote',
    'core/rss',
    'core/search',
    'core/separator',
    'core/block',
    'core/social-links',
    'core/social-link',
    'core/spacer',
    'core/table',
    'core/tag-cloud',
    'core/text-columns',
    'core/verse',
    'core/video',
    'core/site-logo',
    'core/site-tagline',
    'core/site-title',
    'core/query',
    'core/post-template',
    'core/query-title',
    'core/query-pagination',
    'core/query-pagination-next',
    'core/query-pagination-numbers',
    'core/query-pagination-previous',
    'core/post-title',
    'core/post-content',
    'core/post-date',
    'core/post-excerpt',
    'core/post-featured-image',
    'core/post-terms',
    'core/loginout'
  );

  return $blocks;
}
add_filter( 'allowed_block_types_all', 'underscores_allowed_block_types', 10, 2 );