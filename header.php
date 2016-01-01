<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
  <meta http-equiv="content-type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
  <meta name="description" content="<?php echo esc_attr(get_bloginfo('description')); ?>" />
  <title><?php wp_title(""); ?></title>
  <?php if(is_page('login') || is_page('no_script')){ ?>
    <meta name="robots" content="noindex,nofollow">
    <?php  }?>
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
  <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
  <?php if(!is_page('nojs')) { ?>
    <noscript>
      <META HTTP-EQUIV="Refresh" CONTENT="0;URL=nojs">
    </noscript>
  <?php } ?>
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
  <div class="container dmbs-container">
