<?php
// To jest mieszanka z http://wordpress.stackexchange.com/a/19852
// oraz http://wordpress.stackexchange.com/a/139959
add_action( 'add_meta_boxes', 'files_attachment_box' );

/* Do something with the data entered */
add_action( 'save_post', 'dynamic_save_postdata' );

/* Adds a box to the main column on the Post and Page edit screens */
function files_attachment_box() {
    add_meta_box(
        'dynamic_sectionid',
        __( 'Dodaj pliki', 'myplugin_textdomain' ),
        'dynamic_inner_custom_box',
        'project');
}

/* Prints the box content */
function dynamic_inner_custom_box() {
    global $post;
    // Use nonce for verification
    wp_nonce_field( plugin_basename( __FILE__ ), 'dynamicMeta_noncename' );
    ?>
    <div class="files-panel">
        <p><b>Uwaga:</b> Jeśli plik jest dość duży &#8213; najlepiej wrzucić go na jakiś dropbox, a tu wkleić link</p>
    <?php

    //get the saved meta as an arry
    $files = get_post_meta($post->ID,'files',true);

    $c = 0;
    if ( is_array($files) ) {
        foreach( $files as $file ) {
            if ( isset( $file['url'] ) || isset( $file['title'] ) ) {
                printf(
                    '<div class="panel_block">
                        <label>Link</label>
                        <input type="text" name="files[%1$s][url]" id="file-%1$s" value="%2$s" />
                        <label>Nazwa pliku:</label>
                        <input type="text" id="title-%1$s" name="files[%1$s][title]" value="%3$s" />
                        <div class="button-container">
                            <span class="remove">%4$s</span>
                        </div>
                    </div>',
                    $c, $file['url'], $file['title'], __( 'Usuń załączony plik' ) );
                $c = $c +1;
            }
        }
    }

    ?>
<script>
var $ =jQuery.noConflict();
$(document).ready(function() {
    var count = <?php echo $c; ?>;
    $(".add").click(function() {
        count = count + 1;

        $('.files-panel').append(
            '<div class="panel_block">\
                <label>Link</label>\
                <input type="text" name="files['+count+'][url]" id="file-'+count+'" value="" />\
                <label>Nazwa pliku:</label>\
                <input type="text" id="title-'+count+'" name="files['+count+'][title]" value="" />\
                <div class="button-container">\
                    <input id = "upload_image_button" type = "button" class="button button-primary button-large" value="Dodaj do mediów">\
                    <span class="remove">Nie dodawaj</span>\
                </div>\
            </div>' );
        return false;
    });
        $(".remove").live('click', function() {
            $(this).parentsUntil(".files-panel").remove();
        });

// UPLOADING //
    var file_frame;
    $('#upload_image_button').live('click', function(podcast) {

        podcast.preventDefault();

        // If the media frame already exists, reopen it.
        if (file_frame) {
            file_frame.open();
            return;
        }

        // Create the media frame.
        file_frame = wp.media.frames.file_frame = wp.media({
            title: $(this).data('uploader_title'),
            button: {
                text: $(this).data('uploader_button_text'),
            },
            multiple: false // Set to true to allow multiple files to be selected
        });

        // When a file is selected, run a callback.
        file_frame.on('select', function(){
            // We set multiple to false so only get one image from the uploader
            attachment = file_frame.state().get('selection').first().toJSON();

            var title = attachment.title;
            //var filename = attachment.filename;
            var url = attachment.url;

            $('#file-'+count).attr("value", url);
            $('#title-'+count).attr("value", title);
        });

        // Finally, open the modal
        file_frame.open();
    });
});
    </script>
</div>
<div class="button-container">
    <button class="add button button-primary button-large"><?php _e('Dodaj pliki'); ?></button>
</div>
<?php

}

/* When the post is saved, saves our custom data */
function dynamic_save_postdata( $post_id ) {
    // verify if this is an auto save routine.
    // If it is our form has not been submitted, so we dont want to do anything
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
        return;

    // verify this came from the our screen and with proper authorization,
    // because save_post can be triggered at other times
    if ( !isset( $_POST['dynamicMeta_noncename'] ) )
        return;

    if ( !wp_verify_nonce( $_POST['dynamicMeta_noncename'], plugin_basename( __FILE__ ) ) )
        return;

    // OK, we're authenticated: we need to find and save the data

    $files = $_POST['files'];

    update_post_meta($post_id,'files',$files);
}
