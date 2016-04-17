<?php
// Modyfikacje powiązane z kontem członka //


use Carbon_Fields\Container;
use Carbon_Fields\Field;

Container::make('user_meta', 'Zdjęcia i obrazki')
    ->add_fields(array(
        Field::make('image', 'crb_member_profile_image', 'Obrazek profilowy')
            ->set_value_type('url')
            ->set_width(50)
            ->help_text('Można też wkleić URL'),
        Field::make('image', 'crb_member_cover_image', 'Obrazek tła (można wkleić URL)')
            ->set_value_type('url')
            ->help_text('Można też wkleić URL')
            ->set_width(50),
    ));
    $synergia_member = get_role('synergia_member');

Container::make('user_meta', 'Linki do portali społecznościowych, CV i poczta')
    // ->show_on_user_role(array('administrator','synergia_member'))
    ->add_fields(array(
        Field::make('text', 'crb_member_github_link', 'URL Github'),
        Field::make('text', 'crb_member_facebook_link', 'URL Facebook'),
        Field::make('text', 'crb_member_twitter_link', 'URL Twitter'),
        Field::make('text', 'crb_member_lastfm_link', 'URL Last.fm'),
        Field::make('text', 'crb_member_cv_link', 'URL do CV'),
        Field::make('checkbox', 'crb_show_mail', 'Pokazyj adres pocztowy')
            ->set_option_value('no')
            ->help_text('Zaznacz, jeśli chcesz, by był wyświetlany'),

    ));
// if (current_user_can('level_10')) {
    Container::make('user_meta', 'Obierz zarząd lub prezesa')
        ->add_fields(array(
            Field::make('radio', 'crb_managment_board', 'Mianuj na członka zarządu lub prezesa')
            ->help_text('With great power comes great responsibility')
            ->add_options(array(
                'member_of_managment_board' => 'Członek zarządu',
                'president' => 'Prezes',
            )),
        ));
// }

//removing color scheme
remove_action('admin_color_scheme_picker', 'admin_color_scheme_picker');

// Checkbox dla prezesa

function management_board($user)
{
    global $user_ID;
    if ($user_ID && current_user_can('level_10')) {
        ?>
<h3>Obierz zarząd</h3>
	<table class="form-table">
		<tr>
			<th><label>Obierz prezesa</label></th>
			<td>
        <label>
          <input type="checkbox"
                 name="president"
                 id="president"
                 value="yes"
          <?php if (esc_attr(get_the_author_meta('president', $user->ID)) == true) {
    echo 'checked';
}
        ?> />
          Zaznacz, jeśli jest prezesem
        </label>
			</td>
    </tr>
    <tr>
      <th><label>Obierz członka zarządu</label></th>
      <td>
        <label for="member_of_managment_board">
          <input type="checkbox"
                 name="member_of_managment_board"
                 id="member_of_managment_board"
                 value="yes"
          <?php if (esc_attr(get_the_author_meta('member_of_managment_board', $user->ID)) == true) {
    echo 'checked';
}
        ?> />
				Zaznacz, jeśli jest członkiem zarządu
      </label>
			</td>
		</tr>
	</table>
  <script>
(function($) {
  if($('#president').prop('checked') == true) {
    $('#member_of_managment_board').prop('checked', false).attr("disabled", true);
  }
    $('#president').click(function() {
      if ($(this).prop('checked') == true) {
        console.log("click");
      $('#member_of_managment_board').prop('checked', false).attr("disabled", true);
    } else {
      $('#member_of_managment_board').attr("disabled", false);
    }
  });

})(jQuery);
  </script>
<?php

    }
}
