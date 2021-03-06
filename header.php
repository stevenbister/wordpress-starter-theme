<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package underscores
 */

?>
<!doctype html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php wp_head(); ?>

  <script>
    // When fonts are loaded change the class so fonts are applied
    let fontObservers = [
      new FontFaceObserver(''),
    ];

    Promise.all(fontObservers).then(() => document.documentElement.classList.add('fonts-loaded'));

    // Set js enabled class if js is running in browser
    document.documentElement.classList.replace("no-js", "js");
  </script>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<a class="skip-link sr-only focus:not-sr-only" href="#primary"><?php esc_html_e( 'Skip to content', 'underscores' ); ?></a>

<header id="masthead" class="site-header flex justify-between	">
  <div class="site-branding">
    <?php underscores_custom_logo(); ?>
  </div><!-- .site-branding -->

  <?php get_template_part( 'template-parts/navigation', 'header' ); ?>
</header><!-- #masthead -->
