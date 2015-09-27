<?php

////////////////////////////////////////////////////////////////////
// Theme Information
////////////////////////////////////////////////////////////////////
    $themename = "Synergia";
    $developer_uri = "http://vk.com/stsdc";
    $shortname = "sy";
    $version = '0.7';
////////////////////////////////////////////////////////////////////
// include Theme-options.php for Admin Theme settings
////////////////////////////////////////////////////////////////////

   include 'lib/theme-options.php';
   include 'lib/post-types.php';
   include 'lib/author-admin.php';
   include 'lib/projekt-admin.php';
   include 'lib/candies.php';
////////////////////////////////////////////////////////////////////
// Include shortcodes.php for Bootstrap Shortcodes
////////////////////////////////////////////////////////////////////

    include 'lib/shortcodes.php';


////////////////////////////////////////////////////////////////////
// Enqueue Styles (normal style.css and bootstrap.css)
////////////////////////////////////////////////////////////////////
    function synergia_theme_stylesheets()
    {
        global $version;
		wp_register_style('googleFonts', 'https://fonts.googleapis.com/css?family=Titillium+Web:400,300,700&subset=latin,latin-ext');
        wp_register_style('main', get_template_directory_uri() . '/css/main.css', array(), $version, 'all' );
        wp_register_style('github', get_template_directory_uri() . '/css/github.css', array(), $version, 'all' );
        wp_enqueue_style( 'main');
		wp_enqueue_style( 'googleFonts');
        if ( is_author() ) {
          wp_enqueue_style( 'github');
        }
    }
    add_action('wp_enqueue_scripts', 'synergia_theme_stylesheets');

////////////////////////////////////////////////////////////////////
// Register Bootstrap JS with jquery
////////////////////////////////////////////////////////////////////
    function js () {
      wp_register_script( 'underscore', get_template_directory_uri().'/js/underscore.min.js', '1.6.0', true );
      wp_register_script( 'github.js', get_template_directory_uri().'/js/github.min.js', '0.1.3', true );
      if ( is_author() ) {
        wp_enqueue_script('underscore');
        wp_enqueue_script('github.js');
      }
      wp_enqueue_script('js', get_template_directory_uri() . '/js/js.js',array( 'jquery' ),$version,true );
    }
    add_action('wp_footer', 'js');


////////////////////////////////////////////////////////////////////
// Register Custom Navigation Walker include custom menu widget to use walkerclass
////////////////////////////////////////////////////////////////////

    require_once('lib/wp_bootstrap_navwalker.php');
    require_once('lib/bootstrap-custom-menu-widget.php');

////////////////////////////////////////////////////////////////////
// Register Menus
////////////////////////////////////////////////////////////////////

        register_nav_menus(
            array(
                'main_menu' => 'Main Menu',
                'footer_menu' => 'Footer Menu'
            )
        );

////////////////////////////////////////////////////////////////////
// Register the Sidebar(s)
////////////////////////////////////////////////////////////////////

        register_sidebar(
            array(
            'name' => 'Right Sidebar',
            'id' => 'right-sidebar',
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<h3>',
            'after_title' => '</h3>',
        ));

        register_sidebar(
            array(
            'name' => 'Left Sidebar',
            'id' => 'left-sidebar',
            'before_widget' => '<aside id="%1$s" class="widget %2$s">',
            'after_widget' => '</aside>',
            'before_title' => '<h3>',
            'after_title' => '</h3>',
        ));

////////////////////////////////////////////////////////////////////
// Adds RSS feed links to for posts and comments.
////////////////////////////////////////////////////////////////////

    add_theme_support( 'automatic-feed-links' );
