<?php
add_action('wp_head', array('MixPanel', 'insert_tracker'));
add_action('wp_footer', array('MixPanel', 'insert_event'));
add_action('wp_enqueue_scripts', array('MixPanel', 'jquery_ui_scrollable'));

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
    $settings = (array) get_option( 'mixpanel_settings' );
    if (!isset($settings['token_id'])) {
    	self::no_mixpanel_token_found();
    	return false;
    }

    $event_label = self::get_post_event_label();
    echo "<script>console.log( 'trying to set event: " . $event_label . " (EOL)' );</script>";
    if (!empty($event_label)) {
		echo "<script type='text/javascript'>
		  mixpanel.register_once({
			'First page': document.title,
			'First page visit date': new Date().toISOString(),
		  });
		  mixpanel.track(\"$event_label\", {
			'Page Name': document.title,
			'Page Url': window.location.pathname,
      'Label': '$event_label',
		  });
		 </script>";
    }
    echo "<script>console.log( 'set event: " . $event_label . " (EOL)' );</script>";
    /*
     * START STATIC PAGE MIXPANEL JS
     */
    ?>
    <script type='text/javascript'>
    	// function monaeo_form_onsuccess(id) {
      //   	var form = jQuery('input[name="_wpcf7"][value="' + id + '"]').closest("form");
      //   	var email = form.find('[name="email"]').val();
      //   	var firstName = form.find('[name="first-name"]').val();
      //   	var lastName = form.find('[name="last-name"]').val();
      //   	var company = form.find('[name="company"]').val();
      //   	var title = form.find('[name="title"]').val();
      //   	var phone = form.find('[name="phone"]').val();
      //   	mixpanel.alias(email);
      //   	mixpanel.register({
      //       	"email": email,
      //       	"first name": firstName,
      //       	"last name": lastName,
      //       	"company": company,
      //       	"title": title,
      //       	"phone": phone
      //   	});
      //   	mixpanel.people.set({
      //       	"$email": email,
      //       	"$first_name": firstName,
      //       	"$last_name": lastName
      //       });
    	// }

    	jQuery( document ).ready(function() {
			  // jQuery('#site-header .sign-in button').click(function() {
				//   var signInCount = mixpanel.get_property('Sign In Count') || 0;
				//   signInCount++;
				//   mixpanel.register({
				// 	  'Sign In Count': signInCount,
				// 	  'Last Sign In Date': new Date().toISOString()
				//   });
				//   mixpanel.track('Sign In');
			  // });
			  // jQuery('#site-wrapper a[href^="/demo"]').click(function(event) {
			  // 	  var eventName = jQuery(this).attr('href') === '/demo-ra' ? 'Book a Risk Analysis Demo' : 'Book a Demo';
				//   mixpanel.track(eventName, {
				// 	  'source page': document.title,
				// 	  'button location': event.currentTarget.id
				//   });
			  // });
			  // jQuery('#site-header a[href^="/demo"]').click(function(event) {
			  // 	  var eventName = jQuery(this).attr('href') === '/demo-ra' ? 'Book a Risk Analysis Demo' : 'Book a Demo';
				//   mixpanel.track(eventName, {
				// 	  'source page': document.title,
				// 	  'button location': event.currentTarget.id
				//   });
			  // });
			  jQuery('#site-footer a[href^="/demo"]').click(function(event) {
			  	  var eventName = jQuery(this).attr('href') === '/demo-ra' ? 'Book a Risk Analysis Demo' : 'Book a Demo';
				  mixpanel.track(eventName, {
					  'button location': 'Footer'
				  });
			  });
			  // jQuery('a[href^="/support"]').click(function(event) {
				//   mixpanel.track('Support Clicked', {
				// 	  'Topic': jQuery(event.currentTarget).text()
				//   });
			  // });
			  // jQuery('ul.download a, a[href^="/app-downloads"]').click(function(event) {
				//   mixpanel.register({'App store': event.currentTarget.id});
				//   mixpanel.track('Download App');
			  // });
		  });
    </script>
    <?php
    /*
     * END STATIC PAGE MIXPANEL JS
     */
    return true;
  }

  /**
   * Adds the Javascript necessary to start tracking via MixPanel.
   * This gets added to the <head> section.
   *
   * @return [type] [description]
   */
  static function insert_tracker() {
  	$settings = get_option('mixpanel_settings');
  	if (!isset($settings['token_id'])) {
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

  // Enqueue the jQuery UI Scrollable plugin, which is required for
  // the custom MCE editor to work.
  static function jquery_ui_scrollable() {
  	wp_enqueue_script('jquery-ui-scrollable', plugins_url("js/jquery-ui-scrollable.min.js", __FILE__), array('jquery-ui'), '0.1.1');
  	wp_enqueue_script('jquery-ui', "//code.jquery.com/ui/1.11.4/jquery-ui.min.js", array(), '1.11.4');
  }
}



?>
