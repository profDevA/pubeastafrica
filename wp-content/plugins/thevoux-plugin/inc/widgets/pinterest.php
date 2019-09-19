<?php

/**
 * Pinterest pinboard class to fetch the pinterest feed
 * and render the HTML pinboard.
 */
class thb_Pinterest_Pinboard {

	// Render the pinboard and output
	function render($username, $count) {
	  $nr_pins = $count;
	  $pins = $this->get_pins($username, $nr_pins);

	  echo '<div class="photocontainer">';
	  if (is_null($pins)) {
	      echo("Unable to load Pinterest pins for '$username'\n");
	  } else {
      foreach ($pins as $pin) {
        $title = $pin['title'];
        $url = $pin['url'];
        $image = $pin['image'];
        ?>
        <div class="overlay-effect">
        	<figure style="background-image:url(<?php echo esc_url($image); ?>)">
        		<a href="<?php echo esc_url($url); ?>" title="<?php echo esc_attr($title); ?>" target="_blank"></a>
        	</figure>
        </div>
        <?php
      }
	  }
	  ?>
	  </div>
	  <div class="pin_link">
      <a class="pin_logo" href="http://pinterest.com/<?php echo esc_attr($username) ?>/" target="_blank">
        <img src="//passets-cdn.pinterest.com/images/small-p-button.png" width="16" height="16" alt="<?php esc_attr_e('Follow Me on Pinterest', 'thevoux' ); ?>" />
        <span class="pin_text"><?php echo esc_attr($username) ?></span>
      </a>
	  </div>
	  <?php
	}
	/**
	* Retrieve RSS feed for username, and parse the data needed from it.
	* Returns null on error, otherwise a hash of pins.
	*/
	function get_pins($username, $nrpins) {

		// thb Pinterest Widget
		include_once(ABSPATH . WPINC . '/feed.php');

	  // Set caching.
	  add_filter('wp_feed_cache_transient_lifetime', function() {
			return 900;
		});

	  // Get the RSS feed.
	  $url = sprintf('https://pinterest.com/%s/feed.rss', $username);
	  $rss = fetch_feed($url);
	  if (is_wp_error($rss)) {
	      return null;
	  }

	  $maxitems = $rss->get_item_quantity($nrpins);
	  $rss_items = $rss->get_items(0, $maxitems);

	  $pins;
	  if (is_null($rss_items)) {
	      $pins = null;
	  } else {

      // Build patterns to search/replace in the image urls.
      // Pattern to replace for the images.
      $search = array('_b.jpg');
      $replace = array('_t.jpg');
      // Make urls protocol relative
      array_push($search, 'https://');
      array_push($replace, '//');

      $pins = array();
      foreach ($rss_items as $item) {
        $title = $item->get_title();
        $description = $item->get_description();
        $url = $item->get_permalink();
        if (preg_match_all('/<img src="([^"]*)".*>/i', $description, $matches)) {
            $image = str_replace($search, $replace, $matches[1][0]);
        }
        array_push($pins, array(
          'title' => $title,
          'image' => $image,
          'url' => $url
        ));
      }
	  }
	  return $pins;
	}

}

class Pinterest_Pinboard_Widget extends WP_Widget {

  function __construct(){

  	$widget_ops = array(
  		'classname'   => 'thb_pinterest_widget',
  		'description' => esc_html__('Adds a Pinterest Pinboard widget to your sidebar','thevoux')
  	);

  	parent::__construct(
  		'pinterest',
  		esc_html__( 'Fuel Themes - Pinterest' , 'thevoux' ),
  		$widget_ops
  	);

  	$this->defaults = array(
			'title' => '',
			'username' => 'fuelthemes',
			'count' => 3
		);
  }

  function update($new_instance, $old_instance) {
    $instance = $new_instance;

    return $instance;
  }

  function widget($args, $instance) {
		$params = array_merge( $this->defaults, $instance );

    // Before Widget.
		echo $args['before_widget'];

		// Title.
		if ( $params['title'] ) {
			echo wp_kses_post( $args['before_title'] . apply_filters( 'widget_title', $params['title'], $instance, $this->id_base ) . $args['after_title'] );
		}

    // Render the pinboard from the widget settings.
    $pinboard = new thb_Pinterest_Pinboard();
    $pinboard->render($params['username'], $params['count']);

    echo $args['after_widget'];
  }
	function form($instance) {
  	$params = array_merge( $this->defaults, $instance );
    ?>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Widget Title:', 'thevoux' ); ?></label>
      <input class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" name="<?php echo esc_attr($this->get_field_name('title')); ?>" type="text" value="<?php echo esc_attr($params['title']); ?>" />
    </p>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id('username')); ?>"><?php esc_html_e('Username:', 'thevoux' ); ?></label>
      <input class="widefat" id="<?php echo esc_attr($this->get_field_id('username')); ?>" name="<?php echo esc_attr($this->get_field_name('username')); ?>" type="text" value="<?php echo esc_attr($params['username']); ?>" />
    </p>
    <p>
      <label for="<?php echo esc_attr($this->get_field_id('count')); ?>"><?php esc_html_e('Number of Images:', 'thevoux' ); ?></label>
      <input id="<?php echo esc_attr($this->get_field_id('count')); ?>" name="<?php echo esc_attr($this->get_field_name('count')); ?>" type="text" value="<?php echo esc_attr($params['count']); ?>" />
    </p>
    <?php
  }
}