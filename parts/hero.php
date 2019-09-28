<?php
global $banner_options;

$left_page = $banner_options['left_page'];
$right_page = $banner_options['right_page'];
$middle_page = $banner_options['middle_page'];

$args_left = array(
  'name'        => $left_page,
  'post_type'   => array( 'post', ' project' ),
  'post_status' => 'publish',
  'numberposts' => 1);
$args_right = array(
  'name'        => $right_page,
  'post_type'   => array( 'post', ' project' ),
  'post_status' => 'publish',
  'numberposts' => 1);
$args_middle = array(
  'name'        => $middle_page,
  'post_type'   => array( 'post', ' project' ),
  'post_status' => 'publish',
  'numberposts' => 1);
$left_post = get_posts($args_left);
$right_post = get_posts($args_right);
$middle_post = get_posts($args_middle);

function slide_from_project($project) { ?>
  <div class="hero__slide" style="background-image: url('<?php echo wp_get_attachment_url( get_post_thumbnail_id($project[0])); ?>')">
    <a href="<?php echo get_permalink($project[0]); ?>">
      <h3 class="hero__title"><?php echo get_the_title($project[0]); ?></h3>
    </a>
  </div>

<?php
}
?>

<div class="hero">
  <div class="glide">
    <div class="glide__track" data-glide-el="track">
      <ul class="glide__slides">
        <li class="glide__slide">
          <?php slide_from_project($left_post); ?>
        </li>
        <li class="glide__slide">
          <?php slide_from_project($middle_post); ?>
        </li>
        
        <li class="glide__slide">
          <?php slide_from_project($right_post); ?> 
        </li>
      </ul>
    </div>
    <div data-glide-el="controls" class="hero__controls">
      <button class="hero__left_control" data-glide-dir="<">
        <i class="icon-left-open-big"></i>
      </button>
      <button class="hero__right_control" data-glide-dir=">">
      <i class="icon-right-open-big"></i>
      </button>
    </div>
  </div>

</div>
<div class="global global--frontpage" data-ajax-url="<?php echo admin_url('admin-ajax.php'); ?>">
  <div class="container">
