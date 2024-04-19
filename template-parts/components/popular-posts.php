<?php
/**
 * The template for displaying section
 *
 * Displays all of the head element and everything up until the "section" tag.
 *
 * @link https://github.com/ArbahudRioDaroyni/
 * @package WP Midnight Bulma AMP
 * @subpackage WP Midnight Bulma AMP
 */
  
?>

<section class="section has-background-dark">
  <div class="container">
    <h4 class="title has-text-white has-text-centered">Artikel Populer</h4>
    <div class="-mb-8 columns is-multiline">

      <?php
        $posts_array = get_list_popular_posts($total = 4, $offset = null);
        $counter = 0;
        foreach ( $posts_array as $post ) : setup_postdata( $post ); $counter++;
      ?>

        <div class="column">
          <a class="is-block" href="<?php the_permalink() ?>">
            <?php
            // check if the post or page has a Featured Image assigned to it.
            if ( has_post_thumbnail() ) {
              the_post_thumbnail( null, [
                'class' => 'mb-5 image is-fullwidth object-fit-cover',
                'alt' => get_the_title(),
                'style' => 'height:200px;'
              ] );
            } else { ?>
              <img src="<?= get_first_image_in_post() ?>" class="mb-5 image is-fullwidth object-fit-cover" alt="<?= get_the_title() ?>" loading="lazy" style="height:200px;" />
            <?php } ?>

            <h5 class="is-inline-block has-text-primary-gradient mb-2"><?= get_the_title() ?></h5>
            <span class="is-block is-size-7 has-text-grey-lighter has-text-weight-medium">👁️ <?= esc_attr( get_post_meta( get_the_ID(), 'post_views_count', true ) ); ?></span>
          </a>
        </div>

        <?php if ( wp_is_mobile() && $counter < 4 ) : ?>
          <hr class="has-background-grey">
        <?php endif; ?>

      <?php endforeach; wp_reset_postdata() ?>

    </div>
  </div>
</section>