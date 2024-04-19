<?php
/**
 * The template for displaying tag page
 *
 * Displays all of the head element and everything up until the "main" tag.
 *
 * @link https://github.com/ArbahudRioDaroyni/
 * @package WP Midnight Bulma AMP
 * @subpackage WP Midnight Bulma AMP
 */
  
?>

<?php $args = [
	'posts_per_page'  => 9,
	'paged'           => ( get_query_var('paged')) ? get_query_var('paged' ) : 1,
	'post_type'       => ['post', 'file'],
	'tag'   		 			=> get_queried_object()->slug
];
$postslist = new WP_Query( $args );

// var_dump(get_query_var('paged'));
		
if ( $postslist->have_posts() ) : ?>
	<section class="section is-clipped">
		<div class="container">
			<h1 class="title has-text-white has-text-centered">Menampilkan hasil tag: <?= get_queried_object()->slug ?></h1>
			<!-- <p class="subtitle mb-14">Lorem ipsum dolor sit amet, consectetur adipiscing elit</p> -->
			<div class="columns is-multiline">
				<?php while ( $postslist->have_posts() ) : $postslist->the_post(); ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class("column is-4"); ?>>
						<a class="is-block" href="<?php the_permalink() ?>">
							<figure>

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
								
							</figure>
							<h2 class="has-text-grey-lighter has-text-weight-medium"><?= get_the_title() ?></h2>
						</a>
					</article>

					<?php if ( wp_is_mobile() && $counter < $postslist->post_count ) : ?>
						<hr class="has-background-grey">
					<?php endif; ?>

				<?php endwhile; ?>
			</div>
		</div>
	</section>

	<!-- START: Pagination -->
	<?php $pages = paginate_links( [
		'base'        => get_pagenum_link(1) . '%_%',
		'format'      => 'page/%#%',
		'current'     => max(1, get_query_var('paged')),
		'end_size'    => 2,
		'total'       => ceil( $postslist->found_posts / $args['posts_per_page'] ),
		'prev_text'   => __(' << '),
		'next_text'   => __(' >> '),
		'type'        => 'array',
	]); ?>

	<?php if( is_array( $pages ) ) { ?>
		<nav class="pagination section" role="navigation" aria-label="pagination">
			<!-- <a href="#" rel="nofollow" class="pagination-previous">Previous</a>
			<a href="#" rel="nofollow" class="pagination-next">Next page</a> -->
			<ul class="pagination-list">
				<?php
				foreach ( $pages as $page ) { ?>
					<li>
						<?php
							$newPage = str_replace('page-numbers', 'pagination-link', $page);
							$newPageNoFollow = str_replace('pagination-link current', 'is-current pagination-link', $newPage);
							echo str_replace('pagination-link', 'pagination-link" rel="nofollow', $newPageNoFollow);
						?>
					</li>
				<?php } ?>
			</ul>
		</nav>
	<?php } ?>
	<!-- END: Pagination -->

<?php wp_reset_postdata(); endif; ?>