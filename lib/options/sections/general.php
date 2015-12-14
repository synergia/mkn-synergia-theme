<?php
$snrg_option = get_option( 'snrg_options_array', $snrg_options_array );
settings_fields( 'snrg_theme_options' );
?>

<table cellpadding='10'>
      <tr valign="top"><th scope="row">Link do Archiwum</th>
        <td>
            <input type="text" id="archiwum" name="snrg_options_array[archiwum]" value="<?php esc_attr_e($snrg_option['archiwum']); ?>" />
        </td>
    </tr>
      <tr valign="top"><th scope="row">Link do projektów</th>
        <td>
            <input type="text" id="more_projects" name="snrg_options_array[more_projects]" value="<?php esc_attr_e($snrg_option['more_projects']); ?>" />
        </td>
    </tr>
    <tr valign="top"><th scope="row">Google Analytics</th>
        <td>
            <textarea name="snrg_option[google_anal]" id="google_anal"><?php echo $snrg_option['google_anal']; ?></textarea>
            <p class="description">Kod śledzący Google Analytics</p>
        </td>
    </tr>
</table><?php
