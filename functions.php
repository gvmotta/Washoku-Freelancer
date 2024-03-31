<?php

/**
 * Include and setup custom metaboxes and fields. (make sure you copy this file to outside the CMB2 directory)
 *
 * Be sure to replace all instances of 'washoku_' with your project's prefix.
 * http://nacin.com/2010/05/11/in-wordpress-prefix-everything/
 *
 * @category YourThemeOrPlugin
 * @package  Demo_CMB2
 * @license  http://www.opensource.org/licenses/gpl-license.php GPL v2.0 (or later)
 * @link     https://github.com/CMB2/CMB2
 */

/**
 * Get the bootstrap! If using the plugin from wordpress.org, REMOVE THIS!
 */

if (file_exists(dirname(__FILE__) . '/cmb2/init.php')) {
	require_once dirname(__FILE__) . '/cmb2/init.php';
} elseif (file_exists(dirname(__FILE__) . '/CMB2/init.php')) {
	require_once dirname(__FILE__) . '/CMB2/init.php';
}

/**
 * Conditionally displays a metabox when used as a callback in the 'show_on_cb' cmb2_box parameter
 *
 * @param  CMB2 $cmb CMB2 object.
 *
 * @return bool      True if metabox should show
 */
function washoku_show_if_front_page($cmb)
{
	// Don't show this metabox if it's not the front page template.
	if (get_option('page_on_front') !== $cmb->object_id) {
		return false;
	}
	return true;
}

/**
 * Conditionally displays a field when used as a callback in the 'show_on_cb' field parameter
 *
 * @param  CMB2_Field $field Field object.
 *
 * @return bool              True if metabox should show
 */
function washoku_hide_if_no_cats($field)
{
	// Don't show this field if not in the cats category.
	if (!has_tag('cats', $field->object_id)) {
		return false;
	}
	return true;
}

/**
 * Manually render a field.
 *
 * @param  array      $field_args Array of field arguments.
 * @param  CMB2_Field $field      The field object.
 */
function washoku_render_row_cb($field_args, $field)
{
	$classes     = $field->row_classes();
	$id          = $field->args('id');
	$label       = $field->args('name');
	$name        = $field->args('_name');
	$value       = $field->escaped_value();
	$description = $field->args('description');
?>
	<div class="custom-field-row <?php echo esc_attr($classes); ?>">
		<p><label for="<?php echo esc_attr($id); ?>"><?php echo esc_html($label); ?></label></p>
		<p><input id="<?php echo esc_attr($id); ?>" type="text" name="<?php echo esc_attr($name); ?>" value="<?php echo $value; ?>" /></p>
		<p class="description"><?php echo esc_html($description); ?></p>
	</div>
<?php
}

/**
 * Manually render a field column display.
 *
 * @param  array      $field_args Array of field arguments.
 * @param  CMB2_Field $field      The field object.
 */
function washoku_display_text_small_column($field_args, $field)
{
?>
	<div class="custom-column-display <?php echo esc_attr($field->row_classes()); ?>">
		<p><?php echo $field->escaped_value(); ?></p>
		<p class="description"><?php echo esc_html($field->args('description')); ?></p>
	</div>
<?php
}

/**
 * Conditionally displays a message if the $post_id is 2
 *
 * @param  array      $field_args Array of field parameters.
 * @param  CMB2_Field $field      Field object.
 */
function washoku_before_row_if_2($field_args, $field)
{
	if (2 == $field->object_id) {
		echo '<p>Testing <b>"before_row"</b> parameter (on $post_id 2)</p>';
	} else {
		echo '<p>Testing <b>"before_row"</b> parameter (<b>NOT</b> on $post_id 2)</p>';
	}
}

add_action('cmb2_admin_init', 'washoku_register_demo_metabox');
/**
 * Hook in and add a demo metabox. Can only happen on the 'cmb2_admin_init' or 'cmb2_init' hook.
 */
