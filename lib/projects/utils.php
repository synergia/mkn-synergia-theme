<?php
// Różne funkcje //

// Ubiera obrazki w figure //
// Tylko gdy obrazek ma tytuł jakiś, inaczej działa js, który wrzuca sam obrazek
// w <figure>
// http://wordpress.stackexchange.com/a/107373
add_filter('img_caption_shortcode', 'synergia_img_caption_shortcode_filter',10,3);
function synergia_img_caption_shortcode_filter($val, $attr, $content = null)
{
    extract(shortcode_atts(array(
        'id'    => '',
        'align' => '',
        'width' => '',
        'caption' => ''
    ), $attr));

    if ( 1 > (int) $width || empty($caption) )
        return $val;

    $capid = '';
    if ( $id ) {
        $id = esc_attr($id);
        $capid = 'id="figcaption_'. $id . '" ';
        $id = 'id="' . $id . '" aria-labelledby="figcaption_' . $id . '" ';
    }

    return '<figure ' . $id . 'class="wp-caption ' . esc_attr($align) . '" >'
    . do_shortcode( $content ) . '<figcaption ' . $capid
    . 'class="wp-caption-text">' . $caption . '</figcaption></figure>';
}

// Ta funkcja wstawia <figure> od razu w edytorze. Niech tu na wszelki wypadek
// zostanie
// https://css-tricks.com/snippets/wordpress/insert-images-with-figurefigcaption/

// add_filter( 'image_send_to_editor', 'html5_insert_image', 10, 9 );
function html5_insert_image($html, $id, $caption, $title, $align, $url) {
  // $id = 'id="' . $id . '" aria-labelledby="figcaption_' . $id . '" ';
  $html5 = "<figure id='$id'>";
  $html5 .= "<img class='blazy' src='data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==' data-src='$url' alt='$title' />";
  $html5 .= "</figure>";
  return $html5;
}

// Wzucanie wszystkich embed do diva
add_filter( 'embed_oembed_html', 'custom_oembed_filter', 10, 4 ) ;

function custom_oembed_filter($html, $url, $attr, $post_ID) {
    $return = '<div class="video-container">'.$html.'</div>';
    return $return;
}

// Wyświetla stan projektu //
function the_project_status($project_ID) {
    $project_status = get_post_meta($project_ID, "project_status", true);
    if($project_status){
        echo '<span class="project__status">Stan: '.$project_status.'</span>';
    }else {
        echo '<span class="project__status">Stan: Nieznany</span>';
    }
}

// Wyświetla linki projektu //
function the_project_links($project_ID) {
    $web = get_post_meta($project_ID, "web", true);
    $facebook = get_post_meta($project_ID, "facebook", true);
    $github = get_post_meta($project_ID, "github", true);
    if( $web || $facebook || $github) {
        echo '<div class="project__links">';
        if($web){
            echo '<a class="link link--project" title="Strona internetowa projektu" href="'.get_post_meta($project_ID, "web", true).'"><i class="icon icon-link"></i></a>';
        }
        if($facebook) {
            echo '<a class="link link--project" title="Facebook" href="'.get_post_meta($project_ID, "facebook", true).'"><i class="icon icon-facebook"></i></a>';
        }    if($github) {
            echo '<a class="link link--project" title="Github" href="'.get_post_meta($project_ID, "github", true).'"><i class="icon icon-github"></i></a>';
        }
        echo '</div>';
    }
}

// Wyświetla przycisk z dodatkowymi plikami, które można ściągnąć //
function download_button ($project_ID) {
    $files = get_post_meta($project_ID,'files',true);
    if($files){
 ?>
 <div class="download-button-container">
   <dl class="dropy">
     <dt class="dropy__title btn btn--synergia btn--raised">Pobierz <i class="icon icon-down-open-big"></i></dt>
     <dd class="dropy__content">
       <ul> <?php
         if ( is_array($files) ) {
             foreach( $files as $file ) {
                 if ( isset( $file['url'] ) || isset( $file['title'] ) ) {
                     echo '<li><a href="'.$file["url"].'" target="_blank">'.$file["title"].'</a></li>';
                 }
             }
         } ?>
       </ul>
     </dd><input type="hidden" name="first"></dl>
 </div>
<?php
    }
}

// Karta projektu //
// Ta taka malutka ładniutka
function project_card ($query) {
  if ($query->have_posts()) {
    while ($query->have_posts()) {
      $query->the_post(); ?>
        <div class="card">
          <a title="<?php the_title(); ?>" href="<?php the_permalink(); ?>">
            <div class="card__overimage loading">
              <?php if ( has_post_thumbnail() ) { ?>
                <img class="card__image blazy"
                     alt="<?php the_title(); ?>"
                     src="<?php bloginfo('template_directory'); ?>/build/img/card.png"
                     data-src="<?php echo wp_get_attachment_image_src(get_post_thumbnail_id(), 'card_image', true)[0];?>"/>
              <?php } else { ?><img class="blazy" src="<?php bloginfo('template_directory'); ?>/build/img/card.png" /><?php } ?>
              <h2 class="card__title"><?php the_title(); ?></h2>
            </div>
          </a>
          <div class="card__excerpt">
            <?php echo get_the_excerpt(); ?>
          </div>
          <div class="card__action">
            <a class="btn btn--readmore" href="<?php the_permalink(); ?>">Czytaj dalej</a>
          </div>
        </div>
 <?php
    }
  }
}
 ?>
