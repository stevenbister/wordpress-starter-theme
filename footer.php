<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package underscores
 */

?>

<footer class="site-footer">
  <nav class="footer-navigation" aria-label="Footer">
    <?php underscores_footer_menu(); ?>
  </nav>

  <div class="site-info">
    <p>&copy; <?php bloginfo( 'name' ); ?> <?= esc_html( date( 'Y' ) ); ?></p>
    <p><a href="https://www.blinkseo.co.uk"><?= esc_html( _e( 'Blink SEO', '_blink' ) ); ?></a></p>
  </div><!-- .site-info -->
</footer>
<?php wp_footer(); ?>

</body>
</html>
