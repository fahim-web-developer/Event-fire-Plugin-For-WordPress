<?php 

/**
 * Plugin Name: Event
 * Description: Event
 * Version:  1.0.1
 * Requires at least: 5.2
 * Author: Fahim Shaki
 * Requires PHP:      7.2
 * License:  GPL v2 or later
 * TextDomain:  event
 */

if ( ! defined('ABSPATH')) exit; 

register_activation_hook( __FILE__, 'eventForm');
function eventForm(){
	 global $wpdb;
	 $charset_collate = $wpdb->get_charset_collate();
     $table_name = $wpdb->prefix . 'event_collection';

     $sql = "CREATE TABLE `$table_name` (id int NOT NULL AUTO_INCREMENT PRIMARY KEY,name varchar(255),code varchar(255),dates date,description varchar(255),address varchar(255), status varchar(255)) ENGINE=MyISAM DEFAULT CHARSET=latin1;";
    if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
         dbDelta($sql);
    }
}

// forntend
require_once( plugin_dir_path( __FILE__ ) . 'includes/event_form.php');


//admin
require_once( plugin_dir_path( __FILE__ ) . 'admin/event_list.php');

