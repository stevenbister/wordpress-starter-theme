<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package underscores
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class('container mx-auto'); ?>>

  <header class="entry-header text-3xl">
    <?php underscores_heading(); ?>
  </header>

	<div class="post-thumbnail">
    <?php the_post_thumbnail(); ?>
  </div><!-- .post-thumbnail -->

	<div class="entry-content stack">
		<?php the_content(); ?>
	</div><!-- .entry-content -->
</article><!-- #post-<?php the_ID(); ?> -->
