<?php

global $wpdb;

// Escape user inputs for security

$first_name = $_POST['firstname'];
$last_name =  $_POST['lastname'];
$email_address = $_POST['email'];
$region = $_POST['region'];
$device = $_POST['device'];
$country = $_POST['country'];
$refer = $_POST['refer'];

$lastid = $wpdb->insert_id;

require_once('../../../wp-config.php');
global $wpdb;

$timestamp = date('Y-m-d G:i:s');

if(!filter_var($email_address, FILTER_VALIDATE_EMAIL))
    exit("Invalid email address");

$email_query = "SELECT email FROM wp_territory_voting WHERE email = '$email_address'";

$email_duplicate = $wpdb->get_results($email_query);

		if(count($email_duplicate) == 0)

		{

		    $wpdb->insert( 'wp_territory_voting', 
		    	array( 
		    		'time' => $timestamp, 
		    		'first_name' => $first_name, 
		    		'last_name' => $last_name,
		    		'email' => $email_address,
		    		'region' => $region,
		    		'country' => $country,
		    		'device' => $device,
		    		'ref_id' => $refer,
		    	)
		    );

		    $refer_query = "SELECT id FROM wp_territory_voting WHERE email = '$email_address'";
		    $refer_result = $wpdb->get_results($refer_query);
		    
		    foreach( $refer_result as $row ) {
				$refer_id = $row->id . ' ';
		    	echo get_site_url() . '/vote?refer=' . $refer_id;
			}
		}
		else
		{
		    echo 'Someone has already signed up with this email.';

		}
	
	

?>