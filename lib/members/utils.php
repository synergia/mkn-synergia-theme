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
        'meta_key' => 'project_count',
        'meta_query' => array(
            array(
                'key' => 'project_count',
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
                'key' => 'project_count',
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

function social_links($current_member){
    if ($current_member->show_mail) {
        echo '<a title="Poczta" data-email href="mailto:'.$current_member->user_email.'"><i class="icon icon-mail"></i>';
        if (is_author()) {
            echo 'napisz';
        }
        echo '</a>';
    }
    if ($current_member->github_profile) {
        echo '<a data-github title="Github" href="'.$current_member->github_profile.'"><i class="icon icon-github"></i></a>';
    }
    if ($current_member->twitter_profile) {
        echo '<a data-twitter title="Twitter" href="'.$current_member->twitter_profile.'"><i class="icon icon-twitter"></i></a>';
    }
    if ($current_member->facebook_profile) {
        echo '<a data-facebook title="Facebook" href="'.$current_member->facebook_profile.'"><i class="icon icon-facebook"></i></a>';
    }
    if ($current_member->cv) {
      echo '<a data-cv title="Zobacz moje CV" href="'.$current_member->cv.'"><i class="icon icon-briefcase"></i>';
      if (is_author()) {
          echo 'cv';
      }
      echo '</a>';
    }
}

function show_avatar($current_member)
{
    if ($current_member->image) {
        $avatar_img = '<img src="'.$current_member->image.'" />';
    } else {
        $avatar_img = '<img src="'.get_template_directory_uri().'/build/img/member.png"/>';
    }
    return $avatar_img;
}

function is_president($current_member) {
  if ($current_member->president) {
    return true;
  } else {
    return false;
  }
}

// Wyświetla liczbę projektów w panelu admin. //
// Skradziono u co-authors
function users_projects_column($cols){
    $cols['projects'] = 'Projekty';
    return $cols;
}

function user_projects_column_value($value, $column_name, $id){
    if ('projects' != $column_name) {
        return $value;
    }
    $user = get_user_by('id', $id);
    return $value .= "<a href='edit.php?author_name=".$user->user_nicename."&post_type=project' title='Zobacz projekty tego członka' class='edit'>$user->project_count</a>";
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
    return show_avatar($user);
}
add_filter('manage_users_custom_column', 'user_avatars_column_value', 2, 3);

// Zapisuje liczbę projektów do meta użytkownika //

function count_done_projects()
{
    global  $post;
    foreach (get_coauthors($post->ID) as $member) {

//        echo $member->ID.":";
        $args = array(
            'post_type' => 'project ',
            'posts_per_page' => -1,
            'author_name' => $member->user_nicename,
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
        $items = new WP_Query($args);
        if ($items->have_posts()) {
            update_user_meta($member->ID, 'project_count', $items->found_posts);
//            echo $items->found_posts." ";
        } else {
            update_user_meta($member->ID, 'project_count', 0);
        }
    }
}
// Hooki (zdarzenia), przy których się odpala ta funkcja //
// Przy czym, przy usunięciu członka z projektu i
// zaktualizowaniu projektu hooki nie działają oO
    add_action('publish_post', 'project_counter');
    add_action('save_post', 'project_counter');
    add_action('delete_post', 'project_counter');
    add_action('post_updated', 'project_counter');

// Stan członkostwa //
function show_membership_status($current_member) {
  if($current_member->president) {
    echo '<span>Prezes MKNM "Synergia"</span>';
  } else if($current_member->member_of_managment_board) {
    echo '<span>Członek zarządu MKNM "Synergia"</span>';
  } else if(is_member($current_member) || $administrator) {
    echo '<span>Członek MKNM "Synergia"</span>';
  }else if($ex_synergia_member) {
    echo '<span>Były członek MKNM "Synergia"</span>';
  } else {
    echo '<span>Członkostwo nie potwierdzono</span>';
  }
}

// Sprawdza, czy członek ukończył przynajmniej jeden projekt //
function is_member($current_member) {
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
     $projects = new WP_Query( $args );
     if( $projects->have_posts() ) {
       return true;
     }else {
       return false;
     }
}
?>
