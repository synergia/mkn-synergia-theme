<?php get_header(); ?>
<?php get_template_part('template-part', 'topnav'); ?>

<div class="gl">
        <?php //left sidebar ?>
        <?php get_sidebar( 'left' ); ?>
<!-- This sets the $current_member variable -->

    <?php
    $current_member = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
    global $wp_query;
    $current_member = $wp_query->get_queried_object();
	$project_count = 0;

    //dla sprawdzenia konkretnej roli, wrzucamy je do zmiennych
    $synergia_member = in_array( 'synergia_member', (array) $current_member->roles );
    $administrator = in_array( 'administrator', (array) $current_member->roles );
    $ex_synergia_member = in_array( 'ex_synergia_member', (array) $current_member->roles );
?>
    <div class="gl-md-9 gl-cell">
        <div class="gl usercard">
            <div class="gl-md-3 gl-lg-2 userpic gl-cell">
				<?php show_avatar($current_member); ?>
           </div>
            <div class="gl-md-9 gl-lg-10 gl-cell userinfo">
                <h2><?php echo $current_member->display_name; ?></h2>
                <?php //ify sprawdzające czy jest prezesem, członkiem lub byłym członkiem ?>
					<?php if($current_member->president){ ?><span>Prezes MKNM "Synergia"</span>
					<?php }else if($current_member->member_of_managment_board){?><span>Członek zarządu MKNM "Synergia"</span>
                    <?php }else if($synergia_member || $administrator){?><span>Członek MKNM "Synergia"</span>
					<?php }else if($ex_synergia_member){?><span>Były członek MKNM "Synergia"</span>
                    <?php } else { echo 'Członkostwo nie potwierdzono'; }?>
					<?php social_links($current_member); ?>
            </div>
        </div>

        <div class="tabs">
          <input id="tab-1" name="tabset-1" type="radio" hidden checked/>
          <input id="tab-2" name="tabset-1" type="radio" hidden />
          <nav class="tabs-nav" role="navigation">
            <ul>
              <li><label for="tab-1">Projekty (<?php echo $current_member->project_count; ?>)</label></li>
              <li><label for="tab-2">Github</label></li>
            </ul>
          </nav>
          <div class="tab">
            <div class="post-list">
            <?php
                $args = array(
                    'post_type' => 'project ',
                    'posts_per_page' => -1,
					'author_name' => $current_member->user_nicename,
                   );
                $items = new WP_Query( $args );
                if( $items->have_posts() ) {
                  while( $items->have_posts() ) {
                    $items->the_post();
				    project_count($current_member->ID, $items->found_posts);
                    ?>
                      <div class="post-list-item ">
						  <div class="thumb">
								<a rel="bookmark" href="<?php the_permalink(); ?>">
									<time><?php echo get_the_date(); ?></time>
								</a>
									<?php the_post_thumbnail("thumbnail"); ?>
						  </div>
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
                    project_count($current_member->ID, 0);
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