function washoku_register_demo_metabox()
{
	/**
	 * Sample metabox to demonstrate each field type included
	 */

	$header = new_cmb2_box(array(
		'id' => 'header_metabox',
		'title' => esc_html__('Header Section'),
		'object_types' => array('page'),
	));

	$header->add_field(array(
		'name' => esc_html__('Enterprise Logo', 'cmb2'),
		'desc' => esc_html__('drop here your image (mandatory)', 'cmb2'),
		'id' => 'enterprise_logo',
		'type' => 'file'
	));
	$header->add_field(array(
		'name' => esc_html__('Enterprise name', 'cmb2'),
		'desc' => esc_html__('field description (mandatory)', 'cmb2'),
		'id' => 'enterprise_name',
		'type' => 'textarea',
	));
	$header->add_field(array(
		'name' => esc_html__('Enterprise subname', 'cmb2'),
		'desc' => esc_html__('field description', 'cmb2'),
		'id' => 'enterprise_subname',
		'type' => 'text',
	));
	$header->add_field(array(
		'name' => esc_html__('Call to action title', 'cmb2'),
		'desc' => esc_html__('field description', 'cmb2'),
		'id' => 'call_to_action_title',
		'type' => 'textarea_small',
	));
	$header->add_field(array(
		'name' => esc_html__('Call to action subtitle', 'cmb2'),
		'desc' => esc_html__('Call to action subtitle', 'cmb2'),
		'id' => 'call_to_action_subtitle',
		'type' => 'text_small',
	));
	$header->add_field(array(
		'name' => esc_html__('Image Hero', 'cmb2'),
		'desc' => esc_html__('Drop your image Hero here', 'cmb2'),
		'id' => 'image_hero',
		'type' => 'file',
	));

	$about_school = new_cmb2_box(array(
		'id'            => 'about_school_metabox',
		'title'         => esc_html__('About School Session', 'cmb2'),
		'object_types'  => array('page'), // Post type
		// 'show_on_cb' => 'washoku_show_if_front_page', // function should return a bool value
		// 'context'    => 'normal',
		// 'priority'   => 'high',
		// 'show_names' => true, // Show field names on the left
		// 'cmb_styles' => false, // false to disable the CMB stylesheet
		// 'closed'     => true, // true to keep the metabox closed by default
		// 'classes'    => 'extra-class', // Extra cmb2-wrap classes
		// 'classes_cb' => 'washoku_add_some_classes', // Add classes through a callback.

		/*
		 * The following parameter is any additional arguments passed as $callback_args
		 * to add_meta_box, if/when applicable.
		 *
		 * CMB2 does not use these arguments in the add_meta_box callback, however, these args
		 * are parsed for certain special properties, like determining Gutenberg/block-editor
		 * compatibility.
		 *
		 * Examples:
		 *
		 * - Make sure default editor is used as metabox is not compatible with block editor
		 *      [ '__block_editor_compatible_meta_box' => false/true ]
		 *
		 * - Or declare this box exists for backwards compatibility
		 *      [ '__back_compat_meta_box' => false ]
		 *
		 * More: https://wordpress.org/gutenberg/handbook/extensibility/meta-box/
		 */
		// 'mb_callback_args' => array( '__block_editor_compatible_meta_box' => false ),
	));





	$about_school->add_field(array(
		'name'       => esc_html__('Test Text', 'cmb2'),
		'desc'       => esc_html__('field description (optional)', 'cmb2'),
		'id'         => 'washoku_text',
		'type'       => 'text',
		'show_on_cb' => 'washoku_hide_if_no_cats', // function should return a bool value
		// 'sanitization_cb' => 'my_custom_sanitization', // custom sanitization callback parameter
		// 'escape_cb'       => 'my_custom_escaping',  // custom escaping callback parameter
		// 'on_front'        => false, // Optionally designate a field to wp-admin only
		// 'repeatable'      => true,
		// 'column'          => true, // Display field value in the admin post-listing columns
	));

	$about_school->add_field(array(
		'name' => esc_html__('Image', 'cmb2'),
		'desc' => esc_html__('Upload an image or enter a URL.', 'cmb2'),
		'id'   => 'washoku_image',
		'type' => 'file',
	));

	$about_school->add_field(array(
		'name' => esc_html__('Title Session', 'cmb2'),
		'desc' => esc_html__('field description (optional)', 'cmb2'),
		'id'   => 'washoku_textmedium',
		'type' => 'text_medium',
	));

	$about_school->add_field(array(
		'name'    => esc_html__('About School Content', 'cmb2'),
		'desc'    => esc_html__('field description (optional)', 'cmb2'),
		'id'      => 'washoku_text_box',
		'type'    => 'wysiwyg',
		'options' => array(
			'textarea_rows' => 5,
			'media_buttons' => true,
		),
	));

	$about_school->add_field(array(
		'name' => 'Icon',
		'id' => 'svg',
		'type' => 'file',
	));

	$about_school->add_field(array(
		'name' => esc_html__('Below Text', 'cmb2'),
		'desc' => esc_html__('field description', 'cmb2'),
		'id'   => 'washoku_below_text',
		'type' => 'text_medium',
	));

	$about_principals = new_cmb2_box(array(
		'id' => 'about_principals_metabox',
		'title' => esc_html__('About Principals Section'),
		'object_types' => array('page'),
	));

	$group_field_id = $about_principals->add_field(array(
		'id' => 'principal_group',
		'type' => 'group',
		'description' => esc_html__('Description of the principal', 'cmb2'),
		'tag' => esc_html__('Tags', 'cmb2'),
		'options' => array(
			'group_title' => esc_html__('Principal {#}', 'cmb2'),
			'add_button' => esc_html__('Add another entry', 'cmb2'),
			'remove_button' => esc_html__('Remove entry', 'cmb2'),
			'sortable' => true,
			'remove_confirm' => esc_html__('Are you sure you want to remove?', 'cmb2'), // Performs confirmation before removing group.
		)
	));

	$about_principals->add_group_field($group_field_id, array(
		'name' => esc_html__('Entry image', 'cmb2'),
		'id' => 'principal_image',
		'type' => 'file',
	));

	$about_principals->add_group_field($group_field_id, array(
		'name' => esc_html__('Professor name', 'cmb2'),
		'id' => 'principal_name',
		'type' => 'text',
	));

	$about_principals->add_group_field($group_field_id, array(
		'name' => esc_html__('Description of the principal', 'cmb2'),
		'description' => esc_html__('Write a short description for this entry', 'cmb2'),
		'id' => 'principal_description',
		'type' => 'wysiwyg',
		'options' => array(
			'textarea_rows' => 5,
			'media_buttons' => true,
		)
	));

	$about_teachers = new_cmb2_box(array(
		'id' => 'about_teachers_metabox',
		'title' => esc_html__('About Teachers Section'),
		'object_types' => array('page'),
	));

	$teachers_field_id = $about_teachers->add_field(array(
		'id' => 'professors_group',
		'type' => 'group',
		'description' => esc_html__('Campo reutilizável', 'cmb2'),
		'options' => array(
			'group_title' => esc_html__('Professor {#}', 'cmb2'),
			'add_button' => esc_html__('Add another entry', 'cmb2'),
			'remove_button' => esc_html__('Remove entry', 'cmb2'),
			'sortable' => true,
			'remove_confirm' => esc_html__('Are you sure you want to remove?', 'cmb2'),
		)
	));

	$about_teachers->add_group_field($teachers_field_id, array(
		'name' => esc_html__('Entry image', 'cmb2'),
		'id' => 'professor_image',
		'type' => 'file',
	));

	$about_teachers->add_group_field($teachers_field_id, array(
		'name' => esc_html__('Professor name', 'cmb2'),
		'id' => 'professor_name',
		'type' => 'text',
	));

	$about_teachers->add_group_field($teachers_field_id, array(
		'name' => esc_html__('Description', 'cmb2'),
		'description' => esc_html__('Write a short description for the professor', 'cmb2'),
		'id' => 'professor_description',
		'type' => 'wysiwyg',
		'options' => array(
			'textarea_rows' => 5,
			'media_buttons' => true,
		)
	));

	$about_teachers->add_group_field($teachers_field_id, array(
		'name' => esc_html__('Tag', 'cmb2'),
		'description' => esc_html__('Tag', 'cm'),
		'id' => 'professor_tag',
		'type' => 'text',
	));

	$about_courses = new_cmb2_box(array(
		'id' => 'about_couses_metabox',
		'title' => esc_html__('About Courses Section'),
		'object_types' => array('page'),
	));

	$about_courses -> add_field(array(
		'name' => esc_html__('Title', 'cmb2'),
		'desc' => esc_html__('Title of the section here', 'cmb2'),
		'id' => 'title_card_course_section',
		'type' => 'text',
	));

	$about_courses -> add_field(array(
		'name' => esc_html__('Description', 'cmb2'),
		'description' => esc_html__('Write a short description for the section', 'cmb2'),
		'id' => 'card_course_section_description',
		'type' => 'wysiwyg',
		'options' => array(
			'textarea_rows' => 5,
			'media_buttons' => true,
		)
	));

	$courses_field_id = $about_courses -> add_field(array(
		'id' => 'courses_group',
		'type' => 'group',
		'description' => esc_html__('Section for card courses', 'cmb2'),
		'options' => array(
			'group_title' => esc_html__('Card Course {#}', 'cmb2'),
			'add_button' => esc_html__('Add another card course', 'cmb2'),
			'remove_button' => esc_html__('Remove card course', 'cmb2'),
			'sortable' => true,
			'remove_confirm' => esc_html__('Are you sure you want to remove?', 'cmb2'),
		)
	));

	$about_courses -> add_group_field($courses_field_id, array(
		'name' => esc_html__('Entry image', 'cmb2'),
		'id' => 'card_course_image',
		'type' => 'file',
	));

	$about_courses -> add_group_field($courses_field_id, array(
		'name' => esc_html__('Card Course name', 'cmb2'),
		'id' => 'card_course_name',
		'type' => 'text',
	));

	$course = new_cmb2_box(array(
		'id' => 'course_metabox',
		'title' => esc_html__('Course Section'),
		'object_types' => array('page'),
	));

	$course_field_id = $course -> add_field(array(
		'id' => 'course_group',
		'type' => 'group',
		'description' => esc_html__('All the courses and their description can be found here!', 'cmb2'),
		'options' => array(
			'group_title' => esc_html__('Course {#}', 'cmb2'),
			'add_button' => esc_html__('Add another entry', 'cmb2'),
			'remove_button' => esc_html__('Remove entry', 'cmb2'),
			'sortable' => true,
			'remove_confirm' => esc_html__('Are you sure you want to remove?', 'cmb2'),
		)
	));

	$course -> add_group_field($course_field_id, array(
		'name' => esc_html__('Course image' ,'cmb2'),
		'id' => 'course_image',
		'type' => 'file',
	));

	$course -> add_group_field($course_field_id, array(
		'name' => esc_html__('Course name', 'cmb2'),
		'id' => 'course_name',
		'type' => 'text',
	));

	$course -> add_group_field($course_field_id, array(
		'name' => esc_html__('Tag', 'cmb2'),
		'id' => 'course_tag',
		'type' => 'text',
	));

	$course -> add_group_field($course_field_id, array(
		'name' => esc_html__('Duration', 'cmb2'),
		'id' => 'course_duration',
		'type' => 'text',
	));

	$course->add_group_field($course_field_id, array(
		'name' => esc_html__('Description', 'cmb2'),
		'id' => 'course_description',
		'type' => 'wysiwyg',
		'options' => array(
			'textarea_rows' => 5,
			'media_buttons' => true,
		)
	));

	$quality_cards = new_cmb2_box(array(
		'id' => 'quality_cards_metabox',
		'title' => esc_html__('Quality Cards Section'),
		'object_types' => array('page'),
	));

	$quality_cards -> add_field(array(
		'name' => esc_html__('Title of the section', 'cmb2'),
		'desc' => esc_html__('Description', 'cmb2'),
		'id' => 'quality_cards_title_section',
		'type' => 'text',
	));

	$quality_cards_field_id = $quality_cards -> add_field(array(
		'id' => 'quality_cards',
		'type' => 'group',
		'description' => esc_html__('All the quality cards and their description can be found here!', 'cmb2'),
		'options' => array(
			'group_title' => esc_html__('Quality Card {#}', 'cmb2'),
			'add_button' => esc_html__('Add another card', 'cmb2'),
			'remove_button' => esc_html__('Remove card', 'cmb2'),
			'sortable' => true,
			'remove_confirm' => esc_html__('Are you sure you want to remove?', 'cmb2'),
		)
	));

	$quality_cards -> add_group_field($quality_cards_field_id, array(
		'name' => esc_html__('Card image', 'cmb2'),
		'id' => 'card_quality_image',
		'type' => 'file',
	));

	$quality_cards -> add_group_field($quality_cards_field_id, array(
		'name' => esc_html__('Card Description', 'cmb2'),
		'id' => 'card_quality_description',
		'type' => 'text',
	));

	$carousel_images = new_cmb2_box(array(
		'id' => 'carousel_images_metabox',
		'title' => esc_html__('Carousel Images Section'),
		'object_types' => array('page'),
	));

	$carousel_images -> add_field(array(
		'name' => esc_html__('Section title', 'cmb2'),
		'id' => 'carousel_images_title',
		'type' => 'text',
		'desc' => esc_html__('Type here the title of the section', 'cmb2'),
	));

	$carousel_images_field_id = $carousel_images -> add_field(array(
		'id' => 'carousel_images_group',
		'type' => 'group',
		'description' => esc_html__('Here you can add an Image to the carousel', 'cmb2'),
		'options' => array(
			'group_title' => esc_html__('Image {#}', 'cmb2'),
			'add_button' => esc_html__('Add another image', 'cmb2'),
			'remove_button' => esc_html__('Remove image', 'cmb2'),
			'sortable' => true,
			'remove_confirm' => esc_html__('Are you sure you want to remove?', 'cmb2'),
		)
	));

	$carousel_images -> add_group_field($carousel_images_field_id, array(
		'name' => esc_html__('Carousel Image', 'cmb2'),
		'id' => 'carousel_image',
		'type' => 'file',
	));

	$carousel_images -> add_group_field($carousel_images_field_id, array(
		'name' => esc_html__('Description', 'cmb2'),
		'description' => esc_html__('Write a short description for image', 'cmb2'),
		'id' => 'carousel_images_text_box',
		'type' => 'wysiwyg',
		'options' => array(
			'textarea_rows' => 2,
			'media_buttons' => true,
		)
	));

}



