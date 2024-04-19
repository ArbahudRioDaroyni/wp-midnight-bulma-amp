<?php
/**
 * The template for displaying single file [post-type]
 *
 * Displays all of the head element and everything up until the "main" tag.
 *
 * @link https://github.com/ArbahudRioDaroyni/
 * @package WP Midnight Bulma AMP
 * @subpackage WP Midnight Bulma AMP
 */
  
?>

<article id="post-<?php the_ID(); ?>" name="<?php post_class("is-file"); ?>">

	<div itemscope itemtype="https://schema.org/SoftwareApplication">
		<amp-script layout="flex-item" src="<?= get_template_directory_uri() . '/assets/js/page-file.js' ?>">
			<div id="download-area" class="card is-relative mx-3">
				<div class="card-content">
					<div class="content has-text-centered">
						<figure>

							<?php
							// check if the post or page has a Featured Image assigned to it.
							if ( has_post_thumbnail() ) {
								the_post_thumbnail( 'thumbnail', ['class' => 'mx-auto image is-128x128 is-cover'] );
							} else { ?>
								<img src="<?= get_first_image_in_post() ?>" class="mx-auto image is-128x128 is-cover" loading="lazy" alt="<?= get_the_title() ?>" />
							<?php } ?>
							
						</figure>
						<h1 class="title is-2"><?php the_title(); ?></h1>
						<p class="subtitle is-size-6" itemprop="name"><?= esc_attr( get_post_meta( get_the_ID(), 'name', true ) ); ?></p>
					</div>

					<div class="content">
						<div class="is-flex mb-2 is-align-items-center" itemprop="aggregateRating" itemscope itemtype="https://schema.org/AggregateRating">
							<img
								alt="Download <?= get_the_title() ?>"
								src="<?= get_template_directory_uri() . '/assets/svg/star-white.svg' ?>"
								width="18"
								height="18"
								class="mr-2"
							>
							<p class="m-0 is-size-6" itemprop="ratingValue">4.8</p>
							<meta itemprop="bestRating" content="5">
							<meta itemprop="worstRating" content="1">
						</div>

						<div class="is-flex mb-2 is-align-items-center">
							<img
								alt="Download <?= get_the_title() ?>"
								src="<?= get_template_directory_uri() . '/assets/svg/comments-white.svg' ?>"
								width="18"
								height="18"
								class="mr-2"
							>
							<a href="#comments" class="is-size-6" rel="nofollow">
								<p class="m-0"><?= get_comments_number(); ?></p>
							</a>
						</div>

						<div class="is-flex is-align-items-center">
							<img
								alt="Download <?= get_the_title() ?>"
								src="<?= get_template_directory_uri() . '/assets/svg/download-white.svg' ?>"
								width="18"
								height="18"
								class="mr-2"
							>
							<p class="m-0 is-size-6" itemprop="ratingCount"><?= get_post_view() ?></p>
						</div>
					</div>
					<div class="content">
						<a id="download-button" class="button is-primary is-fullwidth is-flex is-justify-content-center is-align-items-center" href="#check-area">
							<img
								alt="Download <?= get_the_title() ?>"
								src="<?= get_template_directory_uri() . '/assets/svg/download.svg' ?>"
								width="18"
								height="18"
							>
							<span class="ml-2">Download (<?= esc_attr( get_post_meta( get_the_ID(), 'size', true ) ); ?>)</span>
						</a>
					</div>
				</div>
			</div>
			
			<div id="check-area" class="px-5 py-6 is-hidden">
				<div class="notification is-warning is-light">
					<div class="is-flex is-align-content-center">
						<span class="has-text-warning mr-2 is-inline-block">
							<svg width="20" height="20" viewbox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M10 0C4.5 0 0 4.5 0 10C0 15.5 4.5 20 10 20C15.5 20 20 15.5 20 10C20 4.5 15.5 0 10 0ZM10 15C9.4 15 9 14.6 9 14C9 13.4 9.4 13 10 13C10.6 13 11 13.4 11 14C11 14.6 10.6 15 10 15ZM11 10C11 10.6 10.6 11 10 11C9.4 11 9 10.6 9 10V6C9 5.4 9.4 5 10 5C10.6 5 11 5.4 11 6V10Z" fill="currentColor"></path>
							</svg>
						</span>
						<p class="text-center">Mohon menunggu, sistem sedang memeriksa virus di aplikasi sebelum dapat diunduh. <span id="waitingSeconds"></span></p>
					</div>
					<!-- <p class="text-center"></p> -->
				</div>
				<progress class="progress is-warning" max="100"></progress>
			</div>

			<div id="checked-area" class="px-5 py-6 is-hidden">
				<div class="notification is-success is-light">
					<div class="is-flex is-align-content-center">
						<span class="has-text-success mr-2 is-inline-block">
							<svg width="20" height="20" viewbox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M10 0C4.5 0 0 4.5 0 10C0 15.5 4.5 20 10 20C15.5 20 20 15.5 20 10C20 4.5 15.5 0 10 0ZM10 15C9.4 15 9 14.6 9 14C9 13.4 9.4 13 10 13C10.6 13 11 13.4 11 14C11 14.6 10.6 15 10 15ZM11 10C11 10.6 10.6 11 10 11C9.4 11 9 10.6 9 10V6C9 5.4 9.4 5 10 5C10.6 5 11 5.4 11 6V10Z" fill="currentColor"></path>
							</svg>
						</span>
						<p class="text-center">Tidak ditemukan adanya virus, aplikasi aman dan siap untuk diunduh.</p>
					</div>
				</div>
				<div class="buttons">
					<a href="<?= esc_attr( get_post_meta( get_the_ID(), 'dropbox', true ) ); ?>" class="button is-primary <?= $x = (get_post_meta( get_the_ID(), 'dropbox', true ) == null) ? 'is-hidden' : '' ; ?>">
						<img
							alt="Download <?= get_the_title() ?>"
							src="<?= get_template_directory_uri() . '/assets/svg/download.svg' ?>"
							width="17"
							height="18"
						>
						&nbsp;Dropbox
					</a>
					<button class="button is-link">Link</button>
				</div>
			</div>
		</amp-script>

		<div id="description-area" class="mx-2"> 
			<div class="card">
				<div class="card-content">
					<div class="content">
						<div class="columns">
							<div class="column is-3">
								<h5 class="mb-2">Diupdate</h5>
								<p><time class="updated" datetime="<?php the_time('Y-m-d H:i'); ?>"><?php the_time( 'D, d F Y' ); ?></time></p>
							</div>

							<div class="column is-3">
								<h5 class="mb-2">Ukuran</h5>
								<p><?= esc_attr( get_post_meta( get_the_ID(), 'size', true ) ); ?></p>
							</div>

							<div class="column is-3">
								<h5 class="mb-2">Versi Saat Ini</h5>
								<p>v.<?= esc_attr( get_post_meta( get_the_ID(), 'version', true ) ); ?></p>
							</div>

							<div class="column is-3">
								<h5 class="mb-2">Perlu Android versi</h5>
								<p>Minimal Android <span itemprop="operatingSystem"><?= esc_attr( get_post_meta( get_the_ID(), 'android-version', true ) ); ?></span> dan yang lebih tinggi</p>
								<meta itemprop="applicationCategory" content="MobileApplication">
							</div>
						</div>
						<div class="columns">
							<div class="column is-3">
								<h5 class="mb-2">Rating Konten</h5>
								<p>Rating 3+</p>
							</div>

							<div class="column is-3">
								<h5 class="mb-2">Ditawarkan Oleh</h5>
								<p><?= esc_attr( get_post_meta( get_the_ID(), 'publisher', true ) ); ?></p>
							</div>

							<div class="column is-3">
								<h5 class="mb-2">Elemen Interaktif</h5>
								<p>Interaksi Pengguna, Pembelian Dalam Aplikasi</p>
							</div>

							<div class="column is-3">
								<h5 class="mb-2">Developer</h5>
								<p>
									Kunjungi situs web <a class="fw-normal" rel="nofollow" href="<?= bloginfo('url') ?>">Jejak Hacker</a>
									<a class="fw-normal" rel="nofollow" href="<?= bloginfo('url') ?>">apps.support@bukalapak.com</a>
									<a class="fw-normal" rel="nofollow" href="<?= bloginfo('url') ?>/privacy-policy/">Kebijakan Privasi</a>
								</p>
							</div>
						</div>
						<div class="columns">
							<div class="column is-3">
								<h5 class="mb-2">Laporan</h5>
								<a class="fw-normal" rel="nofollow" href="<?= bloginfo('url') ?>">Tandai sebagai tidak pantas</a>
							</div>
							<div itemprop="offers" itemscope itemtype="https://schema.org/Offer">
								<meta itemprop="price" content="0" />
								<meta itemprop="priceCurrency" content="USD" />
								<div itemprop="PriceSpecification" itemscope itemtype="https://schema.org/PriceSpecification">
									<meta itemprop="price" content="0" />
									<meta itemprop="priceCurrency" content="USD" />
								</div>
							</div>
						</div>
						<div id="deskripsi" class="mb-3">
							<h4>Deskripsi</h4>
							<div id="content-description">
								<?php the_content(); ?>
							</div>
							<button
								id="btn-description-hide"
								class="button mt-2"
								on="tap:content-description.hide,btn-description-hide.hide,btn-description-show.show">
								Sembunyikan deskripsi
							</button>
							<button
								id="btn-description-show"
								class="button mt-2"
								hidden
								on="tap:content-description.show,btn-description-show.hide,btn-description-hide.show">
								Tampilkan deskripsi
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<header class="entry-header section">
		<span class=""><a href="<?= esc_url( get_category_link( get_the_category()[0]->term_id ) ) ?>" rel="category"><?= get_the_category()[0]->name; ?></a></span>
		<h1 class="entry-title"><a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
		<ul class="entry-meta list-inline align-items-center">
			<li class="vcard">
				<img src="<?= get_avatar_url($comment, null) ?>" alt="<?php echo esc_attr( get_the_author() ); ?>" class="" width="35" height="35">
				Diposting oleh <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" title="<?php echo esc_attr( get_the_author() ); ?>" class="url fn" rel="author"><?php the_author(); ?></a>
			</li>
			<li class="">
				<time class="entry-date updated" datetime="<?php the_time('Y-m-d H:i'); ?>"><?php the_time( 'D, d F Y' ); ?></time>
			</li>
		</ul>
	</header><!-- .entry-header -->

	<footer class="entry-footer post-bottom">
		<?php get_template_part( 'template-parts/elements/post-bottom' ); ?>
	</footer><!-- .entry-footer -->
</article>

<?php set_post_view() ?>