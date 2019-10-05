<?php

use Carbon_Fields\Field;
use Carbon_Fields\Container;

add_action( 'carbon_fields_register_fields', 'crb_attach_theme_options' );
function crb_attach_theme_options() {
// Default options page
  $basic_options_container = Container::make( 'theme_options', 'Synergopcje' )
      ->add_fields( array(
          Field::make( 'header_scripts', 'crb_header_script' ),
          Field::make( 'footer_scripts', 'crb_footer_script' ),
      ) );

  // Add second options page under 'Basic Options'
  Container::make( 'theme_options', 'Linki do portali' )
      ->set_page_parent( $basic_options_container ) // reference to a top level container
      ->add_fields( array(
          Field::make( 'text', 'crb_facebook_link' ),
          Field::make( 'text', 'crb_twitter_link' ),
          Field::make( 'text', 'crb_github_link' ),
          Field::make( 'text', 'crb_instagram_link' ),
      ) );

  Container::make( 'theme_options', 'Mapa' )
      ->set_page_parent( $basic_options_container ) // reference to a top level container
      ->add_fields( array(
          Field::make( 'text', 'crb_lon', 'Lon'),
          Field::make( 'text', 'crb_lat', 'Lat' ),
      ) );

  Container::make( 'theme_options', 'Robodrift' )
      ->set_page_parent( $basic_options_container ) // reference to a top level container
      ->add_fields( array(
          Field::make( 'text', 'crb_number_of_robodrifts', 'Liczba edycji Robodrift'),
      ) );
}


