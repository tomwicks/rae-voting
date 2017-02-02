<?php 	
	
	require_once('../../../wp-config.php');

	global $wpdb;
		
		$sqltotal = "SELECT region, COUNT(*) as mySum FROM wp_territory_voting";
		$resulttotal = $wpdb->get_results($sqltotal) or die(mysql_error());

		$query_europe = "SELECT region, COUNT(*) as total FROM wp_territory_voting WHERE region ='europe'";
		$query_north_america = "SELECT region, COUNT(*) as total FROM wp_territory_voting WHERE region ='north-america'";
		$query_south_america = "SELECT region, COUNT(*) as total FROM wp_territory_voting WHERE region ='south-america'";
		$query_africa = "SELECT region, COUNT(*) as total FROM wp_territory_voting WHERE region ='africa'";
		$query_asia_oceania = "SELECT region, COUNT(*) as total FROM wp_territory_voting WHERE region ='asia-oceania'";

		$result_europe = $wpdb->get_results($query_europe) or die(mysql_error());
		$result_north_america = $wpdb->get_results($query_north_america) or die(mysql_error());
		$result_south_america = $wpdb->get_results($query_south_america) or die(mysql_error());
		$result_africa = $wpdb->get_results($query_africa) or die(mysql_error());
		$result_asia_oceania = $wpdb->get_results($query_asia_oceania) or die(mysql_error());

		foreach	( $resulttotal as $row ) {
			$totalentries = $row->mySum;
		}

		foreach( $result_europe as $row ) {
			$europe_total = $row->total . ' ';
			$europe_percentage = ($europe_total / $totalentries ) * 100 . '%';
			$europe_clean = round($europe_percentage, 0) . '% ';
			$europe_number = round($europe_percentage, 0);
		}

		foreach( $result_north_america as $row ) {
			$north_america_total = $row->total . ' ';
			$north_america_percentage = ($north_america_total / $totalentries ) * 100 . '%';
			$north_america_clean = round($north_america_percentage, 0) . '% ';
			$north_america_number = round($north_america_percentage, 0);
		}

		foreach( $result_south_america as $row ) {
			$south_america_total = $row->total . ' ';
			$south_america_percentage = ($south_america_total / $totalentries ) * 100 . '%';
			$south_america_clean = round($south_america_percentage, 0) . '% ';
			$south_america_number = round($south_america_percentage, 0);
		}

		foreach( $result_africa as $row ) {
			$africa_total = $row->total . ' ';
			$africa_percentage = ($africa_total / $totalentries ) * 100 . '%';
			$africa_clean = round($africa_percentage, 0) . '% ';
			$africa_number = round($africa_percentage, 0);
		}

		foreach( $result_asia_oceania as $row ) {
			$asia_oceania_total = $row->total . ' ';
			$asia_oceania_percentage = ($asia_oceania_total / $totalentries ) * 100 . '%';
			$asia_oceania_clean = round($asia_oceania_percentage, 0) . '% ';
			$asia_oceania_number = round($asia_oceania_percentage, 0);
		}

		// Get all regions

		function mobileRegions() {
			global $wpdb;

			$sqlregions = 'SELECT region, COUNT(*) as total FROM wp_territory_voting GROUP BY region ORDER BY COUNT(*) DESC';
			
			$sqltotal = "SELECT region, COUNT(*) as mySum FROM wp_territory_voting";
			$resulttotal = $wpdb->get_results($sqltotal) or die(mysql_error());

			$result = $wpdb->get_results($sqlregions) or die(mysql_error());

			foreach	( $resulttotal as $row ) {
				$totalentries = $row->mySum;
			}

			foreach( $result as $row ) {

				$region = $row->region . '';
				$total = $row->total . '';
				$percentage = ($total / $totalentries ) * 100 . '%';
				$percentagenumber = round($percentage, 1);
				$percentagerounded = round($percentage, 1) . '% ';
				
				echo '<div name="'.$region.'" id="'.$region.'" class="vote-btn mobile-vote '.$region.'"><div class="bar-holder"><div class="bar-graph bar-graph-' .$percentagenumber. '"></div></div><h3>Vote for ' . $region . '</h3><h3 class="right">' .$percentagerounded. '</h3></div>';
			}
		}
