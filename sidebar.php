<?php
//allows the theme to get info from the theme options page
global $options;
foreach ($options as $value) {
    if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); }
}
?>

<div id="sidebar">
	<ul>
		<?php wp_list_pages('title_li=&depth=1'); ?>
	</ul>
	<br />
		
	
	<?php 	/* Widgetized sidebar */
		if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) : ?>
					
		<b>Hi there.</b> I am BlueBubble, a brandnew minimal &amp; elegant wordpress portfolio theme 
		exclusive designed for <strong>you</strong> <br /> - by <a href="http://www.thomasveit.com">Thomas Veit</a> with love on mac. <br />
		<hr />
					
		<?php endif; ?>

		
</div>