add_action('cmb2_admin_init', 'washoku_register_taxonomy_metabox');
/**
 * Hook in and add a metabox to add fields to taxonomy terms
 */
function washoku_register_taxonomy_metabox()
{

	/**
	 * Metabox to add fields to categories and tags
	 */
	$cmb_term = new_cmb2_box(array(
		'id'               => 'washoku_term_edit',
		'title'            => esc_html__('Category Metabox', 'cmb2'), // Doesn't output for term boxes
		'object_types'     => array('term'), // Tells CMB2 to use term_meta vs post_meta
		'taxonomies'       => array('category', 'post_tag'), // Tells CMB2 which taxonomies should have these fields
		// 'new_term_section' => true, // Will display in the "Add New Category" section
	));

	$cmb_term->add_field(array(
		'name'     => esc_html__('Extra Info', 'cmb2'),
		'desc'     => esc_html__('field description (optional)', 'cmb2'),
		'id'       => 'washoku_term_extra_info',
		'type'     => 'title',
		'on_front' => false,
	));

	$cmb_term->add_field(array(
		'name' => esc_html__('Term Image', 'cmb2'),
		'desc' => esc_html__('field description (optional)', 'cmb2'),
		'id'   => 'washoku_term_avatar',
		'type' => 'file',
	));

	$cmb_term->add_field(array(
		'name' => esc_html__('Arbitrary Term Field', 'cmb2'),
		'desc' => esc_html__('field description (optional)', 'cmb2'),
		'id'   => 'washoku_term_term_text_field',
		'type' => 'text',
	));
}

