<?php //http://wordpress.stackexchange.com/a/119946
global $post;
$author_id=$post->post_author;
foreach( get_coauthors() as $curauth ):
?>
	<div class="co-author gl-md-3 gl-cell">
		<div class="userpic-project">
			<a href="<?php echo get_author_posts_url( $curauth->ID, $curauth->user_nicename ); ?>">
				<?php if ($curauth->image){ ?>
				<img src="<?php echo $curauth->image; ?>" />
				<?php } else {?>
				<?php echo get_avatar( $curauth->user_email, '96' ); }?>
			</a>
			<div class="post-count"><?php echo $curauth->post_count; ?></div>
		</div>
		<div>
			<div class="gl-vertical gl">
				<h3 class="gl-cell"><a href="<?php echo get_author_posts_url( $curauth->ID, $curauth->user_nicename ); ?>"  rel="author"><?php echo $curauth->display_name; ?></a></h3>
				<div class="gl-cell">
					<?php if($curauth->github_profile){ ?>
					<a github href="<?php echo $curauth->github_profile; ?>"><i class="icon icon-github"></i></a>
					<?php } ?>
					<?php if($curauth->twitter_profile){ ?>
					<a twitter href="<?php echo $curauth->twitter_profile; ?>"><i class="icon icon-twitter"></i></a>
					<?php } ?>
					<?php if($curauth->facebook_profile){ ?>
					<a face href="<?php echo $curauth->facebook_profile; ?>"><i class="icon icon-facebook"></i></a>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
	<!-- .entry-author co-author -->
	<?php endforeach; ?>
