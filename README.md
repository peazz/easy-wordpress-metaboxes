Easy Wordpress Metaboxes
========================

This is a small class I made to reduce the amount of code required to create new WordPress meta boxes for custom post types. 

I am still very new to php and object orientated programming, if anyone notices any security issues feel free to bring them up.

This is a time saving method and can be replicated for custom post types and even custom taxonomies as well! If this becomes popular I will upload my other scripts which also creates CPT's and Customs taxonomies in 2 lines of code instead of the procedural style set out by WordPress.

To use this awesome piece of time saving code for WordPress;

1. Initiate our new class
	
$init = new wcd_metaboxes;

2. Pass through variables to the method.

$init -> set_meta_box( $id, $title, $post_type, $description, $input_type, $input_options  );

A) $ID - This is the blocks unique identified and will also be the database 'key'
B) $title - The title of the new box
C) $post_type - 'post' or 'your-custom-post-type'
D) $description - the meta box description
E) $input_type - 'text' or 'select' input type
*D) $input options - If using 'select' input type, pass an array to populate the meta box

you final code for a regular 'text input type' should look like this:

$text_box = new wcd_metaboxes;
$text_box -> set_meta_box('text_box', 'Text Box', 'custom-post-type', 'Enter Text Box Name:', 'text');

you final code for a 'select input type' should look like this:

$input_options = array(
	'Option 1',
	'Option 2',
	'Option 3',
	'Option 4',
	'Option 5'
		
);

$select_box = new wcd_metaboxes;
$select_box -> set_meta_box('select_box', 'Select Box:', 'custom_post_type', 'Select your options', 'select', $input_options);
	
	
