<?php 	
	
	require_once('../../../wp-config.php');

	global $wpdb;

	$sqlregion = 'SELECT region, COUNT(*) as total FROM wp_territory_voting GROUP BY region';
	$sqltotal = "SELECT region, COUNT(*) as mySum FROM wp_territory_voting";

	$result = $wpdb->get_results($sqlregion) or die(mysql_error());
	$resulttotal = $wpdb->get_results($sqltotal) or die(mysql_error());

	foreach	( $resulttotal as $row ) {
		$totalentries = $row->mySum;
	}

	foreach( $result as $row ) {

		$region = $row->region . ' ';
		$total = $row->total . ' ';
		$percentage = ($total / $totalentries ) * 100 . '%';
		$percentagerounded = round($percentage, 1) . '% ';

	   	echo $region;
	   	echo $total;
	   	echo $percentagerounded;

	}
?>