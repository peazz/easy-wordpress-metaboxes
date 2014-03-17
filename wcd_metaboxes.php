
	class wcd_metaboxes {
		
		public $ID; // The unique ID
		public $title; // The Meta Box Title
		public $post_type; // Where it will be insert
		public $description; // Its Description
		public $input_type; // Input type - "text" or "select"
		public $input_options; // input options array for "select"
		
		
		public function __construct() {
			add_action( 'add_meta_boxes', array($this, 'add_meta_box') );
			add_action( 'save_post', array( $this, 'save' ) );
		}
		
		
		public function set_meta_box( $id, $title, $post_type, $description, $input_type, $input_options ) {
		
		
			$this->ID = $id;
			$this->title = $title;
			$this->post_type = $post_type;
			$this->description = $description;
			$this->input_type = $input_type;
			$this->input_options = $input_options;
		
		}
		
		public function add_meta_box() {
			
			if ($this->input_type == "text") {
			
				add_meta_box(
				
					$this->ID,						// Unique ID
					esc_html__($this->title, 'wcd'),	// Title
					array($this, 'render_meta_text_content'),					// Callback Function
					$this->post_type,					// Admin Page or Post type
					'normal',					// Context
					'high'					// Priority
				
				);
			
			} else if ( $this->input_type == "select" ) {
				
				add_meta_box(
				
					$this->ID,						// Unique ID
					esc_html__($this->title, 'wcd'),	// Title
					array($this, 'render_meta_select_content'),					// Callback Function
					$this->post_type,					// Admin Page or Post type
					'normal',					// Context
					'high'					// Priority
				
				);
				
			}
			
		}
		
		public function save( $post_id ) {
	
			/*
			 * We need to verify this came from the our screen and with proper authorization,
			 * because save_post can be triggered at other times.
			 */
	
			// Check if our nonce is set.
			if ( ! isset( $_POST['nonce'] ) )
				return $post_id;
	
			$nonce = $_POST['nonce'];
	
			// Verify that the nonce is valid.
			if ( ! wp_verify_nonce( $nonce, 'inner_custom_box' ) )
				return $post_id;
	
			// If this is an autosave, our form has not been submitted,
					//     so we don't want to do anything.
			if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) 
				return $post_id;
	
			// Check the user's permissions.
			if ( 'page' == $_POST['post_type'] ) {
	
				if ( ! current_user_can( 'edit_page', $post_id ) )
					return $post_id;
		
			} else {
	
				if ( ! current_user_can( 'edit_post', $post_id ) )
					return $post_id;
			}
	
			/* OK, its safe for us to save the data now. */
	
			// Sanitize the user input.
			$mydata = sanitize_text_field( $_POST[ $this->ID  ] );
	
			// Update the meta field.
			update_post_meta( $post_id, $this->ID, $mydata );
			
		}
		
		
		function render_meta_text_content( $post ) {
			
			// Add an nonce field so we can check for it later.
			wp_nonce_field( 'inner_custom_box', 'nonce' );
	
			// Use get_post_meta to retrieve an existing value from the database.
			$value = get_post_meta( $post->ID, $this->ID, true );

			// Display the form, using the current value.
			echo '<label for="'. $this->ID .'"><strong>';
					_e( $this->description, 'wcd' );
			echo '</strong></label> ';
			
			echo '<input type="text" id="'. $this->ID .'" name="'. $this->ID .'"';
			echo ' value="' . esc_attr( $value ) . '" size="25" />';
			
		}
		
		function render_meta_select_content( $post ) {
			
			// Add an nonce field so we can check for it later.
			wp_nonce_field( 'inner_custom_box', 'nonce' );
	
			// Use get_post_meta to retrieve an existing value from the database.
			$value = get_post_meta( $post->ID, $this->ID, true );

			// Display the form, using the current value.
			echo '<label for="'. $this->ID .'"><strong>';
					_e( $this->description, 'wcd' );
			echo '</strong></label> ';
			
			echo '<select id="'. $this->ID .'" name="'. $this->ID .'">';

				foreach ($this->input_options as $option) {
					
					if ($option == $value) {
						
						echo '<option value="'. esc_attr( $option ) .'" selected>'. esc_attr( $option ) .'</option>';
						
					} else  {
						
						echo '<option value="'. esc_attr( $option ) .'">'. esc_attr( $option ) .'</option>';
						
					}
					
					
				}
          
            echo '</select>';
			
			
			
		}
	
	}
		
