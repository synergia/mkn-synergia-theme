<?php get_header(); ?>
<?php get_template_part('template-part', 'topnav'); ?>

<div class="gl">
        <?php //left sidebar ?>
        <?php get_sidebar( 'left' ); ?>
<!-- This sets the $curauth variable -->

    <?php
    $curauth = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
    global $wp_query;
    $curauth = $wp_query->get_queried_object();
	$post_count = 0;
//    $post_count = $wpdb->get_var("SELECT COUNT(*) FROM $wpdb->posts WHERE post_author = '" . $curauth->ID . "' AND post_type = 'projekt' AND post_status = 'publish'");
//$post_count = custom_get_user_posts_count($curauth->ID,array('post_type' =>'projekt','author_name' => $curauth->user_nicename));
?>
    <div class="gl-md-9 gl-cell">
        <div class="gl usercard">
            <div class="gl-md-3 userpic gl-cell">
				<?php if($curauth->image) { ?>
                	<img src="<?php echo $curauth->image; ?>"/>
				<?php }else { ?>
					<?php echo get_avatar( $curauth->user_email, '96' ); }?>
           </div>
            <div class="gl-md-9 gl-cell userinfo">
                <h2><?php echo $curauth->first_name ." ". $curauth->last_name; ?></h2>
                <?php if ( (in_array( 'synergia_member', (array) $curauth->roles )) || (in_array( 'administrator', (array) $curauth->roles )) ) { ?>
					<span>Członek MKNM "Synergia"</span>
					<?php if($curauth->github_profile){ ?>
					<a github href="<?php echo $curauth->github_profile; ?>"><i class="icon icon-github"></i></a>
					<?php } ?>
					<?php if($curauth->twitter_profile){ ?>
					<a twitter href="<?php echo $curauth->twitter_profile; ?>"><i class="icon icon-twitter"></i></a>
					<?php } ?>
					<?php if($curauth->facebook_profile){ ?>
					<a face href="<?php echo $curauth->facebook_profile; ?>"><i class="icon icon-facebook"></i></a>
					<?php } ?>
                <?php } ?>
            </div>
        </div>

        <div class="tabs">
          <input id="tab-1" name="tabset-1" type="radio" hidden checked/>
          <input id="tab-2" name="tabset-1" type="radio" hidden />
          <nav class="tabs-nav" role="navigation">
            <ul>
              <li><label for="tab-1">Projekty (<?php echo $curauth->post_count; ?>)</label></li>
              <li><label for="tab-2">Github</label></li>
            </ul>
          </nav>
          <div class="tab">
            <div class="post-list">
            <?php
                $args = array(
                    'post_type' => 'projekt ',
                    'posts_per_page' => -1,
					'author_name' => $curauth->user_nicename,
                   );
                $items = new WP_Query( $args );
                if( $items->have_posts() ) {
                  while( $items->have_posts() ) {
                    $items->the_post();
					post_count($curauth->ID, $items->found_posts);
                    ?>
                      <div class="post-list-item ">
                        <a rel="bookmark" href="<?php the_permalink(); ?>">
                          <?php the_post_thumbnail("thumbnail"); ?>
						</a>
                        <div class="post-list-item-content">
                          <a rel="bookmark" href="<?php the_permalink(); ?>">
                            <h2><?php the_title(); ?></h2>
                          </a>
                          <div class="excerpt">
                            <?php the_excerpt(); ?>
                          </div>
                        </div>
                      </div>
            <?php
                  }
                }
                else {
                  echo 'Nic a nic';
                }
              ?>

          </div>
        </div>
          <div class="tab">
            <div class="github"></div>
          </div>
    </div>
    </div>
</div>
<?php get_footer(); ?>
