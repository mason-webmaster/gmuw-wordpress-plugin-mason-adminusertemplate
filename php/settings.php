<?php

/**
 * Summary: php file which sets up plugin settings
 */


/**
 * Register plugin settings
 */
add_action('admin_init', 'gmuw_aut_register_settings');
function gmuw_aut_register_settings() {
	
	// Register serialized options setting to store this plugin's options
	register_setting(
		'gmuw_aut_options',
		'gmuw_aut_options',
		'gmuw_aut_callback_validate_options'
	);

	// Add section: basic settings
	add_settings_section(
		'gmuw_aut_section_settings_basic',
		'Basic Settings',
		'gmuw_aut_callback_section_settings_basic',
		'gmuw_aut'
	);

	// Add field: template user id
	add_settings_field(
		'template_user_id',
		'Template User',
		'gmuw_aut_callback_field_user',
		'gmuw_aut',
		'gmuw_aut_section_settings_basic',
		['id' => 'template_user_id', 'label' => 'template user']
	);

} 

/**
 * Generates the plugin settings page
 */
function gmuw_aut_plugin_settings_form() {
    
    // Only continue if this user has the 'manage options' capability
    if (!current_user_can('manage_options')) return;

    // heading
    echo "<h2>Plugin Settings</h2>";

    // Begin form
    echo "<form action='options.php' method='post'>";

    // output settings fields - outputs required security fields - parameter specifes name of settings group
    settings_fields('gmuw_aut_options');

    // output setting sections - parameter specifies name of menu slug
    do_settings_sections('gmuw_aut');

    // submit button
    submit_button();

    // Close form
    echo "</form>";

}

/**
 * Generates content for basic settings section
 */
function gmuw_aut_callback_section_settings_basic() {

    //echo '<p>Basic settings.</p>';

}

/**
 * Generates text field for plugin settings option
 */
function gmuw_aut_callback_field_text($args) {
    
    //Get array of options. If the specified option does not exist, get default options from a function
    $options = get_option('gmuw_aut_options', gmuw_aut_options_default());
    
    //Extract field id and label from arguments array
    $id    = isset($args['id'])    ? $args['id']    : '';
    $label = isset($args['label']) ? $args['label'] : '';
    
    //Get setting value
    $value = isset($options[$id]) ? sanitize_text_field($options[$id]) : '';
    
    //Output field markup
    echo '<input id="gmuw_aut_options_'. $id .'" name="gmuw_aut_options['. $id .']" type="text" size="40" value="'. $value .'">';
    echo "<br />";
    echo '<label for="gmuw_aut_options_'. $id .'">'. $label .'</label>';
    
}

/**
 * Generates yes/no field for plugin settings options
 */
function gmuw_aut_callback_field_yesno($args) {

    //Get array of options. If the specified option does not exist, get default options from a function
    $options = get_option('gmuw_aut_options', gmuw_aut_options_default());

    //Extract field id and label from arguments array
    $id    = isset($args['id'])    ? $args['id']    : '';
    $label = isset($args['label']) ? $args['label'] : '';

    //Get setting value
    $value = isset($options[$id]) ? sanitize_text_field($options[$id]) : '';

    //Output field markup
    echo '<select id="gmuw_aut_options_'. $id .'" name="gmuw_aut_options['. $id .']">';
    echo '<option ';
    echo $value ? 'selected ' : '';
    echo 'value="1">Yes</option>';
    echo '<option ';
    echo !$value ? 'selected ' : '';
    echo 'value="0">No</option>';
    echo '</select>';
    echo "<br />";
    echo '<label for="gmuw_aut_options_'. $id .'">'. $label .'</label>';

}

/**
 * Generates user field for plugin settings option
 */
function gmuw_aut_callback_field_user($args) {
    
    //Get array of options. If the specified option does not exist, get default options from a function
    $options = get_option('gmuw_aut_options', gmuw_aut_options_default());
    
    //Extract field id and label from arguments array
    $id    = isset($args['id'])    ? $args['id']    : '';
    $label = isset($args['label']) ? $args['label'] : '';
    
    //Get setting value
    $value = isset($options[$id]) ? sanitize_text_field($options[$id]) : '';
    
    //Output field markup
	wp_dropdown_users(
		array(
			'name' => 'gmuw_aut_options['. $id .']',
			'selected' => $value
		)
	);
    echo '<p><label for="gmuw_aut_options_'. $id .'">'. $label .'</label></p>';

}

/**
 * Sets default plugin options
 */
function gmuw_aut_options_default() {

    return array(
        'template_user_id'   => '',
    );

}

/**
 * Validate plugin options
 */
function gmuw_aut_callback_validate_options($input) {

    // template_user_id
    if (isset($input['template_user_id'])) {
        $input['template_user_id'] = sanitize_text_field($input['template_user_id']);
    }

    return $input;
    
}
