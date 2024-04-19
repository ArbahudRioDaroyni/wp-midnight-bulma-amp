<?php
/**
 * The template for displaying single page
 *
 * Displays all of the head element and everything up until the "main" tag.
 *
 * @link https://github.com/ArbahudRioDaroyni/
 * @package WP Midnight Bulma AMP
 * @subpackage WP Midnight Bulma AMP
 */
  
?>

<?php get_header(); ?>

<main class="container content-area" id="main" role="main">

  <?php get_template_part( 'template-parts/components/breadcrumb' ); ?>
  
  <?php 
    // Start the loop.
    while ( have_posts() ) :
      the_post();

      // Include the single post content template.
      get_template_part( 'template-parts/content/content', 'single' );

      // End of the loop.
    endwhile;
  ?>
  
</main>

<aside>
  <!-- START: Sidebar -->
  <?php get_sidebar(); ?>
  <!-- END: Sidebar -->
</aside>

<!-- START: Comments -->
<?php comments_template( '/comments.php' ); ?>
<!-- END: Comments -->

<!-- START: Reply -->
<?php echo the_comment_form() ?>
<!-- END: Reply -->

<?php get_footer(); ?>