add_action('cmb2_admin_init', 'washoku_register_theme_options_metabox');
/**
 * Hook in and register a metabox to handle a theme options page and adds a menu item.
 */
function washoku_register_theme_options_metabox()
{

	/**
	 * Registers options page menu item and form.
	 */
	$cmb_options = new_cmb2_box(array(
		'id'           => 'washoku_theme_options_page',
		'title'        => esc_html__('Theme Options', 'cmb2'),
		'object_types' => array('options-page'),

		/*
		 * The following parameters are specific to the options-page box
		 * Several of these parameters are passed along to add_menu_page()/add_submenu_page().
		 */

		'option_key'      => 'washoku_theme_options', // The option key and admin menu page slug.
		'icon_url'        => 'dashicons-palmtree', // Menu icon. Only applicable if 'parent_slug' is left empty.
		// 'menu_title'              => esc_html__( 'Options', 'cmb2' ), // Falls back to 'title' (above).
		// 'parent_slug'             => 'themes.php', // Make options page a submenu item of the themes menu.
		// 'capability'              => 'manage_options', // Cap required to view options-page.
		// 'position'                => 1, // Menu position. Only applicable if 'parent_slug' is left empty.
		// 'admin_menu_hook'         => 'network_admin_menu', // 'network_admin_menu' to add network-level options page.
		// 'priority'                => 10, // Define the page-registration admin menu hook priority.
		// 'display_cb'              => false, // Override the options-page form output (CMB2_Hookup::options_page_output()).
		// 'save_button'             => esc_html__( 'Save Theme Options', 'cmb2' ), // The text for the options-page save button. Defaults to 'Save'.
		// 'disable_settings_errors' => true, // On settings pages (not options-general.php sub-pages), allows disabling.
		// 'message_cb'              => 'washoku_options_page_message_callback',
		// 'tab_group'               => '', // Tab-group identifier, enables options page tab navigation.
		// 'tab_title'               => null, // Falls back to 'title' (above).
		// 'autoload'                => false, // Defaults to true, the options-page option will be autloaded.
	));

	/**
	 * Options fields ids only need
	 * to be unique within this box.
	 * Prefix is not needed.
	 */
	$cmb_options->add_field(array(
		'name'    => esc_html__('Site Background Color', 'cmb2'),
		'desc'    => esc_html__('field description (optional)', 'cmb2'),
		'id'      => 'bg_color',
		'type'    => 'colorpicker',
		'default' => '#ffffff',
	));
}

