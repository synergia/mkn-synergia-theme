<?php
//allows the theme to get info from the theme options page
global $options;
foreach ($options as $value) {
    if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); }
}
?>

<?php $post = $wp_query->post;
if ( in_category($bb_blog_cat) ) {
  include(TEMPLATEPATH . '/single_blog.php');
} else {
  include(TEMPLATEPATH . '/single_portfolio.php');
}
?>