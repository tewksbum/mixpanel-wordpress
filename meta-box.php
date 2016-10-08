<?php

add_action( 'admin_menu', 'mixpanel_create_meta_box' );
add_action( 'admin_menu', 'mavenx_create_meta_box' );
add_action( 'save_post', 'mixpanel_update_event_label' );
add_action( 'save_post', 'mavenx_update_event_label' );

function mixpanel_create_meta_box(){
  if( function_exists('add_meta_box') ){
    add_meta_box( 'mixpanel-event-label', 'MixPanel Event Label', 'mixpanel_event_box', 'post' );
  }
}

function mavenx_create_meta_box(){
  if( function_exists('add_meta_box') ){
    add_meta_box( 'mavenx-event-label', 'Blogger Meta', 'mavenx_blogger_box', 'post' );
  }
}

function mavenx_blogger_box(){
  global $post;
  $mavenx_blogger_type = get_post_meta( $post->ID, 'mavenx_blogger_type', true );
  $mavenx_blogger_grade = get_post_meta( $post->ID, 'mavenx_blogger_grade', true );
  $mavenx_blogger_email = get_post_meta( $post->ID, 'mavenx_blogger_email', true );
  ?>
  <table class="form_table">
    <tr>
      <th width="30%"><label for="mavenx_blogger_type">Blogger Type:</label></th>
      <td width="70%"><input type="text" size="60" name="mavenx_blogger_type" value="<?php echo $mavenx_blogger_type; ?>" /></td>
    </tr>
    <tr>
      <th width="30%"><label for="mavenx_blogger_grade">Blogger Grade:</label></th>
      <td width="70%"><input type="text" size="60" name="mavenx_blogger_grade" value="<?php echo $mavenx_blogger_grade; ?>" /></td>
    </tr>
    <tr>
      <th width="30%"><label for="mavenx_blogger_email">Blogger Email:</label></th>
      <td width="70%"><input type="text" size="60" name="mavenx_blogger_email" value="<?php echo $mavenx_blogger_email; ?>" /></td>
    </tr>
  </table>
  <?php
}

function mixpanel_event_box(){
  global $post;
  $mixpanel_event_label = get_post_meta( $post->ID, 'mixpanel_event_label', true );
  $mixpanel_event_prop = get_post_meta( $post->ID, 'mixpanel_event_prop', true );
  ?>
  <table class="form_table">
    <tr>
      <th width="30%"><label for="mixpanel_event_label">Maven MixPanel Event Name</label></th>
      <td width="70%"><input type="text" size="60" name="mixpanel_event_label" value="<?php echo $mixpanel_event_label; ?>" /></td>
    </tr>
    <tr>
      <th width="30%"><label for="mixpanel_event_prop">Maven MixPanel Prop</label></th>
      <td width="70%"><input type="text" size="60" name="mixpanel_event_prop" value="<?php echo $mixpanel_event_prop; ?>" /></td>
    </tr>
  </table>
  <?php
}

function mixpanel_update_event_label( $post_id ){
  if( isset($_POST['mixpanel_event_label']) ){
    update_post_meta( $post_id, 'mixpanel_event_label', $_POST['mixpanel_event_label'] );
    update_post_meta( $post_id, 'mixpanel_event_prop', $_POST['mixpanel_event_prop'] );
  }
}

function mavenx_update_event_label( $post_id ){
  if( isset($_POST['mixpanel_event_label']) ){
    update_post_meta( $post_id, 'mavenx_blogger_grade', $_POST['mavenx_blogger_grade'] );
    update_post_meta( $post_id, 'mavenx_blogger_type', $_POST['mavenx_blogger_type'] );
    update_post_meta( $post_id, 'mavenx_blogger_email', $_POST['mavenx_blogger_email'] );
  }
}
?>
