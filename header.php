<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta http-equiv="content-type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
  <meta itemprop="description" name="description" content="<?php echo esc_attr(get_bloginfo('description')); ?>" />
  <title><?php wp_title(""); ?></title>
  <?php if(is_page('login')){ ?><meta name="robots" content="noindex,nofollow"><?php  }?>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
  <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <noscript>
        <div class="nojs">
            <a class="nojs__logo link--logo" title="<?php bloginfo('name'); ?>" href="<?php echo site_url(); ?>"></a>
            <div class="nojs__info">
                <h1>Brak obsługi JavaScript</h1>
                <p>
                    Strona MKNM "Synergia" wymaga obsługi języka JavaScript.<br />
                    <a class="link" title="Jak włączyć obsługę skryptów JavaScript w Twojej przeglądarce" target="_blank" href="http://www.enable-javascript.com/pl/">Dowiedz się jak włączyć obsługę skryptów JavaScript w Twojej przeglądarce</a>.
                </p>
            </div>
        </div>
    </noscript>
