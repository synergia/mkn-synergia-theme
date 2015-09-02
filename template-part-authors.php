<?php //http://wordpress.stackexchange.com/a/119946
global $post;
$author_id=$post->post_author;
foreach( get_coauthors() as $coauthor ): ?>
  <div class="entry-author co-author">
    <?php echo get_avatar( $coauthor->user_email, '96' ); ?>
    <h3 class="author vcard"><span class="fn"><a href="<?php echo get_author_posts_url( $coauthor->ID, $coauthor->user_nicename ); ?>"><?php echo $coauthor->display_name; ?></a></span></h3>
    <p class="author-bio"><?php echo $coauthor->description; ?></p>
    <div class="clear"></div>
   </div><!-- .entry-author co-author -->
<?php endforeach; ?>
