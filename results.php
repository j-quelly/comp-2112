<?php 
	include "includes/functions.php";

	if ($_POST['q']) {

		$q = $_POST['q'];

		// prepare the query for better results
		if (strpos($q, ',') !== false) {
			$q = explode(",", $q);
			$q = str_replace(" ", "", $q[0]);
		} else if (strpos($q, ' ') !== false) {
			$q = str_replace(" ", "", $q);
		} 

		// get daily weather
		$daily = getData($q, 'daily');

		// get forecast
		$forecast = getData($q, 'forecast');
	}
?>

<!doctype html>
<html lang="en" id="results">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>Weatherly</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
        <meta name="robots" content="noindex, nofollow" /> 

        <link rel="stylesheet" href="/css/styles.css">         
    </head>
    <body>
    
        <header>
            <div class="xl-6 s-8">
                <h1>
                    <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                         viewBox="246 -246 612 612" style="enable-background:new 246 -246 612 612;" xml:space="preserve">
                    <g>
                        <g id="Sun">
                            <g>
                                <path d="M350.9,60c0-14.5-11.8-26.2-26.2-26.2h-52.5C257.8,33.8,246,45.5,246,60c0,14.5,11.8,26.2,26.2,26.2h52.5
                                    C339.2,86.2,350.9,74.5,350.9,60z M377.1,208.6c-7.2,0-13.8,2.9-18.6,7.7l-35,35c-4.7,4.8-7.7,11.3-7.7,18.6
                                    c0,14.5,11.7,26.2,26.2,26.2c7.2,0,13.8-2.9,18.5-7.7l35-35c4.8-4.7,7.7-11.3,7.7-18.5C403.4,220.4,391.6,208.6,377.1,208.6z
                                     M552-141.1c14.5,0,26.2-11.8,26.2-26.2v-52.5c0-14.5-11.7-26.2-26.2-26.2s-26.2,11.8-26.2,26.2v52.5
                                    C525.8-152.8,537.5-141.1,552-141.1z M726.9-88.6c7.2,0,13.8-2.9,18.5-7.7l35-35c4.8-4.8,7.7-11.3,7.7-18.6
                                    c0-14.5-11.7-26.2-26.2-26.2c-7.2,0-13.8,2.9-18.6,7.7l-35,35c-4.7,4.7-7.7,11.3-7.7,18.5C700.6-100.4,712.4-88.6,726.9-88.6z
                                     M358.6-96.3c4.8,4.7,11.3,7.7,18.6,7.7c14.5,0,26.2-11.8,26.2-26.2c0-7.2-2.9-13.8-7.7-18.6l-35-35c-4.8-4.7-11.3-7.7-18.6-7.7
                                    c-14.5,0-26.2,11.8-26.2,26.2c0,7.2,2.9,13.8,7.7,18.5L358.6-96.3z M831.8,33.8h-52.5c-14.5,0-26.2,11.8-26.2,26.2
                                    s11.8,26.2,26.2,26.2h52.5c14.5,0,26.2-11.8,26.2-26.2C858,45.5,846.2,33.8,831.8,33.8z M745.4,216.3c-4.8-4.7-11.3-7.7-18.6-7.7
                                    c-14.5,0-26.2,11.8-26.2,26.2c0,7.2,2.9,13.8,7.7,18.5l35,35c4.8,4.8,11.3,7.7,18.6,7.7c14.5,0,26.2-11.8,26.2-26.2
                                    c0-7.2-2.9-13.8-7.7-18.6L745.4,216.3z M552,261.1c-14.5,0-26.2,11.8-26.2,26.2v52.5c0,14.5,11.7,26.2,26.2,26.2
                                    s26.2-11.8,26.2-26.2v-52.5C578.2,272.8,566.5,261.1,552,261.1z M552-123.6c-101.2,0-183.6,82.4-183.6,183.6
                                    S450.8,243.6,552,243.6S735.6,161.2,735.6,60S653.2-123.6,552-123.6z M552,191.1c-72.3,0-131.1-58.8-131.1-131.1
                                    c0-72.3,58.8-131.1,131.1-131.1S683.1-12.3,683.1,60S624.3,191.1,552,191.1z"/>
                            </g>
                        </g>
                    </g>
                    </svg>                  
                    Weatherly
                </h1>
            </div>
            <div class="xl-6 s-4">
            	<a href="/" class="btn right">Back</a>
            </div>  
        </header> 
    
        
        <main>
            <section class="container"> 
							<?php if ($daily) { ?>
	                <div class="xl-12">
	                    <h2><?php echo $daily['name']; ?>, <?php echo $daily['sys']['country']; ?></h2>
	                    <img src="http://openweathermap.org/images/flags/<?php echo strtolower($daily['sys']['country']); ?>.png" class="flag" />
	                </div>
	                <div class="xl-12 no-padding-bottom">
										<h3><?php echo ucfirst($daily['weather'][0]['description']); ?></h3>
	                </div>
	                <div class="xl-2 s-6 no-padding-top text-center">
											<img src="http://openweathermap.org/img/w/<?php echo $daily['weather'][0]['icon']; ?>.png" alt="<?php echo ucfirst($daily['weather'][0]['description']); ?>"  class="icon" />
	                </div>
	                <div class="xl-2 s-6 no-padding-top">
										<h5>Current</h5>
										<h5 class="temp"><?php echo convertKtoC($daily['main']['temp']); ?>&deg;C</h5>												
	                </div>
	                <div class="xl-2 s-6 text-center">
										<h5>Max Temp</h5>
										<h5><?php echo convertKtoC($daily['main']['temp_max']); ?>&deg;C</h5>												
	                </div>
	                <div class="xl-2 s-6 text-center">
										<h5>Min Temp</h5>
										<h5><?php echo convertKtoC($daily['main']['temp_min']); ?>&deg;C</h5>												
	                </div>
	                <div class="xl-2 s-6 text-center">
										<h5>Humidity</h5>
										<h5><?php echo $daily['main']['humidity']; ?>%</h5>												
	                </div>
	                <div class="xl-2 s-6 text-center">
										<h5>Wind</h5>
										<h5><?php echo $daily['wind']['speed']; ?> m/s</h5>	 											
	                </div>	                	                	                	                
				<?php } else { ?>   
					<div class="xl-12">		                 
						<h1>Oops!</h1>
				        <div class="alert alert-warning">
				            <p><strong><?php echo $_POST['q']; ?></strong> returned no results, please try and simplify your term. <a href="/">Try again</a>.</p>
				        </div>
				    </div>                  
				<?php } ?>

				
				<?php if ($forecast) { ?>
					<div class="xl-12 no-padding-bottom">
						<h2>Forecast<h2>
					</div>		
					<?php
						// loop thru forecast array
						foreach($forecast['list'] as $key => $val) {	 						
							// calculate average temp
							$avg = ($val['temp']['min'] +  $val['temp']['max']) / 2;
					?>
							<div class="xl-2 text-center">
									<div class="card">
											<ul>
													<li class="day"><?php echo gmdate("D", $val['dt']); ?></li> 
													<li class="month"><?php echo gmdate("M j", $val['dt']); ?></li>
													<li><img src="http://openweathermap.org/img/w/<?php echo $val['weather'][0]['icon']; ?>.png" alt="<?php echo ucfirst($val['weather'][0]['description']); ?>"  /></li>
													<li class="desc"><?php echo ucfirst($val['weather'][0]['description']); ?></li>
													<li class="temp"><?php echo convertKtoC($avg); ?>&deg;C</li>
													<li>Min Temp: <?php echo convertKtoC($val['temp']['min']); ?>&deg;C</li>
													<li>Max Temp: <?php echo convertKtoC($val['temp']['max']); ?>&deg;C</li>
													<li>Humidity: <?php echo $val['humidity']; ?>%</li> 
													<li>Wind: <?php echo $val['speed']; ?> m/s</li>
											</ul> 
									</div>
							</div> 						
					<?php } ?>
				<?php } ?>
			</section>     

<?php include "includes/footer.php" ?>           