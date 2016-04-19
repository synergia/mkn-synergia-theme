<?php
// Różne funkcje pomocnicze //

function get_members_with_projects() {

// https://tommcfarlin.com/wp_user_query-multiple-roles/
// Każdy członek z rolą synergia_member i administrator
// jest pobierany z bazy, jeśli ma na koncie przynajmniej jeden projekt.
// Pobierane są dwie tablice: dla członków i adminów a następnie
// scalane do jednej.
    $synergia_member_args = array(
        'role' => 'synergia_member',
        'order' => 'DESC',
        'orderby' => 'meta_value',
        'meta_query' => array(
            array(
                'key' => 'number_of_finished_projects',
                'compare' => '>',
                'type' => 'NUMERIC',
                'value' => '0',
            ),
        ),
    );

    $administrator_args = array(
        'role' => 'administrator',
        'order' => 'DESC',
        'orderby' => 'meta_value',
        'meta_query' => array(
            array(
                'key' => 'number_of_finished_projects',
                'compare' => '>',
                'type' => 'NUMERIC',
                'value' => '0',
            ),
        ),
    );
// Create the WP_User_Query object
    $administrator_query = new WP_User_Query($administrator_args);
    $synergia_member_query = new WP_User_Query($synergia_member_args);

    $administrators = $administrator_query->get_results();
    $synergia_members = $synergia_member_query->get_results();
// scalanie tablic
    return array_merge($administrators, $synergia_members);
}

// pobieranie byłych członków
function get_ex_members() {
    $ex_synergia_member_args = array(
    'role' => 'ex_synergia_member',
);
    $ex_synergia_member_query = new WP_User_Query($ex_synergia_member_args);
    $ex_synergia_members = $ex_synergia_member_query->get_results();

    return $ex_synergia_members;
}

function get_member_avatar_url($current_member) {
    $avatar_url = carbon_get_user_meta($current_member->ID, 'crb_member_profile_image');
    if ($avatar_url) {
        return $avatar_url;
    } else {
        return get_template_directory_uri().'/build/img/member.png';
    }
}

function show_avatar($current_member, $css_class = "")
{
    $avatar_url = get_member_avatar_url($current_member);
    $avatar_img = '<a class="link--name" href="'.get_author_posts_url( $current_member->ID, $current_member->user_nicename ).'">';
    if ($avatar_url) {
        $avatar_img .= '<img class="blazy '.$css_class.'" src="'.get_template_directory_uri().'/build/img/member.png"  data-src="'.$avatar_url.'" /></a>';
    }
    return $avatar_img;
}
function show_avatar_on_admin($current_member)
{
    $avatar_url = get_member_avatar_url($current_member);
    $avatar_img = '<a class="link--name" href="'.get_author_posts_url( $current_member->ID, $current_member->user_nicename ).'">';
    if ($avatar_url) {
        $avatar_img .= '<img src="'.$avatar_url.'" /></a>';
    } else {
        $avatar_img .= '<img src="'.get_template_directory_uri().'/build/img/member.png" /></a>';
    }
    return $avatar_img;
}
function get_member_name($current_member) {
    $member_url = get_author_posts_url( $current_member->ID, $current_member->user_nicename );
    return '<a class="link link--name" href="'.$member_url.'">'.$current_member->display_name.'</a>';
}

function is_president($current_member) {
    $member_of_managment_board = carbon_get_user_meta($current_member->ID, 'crb_managment_board');

  if ($member_of_managment_board[0] == 'president') {
    return true;
  } else {
    return false;
  }
}

// Wyświetla liczbę projektów w panelu admin. //
// Skradziono u co-authors
function users_projects_column($cols){
    $cols['projects'] = 'Ukończone (Realiz.)';
    return $cols;
}

function user_projects_column_value($value, $column_name, $id){
    if ('projects' != $column_name) {
        return $value;
    }
    $user = get_user_by('id', $id);
    $finished = get_number_of_projects($user, 'finished');
    $in_progress = get_number_of_projects($user, 'in_progress');

    return $value .= "<a href='edit.php?author_name=".$user->user_nicename."&post_type=project' title='Zobacz projekty tego członka' class='edit'>$finished ($in_progress)</a>";
}
add_filter('manage_users_custom_column', 'user_projects_column_value', 10, 3);
add_filter('manage_users_columns', 'users_projects_column');

// Wyświetlanie loga na liście członków //
// Wrzucenie kolumny z profilowymi przed username
function users_avatars_column($cols){
  $cols['avatars'] = 'Profilowe';
  $crunchify_columns = array();
  $title = 'username';
  foreach($cols as $key => $value) {
    if ($key==$title){
      $crunchify_columns['avatars'] = '';   // Move date column before title column
      // Move tags column before title column
    }
    $crunchify_columns[$key] = $value;
  }
  return $crunchify_columns;
}
add_filter('manage_users_columns', 'users_avatars_column');

