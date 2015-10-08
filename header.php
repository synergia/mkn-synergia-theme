<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta http-equiv="content-type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
    <link rel="apple-touch-icon" href="<?php bloginfo('template_directory'); ?>/img/safari_60.png">
    <link rel="apple-touch-icon" sizes="76x76" href="<?php bloginfo('template_directory'); ?>/img/safari_76.png">
    <link rel="apple-touch-icon" sizes="120x120" href="<?php bloginfo('template_directory'); ?>/img/safari_120.png">
    <link rel="apple-touch-icon" sizes="152x152" href="<?php bloginfo('template_directory'); ?>/img/safari_152.png">
    <meta name="msapplication-TileColor" content="#eeeeee">
    <meta name="msapplication-TileImage" content="<?php bloginfo('template_directory'); ?>/img/tile144.png">
    <meta name="description" content="<?php echo esc_attr(get_bloginfo('description')); ?>" />
    <title>
        <?php wp_title( '&laquo;', true, 'right'); ?>
    </title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <div class="container dmbs-container">
