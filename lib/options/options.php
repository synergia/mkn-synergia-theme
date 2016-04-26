<?php
include 'callbacks.php';
include 'display.php';

add_action('admin_menu', 'snrg_options_add_to_menu');
function snrg_options_add_to_menu()
{
    /* Base Menu */
    add_theme_page(
    'Synergopcje',
    'Synergopcje',
    'manage_options',
    'synergoptions',
    'snrg_options_display');
}
// Adminbar //
function adminbar_link_to_snrg_options($wp_admin_bar) {
  $args = array(
    'id' => 'snrg_options_display',
    'title' => 'Synergopcje',
    'href' => home_url().'/wp-admin/themes.php?page=synergoptions',
    'meta' => array('class' => 'synergoptions'),
    'parent' => 'site-name',
    );
  $wp_admin_bar->add_node($args);
}
add_action('admin_bar_menu', 'adminbar_link_to_snrg_options', 999);
add_action('admin_init', 'snrg_options');
function snrg_options()
{

// ===============OGÓLNE===================== //
add_settings_section(
    'snrg_general_page',
    'Ogólne',
    false,
    'snrg_general_page_option'
);

    add_settings_field(
    'fb_link',
    'Link do fanpage\'a',
    'snrg_fb_link_callback',
    'snrg_general_page_option',
    'snrg_general_page'
);
    add_settings_field(
    'twitter_link',
    'Link do Twittera',
    'snrg_twitter_link_callback',
    'snrg_general_page_option',
    'snrg_general_page'
);
    add_settings_field(
    'github_link',
    'Link do Githuba',
    'snrg_github_link_callback',
    'snrg_general_page_option',
    'snrg_general_page'
);
    add_settings_field(
    'instagram_link',
    'Link do Instagramu',
    'snrg_instagram_link_callback',
    'snrg_general_page_option',
    'snrg_general_page'
);
    add_settings_field(
    'g_anal',
    'Google Analytics',
    'snrg_g_anal_callback',
    'snrg_general_page_option',
    'snrg_general_page'
);

// ===============BANER================= //
add_settings_section(
    'snrg_banner_page',
    'Baner',
    false,
    'snrg_banner_page_option'
);

    add_settings_field(
    'left_page',
    'Wybierz stronę do wyświetlania po lewej (slug)',
    'snrg_left_page_callback',
    'snrg_banner_page_option',
    'snrg_banner_page'
);
    add_settings_field(
    'middle_page',
    'Wybierz stronę do wyświetlania pośrodku (slug)',
    'snrg_middle_page_callback',
    'snrg_banner_page_option',
    'snrg_banner_page'
);
    add_settings_field(
    'right_page',
    'Wybierz stronę do wyświetlania po prawej (slug)',
    'snrg_right_page_callback',
    'snrg_banner_page_option',
    'snrg_banner_page'
);
// ===============O NAS================= //
add_settings_section(
    'snrg_about_page',
    'O nas',
    false,
    'snrg_about_page_option'
);

    add_settings_field(
    'robodrift_edition',
    'Liczba edycji RoboDrift',
    'snrg_robodrift_edition_callback',
    'snrg_about_page_option',
    'snrg_about_page'
);
    add_settings_field(
    'latitude',
    'Szerokość geograficzna (lat)',
    'snrg_latitude_callback',
    'snrg_about_page_option',
    'snrg_about_page'
);
    add_settings_field(
    'longtitude',
    'Długość geograficzna (lon)',
    'snrg_longtitude_callback',
    'snrg_about_page_option',
    'snrg_about_page'
);
register_setting('snrg_general_page_option', 'snrg_general_page_option', 'snrg_validate_options');
register_setting('snrg_banner_page_option', 'snrg_banner_page_option', 'snrg_validate_options');
register_setting('snrg_about_page_option', 'snrg_about_page_option', 'snrg_validate_options');
}

$general_options = get_option('snrg_general_page_option');
$banner_options = get_option('snrg_banner_page_option');
$about_options = get_option('snrg_about_page_option');

function snrg_validate_options( $input ) {
  $input['archive_link'] = wp_filter_nohtml_kses( $input['archive_link'] );
  $input['projects_link'] = wp_filter_nohtml_kses( $input['projects_link'] );
  $input['fb_link'] = wp_filter_nohtml_kses( $input['fb_link'] );
  $input['twitter_link'] = wp_filter_nohtml_kses( $input['twitter_link'] );
  $input['github_link'] = wp_filter_nohtml_kses( $input['github_link'] );

  $input['left_page'] = wp_filter_nohtml_kses( $input['left_page'] );
  $input['middle_page'] = wp_filter_nohtml_kses( $input['middle_page'] );
  $input['right_page'] = wp_filter_nohtml_kses( $input['right_page'] );

  $input['robodrift_edition'] = wp_filter_nohtml_kses( $input['robodrift_edition'] );
  $input['latitude'] = wp_filter_nohtml_kses( $input['latitude'] );
  $input['longtitude'] = wp_filter_nohtml_kses( $input['longtitude'] );

  return $input;
}

// Wyświetla info o aktualizacji danych członków //
function update_members_meta_page() {
  $timestamp = date('d F Y H:i:s', wp_next_scheduled('update_members_meta'));
  // $timestamp_s =wp_next_scheduled('update_members_meta');
  // $current_time = date('d F Y H:i:s', time());
  // $current_time_s = time();
  // $countdown = $timestamp_s - $current_time_s; ?>
  <h1>Do następnej aktualizacji pozostało</h1>
  <div id="clockdiv" data-event-date="<?php echo $timestamp;?>">
    <div>
      <span class="days"></span>
      <div class="smalltext">Days</div>
    </div>
    <div>
      <span class="hours"></span>
      <div class="smalltext">Hours</div>
    </div>
    <div>
      <span class="minutes"></span>
      <div class="smalltext">Minutes</div>
    </div>
    <div>
      <span class="seconds"></span>
      <div class="smalltext">Seconds</div>
    </div>
  </div>
    <script>
    // http://codepen.io/SitePoint/pen/MwNPVq
    function getTimeRemaining(endtime) {
  var t = Date.parse(endtime) - Date.parse(new Date());
  var seconds = Math.floor((t / 1000) % 60);
  var minutes = Math.floor((t / 1000 / 60) % 60);
  var hours = Math.floor((t / (1000 * 60 * 60)) % 24);
  var days = Math.floor(t / (1000 * 60 * 60 * 24));
  return {
    'total': t,
    'days': days,
    'hours': hours,
    'minutes': minutes,
    'seconds': seconds
  };
}

function initializeClock(id, endtime) {
  var clock = document.getElementById(id);
  var daysSpan = clock.querySelector('.days');
  var hoursSpan = clock.querySelector('.hours');
  var minutesSpan = clock.querySelector('.minutes');
  var secondsSpan = clock.querySelector('.seconds');

  function updateClock() {
    var t = getTimeRemaining(endtime);

    daysSpan.innerHTML = t.days;
    hoursSpan.innerHTML = ('0' + t.hours).slice(-2);
    minutesSpan.innerHTML = ('0' + t.minutes).slice(-2);
    secondsSpan.innerHTML = ('0' + t.seconds).slice(-2);

    if (t.total <= 0) {
      clearInterval(timeinterval);
    }
  }

  updateClock();
  var timeinterval = setInterval(updateClock, 1000);
}

var deadline = jQuery('#clockdiv').attr('data-event-date');
console.log(deadline);
initializeClock('clockdiv', deadline);
</script>
<?php
}
