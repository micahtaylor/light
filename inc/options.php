<?php
/**
 * A unique id is used to store the options in the database and reference them from the theme.
 * By default it uses 'light'.  If the id changes, it'll appear as if the options have been reset.
 *
 * The Options Framework plugin is required for options to work:
 * http://wordpress.org/extend/plugins/options-framework/
 *
 * @package Light
 * @since Light 1.0
 */

function optionsframework_option_name() {
	$optionsframework_settings = get_option('optionsframework');
	$optionsframework_settings['id'] = 'light';
	update_option('optionsframework', $optionsframework_settings);
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the "id" fields, make sure to use all lowercase and no spaces.
 *  
 */

function optionsframework_options() {
	
	// Options array	
	$options = array();
		
	$options[] = array( "name" => __('General Settings','light'),
                    	"type" => "heading");
						
	$options[] = array( "name" => __('Custom Logo','light'),
						"desc" => __('Upload a logo for your theme if you would like to use one.','light'),
						"id" => "logo",
						"type" => "upload");
						
	$options[] = array( "name" => __('Show site tagline','light'),
						"desc" => __('Show the site tagline under the site title.','light'),
						"id" => "tagline",
						"std" => "0",
						"type" => "checkbox");
						
	$options[] = array( "name" => __('Custom Favicon','light'),
						"desc" => __('Upload a 16px x 16px Png/Gif image to represent your website.','light'),
						"id" => "custom_favicon",
						"type" => "upload");
	
	$options[] = array( "name" => __('Custom Footer Text','light'),
						"desc" => __('Custom text that will appear in the footer of your theme.','light'),
						"id" => "footer_text",
						"type" => "textarea");										
	return $options;
}