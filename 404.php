<?php
/**
 * The template for displaying 404 page
 *
 * Displays all of the head element and everything up until the "main" tag.
 *
 * @link https://github.com/ArbahudRioDaroyni/
 * @package WP Midnight Bulma AMP
 * @subpackage WP Midnight Bulma AMP
 */
  
?>

<?php get_header(); ?>

<section class="hero is-fullheight">
  <div class="hero-body">
    <div class="columns is-align-items-center">
      <div class="column mb-12 mb-0-tablet">
        <small class="is-block is-uppercase has-leading-4 has-text-weight-semibold mb-2">
          <span>Error</span>
          <span class="has-text-primary">404</span>
        </small>
        <h2 class="title">Halaman tidak ditemukan</h2>
        <p class="subtitle mb-10">Uppss... Halaman yang Anda cari tidak ditemukan atau sudah dihapus</p>
        <div class="buttons">
          <a class="button is-primary mr-4" href="<?php bloginfo( 'url' ); ?>">Halaman utama</a>
          <button class="button is-dark" title="Disabled button" disabled>Muat ulang</button>
      </div>
      <div class="column">
        <img class="image mx-auto" src="acros-assets/images/http-codes/robot.png" alt="">
      </div>
    </div>
  </div>
</section>

<?php get_footer(); ?>