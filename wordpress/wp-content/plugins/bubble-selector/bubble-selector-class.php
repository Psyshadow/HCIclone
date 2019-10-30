<?php
/**
 * Adds a bubble selection widget.
 */
class BubbleSelectionWidget extends WP_Widget {
	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		$widget_ops = array( 
			'classname' => 'BubbleSelectionWidget',
			'description' => 'dummy description',
		);
		parent::__construct( 'BubbleSelectionWidget', 'BubbleSelection', $widget_ops );
	}

	/**
	 * Outputs the content of the widget
	 * 
	 * @see WP_Widget::widget()
	 *
	 * @param array $args Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		// outputs the content of the widget
		echo test;
	}

	/**
	 * Outputs the options form on admin backend.
	 * 
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values fromd database.
	 */
	public function form( $instance ) {
		$title = ! empty( $instance['title'] ) ? $instance['title'] : esc_html__( 'New title', 'text_domain' );
		?>
		<p>
		<label for="
			<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>
		">
			<?php esc_attr_e( 'Title:', 'text_domain' ); ?>
		</label> 
		<input class="widefat" id="
			<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>
		" name="
			<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>
		" type="text" value="
			<?php echo esc_attr( $title ); ?>
		">
		</p>
		<?php 
	}



	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 *
	 * @return array
	 */
	public function update( $new_instance, $old_instance ) {
		// processes widget options to be saved
	}
}
