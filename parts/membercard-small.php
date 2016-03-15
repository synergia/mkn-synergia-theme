<?php //http://wordpress.stackexchange.com/a/119946
global $post;
$author_id = $post->post_author;
foreach (get_coauthors() as $curauth):
?>
	<div class="membercardSmall">
		<div class="membercardSmall__avatarWrapper">
			<a href="<?php echo get_author_posts_url($curauth->ID, $curauth->user_nicename); ?>">
				<?php echo show_avatar($curauth, 'membercardSmall__avatar');?>
			</a>
			<div title="Liczba ukończonych projektów" class="membercardSmall__counter"><?php echo get_number_of_projects($curauth, 'finished') ?></div>
		</div>
		<div>
			<h3 class="membercardSmall__name">
				<a class="link link--name noWrap" href="<?php echo get_author_posts_url($curauth->ID, $curauth->user_nicename); ?>"  rel="author"><?php echo $curauth->display_name; ?></a>
			</h3>
		<div class="membercardSmall__icons">
			<?php social_links($curauth, 'link--social'); ?>
		</div>
		</div>

	</div>
	<?php endforeach; ?>
