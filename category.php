<?php
/**
 * The template for displaying category page
 *
 * Displays all of the head element and everything up until the "main" tag.
 *
 * @link https://github.com/ArbahudRioDaroyni/
 * @package WP Midnight Bulma AMP
 * @subpackage WP Midnight Bulma AMP
 */
  
?>

<?php get_header(); ?>

<main id="main" class="content-area container" role="main">
  <?php get_template_part( 'template-parts/content/content', 'category' ); ?>
</main><!-- .site-main -->

<aside>
  <!-- START: Sidebar -->
  <?php get_sidebar(); ?>
  <!-- END: Sidebar -->
</aside>

<?php get_footer(); ?>