<?php
/**
 * Template part for displaying the card component.
 * This component takes the post ID as an argument so we can generate the appropriate attributes.
 * The received args can be expanded by adding items to the array after the 'post_id' item.
 *
 * Example usage: get_template_part( 'template-parts/card', null, [ 'post_id' => get_the_ID() ] );
 *
 * @package underscores
 */

  if ( $args['post_id'] ) :

    $ID = $args['post_id'];

    $card_title = get_the_title( $ID );
    $card_thumb = get_the_post_thumbnail( $ID, 'card-thumb', [ 'class' => 'card__image' ] );
    $card_excerpt = get_the_excerpt( $ID );
    $card_permalink = get_the_permalink( $ID );
?>

  <div id="post-<?= $ID ?>" class="card box stack">
    <div class="card__header">
      <?= $card_thumb; ?>
    </div>

    <div class="card__body stack">
      <h2><?= $card_title; ?></h2>

      <p><?= $card_excerpt; ?></p>

      <a class="button" href="<?= $card_permalink; ?>">
        <?= __( 'Read more', 'underscores' ); ?>
      </a>
    </div>

  </div>

<?php else : ?>

  <p>No ID passed to card</p>

<?php endif; ?>