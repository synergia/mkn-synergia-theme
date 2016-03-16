<div class="blogEntry">
    <a rel="bookmark" href="<?php the_permalink(); ?>">
    <?php if ( has_post_thumbnail() ) { ?>
        <img class="blazy blogEntry__image"
             alt="<?php the_title(); ?>"
             src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="
             data-src="<?php echo wp_get_attachment_image_src(get_post_thumbnail_id(), 'thumbnail', true)[0];?>"/>
    <?php } else { ?>
        <img class="blazy blogEntry__image"                                              src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw=="  data-src="<?php bloginfo('template_directory'); ?>/build/img/thumb.png"/><?php } ?>
    </a>
    <a class="link" rel="bookmark" href="<?php the_permalink(); ?>">
        <h2 class="blogEntry__title"><?php the_title(); ?></h2>
    </a>
    <div class="blogEntry__wrapper">
        <time class="blogEntry__time"><?php echo get_the_date(); ?></time>
        <div class="blogEntry__tags"><?php show_tags('blogEntry__tag'); ?></div>
    </div>
</div>
