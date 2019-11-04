<?php

/**
 * Adds BubbleSelectionWidget widget.
 */
class BubbleSelectionWidget extends WP_Widget {

	/// Plugin name.
	protected $m_plugin_name;

	/// Plugin version.
	protected $m_version;

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
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'bubble_selection_widget', // Base ID
			esc_html__( 'Bubble Selection', 'bs_domain' ), // Name
			array( 'description' => esc_html__( 'Widget to make a selection from bubbles.', 'bs_domain' ), ) // Args
		);
		$this->$m_plugin_name = "Bubble-Selection";
		$this->definePublicHooks();
		$this->defineAdminHooks();

		if( defined('BUBBLE_SELECTOR_VERSION')) {
			$this->m_version = BUBBLE_SELECTOR_VERSION;
		} else {
		  $this->$m_version = "0.0.1";
		}

	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		echo $args['before_widget']; 

		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'bubble_selection_widget', $instance['title'] ) . $args['after_title'];
		}

		// widget content
		echo '<h3> Hello from bubble widget. </h3>';

		echo $args['after_widget'];
	}

	private function definePublicHooks() {

	}

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

} // class Foo_Widget