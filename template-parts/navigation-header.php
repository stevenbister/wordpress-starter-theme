<?php
/**
 * Template part for displaying the primary navigation across the site.
 *
 * Inline Aplpine script handles the state for the menu button.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package underscores
 */

?>

<nav id="site-navigation" class="main-navigation" aria-label="Primary" x-data="menubutton">
  <button class="menu-toggle md:hidden" aria-controls="primary-menu" x-bind:aria-expanded="open" @click="toggle()">
    <?php esc_html_e( 'Primary Menu', 'underscores' ); ?>
  </button>

  <?php underscores_primary_menu(); ?>
</nav>

<script>
  document.addEventListener('alpine:init', () => {
    Alpine.data('menubutton', (initialOpenState = false) => ({
      open: initialOpenState,

      toggle() {
        this.open = ! this.open;
      }
    }));
  });
</script>
<!-- #site-navigation -->