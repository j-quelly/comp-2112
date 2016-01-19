<?php 
	include "includes/functions.php";

	if ($_POST['q']) {

		$q = $_POST['q'];

		// explode string to refine the results
		if (strpos($q, ',') !== false) {
			$q = explode(",", $q);
			$q = $q[0];
		}

		// get data
		$json = getData($q);
	}

	include "includes/head.php" 
?>

<section class="container">    

	<?php if ($json) { ?>
		<div class="xl-12">
			<h1>Current<h1>
		</div>

		<div class="xl-12">		
			<ul>
				<li><b>Longitude:</b>  <?php echo $json['coord']['lon']; ?></li>
				<li><b>Latitude:</b>  <?php echo $json['coord']['lat']; ?></li>
				<li><b>ID:</b>  <?php echo $json['weather'][0]['id']; ?></li>
				<li><b>Main:</b>  <?php echo $json['weather'][0]['main']; ?></li>
				<li><b>Description:</b>  <?php echo $json['weather'][0]['description']; ?></li>
				<li><b>Icon:</b>  <img src="http://openweathermap.org/img/w/<?php echo $json['weather'][0]['icon']; ?>.png" /></li>
				<li><b>Base:</b>  <?php echo $json['base']; ?></li>
				<li><b>Current Temp:</b>  <?php echo covertKtoC($json['main']['temp']); ?>&deg;C</li> 
				<li><b>Pressure:</b>  <?php echo $json['main']['pressure']; ?></li>
				<li><b>Humidity:</b>  <?php echo $json['main']['humidity']; ?></li>
				<li><b>Min Temp:</b>  <?php echo covertKtoC($json['main']['temp_min']); ?>&deg;C</li> 
				<li><b>Max Temp:</b>  <?php echo covertKtoC($json['main']['temp_max']); ?>&deg;C</li> 
				<li><b>Wind speed:</b>  <?php echo $json['wind']['speed']; ?></li>
				<li><b>Wind deg:</b>  <?php echo $json['wind']['deg']; ?></li>
				<li><b>Clouds all:</b>  <?php echo $json['clouds']['all']; ?></li>
				<li><b>Clouds dt:</b> <?php echo $json['clouds']['dt']; ?></li>
				<li><b>Sys type:</b> <?php echo $json['sys']['type']; ?></li>
				<li><b>Sys id:</b> <?php echo $json['sys']['id']; ?></li>
				<li><b>Sys message:</b> <?php echo $json['sys']['message']; ?></li>
				<li><b>Sys country:</b> <img src="http://openweathermap.org/images/flags/<?php echo strtolower($json['sys']['country']); ?>.png" /></li>
				<li><b>Sys sunrise:</b> <?php echo $json['sys']['sunrise']; ?></li>
				<li><b>Sys sunset:</b> <?php echo $json['sys']['sunset']; ?></li>
				<li><b>Id:</b> <?php echo $json['id']; ?></li>
				<li><b>Name:</b>  <?php echo $json['name']; ?></li>
				<li><b>Cod:</b> <?php echo $json['cod']; ?></li>
			</ul>
		</div>
	<?php } else { ?>   
		<div class="xl-12">		                 
			<h1>Oops!</h1>
	        <div class="alert alert-warning">
	            <p><strong><?php echo $_POST['q']; ?></strong> returned no results, please try and simplify your term. <a href="/">Try again</a>.</p>
	        </div>
	    </div>                  
	<?php } ?>

	<?php if ($json) { ?>
		<div class="xl-12">
			<h2>Forecast<h2>
		</div>
	<?php } ?>
    
	<?php // print_r($json); ?>

</section>     

<?php include "includes/footer.php" ?>           