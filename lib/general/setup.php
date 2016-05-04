<?php

// Tworzy strony //

function create_pages()
{
// Argument dla strony Głównej
  $main_page_args = array(
    'post_status' => 'publish',
    'post_type' => 'page',
    'post_name' => 'main',
    'page_template' => 'page-templates/main.php',
    'post_title' => 'Główna',
    'post_content' => '',
);

    if (get_page_by_title('Główna') == null) {
        $main_page = wp_insert_post($main_page_args);
        update_option('page_on_front', $main_page);
        update_option('show_on_front', 'page');
        echo '<div class="updated"> <p>Utworzono stronę "Główna"</p></div>';
    }


    // Argument dla strony Blog
    $blog_page_args = array(
        'post_status' => 'publish',
        'post_type' => 'page',
        'post_name' => 'blog',
        'page_template' => 'page-templates/blog.php',
        'post_title' => 'Blog',
        'post_content' => '',
    );

    if (get_page_by_title('Blog') == null) {
        wp_insert_post($blog_page_args);
        echo '<div class="updated"> <p>Utworzono stronę "Blog"</p></div>';
    }

    // Argument dla strony Projekty
    $projects_page_args = array(
        'post_status' => 'publish',
        'post_type' => 'page',
        'post_name' => 'projects',
        'page_template' => 'page-templates/projects.php',
        'post_title' => 'Projekty',
        'post_content' => '',
    );

    if (get_page_by_title('Projekty') == null) {
        wp_insert_post($projects_page_args);
        echo '<div class="updated"> <p>Utworzono stronę "Projekty"</p></div>';
    }

    // Argument dla strony Login
    $login_page_args = array(
        'post_status' => 'publish',
        'post_type' => 'page',
        'post_name' => 'login',
        'page_template' => 'page-templates/login.php',
        'post_title' => 'Logowanie',
        'post_content' => '',
    );

    if (get_page_by_title('Logowanie') == null) {
        wp_insert_post($login_page_args);
        echo '<div class="updated"> <p>Utworzono stronę "Logowanie"</p></div>';
    }

    // Argument dla strony Członkowie
    $members_page_args = array(
        'post_status' => 'publish',
        'post_type' => 'page',
        'post_name' => 'members',
        'page_template' => 'page-templates/members.php',
        'post_title' => 'Członkowie',
        'post_content' => '',
    );

    if (get_page_by_title('Członkowie') == null) {
        wp_insert_post($members_page_args);
        echo '<div class="updated"> <p>Utworzono stronę "Członkowie"</p></div>';
    }

    // Argument dla strony O nas
    $about_page_args = array(
        'post_status' => 'publish',
        'post_type' => 'page',
        'post_name' => 'about',
        'post_title' => 'O nas',
        'post_content' => 'Jakiś tekst o nas',
    );

    if (get_page_by_title('O nas') == null) {
        wp_insert_post($about_page_args);
        echo '<div class="updated"> <p>Utworzono stronę "O nas"</p></div>';
    }

    // Tworzymy menu i dodajemy do niego pozycje //

    if (! is_nav_menu( 'topbar_menu' )) {
        $menu_id = wp_create_nav_menu('topbar_menu');

        wp_update_nav_menu_item($menu_id, 0, array('menu-item-title' => 'Blog',
                                           'menu-item-object' => 'page',
                                           'menu-item-object-id' => get_page_by_path('blog')->ID,
                                           'menu-item-type' => 'post_type',
                                           'menu-item-status' => 'publish', ));
        wp_update_nav_menu_item($menu_id, 0, array('menu-item-title' => 'Członkowie',
                                           'menu-item-object' => 'page',
                                           'menu-item-object-id' => get_page_by_path('members')->ID,
                                           'menu-item-type' => 'post_type',
                                           'menu-item-status' => 'publish', ));
        wp_update_nav_menu_item($menu_id, 0, array('menu-item-title' => 'O nas',
                                           'menu-item-object' => 'page',
                                           'menu-item-object-id' => get_page_by_path('about')->ID,
                                           'menu-item-type' => 'post_type',
                                           'menu-item-status' => 'publish', ));
                                           // Grab the theme locations and assign our newly-created menu
                                           // to the BuddyPress menu location.
if (!has_nav_menu('topbar_menu')) {
    $locations = get_theme_mod('nav_menu_locations');
    $locations['main_menu'] = $menu_id;
    set_theme_mod('nav_menu_locations', $locations);
    echo '<div class="updated"> <p>Utworzono menu</p></div>';
}
    }
}

add_action('after_switch_theme', 'create_pages');
