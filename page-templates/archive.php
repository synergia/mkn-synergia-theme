<?php
/*
Template Name: Archiwum
*/
?>
<?php get_header(); ?>

<?php get_template_part('template-part', 'topnav'); ?>

<!-- start content container -->
<div class="row dmbs-content">

    <?php //left sidebar ?>
    <?php get_sidebar( 'left' ); ?>

    <div class="col-sm-<?php synergia_main_content_width(); ?> dmbs-main">

        <h2 class="page-header-no-thumb">Archiwum</h2>
		<ul>
			<?php wp_get_archives('type=monthly'); ?>
		</ul>

    </div>

    <?php //get the right sidebar ?>
    <?php get_sidebar( 'right' ); ?>

</div>
<!-- end content container -->

<?php get_footer(); ?>
