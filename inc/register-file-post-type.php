<?php
/**
 * Register a custom post type called "file".
 *
 * @see get_post_type_labels() for label keys.
 */
function new_post_type_file_init() {
	$labels = [
		'name'                  => _x( 'File', 'Post type general name', 'jejakcyber' ),
		'singular_name'         => _x( 'File', 'Post type singular name', 'jejakcyber' ),
		'menu_name'             => _x( 'File', 'Admin Menu text', 'jejakcyber' ),
		'name_admin_bar'        => _x( 'File', 'Add New on Toolbar', 'jejakcyber' ),
		'add_new'               => __( 'Tambah Baru', 'jejakcyber' ),
		'add_new_item'          => __( 'Tambah File Baru', 'jejakcyber' ),
		'new_item'              => __( 'File Baru', 'jejakcyber' ),
		'edit_item'             => __( 'Edit File', 'jejakcyber' ),
		'view_item'             => __( 'Lihat File', 'jejakcyber' ),
		'update_item'           => __( 'Edit File', 'jejakcyber' ),
		'all_items'             => __( 'Semua File', 'jejakcyber' ),
		'search_items'          => __( 'Cari File', 'jejakcyber' ),
		'parent_item_colon'     => __( 'Parent File:', 'jejakcyber' ),
		'not_found'             => __( 'No File found.', 'jejakcyber' ),
		'not_found_in_trash'    => __( 'No File found in Trash.', 'jejakcyber' ),
		'featured_image'        => _x( 'Gambar andalan', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'jejakcyber' ),
		'set_featured_image'    => _x( 'Tetapkan gambar unggulan', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'jejakcyber' ),
		'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'jejakcyber' ),
		'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'jejakcyber' ),
		'archives'              => _x( 'File archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'jejakcyber' ),
		'insert_into_item'      => _x( 'Insert into File', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'jejakcyber' ),
		'uploaded_to_this_item' => _x( 'Uploaded to this File', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'jejakcyber' ),
		'filter_items_list'     => _x( 'Filter books list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'jejakcyber' ),
		'items_list_navigation' => _x( 'File list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'jejakcyber' ),
		'items_list'            => _x( 'File list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'jejakcyber' ),
		'attributes'            => 'Item Attributes',
	];

	$args = [
		'labels'							=> $labels,
		'label'								=> 'file',
		'description'					=> 'Post Type Description',
		'public'							=> true,
		'publicly_queryable'	=> true,
		'show_ui'							=> true,
		'show_in_menu'				=> true,
		'query_var'						=> true,
		'rewrite'							=> [ 'slug' => 'file' ],
		'capability_type'			=> 'post',
		'has_archive'					=> true,
		'hierarchical'				=> false,
		'menu_position'				=> 5,
		'show_in_rest'				=> true,
		'supports'						=> [ 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments', 'custom-fields' ],
		'taxonomies'          => [ 'file_category' ],
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'exclude_from_search' => false,
		'taxonomies'          => [ 'category', 'post_tag' ],
	];

	register_post_type( 'file', $args );
	flush_rewrite_rules();
}

add_action( 'init', 'new_post_type_file_init' );