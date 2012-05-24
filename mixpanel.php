<?php
/*
Plugin Name: MixPanel for WordPress 
Plugin URI: http://zippykid.com/
Description: A relatively easy way to integrate MixPanel with your WordPress site
Author: Vid Luther <vid@zippykid.com>
Version: 0.1
Author URI: http://zippykid.com/
*/

if( is_admin() ){
  require_once dirname( __FILE__ ) . '/meta-box.php';
} else {
  require_once dirname( __FILE__ ) . '/page.php';
}

?>