<?php
$theme = wp_get_theme();
define('THEME_VERSION', $theme->Version); //gets version written in your style.css

/**
 * Remove emoji script and styles from <head>
 */
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

function wpassist_remove_block_library_css(){
    wp_dequeue_style( 'wp-block-library' );
    wp_dequeue_style( 'global-styles' );
    wp_dequeue_style( 'dashicons-css' );
		wp_dequeue_style( 'classic-theme-styles' );
}
add_action( 'wp_enqueue_scripts', 'wpassist_remove_block_library_css', 100 );

add_theme_support( 'post-thumbnails' );

// filter tag in the_content()
function content_filter($content){
	$patterns = []; $replacements = [];
	$patterns_non_amp = []; $replacements_non_amp = [];

	$patterns = [
		'/<img (.*?) class="(.*?)>/',
		'/<div class="wp-block-button">(.*?)<\/div>/',
		'/<figure class="/',
		'/<table([^>]+)?>/',
		'/<a class="wp-block-button__link (.*?)" href="(.*?)">(.*?)<\/a>/'
	];
	$replacements = [
		'<img $1 class="is-fullwidth $2>',
		'<p class="wp-block-button">$1</p>',
		'<figure class="my-4 ',
		'<table class="table is-bordered is-striped is-hoverable is-fullwidth">',
		'<a href="$2" class="button is-fullwidth is-danger is-outlined my-2 $1">$3</a>'
	];
	
  return preg_replace($patterns, $replacements, $content);
}
add_filter('the_content', 'content_filter');

// get first image in post
function get_first_image_in_post() {
	global $post, $posts;
	$first_img = '';
	ob_start();
	ob_end_clean();
	$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
	$first_img = $matches [1] [0];
	
	if(empty($first_img)){
		$first_img = 'https://randdsoftindonesia.com/wp-content/uploads/2022/06/Icon-Randd-Soft.png';
	}
	return $first_img;
}

// get popular post
function get_list_popular_posts($total, $offset = 0){
	$args = [
		'post_type'        => 'post',
		'posts_per_page'   => $total,
		'offset'           => $offset,
		'order'            => 'DESC',
		'orderby'          => 'meta_value_num',
		'meta_key'         => 'post_views_count',
		'post_status'      => 'publish',
		'suppress_filters' => true,
	];
	return get_posts( $args );
}

function get_list_type_posts($total, $category = null, $offset = 0, $posttype= 'post'){
	$args = [
		'post_type'        => $posttype,
		'posts_per_page'   => $total,
		'category_name'    => $category,
		'offset'           => $offset,
		'order'            => 'DESC',
		'orderby'          => 'date',
		'post_status'      => 'publish',
		'suppress_filters' => true,
	];
	return get_posts( $args );
}

function new_excerpt_more( $more ) {
	return '';
}
add_filter('excerpt_more', 'new_excerpt_more');

add_filter( 'excerpt_length', function( $length ){
	return 20;
}, 999 );

function amp_comment_submit(){
  $comment = wp_handle_comment_submission( wp_unslash( $_POST ) );
  if ( is_wp_error( $comment ) ) {
    $data = intval( $comment->get_error_data() );
    if ( ! empty( $data ) ) {
      status_header(500);
      wp_send_json([
				'msg' => $comment->get_error_message(),
				'response' => $data,
        'back_link' => true
			]);
    }
  }
  else {
    wp_send_json([
			'success' => true,
			'data' => $comment,
			'msg' => 'Komentar terkirim'
		]);
  }
}
add_action('wp_ajax_amp_comment_submit', 'amp_comment_submit');
add_action('wp_ajax_nopriv_amp_comment_submit', 'amp_comment_submit');

include 'inc/get-view-count.php';
include 'inc/disable-feed.php';
include 'inc/register-file-meta-box-spesifikasi.php';
include 'inc/register-file-post-type.php';
include 'inc/comments.php';