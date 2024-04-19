<?php
/**
 * The template for displaying breadcrumb
 *
 * Displays all of the head element and everything up until the "nav" tag class "breadcrumb".
 *
 * @link https://github.com/ArbahudRioDaroyni/
 * @package WP Midnight Bulma AMP
 * @subpackage WP Midnight Bulma AMP
 */
  
?>

<nav class="breadcrumb mx-3 mt-6" aria-label="breadcrumbs">
  <ul>
    <li><a href="<?= home_url() ?>" class="has-text-grey-lighter">Halaman Depan</a></li>
    <li><a href="<?= esc_url( get_category_link( get_the_category()[0]->term_id ) ) ?>" rel="category" class="has-text-grey-lighter"><?= get_the_category()[0]->name; ?></a></li>
    <li class="is-active"><span class="ml-3 has-text-grey" aria-current="page"><?php the_title(); ?></span></li>
  </ul>
</nav>