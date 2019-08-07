<?php
/**
 * Plugin Name: The cool shortcode
 * Plugin URI: https://www.fahdmurtaza.com/the-cool-shortcode-plugin/
 * Description: A plugin that demonstrates using shortcodes and settings API
 * Version: 1.0
 * Author: Fahad Muratza
 * Author URI: https://www.fahdmurtaza.com/
 **/

// create custom plugin settings menu
add_action( 'admin_menu', 'fm_my_cool_plugin_create_menu' );

function fm_my_cool_plugin_create_menu() {

	//create new top-level menu
	add_menu_page( 'My Cool Plugin Settings', 'Cool Settings', 'administrator', __FILE__, 'fm_my_cool_plugin_settings_page', 'dashicons-welcome-write-blog' );

	//call register settings function
	add_action( 'admin_init', 'fm_register_my_cool_plugin_settings' );
}


function fm_register_my_cool_plugin_settings() {
	//register our settings
	register_setting( 'my-cool-plugin-settings-group', 'a_cool_option' );
	register_setting( 'my-cool-plugin-settings-group', 'another_cool_option' );
}

function fm_my_cool_plugin_settings_page() {
	?>
    <div class="wrap">
        <h1>Your Cool Options</h1>

        <form method="post" action="options.php">
			<?php settings_fields( 'my-cool-plugin-settings-group' ); ?>
			<?php do_settings_sections( 'my-cool-plugin-settings-group' ); ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">A cool option</th>
                    <td><input type="text" name="a_cool_option" size="40"
                               value="<?php echo esc_attr( get_option( 'a_cool_option' ) ); ?>"/>
                    </td>
                </tr>

                <tr valign="top">
                    <th scope="row">Another cool option</th>
                    <td><input type="text" name="another_cool_option" size="40"
                               value="<?php echo esc_attr( get_option( 'another_cool_option' ) ); ?>"/>
                    </td>
                </tr>

            </table>

			<?php submit_button(); ?>

        </form>
    </div>
<?php }


function fm_get_cool_stuff( $atts ) {
	$atts = shortcode_atts( [
		'option' => 'a_cool_option' # defaults to a_cool_option
	], $atts, 'getcoolstuff' );


	return get_option( $atts['option'] );
}

add_shortcode( 'getcoolstuff', 'fm_get_cool_stuff' );
