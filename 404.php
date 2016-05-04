
<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta http-equiv="content-type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>"/>
    <meta itemprop="description" name="description" content="Błąd 404"/>
    <title>To chyba jakaś pomyłka</title>

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport'/>
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>"/>
    <?php wp_head(); ?>
</head>
<body class="error404">
    <div class="error404__topbar">
        <a title="Wróć" class="link link--glowing error404__back" href="#"><i class="icon-left-open-big"></i></a>
        <img class="error404__logo" src="<?php echo get_template_directory_uri().'/build/img/synergia-mono-horizontal-inverted.svg';?>"/>
        <span class="error404__404">/404</span>
    </div>
    <span class="error404__powered">Powered by <a class="link link--social" href="http://giphy.com">giphy.com</a></span>
<?php wp_footer(); ?>
</body>
</html>