/**
 * Callback to define the optionss-saved message.
 *
 * @param CMB2  $cmb The CMB2 object.
 * @param array $args {
 *     An array of message arguments
 *
 *     @type bool   $is_options_page Whether current page is this options page.
 *     @type bool   $should_notify   Whether options were saved and we should be notified.
 *     @type bool   $is_updated      Whether options were updated with save (or stayed the same).
 *     @type string $setting         For add_settings_error(), Slug title of the setting to which
 *                                   this error applies.
 *     @type string $code            For add_settings_error(), Slug-name to identify the error.
 *                                   Used as part of 'id' attribute in HTML output.
 *     @type string $message         For add_settings_error(), The formatted message text to display
 *                                   to the user (will be shown inside styled `<div>` and `<p>` tags).
 *                                   Will be 'Settings updated.' if $is_updated is true, else 'Nothing to update.'
 *     @type string $type            For add_settings_error(), Message type, controls HTML class.
 *                                   Accepts 'error', 'updated', '', 'notice-warning', etc.
 *                                   Will be 'updated' if $is_updated is true, else 'notice-warning'.
 * }
 */
function washoku_options_page_message_callback($cmb, $args)
{
	if (!empty($args['should_notify'])) {

		if ($args['is_updated']) {

			// Modify the updated message.
			$args['message'] = sprintf(esc_html__('%s &mdash; Updated!', 'cmb2'), $cmb->prop('title'));
		}

		add_settings_error($args['setting'], $args['code'], $args['message'], $args['type']);
	}
}

/**
 * Only show this box in the CMB2 REST API if the user is logged in.
 *
 * @param  bool                 $is_allowed     Whether this box and its fields are allowed to be viewed.
 * @param  CMB2_REST_Controller $cmb_controller The controller object.
 *                                              CMB2 object available via `$cmb_controller->rest_box->cmb`.
 *
 * @return bool                 Whether this box and its fields are allowed to be viewed.
 */
function washoku_limit_rest_view_to_logged_in_users($is_allowed, $cmb_controller)
{
	if (!is_user_logged_in()) {
		$is_allowed = false;
	}

	return $is_allowed;
}


function add_file_types_to_uploads($file_types)
{
	$new_filetypes = array();
	$new_filetypes['svg'] = 'image/svg+xml';
	$file_types = array_merge($file_types, $new_filetypes);
	return $file_types;
}
add_filter('upload_mimes', 'add_file_types_to_uploads');
