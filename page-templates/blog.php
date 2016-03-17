<?php
/*
Template Name: Blog
*/
?>
<?php get_header(); ?>
<?php get_template_part('parts/topbar'); ?>
<?php
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array(
    'pagination' => true,
    'posts_per_page' => '6',
    'paged' => $paged,
);
$posts = new WP_Query($args);
?>
<div class="compensator">
    <ul class="tabsMenu">
        <li id="tabsReset" class="tabsMenu__item tabsMenu__item--current">
            <a class="link link--tab" href="#last_posts">Ostatnie wpisy</a>
        </li>
        <li class="tabsMenu__item">
            <a class="link link--tab" href="#archive">Archiwum</a>
        </li>
        <li class="tabsMenu__item">
            <a class="link link--tab" href="#tags">Tagi</a>
        </li>
    </ul>
    <div class="tab">
        <div class="tab__content" id="last_posts">
            <div class="cardsWrapper">
                <?php project_card($posts); ?>
            </div>
        </div>
        <div class="tab__content" id="archive">
            <?php get_template_part('parts/archive'); ?>
        </div>
        <div class="tab__content" id="tags">
            <?php
            $tags = My_TagCloud(array('wrapper' => 'div'));
            if ($tags) {
                echo $tags;
            } else {
                echo '<p class="emptyState">Brak tagów na razie.</p>';
            }
             ?>
        </div>
    </div>
<?php
wp_reset_postdata();
?>
</div>
<?php get_footer(); ?>
