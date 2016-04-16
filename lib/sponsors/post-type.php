<?php
function sponsorowane() {

	$labels = array(
		'name'                => _x( 'Sponsorzy i współpracy', 'Post Type General Name', 'text_domain' ),
		'singular_name'       => _x( 'Sponsor i współpraca', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'           => __( 'Sponsorzy i współpracy', 'text_domain' ),
		'parent_item_colon'   => __( 'Parent Item:', 'text_domain' ),
		'all_items'           => __( 'Wszystkie', 'text_domain' ),
		'view_item'           => __( 'Zobacz sponsora lub współpracę', 'text_domain' ),
		'add_new_item'        => __( 'Dodaj nowego sponsora lub współpracę', 'text_domain' ),
		'add_new'             => __( 'Dodaj', 'text_domain' ),
		'edit_item'           => __( 'Edytuj sponsora lub współpracę', 'text_domain' ),
		'update_item'         => __( 'Zaktualizuj sponsora lub współpracę', 'text_domain' ),
		'search_items'        => __( 'Szukaj sponsora lub współpracę', 'text_domain' ),
		'not_found'           => __( 'Nie znaleziono', 'text_domain' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'text_domain' ),
	);
	$args = array(
		'label'               => __( 'sponsorowane', 'text_domain' ),
		'description'         => __( 'Linki sponsorowane', 'text_domain' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'thumbnail', 'editor' ),
        'taxonomies'          => array( 'category'),
        'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
        'menu_icon'           => 'dashicons-format-links',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'rewrite'             => false,
		'capability_type'     => 'page',
	);
	register_post_type( 'sponsorowane', $args );
}

// Hook into the 'init' action
add_action( 'init', 'sponsorowane', 0 );
 ?>
