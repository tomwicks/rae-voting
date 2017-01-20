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

add_action('admin_menu', 'vote_plugin_setup_menu');
 
function vote_plugin_setup_menu(){
        add_menu_page( 'Voting Page', 'Voting Plugin', 'manage_options', 'vote-plugin', 'vote_init' );
}
 
function vote_init(){
        global $wpdb;

		$sqlregion = 'SELECT region, COUNT(*) as total FROM wp_territory_voting GROUP BY region ORDER BY COUNT(*) DESC';
		$sqltotal = "SELECT region, COUNT(*) as mySum FROM wp_territory_voting";
		$sqltable = "SELECT * FROM wp_territory_voting";

		$result = $wpdb->get_results($sqlregion) or die(mysql_error());
		$resulttotal = $wpdb->get_results($sqltotal) or die(mysql_error());
		$resulttable = $wpdb->get_results($sqltable) or die(mysql_error());

		foreach	( $resulttotal as $row ) {
			$totalentries = $row->mySum;
		}

		echo "<h1>Results</h1>";

		foreach( $result as $row ) {

			$region = $row->region . ' ';
			$total = $row->total . ' ';
			$percentage = ($total / $totalentries ) * 100 . '%';
			$percentagerounded = round($percentage, 1) . '% ';

		   	echo "<h3>".$region;
		   	echo $total;
		   	echo $percentagerounded."</h3>";

		}

		$viralPeople = "SELECT ref_id, COUNT(*) as total FROM wp_territory_voting GROUP BY ref_id ORDER BY COUNT(*) DESC";
		$viralttable = $wpdb->get_results($viralPeople) or die(mysql_error());

		foreach( $viralttable as $row ) {
			$ref_total = $row->total;
			$ref_id = $row->ref_id;

			echo $ref_id . ' - ';
			echo $ref_total . ' / ';

		}

		

		echo "<h1>Viral Kings &amp; Queens</h1>";
		echo "<table>";
		echo "<tr>";
	    echo "<td>Name</td>";
	    echo "<td>Email</td>";
	    echo "<td>#Signups</td>";
	    echo "</tr>";
	    echo "</table>";

		echo "<table>";
		echo "<tr>";
	    echo "<td>ID</td>";
	    echo "<td>Time</td>";
	    echo "<td>First Name</td>";
	    echo "<td>Last Name</td>";
	    echo "<td>Email</td>";
	    echo "<td>Region</td>";
	    echo "<td>Country</td>";
	    echo "<td>Device</td>";
	    echo "<td>City</td>";
	    echo "<td>Refer ID</td>";
	    echo "</tr>";

	    echo "<h1>Sign Up List</h1>";
	    
		foreach( $resulttable as $row ) {

			$id = $row->id;
			$time = $row->time;
			$first_name = $row->first_name;
			$last_name = $row->last_name;
			$email = $row->email;
			$region = $row->region;
			$country = $row->country;
			$device = $row->device;
			$city = $row->city;
			$ref_id = $row->ref_id;
			 
			echo "<tr>";
		    echo "<td>".$id."</td>";
		    echo "<td>".$time."</td>";
		    echo "<td>".$first_name."</td>";
		    echo "<td>".$last_name."</td>";
		    echo "<td>".$email."</td>";
		    echo "<td>".$region."</td>";
		    echo "<td>".$country."</td>";
		    echo "<td>".$device."</td>";
		    echo "<td>".$city."</td>";
		    echo "<td>".$ref_id."</td>";
		    echo "</tr>";
		}

		echo "</table>";
}


?>