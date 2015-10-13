<?php
/*
Template Name: Archiwum
*/
?>
<?php get_header(); ?>

<?php get_template_part('template-part', 'topnav'); ?>

<!-- start content container -->
<div class="gl">

    <?php //left sidebar ?>
    <?php get_sidebar( 'left' ); ?>

    <div class="gl-sm-9 gl-cell">

        <h2>Archiwum</h2>
		<ul>
			<?php wp_get_archives('type=monthly'); ?>
		</ul>

    </div>

</div>
<!-- end content container -->

<?php get_footer(); ?>
