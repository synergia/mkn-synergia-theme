<div class="authors gl">
<?php //http://wordpress.stackexchange.com/a/119946
global $post;
$author_id = $post->post_author;
// count_projects();
foreach (get_coauthors() as $curauth):
?>
	<div class="co-author gl-cell gl-sm-1 gl-lg-3 gl-md-4">
		<div class="gl">
			<div class="gl-cell gl-sm-3">
				<div class="userpic-project">
					<a href="<?php echo get_author_posts_url($curauth->ID, $curauth->user_nicename); ?>">
						<?php echo show_avatar($curauth);?>
					</a>
					<div class="project-count"><?php echo get_number_of_projects($curauth, 'finished') ?></div>
				</div>
			</div>
			<div class="gl-cell">
				<div class="gl-vertical gl">
						<h3 class="gl-cell">
							<a href="<?php echo get_author_posts_url($curauth->ID, $curauth->user_nicename); ?>"  rel="author"><?php echo $curauth->display_name; ?></a>
						</h3>
					<div class="gl-cell">
						<div class="icons-wrapper">
							<?php social_links($curauth); ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- .entry-author co-author -->
	<?php endforeach; ?>
</div>
