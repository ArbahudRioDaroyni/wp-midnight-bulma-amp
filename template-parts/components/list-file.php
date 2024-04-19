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
  <h4 class="title has-text-white has-text-centered">Aplikasi Terbaru</h4>
  <!-- <div class=" is-flex is-flex-direction-row is-flex-wrap-nowrap" style="overflow:auto"> -->
  <div class="columns" style="overflow:auto">
    <?php
      $args = [
        'posts_per_page'  => 4,
        'post_type'       => 'file'
      ];
      $postslist = new WP_Query( $args );
      $counter = 0; // Inisialisasi counter
    ?>
        
    <?php if ( $postslist->have_posts() ) : ?>
      <?php while ( $postslist->have_posts() ) : $postslist->the_post(); $counter++;?>

        <div class="column">
          <?php
          // check if the post or page has a Featured Image assigned to it.
          if ( has_post_thumbnail() ) {
            the_post_thumbnail( null, [
              'class' => 'mb-5 image is-fullwidth',
              'alt' => get_the_title(),
              'style' => 'height:200px;object-fit:cover;'
            ] );
          } else { ?>
            <img src="<?= get_first_image_in_post() ?>" class="mb-5 image is-fullwidth" alt="<?= get_the_title() ?>" loading="lazy" style="height:200px;object-fit:cover;" />
          <?php } ?>

          <div class="is-flex is-justify-content-space-between mb-2">
            <span class="has-text-grey-lighter"><?= esc_attr( get_post_meta( get_the_ID(), 'publisher', true ) ); ?></span>
            <span class="has-text-primary has-text-weight-bold is-flex is-justify-content-space-between">
              <img
                alt="Download <?= get_the_title() ?>"
                src="<?= get_template_directory_uri() . '/assets/svg/download-white.svg' ?>"
                width="18"
                height="18"
                layout="responsive"
                class="mr-2"
              >
              <?= esc_attr( get_post_meta( get_the_ID(), 'post_views_count', true ) ); ?>
            </span>
          </div>
          <h5 class="has-text-grey-lighter mb-4 has-text-weight-medium" style="min-height:48px;"><?= wp_trim_words( get_the_title(), $num_words = 10, $more = '..' ); ?></h5>
          <a class="button is-borderless is-fullwidth" href="<?php the_permalink() ?>">
            <img
              alt="Download <?= get_the_title() ?>"
              src="<?= get_template_directory_uri() . '/assets/svg/download-white.svg' ?>"
              width="18"
              height="18"
              layout="responsive"
              class="mr-2"
            >
            Unduh
          </a>
        </div>

        <?php if ( wp_is_mobile() && $counter < $postslist->post_count ) : ?>
          <hr>
        <?php endif; ?>

      <?php endwhile; ?>
    <?php wp_reset_postdata(); endif; ?>

  </div>
</section>