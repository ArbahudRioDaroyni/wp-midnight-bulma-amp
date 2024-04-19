<?php
/**
 * The template for displaying sidebar
 *
 * Displays all of the head element and everything up until the "aside" tag.
 *
 * @link https://github.com/ArbahudRioDaroyni/
 * @package WP Midnight Bulma AMP
 * @subpackage WP Midnight Bulma AMP
 */
  
?>

<!-- widget advertisement -->
<?php get_template_part( 'template-parts/ads/ads', 'card-article' )?>

<?php get_template_part( 'template-parts/components/list-file' ); ?>

<?php get_template_part( 'template-parts/components/related-posts' ); ?>

<?php get_template_part( 'template-parts/components/popular-posts' ); ?>

<?php get_template_part( 'template-parts/ads/ads', 'card-article' )?>

<?php get_template_part( 'template-parts/components/recent-posts' ); ?>

<!-- widget advertisement -->
<div class="widget rounded text-md-center">
  <!-- <span class="ads-title">- Sponsored Ad -</span> -->
  <?php get_template_part( 'template-parts/ads/ads', 'card-article' )?>
</div>

<?php get_template_part( 'template-parts/widgets/collection-tags' ); ?>