function user_avatars_column_value($value, $column_name, $id){
  if ('avatars' != $column_name) {
      return $value;
  }
    $user = get_user_by('id', $id);
    return show_avatar_on_admin($user);
}
add_filter('manage_users_custom_column', 'user_avatars_column_value', 2, 3);

// Aktualizuje liczbę wykonanych projektów wszystkich użytkowników //
add_action('update_members_meta', 'update_number_of_projects');
function em_event_activation()
{
  // wp_unschedule_event( wp_next_scheduled( 'update_members_meta' ), 'update_members_meta' );

    if ( !wp_next_scheduled( 'update_members_meta' ) ) {
        wp_schedule_event( current_time( 'timestamp' ), 'daily', 'update_members_meta');
    }
}
add_action('wp', 'em_event_activation');
// Make sure this event hasn't been scheduled

function update_number_of_projects() {
  $all_members = get_users();
  function update_number_of_projects_meta($member, $number_of_projects, $project_status) {
    if ($project_status == 'finished') {
        update_user_meta($member->ID, 'number_of_finished_projects', $number_of_projects);
        if (get_user_meta($member->ID, 'number_of_finished_projects', true) != $number_of_projects) {
          return false;
        } else {
          return true;
        }
      } elseif ($project_status == 'in_progress') {
        update_user_meta($member->ID, 'number_of_in_progress_projects', $number_of_projects);
        if (get_user_meta($member->ID, 'number_of_in_progress_projects', true) != $number_of_projects) {
          return false;
        } else {
          return true;
        }
      }
    }
  echo '<ol>';
  foreach ( $all_members as $member ) {
	   $finished_projects = new WP_Query(project_args_per_user($member, 'finished'));
	   $in_progress_projects = new WP_Query(project_args_per_user($member, 'in_progress'));
     // Jeśli członek ma projekty, to je przelicza
     if ($finished_projects->have_posts()) {
       if (update_number_of_projects_meta($member, $finished_projects->found_posts, 'finished')) {
         echo '<li>Updating Fin '.$member->display_name.' ('.$member->number_of_finished_projects.'): OK</li>';
       } else {
         echo '<li>Updating Fin '.$member->display_name.': FAILED</li>';
       }
     } else {
       // Gdy brak ukończonych projektów
       if (update_number_of_projects_meta($member, 0, 'finished')) {
         echo '<li>Updating Fin '.$member->display_name.' ('.$member->number_of_finished_projects.'): OK</li>';
       } else {
         echo '<li>Updating Fin '.$member->display_name.': FAILED</li>';
       }
     }
     if ($in_progress_projects->have_posts()) {
       if (update_number_of_projects_meta($member, $in_progress_projects->found_posts, 'in_progress')) {
         echo '<li>Updating IP '.$member->display_name.' ('.$member->number_of_in_progress_projects.'): OK</li>';
       } else {
         echo '<li>Updating IP '.$member->display_name.': FAILED</li>';
       }
     } else {
       // Gdy brak ukończonych projektów
       if (update_number_of_projects_meta($member, 0, 'in_progress')) {
         echo '<li>Updating IP '.$member->display_name.' ('.$member->number_of_in_progress_projects.'): OK</li>';
       } else {
         echo '<li>Updating IP '.$member->display_name.': FAILED</li>';
       }
     }
   }
   echo '</ol>';
}

// Zapisuje liczbę ukończonych projektów do meta użytkownika //

function count_projects() {
  global  $post;

    // Pobiera stan projektu
    $project_status = get_post_meta($post->ID, 'project_status', true);
    // get_coauthors() zwraca wszystkich członków przypisanych do tego wpisu
    foreach (get_coauthors($post->ID) as $member) {
      // Sprawdza, jaki licznik zaktualizować
      if($project_status == "Ukończony" || $project_status == "W ciągłym doskonaleniu" ) {
        $projects = new WP_Query(project_args_per_user($member, 'finished'));
        if ($projects->have_posts()) {
          update_user_meta($member->ID, 'number_of_finished_projects', $projects->found_posts);
        }
      } else if ($project_status == "W trakcie realizacji") {
        $projects = new WP_Query(project_args_per_user($member, 'in_progress'));
        if ($projects->have_posts()) {
          update_user_meta($member->ID, 'number_of_in_progress_projects', $projects->found_posts);
        }
      }
    }
}
// Hooki (zdarzenia), przy których się odpala ta funkcja //
// Przy czym, przy usunięciu członka z projektu i
// zaktualizowaniu projektu hooki nie działają oO
add_action('publish_post', 'count_projects');
add_action('save_post', 'count_projects');
add_action('pre_post_update', 'count_projects', 1, 0);
add_action('before_delete_post', 'count_projects');
add_action('wp_trash_post', 'count_projects');
add_action('untrashed_post', 'count_projects');
// Wyświetla liczbę projektów //
function get_number_of_projects ($current_member, $project_status) {
  if (($current_member->number_of_finished_projects) && $project_status == 'finished') {
    return $current_member->number_of_finished_projects;
  } elseif (($current_member->number_of_in_progress_projects) && $project_status == 'in_progress') {
    return $current_member->number_of_in_progress_projects;
  } else {
    return 0;
  }
}