?>

      	<section class="mobile-results">
      		<div class="container">
      			<?php echo mobileRegions(); ?>
      		</div>
      	</section>
      	<section class="article-map">
      		<div class="world-container">
      			<div class="world-inner-container">
	      			<div class="country vote-btn north-america" id="north-america" name="North America">
	      				<img src="<?php echo get_bloginfo('template_url') ?>/images/vote/north-america.svg">
	      				<div class="percentage-marker percentage-<?php echo $north_america_number ?>">
	      					<h3><?php echo $north_america_clean ?></h3>
	      				</div>
	      				<div class="fake-btn">Vote North America</div>
	      			</div>
	      			<div class="country vote-btn south-america" id="south-america" name="South America">
	      				<img src="<?php echo get_bloginfo('template_url') ?>/images/vote/south-america.svg">
	      				<div class="percentage-marker percentage-<?php echo $south_america_number ?>">
	      					<h3><?php echo $south_america_clean; ?></h3>
	      				</div>
	      				<div class="fake-btn">Vote South America</div>
	      			</div>
	      			<div class="country vote-btn europe" id="europe" name="Europe">
	      				<img src="<?php echo get_bloginfo('template_url') ?>/images/vote/europe.svg">
	      				<div class="percentage-marker percentage-<?php echo $europe_number ?>">
	      					<h3><?php echo $europe_clean ?></h3>
	      				</div>
	      				<div class="fake-btn">Vote Europe</div>
	      			</div>
	      			<div class="country vote-btn asia-oceania" id="asia-oceania" name="Asia &amp; Oceania">
	      				<img src="<?php echo get_bloginfo('template_url') ?>/images/vote/asia-oceania.svg">
	      				<div class="percentage-marker percentage-<?php echo $asia_oceania_number ?>">
	      					<h3><?php echo $asia_oceania_clean ?></h3>
	      				</div>
	      				<div class="fake-btn">Vote Asia &amp; Oceania</div>
	      			</div>
	      			<div class="country vote-btn africa" name="Africa" id="africa">
	      				<img src="<?php echo get_bloginfo('template_url') ?>/images/vote/africa.svg">
	      				<div class="percentage-marker percentage-<?php echo $africa_number ?>">
	      					<h3><?php echo $africa_clean ?></h3>
	      				</div>
	      				<div class="fake-btn">Vote Africa</div>
	      			</div>
	      		</div>
      		</div>
      	</section>
      	<section class="form">
      		<div class="form-container vote-form">
      				<div class="form-header">
      					<h3></h3>
      				</div>
			        <form id="rae-vote" action="<?php echo get_site_url(); ?>/wp-content/plugins/rae-voting/vote-form-submit.php" method="post">
			        	<?php
						if(isset($_GET['refer'])){ //Checks for refer code
							?><input type="hidden" value="<?php echo $_GET['refer'];?>" id="refer" name="refer">
						<?php
							}
						?>
						<fieldset class="half">
							<label>First Name</label>
				        	<input name="firstname" id="firstName" placeholder="Run" type="text">
			        	</fieldset>
			        	<fieldset class="half">
				        	<label>Last Name</label>
				        	<input name="lastname" placeholder="Weasley" id="lastName" type="text">
				        </fieldset>
			        	<label>Email</label>
			        	<input name="email" id="email" placeholder="r.weasley@gryfrundor.com" type="email">
			        	<select name="region" id="region">
			        	<option disabled selected value>Select an region...</option>
						  <option value="north-america">North America</option>
						  <option value="south-america">South America</option>
						  <option value="europe">Europe</option>
						  <option value="asia-oceania">Asia &amp; Oceania</option>
						  <option value="africa">Africa</option>
						</select>
						<label>Device</label>
						<select name="device" id="device">
						  <option disabled selected value>Select a device...</option>
						  <option value="Android">Android</option>
						  <option value="Windows">Windows</option>
						  <option value="iOS">iOS</option>
						</select>
						<label>Country</label>
			        	<select name="country" id="country">
			        	  <option disabled selected value>Select an option...</option>
						</select>
						<input type="submit" 
			      name="submit" value="Vote For Pedro">
			        </form>
      			</div>
      			<div class="form-container success">
      				<div class="form-header">
      					<h3></h3>
      				</div>
      				<div class="form-body">
      					<h4>Share and win!</h4>
      					<p class="large">Share using your unique URL and get a chance to win an Amazon voucher every week.</p>
      					<input id="referral-box" type="text" value="<?php echo get_site_url(); ?>/vote?ref=">
      					<a class="share-btn facebook-btn">Share URL On Facebook</a>
      					<a class="share-btn twitter-btn">Share URL on Twitter</a>
      					<a class="share-btn email-btn">Email URL</a>
      				</div>
      			</div>
      			<div class="form-container about-rae">
      			<div class="videoWrapper">
      			<iframe width="560" height="315" src=" 
https://www.youtube.com/embed/vwq9u1JjX0c?" frameborder="0" 
allowfullscreen></iframe>
					</div>
      				<div class="form-body">
      					<h4>Run An Empire</h4>
      					<h2>A Real World Strategy Running Game.</h2>
      					<p class="large">Race against others to control the most territory in your local environment.</p>
      					<ul>
	      					<li><a class="button" href="">View Site</a></li>
	      					<li class="twitter"><a target="_blank" href="https://twitter.com/runanempire"></a></li>
	  						<li class="facebook"><a target="_blank" href="https://www.facebook.com/RunAnEmpire/"></a></li>
  						</ul>
      				</div>
      			</div>
      			<div class="form-container about-rae">
      			<div class="videoWrapper">
      			<iframe width="560" height="315" src=" 
https://www.youtube.com/embed/vwq9u1JjX0c?" frameborder="0" 
allowfullscreen></iframe>
					</div>
      				<div class="form-body">
      					<h4>Run An Empire</h4>
      					<h2>A Real World Strategy Running Game.</h2>
      					<p class="large">Race against others to control the most territory in your local environment.</p>
      					<ul>
	      					<li><a class="button" href="">View Site</a></li>
	      					<li class="twitter"><a target="_blank" href="https://twitter.com/runanempire"></a></li>
	  						<li class="facebook"><a target="_blank" href="https://www.facebook.com/RunAnEmpire/"></a></li>
  						</ul>
      				</div>
      			</div>
      			<div class="form-container about-vote">
      				<div class="form-body">
      					<h4>Run An Empire</h4>
      					<p class="large">From 6th February 2017, we are opening the floor to you to help us decide where to launch Run an Empire next.</p>
      					<p>Vote for your chosen area (you don’t have to live there) by clicking the vote button and filling out the form. </p>
      					<p>We’ll ask you to specify a country, but the vote counts for the overall area.This page shows how each area is stacking up. At the end of the competition, we’ll announce the winner and let you know what’s to come.</p>
      				</div>
      			</div>
      	</section>