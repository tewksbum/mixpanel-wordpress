<?php
add_action( 'wp_head', array('MixPanel', 'insert_tracker' ));
add_action( 'wp_footer', array('MixPanel', 'insert_event' ));



class MixPanel {

  /**
   * Gets the value of the key mixpanel_event_label for this specific Post
   * 
   * @return string The value of the meta box set on the page
   */
  static function get_post_event_label()
  {
    global $post;
	
    return get_post_meta( $post->ID, 'mixpanel_event_label', true );
  }

  /**
   * Inserts the value for the mixpanel.track() API Call
   * @return boolean technically this should be html.. 
   */
  function insert_event()
  {
    $event_label = self::get_post_event_label(); 
    if (empty($event_label)) {
    	return false;
    }

    $settings = (array) get_option( 'mixpanel_settings' );
    if (!isset($settings['token_id'])) {
    	self::no_mixpanel_token_found();
    	return false;
    }

    echo "<script type='text/javascript'>
	  mixpanel.register_once({ 
        'first_wp_page': document.title,
        'first_wp_contact': new Date().toDateString() 
      });
      mixpanel.track(\"$event_label\", 
          {
            'page name': document.title, 
            'page url': window.location.pathname
          }
      ); 
    </script>"; 

    return true; 
  }


  /**
   * Adds the Javascript necessary to start tracking via MixPanel. 
   * this gets added to the <head> section usually. 
   *
   * @return [type] [description]
   */
  function insert_tracker()
  {
    $settings = (array) get_option( 'mixpanel_settings' );
    if(!isset($settings['token_id'])) {
      self::no_mixpanel_token_found();
      return false;  
    }

    require_once dirname(__FILE__) . '/mixpaneljs.php';  
  

    return true;  
  }

  static function no_mixpanel_token_found()
  {
    echo "<!-- No MixPanel Token Defined -->"; 
  }

}

// Enqueue the jQuery UI Scrollable plugin, which is required for
// the custom MCE editor to work.
function jquery_ui_scrollable() {
	wp_enqueue_script('jquery-ui-scrollable', plugins_url("js/jquery-ui-scrollable.min.js", __FILE__), array('jquery-ui'), '0.1.1');
	wp_enqueue_script('jquery-ui', "//code.jquery.com/ui/1.11.4/jquery-ui.min.js", array(), '1.11.4');
}
add_action('wp_enqueue_scripts', 'jquery_ui_scrollable');

?>