// Stan członkostwa //
function show_membership_status($current_member) {
    $role = array_shift($current_member->roles);
    $member_of_managment_board = carbon_get_user_meta($current_member->ID, 'crb_managment_board');
  if(is_president($current_member)) {
    echo 'Prezes';
} else if($member_of_managment_board[0] == 'member_of_managment_board' && ($role != 'ex_synergia_member')) {
    echo 'Członek zarządu';
} else if((has_finished_projects($current_member) || $administrator) && ($role != 'ex_synergia_member')) {
    echo 'Członek koła';
}else if($role = 'ex_synergia_member') {
    echo 'Były członek koła';
  } else {
    echo 'Członkostwo nie potwierdzono';
  }
}
// Zwraca tablicę argumentów projektów //
// finished - Ukończone
// in_progress - W trakcie realizacji
function project_args_per_user($current_member, $project_status) {
  if ($project_status == "finished") {
    $args = array(
      'post_type' => 'project ',
      'posts_per_page' => -1,
      'author_name' => $current_member->user_nicename,
      'meta_query' => array(
      'relation' => 'OR',
      array(
        'key' => 'project_status',
        'value' => 'Ukończony',
        ),
      array(
        'key' => 'project_status',
        'value' => 'W ciągłym doskonaleniu',
        ),
      ),
    );
    return $args;
  }
  elseif ($project_status == "in_progress") {
    $args = array(
      'post_type' => 'project ',
      'posts_per_page' => -1,
      'author_name' => $current_member->user_nicename,
      'meta_key' => 'project_status',
      'meta_value' => 'W trakcie realizacji',
    );
    return $args;
  }
}
// Sprawdza, czy członek ukończył przynajmniej jeden projekt //
// zwraca true, lub false
function has_finished_projects($current_member) {
  $projects = new WP_Query( project_args_per_user($current_member, 'finished') );
     if( $projects->have_posts() ) {
       return true;
     }else {
       return false;
     }
}

function social_links($current_member, $css_class)
{
    $github_url = carbon_get_user_meta($current_member->ID, 'crb_member_github_link');
    $facebook_url = carbon_get_user_meta($current_member->ID, 'crb_member_facebook_link');
    $twitter_url = carbon_get_user_meta($current_member->ID, 'crb_member_twitter_link');
    $lastfm_url = carbon_get_user_meta($current_member->ID, 'crb_member_lastfm_link');
    $cv_url = carbon_get_user_meta($current_member->ID, 'crb_member_cv_link');
    $show_mail = carbon_get_user_meta($current_member->ID, 'crb_show_mail');

    if ($show_mail) {
        echo '<a class="link '.$css_class.'" title="Poczta" data-email href="mailto:'.$current_member->user_email.'"><i class="icon icon-mail"></i>';
        echo '</a>';
    }
    if ($github_url) {
        echo '<a class="link '.$css_class.'" data-github href="'.$current_member->github_profile.'"><i class="icon icon-github"></i><div class="tooltip"></div></a>';
    }
    if ($twitter_url) {
        echo '<a class="link '.$css_class.'" data-twitter title="Twitter" href="'.$current_member->twitter_profile.'"><i class="icon icon-twitter"></i></a>';
    }
    if ($facebook_url) {
        echo '<a class="link '.$css_class.'" data-facebook title="Facebook" href="'.$current_member->facebook_profile.'"><i class="icon icon-facebook-squared"></i></a>';
    }
    if ($lastfm_url) {
        echo '<a class="link '.$css_class.'" data-lastfm href="'.$current_member->lastfm_profile.'"><i class="icon icon-lastfm"></i><div class="tooltip"></div></a>';
    }
    if ($cv_url) {
        echo '<a class="link '.$css_class.'" data-cv title="Zobacz moje CV" href="'.$cv_url.'"><i class="icon icon-briefcase"></i>';
        echo '</a>';
    }
}
function cmp($a, $b){  //The function to order our authors
    $member_of_managment_board_A = carbon_get_user_meta($a->ID, 'crb_managment_board');
    $member_of_managment_board_B = carbon_get_user_meta($b->ID, 'crb_managment_board');

  if ($member_of_managment_board_A[0] == $member_of_managment_board_B[0]) {  //This is where the name of our custom meta key is entered, I named mine "order"
    return 0;
  }
  return ($member_of_managment_board_B[0] < $member_of_managment_board_A[0] ) ? -1 : 1;  //The actual sorting is done here. Change ">" to "<" to reverse order
}
?>
