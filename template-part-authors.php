<?php //http://wordpress.stackexchange.com/a/119946
global $post;
$author_id=$post->post_author;
foreach( get_coauthors() as $coauthor ): ?>
	<div class="co-author gl-md-3 gl-cell">
		<div class="userpic-project">
			<a href="<?php echo get_author_posts_url( $coauthor->ID, $coauthor->user_nicename ); ?>">
				<?php if ($coauthor->image){ ?>
				<img src="<?php echo $coauthor->image; ?>" />
				<?php } else {?>
				<?php echo get_avatar( $coauthor->user_email, '96' ); }?>
			</a>
		</div>
		<div>
			<div class="gl-vertical gl">
				<h3 class="gl-cell"><a href="<?php echo get_author_posts_url( $coauthor->ID, $coauthor->user_nicename ); ?>"  rel="author"><?php echo $coauthor->display_name; ?></a></h3>
				<div class="gl-cell">
					<a github href="<?php echo $coauthor->github_profile; ?>"><i class="icon icon-github"></i></a>
					<a twitter href="<?php echo $coauthor->twitter_profile; ?>"><i class="icon icon-twitter"></i></a>
					<a face href="<?php echo $coauthor->facebook_profile; ?>"><i class="icon icon-facebook"></i></a>
				</div>
			</div>
		</div>
	</div>
	<!-- .entry-author co-author -->
	<?php endforeach; ?>
