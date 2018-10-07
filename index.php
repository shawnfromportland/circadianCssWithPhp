<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="UTF-8">
		
		<link rel="stylesheet"  
			href="css.css" />
			
		<link href="https://fonts.googleapis.com/css?family=Alegreya:400,700" 
			rel="stylesheet">
		
		<title>
			Circadian CSS with PHP - by @shawnfromportland
		</title>
		
		<?php
			/* 
				Configure the configuration section 
				of circadian_css_animation.php
				to match your own needs
			*/
			require('circadian_css_animation.php');
		?>
	</head>
	
	<body>
		<!-- 
			Load a header image that corresponds 
			to the current time of day (relative 
			to the target timezone set in 
			circadian_css_animation.php config section 
		-->
		<img src="headerpics/<?= $headerImageName; ?>" alt="<?= $headerImageName; ?>" id="mainpic" class="center"/>
		<h1 class="center">
			Circadian CSS<br />with PHP
		</h1>
		<h2 class="name">
			by <a href="https://github.com/shawnfromportland" target="_blank" class="nounderline">shawnfromportland</a>
		</h2>
		
		<p>
			In this example page, the background color animates between colors in real-time (with no javascript) according to the timezone and color values you set up the Config section of the circadian_css_animation.php script. 
		</p>
		
		<p id="dayCycleWindow">
			This sample window shows your animation as defined in the config section of circadian_css_animation.php, cycling a 24 hour period over just 15 seconds.
		</p>
	</body>
</html>