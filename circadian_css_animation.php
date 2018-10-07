<?php
	// ============================================================================
	// Config section
	// Set up whatever values you want for the circadian animation
	// ============================================================================

	// Time zone used to do day/night calculations
	$targetTimezone = 'America/Los_Angeles';

	// Coordinates used to retrieve circadian cycle information (Lat, Long)
	$targetCoordinates = [44.5, -123.2];
	
	// Background colors to use at corresponding points of the day/night cycle
	// any valid css color string will work here, hex or rgba.
	$bgColors = 
		[
			'astronomical_twilight_begin' => 'rgba(39, 50, 79, 1)',
			'nautical_twilight_begin' => 'rgba(58, 79, 110, 1)',
			'civil_twilight_begin' =>'rgba(246, 156, 238, 1)',
			'civil_twilight_begin' => 'rgba(246, 156, 238, 1)',
			'sunrise' =>'rgba(248, 235, 181, 1)',
			'transit' => 'rgba(32, 36, 10, 1)',
			'sunset' => 'rgba(255, 202, 123, 1)',
			'civil_twilight_end' => 'rgba(56, 93, 148, 1)',
			'nautical_twilight_end' => 'rgba(36, 67, 94, 1)',	
			'astronomical_twilight_end' => 'rgba(5, 18, 50, 1)'
		];
		
	// Text colors to use at corresponding points of the day/night cycle
	// any valid css color string will work here, hex or rgba.
	$textColors = 
		[
			'astronomical_twilight_begin' => '#f7ca83',
			'nautical_twilight_begin' => '#f7ca83',
			'civil_twilight_begin' => '#946ed2',
			'sunrise' => '#e28336',
			'transit' => '#c0ae68',
			'sunset' => '#dd3805',
			'civil_twilight_end' => '#f9e287',
			'nautical_twilight_end' => '#f7c283',
			'astronomical_twilight_end' => '#f7ca83'
		];
	
	// Optional: load a random pic from different sets corresponding to times of day
	$dayPics =
		[
			'day1.png',
			'day2.png',
			'day3.png',
			'day4.png',
			'day5.png',
			'day6.png'
		];
	
	
	$sunsetPics =
		[
			'sunset1.png',
			'sunset2.png',
			'sunset3.png',
			'sunset4.png'		
		];
	
	$sunrisePics =
		[
			'dawn1.png',
			'dawn2.png',		
		];
		
	$nightPics =
		[
			'night1.png',
			'night2.png',
			'night3.png',		
		];
		
	// ============================================================================
	// Fetch and set up circadian information
	// This section sets up the $sun variable for use throughout your page
	// ============================================================================
	
	// set UTC times returned to our local time for easy calculations
	date_default_timezone_set($targetTimezone);

	// the timestamp today at 00:00:00 
	$zeroSecondTs = mktime(0,0,0);

	// the timestamp right now 
	$nowSecond = time();

	// number of seconds into this day since 00:00:00 
	$daySoFarSecond = (int)($nowSecond - $zeroSecondTs);
	
	// fetch circadian info 
	$sun = date_sun_info ( $zeroSecondTs , $targetCoordinates[0], $targetCoordinates[1] );

	// sort sun info by earliest day cycle marker to latest.
	asort($sun);
	
	
	// ============================================================================
	// Optional:
	// Select a random picture from different time-of-day sets
	// selected choice is loaded into $headerImageName for use in your page
	// ============================================================================
		
	// default to the daytime set
	$activePicSet = $dayPics;
	
	switch($nowSecond){
		case $nowSecond >= $sun['civil_twilight_end']:
				//NIGHT TIME
				$activePicSet = $nightPics;
			break;
	
		case $nowSecond <= $sun['sunrise']:
				//DAWN
				$activePicSet = $sunrisePics;
			break;
		
		case $nowSecond > $sun['sunset'] 
			&& 
			$nowSecond < $sun['civil_twilight_end'] :
				//SUNSET
				$activePicSet = $sunsetPics;
			break;	
			
		case $nowSecond > $sun['sunrise'] 
			&& 
			$nowSecond < $sun['sunset'] :
		default:
				//DAY
				$activePicSet = $dayPics;
			break;
	}
	
	// choose at random from the active pic set
	$headerImageName = $activePicSet[array_rand($activePicSet)];
		
		
?>
<!-- build animation keyframes based on % during the day at which different circadian points occur -->
<style type="text/css">
	@keyframes color-animation {
		/* 
			the colors at 
			"midnight"
		*/
		0%, 100% {
			background: rgba(0, 7, 22, 1);
			color: #f7ca83;
		}
		
		<?php
			foreach($sun as $k => $v){
				$momentSeconds = $v - $zeroSecondTs;
				$dayPercent = (int)($momentSeconds / 864);
		?>
				/* The color during <?= $k; ?> */
			    <?= $dayPercent ?>% {
			       background: <?= $bgColors[$k] ?>;
			       color: <?= $textColors[$k] ?>;
			    }
		<?php
			}//end foreach sun cycle data point
		?>
	}

	body{
		/* animate the backrground in a 24 hour cycle */
		animation: color-animation 86400s linear -<?= $daySoFarSecond; ?>s infinite normal;
	}

	<?php
		/* 
			define whatever link behavior you want. in this case we match the links to the body text styles to accomodate the color change, but you could define a secondary color palette for link colors in the config section above.
		*/
	?>
	a, a:visited, a:active{
		animation: color-animation 86400s linear -<?= $daySoFarSecond; ?>s infinite normal;
	}
</style>