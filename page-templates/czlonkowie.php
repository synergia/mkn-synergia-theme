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
// https://tommcfarlin.com/wp_user_query-multiple-roles/
// prepare arguments
$synergia_member_args = array (
	'role'           => 'synergia_member',
	'order'          => 'ASC',
	'orderby'        => 'post_count',
	'meta_query'     => array(
		array(
			'key'       => 'post_count',
			'compare'   => '>',
			'type'      => 'NUMERIC',
            'value'     => '0',
		),
	),
);

$administrator_args = array (
	'role'           => 'administrator',
	'order'          => 'ASC',
	'orderby'        => 'post_count',
	'meta_query'     => array(
		array(
			'key'       => 'post_count',
			'compare'   => '>',
			'type'      => 'NUMERIC',
            'value'     => '0',
		),
	),
);
// Create the WP_User_Query object
$administrator_query = new WP_User_Query($administrator_args);
$synergia_member_query = new WP_User_Query($synergia_member_args);

$administrators = $administrator_query->get_results();
$synergia_members = $synergia_member_query->get_results();

$members = array_merge( $administrators, $synergia_members );

// Get the results
// Check for results
if (!empty($members))
{
    echo '<ul>';
    // loop trough each author
    foreach ($members as $member)
    {
        // get all the user's data
        $member_info = get_userdata($member->ID);
        echo '<li>'.$member_info->user_nicename.'</li>';
    }
    echo '</ul>';
} else {
    echo 'No authors found';
}

        ?>
    </div>
</div>


<?php get_footer(); ?>
