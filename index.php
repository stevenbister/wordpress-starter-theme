<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package underscores
 */

get_header();
?>

	<main id="primary" class="site-main">

    <header>
      <h1 class="page-title text-3xl"><?php single_post_title(); ?></h1>
    </header>

		<?php if ( have_posts() ) : ?>

    <ul class="grid container" style="--grid-cols: 3;" role="list">
      <?php
        while ( have_posts() ) : the_post();
          /*
          * Include the Post-Type-specific template for the content.
          * If you want to override this in a child theme, then include a file
          * called content-___.php (where ___ is the Post Type name) and that will be used instead.
          */
      ?>

          <li>
            <?php get_template_part( 'template-parts/card', null, [ 'post_id' => get_the_ID() ] ); ?>
          </li>

        <?php endwhile; ?>
    </ul>

    <!-- TODO: Include js load more posts -->
    <?php
      echo '<p class="post-count">Displaying 1 - <span data-element="post-count">' . $wp_query->post_count . '</span> of <span data-element="post-total">' . wp_count_posts( 'post', 'readable')->publish . '</span></p>';

      $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;

      if ( $paged != $wp_query->max_num_pages ) {
        echo '<div><button class="button" data-element="load-more-button">Show More</button></div>';
      }
    ?>

    <noscript>
      <?php underscores_page_navi(); ?>
    </noscript>

    <!-- <div class="spinner-container" data-element="spinner">
      <div class="spinner"><div></div><div></div><div></div><div></div></div>
    </div> -->

    <?php
    else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- #main -->

<?php
get_footer();
