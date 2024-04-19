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

<section class="section is-clipped">
  <div class="container">
    <h4 class="title has-text-white has-text-centered">Artikel Terbaru</h4>
    <!-- <p class="subtitle mb-14">Lorem ipsum dolor sit amet, consectetur adipiscing elit</p> -->
    <div class="columns is-multiline">

      <?php
        $args = [
          'posts_per_page'  => 3,
          'post_type'       => 'post'
        ];
        $postslist = new WP_Query( $args );
        $counter = 0;
      ?>
          
      <?php if ( $postslist->have_posts() ) : ?>
        <?php while ( $postslist->have_posts() ) : $postslist->the_post(); $counter++;?>

          <div class="column is-4">
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
              
              <h5 class="has-text-grey-lighter has-text-weight-medium"><?= get_the_title() ?></h5>
            </a>
          </div>

          <?php if ( wp_is_mobile() && $counter < $postslist->post_count ) : ?>
            <hr class="has-background-grey">
          <?php endif; ?>
        
        <?php endwhile; ?>
      <?php wp_reset_postdata(); endif; ?>

    </div>
  </div>
</section>