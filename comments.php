<?php
/**
 * The template for displaying comment lists
 *
 * Displays all of the head element and everything up until the "header" tag.
 *
 * @link https://github.com/ArbahudRioDaroyni/
 * @package WP Midnight Bulma AMP
 * @subpackage WP Midnight Bulma AMP
 *
 *
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
?>

<?php
	if ( post_password_required() ) {
		return;
	}
?>

<div id="comments" class="comments-area section">
    
	<?php if ( have_comments() ) : ?>
		<h3 class="title is-3">Komentar Terbaru</h3>

		<?php the_comments_navigation(); ?>

		<ul id="comments-list" class="comments-list comments p-0">
			<?php
				wp_list_comments([
					'type'							=> 'comment',
					// 'max_depth'					=> 1,
					'per_page'					=> 50,
					'reverse_top_level'	=> true,
					'avatar_size'				=> 35,
					'callback'					=> 'comment_list'
				]);
			?>
		</ul><!-- .comment-list -->

		<?php the_comments_navigation(); ?>

	<?php endif; // Check for have_comments(). ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments">Komentar Ditutup</p>
	<?php endif; ?>

</div><!-- .comments-area -->