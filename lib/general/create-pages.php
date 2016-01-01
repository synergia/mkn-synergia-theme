<?php

// Tworzy strony //

//Argumenty dla strony Błędu <noscript>
function create_nojs()
{
  $nojs_args = array(
  'post_status' => 'publish',
  'post_type' => 'page',
  'post_name' => 'nojs',
  'page_template' => 'page-templates/nojs.php',
  'post_title' => 'Brak obsługi JavaScript',
  'post_content' => '',

);
    if (get_page_by_title('Brak obsługi JavaScript') == null) {
        wp_insert_post($nojs_args);
        echo '<div class="updated"> <p>Utworzono stronę "Javascript wyłączony"</p></div>';

    }
}
add_action('after_switch_theme', 'create_nojs');
