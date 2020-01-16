<?php

require_once(plugin_dir_path(__FILE__).'db.php');

// Make sure no other class named BubbleSelector exists to avoid fatal erros.
if(!class_exists('BubbleSelector')) {

// TODO conditional loading. Only load javascript when the plugin is used
// TODO investigate if shortcode is best approach to load this plugin.
// TODO read correct tables
// TODO write preferred categories to table
// TODO refactor hooks (public & admin)
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

	/// DB table name.
	private static $m_table_name;

	/// DB table prefix.
	private static $m_table_prefix;

	/**
	 * Register widget with WordPress.
	 */
	function __construct($table_name_) {
		global $wpdb;
		$this->m_plugin_name = "Bubble-Selection";
		$this->m_version = BUBBLE_SELECTOR_VERSION;

		$this->table = $table_name_;
		
		// fetch categories from DB
		$this->m_categories = getFromDB("SELECT * FROM 'wp_terms'");

		$this->definePublicHooks();
		$this->defineAdminHooks();

		// Register Shortcode
		add_shortcode('bubble-selector', array($this, 'shortCodeFunction'));

		// Enqueue scripts
		add_action('wp_enqueue_scripts', array($this, 'enqueueScripts'));
		
		// Set callbacks TODO: put in own function
    add_action('wp_ajax_post_selection', array($this, 'post_selection'));
		add_action('wp_ajax_nopriv_post_selection', array($this, 'post_selection'));
	 	add_action('wp_ajax_get_data', array($this, 'get_data'));
		add_action('wp_ajax_nopriv_get_data', array($this, 'get_data'));
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


	// TODO refactor hooks
	private function definePublicHooks() {

	}

	// TODO refactor hooks
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
		$content .= '<div id="bubbleGraph"></div>';
		return $content;
	}

	/**
	 * Enqueue scripts.
	 */
	public function enqueueScripts() {
		//
		// Javscript
		wp_register_script( 'd3js', 'https://d3js.org/d3.v4.min.js', null, null, true );
		// JQuery is already registered as a default
		wp_enqueue_script( 'bubble_graph', plugin_dir_url(__FILE__).'../js/bubble_graph.js', array('d3js', 'jquery') );

		// pass variables from php to js
		wp_localize_script( 'bubble_graph', 'php_vars', array(
			'ajax_url' => admin_url('admin-ajax.php')
			) );
		
		//
		// CSS
		wp_enqueue_style( 'style', plugin_dir_url(__FILE__) . '../css/style.css' );
	}

	/**
	 * Ajax callback handler. 
	 * Writes the selected topics to the database.
	 * 
	 * TODO change to more sophisticated updates.
	 */
	public function post_selection() {
		// Create db handle
		global $wpdb;

		// get the user id
		$current_user = wp_get_current_user();
		$user_id = $current_user->ID;

		// first delete all rows for user
		$wpdb->delete("test_table", Array('user_id' => $user_id));

		$wpdb->insert("test_table", Array('user_id' => $user_id, 'topic_id' => 1));

		echo json_encode($POST_);

		// add a row for each selection
		// foreach ($POST_.selection as $id) {
		// 	$wpdb->insert("test_table", 
		// 	Array(
		// 		'user_id' => $user_id, 
		// 		'topic_id' => $id
		// 	), 
		// 	Array('%d', '%d')); // add topic key
		// }

		wp_die(); // This is required for some reason
	}

	//TODO add properties: (read from different table)
	/**
	 * Handles ajax request.
	 */
	public function get_data() {
		global $wpdb;

		/* The category taxonomy is listed in the table '<prefix>_term_taxonomy'.
		All the terms are listed in the '<prefix>_terms' table.

		Therefore retrieve the wanted taxonomy in '<prefix>_term_taxonomy' and fetch
		the corresponding term_id's in the '<prefix>_terms' table.
		*/

		// get the user id
		$current_user = wp_get_current_user();
		$user_id = $currente_user->ID;

		// Get all the categories
		$query = "SELECT * FROM wp_terms;";
		$categories = $wpdb->get_results($query);

		// Get preferred categories
		$query2 = "SELECT * FROM test_table WHERE user_id=$user_id";
		$preferred = $wpdb->get_results($query2);

		// Pack the categories such as preferred in the response;
		echo json_encode(Array(
			categories => $categories, 
			preferred => $preferred)
			);

		wp_die(); // This is required for some reason
	}

} // class BubbleSelector

} // class guard