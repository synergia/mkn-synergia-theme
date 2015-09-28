<?php
/*
Template Name: Członkowie
*/
?>

<?php get_header(); ?>

<?php get_template_part('template-part', 'topnav'); ?>

<!-- start content container -->
<div class="gl">

    <?php //left sidebar ?>
    <?php get_sidebar( 'left' ); ?>
    <div class="gl-sm-9 gl-cell">

<?php

// prepare arguments
$args = array (
	'role'           => 'synergia_member',
	'order'          => 'ASC',
	'orderby'        => 'post_count',
	'meta_query'     => array(
		array(
			'key'       => 'post_count',
			'compare'   => '>',
			'type'      => 'NUMERIC',
		),
	),
);
// Create the WP_User_Query object
$wp_user_query = new WP_User_Query($args);
// Get the results
$authors = $wp_user_query->get_results();
// Check for results
if (!empty($authors))
{
    echo '<ul>';
    // loop trough each author
    foreach ($authors as $author)
    {
        // get all the user's data
        $author_info = get_userdata($author->ID);
        echo '<li>'.$author_info->user_nicename.'</li>';
    }
    echo '</ul>';
} else {
    echo 'No authors found';
}

        ?>
    </div>
</div>


<?php get_footer(); ?>
