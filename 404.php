<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta http-equiv="content-type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>"/>
    <meta itemprop="description" name="description" content="<?php echo esc_attr(get_bloginfo('description')); ?>"/>
    <title><?php wp_title(""); ?></title>
    <?php if (is_page('login') || is_page('no_script')) { ?>
        <meta name="robots" content="noindex,nofollow">
    <?php } ?>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'/>
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>"/>
    <?php if (!is_page('nojs')) { ?>
        <noscript>
            <META HTTP-EQUIV="Refresh" CONTENT="0;URL=nojs">
        </noscript>
    <?php }
    wp_head(); ?>
</head>
<body>
<a style="display:block" href="http://synergia.pwr.wroc.pl">
    <div class="topbarholder">
        <div class="icon-left-open-big arrow"></div>
        <div class="logo404"></div>
        <div class="write404">/404</div>
    </div>
</a>

<div class="gradient404"></div>
<div class="gif"></div>


<?php wp_footer(); ?>
</body>
</html>