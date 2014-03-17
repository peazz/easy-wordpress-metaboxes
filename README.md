Easy Wordpress Metaboxes
========================

This is a small class I made to reduce the amount of code required to create new WordPress meta boxes for custom post types. 

I am still very new to php and object orientated programming, if anyone notices any security issues feel free to bring them up.

This is a time saving method and can be replicated for custom post types and even custom taxonomies as well! If this becomes popular I will upload my other scripts which also creates CPT's and Customs taxonomies in 2 lines of code instead of the procedural style set out by WordPress.

To use this awesome piece of time saving code for WordPress;

<b>1. Initiate our new class</b>
	
$init = new wcd_metaboxes;

<b>2. Pass through variables to the method.</b>

$init -> set_meta_box( $id, $title, $post_type, $description, $input_type, $input_options  );

A) $ID - This is the blocks unique identifier and will also be the database 'key' and the input 'name & id'<br />
B) $title - The title of the new box<br />
C) $post_type - 'post' or 'your-custom-post-type'<br />
D) $description - the meta box description<br />
E) $input_type - 'text' or 'select' input type<br />
*D) $input options - If using 'select' input type, pass an array to populate the meta box<br />

<b>your final code for a regular 'text input type' should look like this:</b>

$text_box = new wcd_metaboxes;
$text_box -> set_meta_box('text_box', 'Text Box', 'custom-post-type', 'Enter Text Box Name:', 'text');

<b>your final code for a 'select input type' should look like this:</b>

$input_options = array(
	'Option 1',
	'Option 2',
	'Option 3',
	'Option 4',
	'Option 5'
		
);

$select_box = new wcd_metaboxes;
$select_box -> set_meta_box('select_box', 'Select Box:', 'custom_post_type', 'Select your options', 'select', $input_options);
	
	
