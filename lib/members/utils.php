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
        echo '<a email href="mailto:'.$current_member->user_email.'"><i class="icon icon-mail"></i>';
        if (is_author()) {
            echo 'napisz';
        }
        echo '</a>';
    }
    if ($current_member->github_profile) {
        echo '<a data-github href="'.$current_member->github_profile.'"><i class="icon icon-github"></i></a>';
    }
    if ($current_member->twitter_profile) {
        echo '<a data-twitter href="'.$current_member->twitter_profile.'"><i class="icon icon-twitter"></i></a>';
    }
    if ($current_member->facebook_profile) {
        echo '<a data-facebook href="'.$current_member->facebook_profile.'"><i class="icon icon-facebook"></i></a>';
    }
}

function show_avatar($current_member)
{
    if ($current_member->image) {
        echo '<img src="'.$current_member->image.'" />';
        if ($current_member->president && is_author()) {
            echo '<i class="icon crown icon-crown"></i>';
        }
    } else {
        echo '<img src="'.get_template_directory_uri().'/build/img/safari_152.png"/>';
    }
}

// Wyświetla liczbę projektów w panelu admin. //
// Skradziono u co-authors
function users_events_column($cols){
    $cols['projects'] = 'Projekty';
    return $cols;
}

function user_events_column_value($value, $column_name, $id){
    if ('projects' != $column_name) {
        return $value;
    }
    $user = get_user_by('id', $id);
    return $value .= "<a href='edit.php?author_name=".$user->user_nicename."&post_type=project' title='Zobacz projekty tego członka' class='edit'>$user->project_count</a>";
}

add_filter('manage_users_custom_column', 'user_events_column_value', 10, 3);
add_filter('manage_users_columns', 'users_events_column');

// Zapisuje liczbę projektów do meta użytkownika //

function project_counter()
{
    global  $post;

    foreach (get_coauthors($post->ID) as $member) {

//        echo $member->ID.":";
        $args = array(
            'post_type' => 'project ',
            'posts_per_page' => -1,
            'author_name' => $member->user_nicename,
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
?>
