<?php
// ===============BANNER================= //

function snrg_left_page_callback() {
  global $banner_options;
  var_dump($banner_options);
  echo '<input type="text" id="left_page" name="snrg_banner_page_option[left_page]" value="' . $banner_options['left_page']. '"></input>';
 }
function snrg_middle_page_callback() {
  global $banner_options;
  echo '<input type="text" id="middle_page" name="snrg_banner_page_option[middle_page]" value="' . $banner_options['middle_page']. '"></input>';
 }
function snrg_right_page_callback() {
  global $banner_options;
  echo '<input type="text" id="right_page" name="snrg_banner_page_option[right_page]" value="' . $banner_options['right_page']. '"></input>';
 }


// ================OGÓLNE===================== //

function snrg_fb_link_callback() {
  global $general_options;
    echo '<input type="text" id="fb_link_id" name="snrg_general_page_option[fb_link]" value="' . $general_options['fb_link']. '"></input>';
}
function snrg_twitter_link_callback() {
  global $general_options;
    echo '<input type="text" id="twitter_link_id" name="snrg_general_page_option[twitter_link]" value="' . $general_options['twitter_link']. '"></input>';
}
function snrg_github_link_callback() {
  global $general_options;
    echo '<input type="text" id="github_link_id" name="snrg_general_page_option[github_link]" value="' . $general_options['github_link']. '"></input>';
}
function snrg_instagram_link_callback() {
  global $general_options;
    echo '<input type="text" id="instagram_link_id" name="snrg_general_page_option[instagram_link]" value="' . $general_options['instagram_link']. '"></input>';
}
function snrg_g_anal_callback() {
  global $general_options;
  ?>
  <textarea name="snrg_general_page_option[g_anal]" id="google_anal"><?php echo $general_options['g_anal']; ?></textarea>
  <p class="description">Kod śledzący Google Analytics</p>
  <?php
}
