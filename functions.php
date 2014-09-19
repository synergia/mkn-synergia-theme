<?php

/*Sidebar Widget*/

if ( function_exists('register_sidebar') )
    register_sidebar(array(
    	'name' => 'standard',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
    ));
    
if ( function_exists('register_sidebar') )
    register_sidebar(array(
    	'name' => 'blog',
        'before_widget' => '',
        'after_widget' => '',
        'before_title' => '<h2>',
        'after_title' => '</h2>',
    ));


/* Add Post Image Theme Support */
add_theme_support( 'post-thumbnails' );
add_image_size( 'portfolio-thumb', 310, 150, true );
add_image_size( 'portfolio-big', 657, 318, true ); 


/*Custom Write Panel*/

$meta_boxes =
	array(
		"image" => array(
			"name" => "post_image",
			"type" => "text",
			"std" => "",
			"title" => "Image",
			"description" => "Using the \"<em>Add an Image</em>\" button, upload an image and paste the URL here.")
	);

function meta_boxes() {
	global $post, $meta_boxes;
	
	echo'
		<table class="widefat" cellspacing="0" id="inactive-plugins-table">
		
			<tbody class="plugins">';
	
			foreach($meta_boxes as $meta_box) {
				$meta_box_value = get_post_meta($post->ID, $pre.'_value', true);
				
				if($meta_box_value == "")
					$meta_box_value = $meta_box['std'];
				
				echo'<tr>
						<td width="100" align="center">';		
							echo'<input type="hidden" name="'.$meta_box['name'].'_noncename" id="'.$meta_box['name'].'_noncename" value="'.wp_create_nonce( plugin_basename(__FILE__) ).'" />';
							echo'<h2>'.$meta_box['title'].'</h2>';
				echo'	</td>
						<td>';
							echo'<input type="text" name="'.$meta_box['name'].'_value" value="'.get_post_meta($post->ID, $meta_box['name'].'_value', true).'" size="100" /><br />';
							echo'<p><label for="'.$meta_box['name'].'_value">'.$meta_box['description'].' </label></p>';
				echo'	</td>
					</tr>';
			}
	
	echo'
			</tbody>
		</table>';		
}







/*Start of Theme Options*/
 
$themename = "BlueBubble";
$shortname = "bb";
$options = array (
 
array( "name" => "BlueBubble Options",
	"type" => "title"),
 
array( "type" => "open"),
 
array( "name" => "Logo",
	"desc" => "Enter full path to your Logo. For Example: http://www.yoursite.com/wp-content/uploads/image.png",
	"id" => $shortname."_logo",
	"type" => "text",
	"std" => ""),
	
array( "name" => "Portfolio Category",
	"desc" => "Enter the name of the Portfolio category",
	"id" => $shortname."_portfolio_cat",
	"type" => "text",
	"std" => ""),
	
array( "name" => "Blog Parent Category",
	"desc" => "Enter the name of the Blog parent category",
	"id" => $shortname."_blog_cat",
	"type" => "text",
	"std" => ""),
	
array( "name" => "Comments disable?",
	"desc" => "Check if you want to disable comments on portfolio items.",
	"id" => $shortname."_comments",
	"type" => "checkbox",
	"std" => ""),	
 
array( "type" => "close")
 
);

function mytheme_add_admin() {
 
global $themename, $shortname, $options;
 
if ( $_GET['page'] == basename(__FILE__) ) {
 
if ( 'save' == $_REQUEST['action'] ) {
 
foreach ($options as $value) {
update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }
 
foreach ($options as $value) {
if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } }
 
header("Location: themes.php?page=functions.php&saved=true");
die;
 
} else if( 'reset' == $_REQUEST['action'] ) {
 
foreach ($options as $value) {
delete_option( $value['id'] ); }
 
header("Location: themes.php?page=functions.php&reset=true");
die;
 
}
}
 
add_theme_page($themename." Options", "".$themename." Options", 'edit_themes', basename(__FILE__), 'mytheme_admin');
 
}
 


?>
