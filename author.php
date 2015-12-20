<?php get_header(); ?>
<?php get_template_part('template-part', 'topnav');
 ?>
<div class="gl">
<?php // This sets the $current_member variable
$current_member = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
global $wp_query;
$current_member = $wp_query->get_queried_object();


// Ukończone i w trakcie realizacji projekty //
$finished_projects = new WP_Query( project_args_per_user($current_member, 'finished'));
$in_progress_projects = new WP_Query( project_args_per_user($current_member, 'in_progress'));

// project_counter();
//dla sprawdzenia konkretnej roli, wrzucamy je do zmiennych
$synergia_member = in_array( 'synergia_member', (array) $current_member->roles );
$administrator = in_array( 'administrator', (array) $current_member->roles );
$ex_synergia_member = in_array( 'ex_synergia_member', (array) $current_member->roles );
?>
  <div class="gl-md-9 gl-cell">
    <div class="gl usercard">
      <div class="gl-md-3 gl-lg-2 userpic gl-cell">
				<?php echo show_avatar($current_member); ?>
        <?php if (is_president($current_member)) { echo '<i class="icon crown icon-crown"></i>';} ?>
      </div>
      <div class="gl-md-9 gl-lg-10 gl-cell userinfo">
        <h2><?php echo $current_member->display_name; ?></h2>
        <?php show_membership_status($current_member); ?>
        <?php social_links($current_member); ?>
      </div>
    </div>

    <div class="tabs">
      <input id="tab-1" name="tabset-1" type="radio" hidden checked/>
      <input id="tab-2" name="tabset-1" type="radio" hidden />
      <input id="tab-3" name="tabset-1" type="radio" hidden />
      <nav class="tabs-nav" role="navigation">
        <ul>
          <li><label for="tab-1">Ukończone (<?php echo get_number_of_projects($current_member, 'finished'); ?>)</label></li>
          <li><label for="tab-2">Realizowane (<?php echo get_number_of_projects($current_member, 'in_progress') ?>)</label></li>
          <li><label for="tab-3">Github</label></li>
        </ul>
      </nav>
      <div class="tab">
        <div class="post-list">
<?php
  if( $finished_projects->have_posts() ) {
    while( $finished_projects->have_posts() ) {
      $finished_projects->the_post();
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
              <div class="excerpt"><?php the_excerpt(); ?></div>
            </div>
          </div>
<?php }
  } else {
    echo 'Nic a nic';
  }
?>
      </div>
    </div>
    <!-- UKOŃCZONE END -->
    <div class="tab">
      <div class="post-list">
          <?php
              if( $in_progress_projects->have_posts() ) {
                while( $in_progress_projects->have_posts() ) {
                  $in_progress_projects->the_post();
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
