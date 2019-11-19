<?php

require_once(plugin_dir_path(__FILE__).'db.php');

// Make sure no other class named BubbleSelector exists to avoid fatal erros.
if(!class_exists('BubbleSelector')) {

/**
 * Bubble selector class definition.
 */
class BubbleSelector {

	/// Plugin name.
	protected $m_plugin_name;

	/// Plugin version.
	protected $m_version;

	/// Learndash categories.
	public $m_categories;

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		$this->$m_plugin_name = "Bubble-Selection";
		$this->m_version = BUBBLE_SELECTOR_VERSION;
		
		// fetch categories from DB
		$this->m_categories = getFromDB("SELECT * FROM 'wp_terms'");


		$this->definePublicHooks();
		$this->defineAdminHooks();

		// Register Shortcode
		add_shortcode('bubble-selector', array($this, 'shortCodeFunction'));

		// Enqueue scripts
		add_action('wp_enqueue_scripts', array($this, 'enqueueScripts'));
	}

	/**
	 * Getter for the plugin name.
	 */
	public function getPluginName() {
		return $this->$m_plugin_name;
	}

	/**
	 * Getter for the plugin version.
	 */
	public function getVersion() {
		return $this->$m_version;
	}

	/**
	 * Getter for the categories.
	 */
	public function getCategories() {
		return $this->$m_categories;
	}


	// TODO hook in stuff...
	private function definePublicHooks() {

	}

	// TODO hook in stuff...
	private function defineAdminHooks() {}

	public function run() {}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'Bubble Selection', 'bs_domain' );
		?>
		<p>
		  <label 
			  for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
				<?php esc_attr_e( 'Title:', 'bs_domain' ); ?>
			</label> 
		  <input 
			  class="widefat" 
				id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" 
				name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" 
				type="text" 
				value="<?php echo esc_attr( $title ); ?>">
			<label for="<?php echo esc_attr( $this->get_field_id(' test ') ); ?>">
			  <?php esc_attr_e( 'Test:', 'bs_domain' ); ?>
			</label>
			<input 
			  class="widefat"
				id="<?php echo esc_attr( $this->get_field_id( 'test' ) ); ?>"
				name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>"
				type="text"
				value="<?php echo esc_attr( $test ); ?>">
		</p>
		<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';

		return $instance;
	}

	/**
	 * Shortcode function. 
	 * Needs to be static for wordpress handler.
	 * 
	 * @return The shortcode html and js entry point.
	 */
	public static function shortCodeFunction() {
		$content = "<style>\r\n";
		$content .= "h3.demoClass { \r\n";
		$content .= "color: #26b158";
		$content .= "}\r\n";
		$content .= "</style>\r\n";
		$content .= '<h3 class="demoClass" id="demoId"> Check it out!</h3>';
		$content .= '<button id="demoButton">demobutton</button>';
		$content .= '<div id="bubbleGraph"></div>';
		return $content;
	}

	/**
	 * Enqueue scripts.
	 */
	public function enqueueScripts() {
		//
		// Javscript
		//
		wp_register_script('d3js', 'https://d3js.org/d3.v4.min.js', null, null, true);
		// JQuery is already registered as a default
		wp_enqueue_script('test', plugin_dir_url(__FILE__).'../js/test.js', array('d3js', 'jquery'));

		// add variables from php to js
		wp_localize_script('test', 'php_vars', array(
			'test_value' => 4,
			'ajax_url' => admin_url('admin-ajax.php')
			));
		
		// Set callback for ajax request
		add_action('wp_ajax_selection_callback', 'selection_callback');

		//
		// CSS
		//
		wp_register_style('my_style', plugin_dir_url(__FILE__).'../css/test_style.css');
	}

	/**
	 * Ajax callback handler. 
	 * Writes the selected topics to the database.
	 */
	public function selection_callback() {
		// Create db handle
		global $wpdb;

		echo $_POST.test;
	}

} // class BubbleSelector

} // class guard
