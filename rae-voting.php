<?php
/**
* Plugin Name: RAE - Voting
* Plugin URI: 
* Description: This allows players to vote on the territory we launch in next.
* Version: 1.0
* Author: Run An Empire
* Author URI: Author's website
* License: A "Slug" license name e.g. GPL12
*/


register_activation_hook( __FILE__, 'rae_vote' );

function rae_vote() {

	global $wpdb;
	$charset_collate = $wpdb->get_charset_collate();
	$table_name = $wpdb->prefix . 'territory_voting';

	$sql = "CREATE TABLE $table_name (
		id mediumint(9) NOT NULL AUTO_INCREMENT,
		time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
		first_name Varchar(255) NOT NULL,
		last_name Varchar(255) NOT NULL,
		email Varchar(255) NOT NULL,
		device Varchar(255) NOT NULL,
		country Varchar(255) NOT NULL,
		region Varchar(255) NOT NULL,
		city Varchar(255) NOT NULL,
		ref_id Int(11),
		UNIQUE KEY id (id)
	) $charset_collate;";

	require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	dbDelta( $sql );
}


?>