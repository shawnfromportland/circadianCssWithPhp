<style type="text/css">
	@keyframes color-animation {

		0%, 100% {
			background: rgba(0, 7, 22, 1);
			color: #f7ca83;
		}
		
		<?php
			foreach($sun as $k => $v){
				$momentSeconds = $v - $zeroSecondTs;
				$dayPercent = (int)($momentSeconds / 864);
		?>
				/* <?= $k; ?> */
			    <?= $dayPercent ?>% {
			       background: <?= $dayColors[$k] ?>;
			       color: <?= $textColors[$k] ?>;
			    }
		<?php
			}//end foreach sun cycle data point
		?>
	}

	body {
	   animation: color-animation 86400s linear -<?= $daySoFarSecond; ?>s infinite normal;
	   
	   
	}
	
	a, a:visited, a:active{
		animation: color-animation 86400s linear -<?= $daySoFarSecond; ?>s infinite normal;
	}
	
	a:hover{
		animation: color-animation 86400s linear -<?= $daySoFarSecond; ?>s infinite normal;
	}
</style>