<?php
// Register Project Post Type //

function projects() {
    // Co można robić z tym typem postów
    $capabilities = array(
				'publish_posts' => 'publish_projects',
				'edit_posts' => 'edit_projects',
				'edit_others_posts' => 'edit_others_projects',
				'delete_posts' => 'delete_projects',
				'delete_others_posts' => 'delete_others_projects',
				'read_private_posts' => 'read_private_projects',
				'edit_post' => 'edit_project',
				'delete_post' => 'delete_project',
				'read_post' => 'read_project',
			);

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
		'slug'                => 'project',
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
		'query_var'           => 'project',
		'rewrite'             => $rewrite,
        'capability_type' => 'project',
        'capabilities' => $capabilities,
        'map_meta_cap'        => true,
	);
	register_post_type( 'project', $args );
    flush_rewrite_rules(false);
}
add_action( 'init', 'projects', 0 );

 ?>
