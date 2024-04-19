<?php
/**
 * The template for displaying single post
 *
 * Displays all of the head element and everything up until the "article" tag.
 *
 * @link https://github.com/ArbahudRioDaroyni/
 * @package WP Midnight Bulma AMP
 * @subpackage WP Midnight Bulma AMP
 */
  
?>

<article id="post-<?php the_ID(); ?>" <?php post_class("is-single"); ?>>

	<!-- <amp-ad width="100vw" height="320"
		type="adsense"
		data-ad-client="ca-pub-3780041077137992"
		data-ad-slot="1782717232"
		data-auto-format="rspv"
		data-full-width="">
		<div overflow="Memuat iklan ..."></div>
		<div fallback>No ad for you</div>
	</amp-ad> -->

	<div class="hero">
		<div class="hero-body p-0">
			<figure class="image is-16by9">
				<?php
				if ( has_post_thumbnail() ) {
					$isMobile = (wp_is_mobile()) ?
						the_post_thumbnail('medium', ['class' => 'img-hero object-fit-cover', 'loading' => 'lazy']) :
						the_post_thumbnail(NULL, ['class' => 'img-hero object-fit-cover', 'loading' => 'lazy']);
				} else { ?>
					<img src="<?= get_first_image_in_post() ?>" class="img-hero object-fit-cover" alt="<?= get_the_title() ?>" />
				<?php } ?>
			</figure>
		</div>
	</div>

	<header class="entry-header section">
		<div class="columns">
			<div class="column is-8 is-offset-2">
				<a href="<?= esc_url( get_category_link( get_the_category()[0]->term_id ) ) ?>" rel="category" class="has-text-light"><?= get_the_category()[0]->name; ?></a>
				<h1 class="entry-title title mb-2"><a href="<?php the_permalink(); ?>" rel="bookmark" class="has-text-light"><?php the_title(); ?></a></h1>
				<ul class="entry-meta">
					<li class="mb-5">
						<time class="entry-date updated" datetime="<?php the_time('Y-m-d H:i'); ?>"><?php the_time( 'D, d F Y' ); ?></time>
					</li>
					<li class="vcard is-flex is-align-items-center">
						<img src="<?= get_avatar_url($comment, null) ?>" alt="<?php echo esc_attr( get_the_author() ); ?>" class="" width="35" height="35">
						<span class="mx-2">Diposting oleh</span>
						<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" title="<?php echo esc_attr( get_the_author() ); ?>" class="url fn has-text-weight-bold" rel="author nofollow"><?php the_author(); ?></a>
					</li>
				</ul>
			</div>
		</div>
	</header><!-- .entry-header -->

	<section class="entry-content section pt-2">
		<div class="columns">
			<div class="column is-8 is-offset-2">
				<div class="content">
					<?php the_content(); ?>
				</div>
			</div>
		</div>
	</section><!-- .entry-content -->

	<!-- <amp-ad width="100vw" height="320"
		type="adsense"
		data-ad-client="ca-pub-3780041077137992"
		data-ad-slot="1782717232"
		data-auto-format="rspv"
		data-full-width="">
		<div overflow="Memuat iklan ..."></div>
		<div fallback>No ad for you</div>
	</amp-ad> -->

	<footer class="section entry-footer">
		<div class="container">
			<div class="pb-5 is-flex is-flex-wrap-wrap is-justify-content-between is-align-items-center">
				<div class="mr-auto mb-2">
					<h4>Tags:</h4>
				</div>
				<div>
					<ul class="is-flex is-flex-wrap-wrap is-align-items-center is-justify-content-center">
						<?php if (has_tag()) {
							foreach (get_the_tags() as $value) { ?>
							<li>
								<a href="<?= esc_url( get_tag_link( $value ) ) ?>" rel="tag nofollow" class="tag is-dark"># <?= $value->name ?>&nbsp;</a> 
							</li> 
							<?php } ?>
						<?php } else { ?>
							<li>
								<a href="javascript:void(0)" rel="tag nofollow" class="tag is-dark"># tanpa tag</a> 
							</li>
						<?php } ?>
					</ul>
				</div>
			</div>
		</div>
		<div class="pt-5" style="border-top: 1px solid #dee2e6;"></div>
		<div class="container">
			<div class="is-flex-tablet is-justify-content-between is-align-items-center">
				<p>All</p>
				<div class="py-2 is-hidden-tablet"></div>
				<div class="ml-auto">
					<a class="mr-4 is-inline-block" href="#">
						<!-- <img src="bulma-plain-assets/socials/facebook.svg" alt=""> -->
					</a>
					<a class="mr-4 is-inline-block" href="#">
						<!-- <img src="bulma-plain-assets/socials/twitter.svg" alt=""> -->
					</a>
					<a class="mr-4 is-inline-block" href="#">
						<!-- <img src="bulma-plain-assets/socials/github.svg" alt=""> -->
					</a>
					<a class="mr-4 is-inline-block" href="#">
						<!-- <img src="bulma-plain-assets/socials/instagram.svg" alt=""> -->
					</a>
					<a class="is-inline-block" href="#">
						<!-- <img src="bulma-plain-assets/socials/linkedin.svg" alt=""> -->
					</a>
				</div>
			</div>
		</div>
	</footer><!-- .entry-footer -->

	<!-- <amp-ad width="100vw" height="320"
			type="adsense"
			data-ad-client="ca-pub-3780041077137992"
			data-ad-slot="8339219434"
			data-auto-format="mcrspv"
			data-full-width="">
		<div overflow="Memuat iklan ..."></div>
		<div fallback>No ad for you</div>
	</amp-ad> -->
			
</article><!-- #post-<?php the_ID(); ?> -->

<?php set_post_view() ?>