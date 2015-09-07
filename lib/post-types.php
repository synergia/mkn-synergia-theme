<?php
////////////////////////////////////////////////////////////////////
// Linki sponsorowane
////////////////////////////////////////////////////////////////////
function sponsorowane() {

	$labels = array(
		'name'                => _x( 'Linki sponsorowane', 'Post Type General Name', 'text_domain' ),
		'singular_name'       => _x( 'Link sponsorowany', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'           => __( 'Linki sponsorowane', 'text_domain' ),
		'parent_item_colon'   => __( 'Parent Item:', 'text_domain' ),
		'all_items'           => __( 'Wszystkie linki', 'text_domain' ),
		'view_item'           => __( 'Zobacz link', 'text_domain' ),
		'add_new_item'        => __( 'Dodaj nowy link sponsorowany', 'text_domain' ),
		'add_new'             => __( 'Dodaj jeszcze jeden', 'text_domain' ),
		'edit_item'           => __( 'Edytuj link', 'text_domain' ),
		'update_item'         => __( 'Zaktualizuj link', 'text_domain' ),
		'search_items'        => __( 'szukaj link', 'text_domain' ),
		'not_found'           => __( 'Nie znaleziono', 'text_domain' ),
		'not_found_in_trash'  => __( 'Not found in Trash', 'text_domain' ),
	);
	$args = array(
		'label'               => __( 'sponsorowane', 'text_domain' ),
		'description'         => __( 'Linki sponsorowane', 'text_domain' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'thumbnail' ),
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

// Register Custom Post Type
function projects() {

	$labels = array(
		'name'                => _x( 'Projekty', 'Post Type General Name', 'projects' ),
		'singular_name'       => _x( 'Projekt', 'Post Type Singular Name', 'projects' ),
		'menu_name'           => __( 'Projekty', 'projects' ),
		'name_admin_bar'      => __( 'Projekt', 'projects' ),
		'parent_item_colon'   => __( 'Parent Item:', 'projects' ),
		'all_items'           => __( 'Wszystkie projekty', 'projects' ),
		'add_new_item'        => __( 'Dodaj nowy projekt', 'projects' ),
		'add_new'             => __( 'Dodaj nowy', 'projects' ),
		'new_item'            => __( 'Nowy projekt', 'projects' ),
		'edit_item'           => __( 'Edytuj projekt', 'projects' ),
		'update_item'         => __( 'Zaktualizuj projekt', 'projects' ),
		'view_item'           => __( 'Zobacz projekt', 'projects' ),
		'search_items'        => __( 'Szukaj projektów', 'projects' ),
		'not_found'           => __( 'Nie ma takiego', 'projects' ),
		'not_found_in_trash'  => __( 'Nawet w koszu nie ma', 'projects' ),
	);
	$rewrite = array(
		'slug'                => 'projekt',
		'with_front'          => false,
		'pages'               => true,
		'feeds'               => true,
	);
	$args = array(
		'label'               => __( 'Projekt', 'projects' ),
		'description'         => __( 'Projekty Synergii', 'projects' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'author', 'thumbnail', 'revisions' ),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-carrot',
		'show_in_admin_bar'   => true,
		'show_in_nav_menus'   => true,
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'query_var'           => 'projekt',
		'rewrite'             => $rewrite,
        'capability'     => __('project'),
        'map_meta_cap'        => true,
	);
	register_post_type( 'projekt', $args );
    flush_rewrite_rules();
}
add_action( 'init', 'projects', 0 );
?>
