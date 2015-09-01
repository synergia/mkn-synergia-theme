<?php $i = new CoAuthorsIterator(); ?>
    <div id="author-info">
        <div id="authorbox-title">Authors:</div>
        <?php while($i->iterate()){ ?>
            <div class="authorboxfix"></div>
            <div id="author-image">
                <a href="<?php the_author_meta('url'); ?>">
                    <?php echo get_avatar( get_the_author_meta('user_email'), '102', '' ); ?>
                </a>
            </div>
                <?php the_author_meta('user_login'); ?>
            <?php } ?>
    </div>
    <!--Author Info-->
