<?php
/**
 * Example Widget Class
 */
class irina_example_widget extends WP_Widget {
	/** constructor */
    function irina_example_widget() {
        parent::WP_Widget(false, $name = 'Example Widget');
    }
	/** @see WP_Widget::widget */
	function widget($args, $instance) {
	    extract( $args );

		// these are our widget options
		$title = apply_filters('widget_title', $instance['title']);
		$text = $instance['text'];
		$checkbox = $instance['checkbox'];
		$textarea = $instance['textarea'];
		$select = $instance['select'];

		echo $before_widget;

		// if the title is set
		if ( $title ) {
			echo $before_title . $title . $after_title;
		}

			// if the text field is set
		if ( $text ) {
			echo '<div class="widget-text">' . $text . '</div>';
		}

		// if the checkbox is checked
		if ( $checkbox == true ) {
			echo 'This message is displayed if our checkbox is checked.';
		}

		// if text is entered in the textarea
		if ( $textarea ) {
			echo '<div class="widget-textarea">' . $textarea . '</div>';
		}

		// output text depended on which option is picked
		if ( $select == 'one' ) {
			echo 'Option One is Selected';
		} 
		else if ( $select == 'two' ) {
			echo 'Option Two is Selected';
		} 
		else {
			echo 'Option Three is Selected';
		}
		
		echo $after_widget;
	}

	/** @see WP_Widget::update */
    function update($new_instance, $old_instance) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['text'] = strip_tags($new_instance['text']);
		$instance['checkbox'] = strip_tags($new_instance['checkbox']);
		$instance['textarea'] = strip_tags($new_instance['textarea']);
		$instance['select'] = strip_tags($new_instance['select']);
		
		return $instance;
    }
	
	 /** @see WP_Widget::form */
	function form($instance) {	
		$title = esc_attr($instance['title']);
		$text = esc_attr($instance['text']);
		$checkbox = esc_attr($instance['checkbox']);
		$textarea = esc_attr($instance['textarea']);
		$select = esc_attr($instance['select']);

		?>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Widget Title'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('text_field'); ?>"><?php _e('This is a single line text field:'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('text_field'); ?>" name="<?php echo $this->get_field_name('text_field'); ?>" type="text" value="<?php echo $text_field; ?>" />
		</p>

		<p>
			<input id="<?php echo $this->get_field_id('checkbox'); ?>" name="<?php echo $this->get_field_name('checkbox'); ?>" type="checkbox" value="1" <?php checked( '1', $checkbox ); ?>/>
			<label for="<?php echo $this->get_field_id('checkbox'); ?>"><?php _e('This is a checkbox'); ?></label>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('textarea'); ?>"><?php _e('This is a textarea:'); ?></label>
			<textarea class="widefat" id="<?php echo $this->get_field_id('textarea'); ?>" name="<?php echo $this->get_field_name('textarea'); ?>"><?php echo $textarea; ?></textarea>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('select'); ?>"><?php _e('This is a select menu'); ?></label>
			<select name="<?php echo $this->get_field_name('select'); ?>" id="<?php echo $this->get_field_id('select'); ?>" class="widefat">
				<?php
				$options = array('one', 'two', 'three');
				foreach ($options as $option) {
					echo '<option value="' . $option . '" id="' . $option . '"', $select == $option ? ' selected="selected"' : '', '>', $option, '</option>';
				}
				?>
			</select>
		</p>

		<?php
	}

}
// register example widget
	add_action('widgets_init', function(){
		register_widget('irina_example_widget');
	});

