<?php 
    include "includes/functions.php";

    if ($_POST['q'] || $_GET['q']) {

        $q = ($_POST['q'] ? $_POST['q'] : $_GET['q']);

        // prepare the string for better search results
        $q = assembleQuery($q);

        // GET daily weather
        $daily = getData($q, 'daily');

        // GET forecast
        $forecast = getData($q, 'forecast');
    }

    $index = false;

    include "includes/head.php";
?>
    <div class="container">
        <?php if ($daily) { ?>
            <div class="xl-12">
                <h2><?php echo $daily['name']; ?>, <?php echo $daily['sys']['country']; ?></h2>
                <img src="http://openweathermap.org/images/flags/<?php echo strtolower($daily['sys']['country']); ?>.png" class="flag" />
            </div>
            <div class="xl-2 s-12 m-6 no-padding-top h140 text-center">
                <h3><?php echo ucfirst($daily['weather'][0]['description']); ?></h3>
                <img src="http://openweathermap.org/img/w/<?php echo $daily['weather'][0]['icon']; ?>.png" alt="<?php echo ucfirst($daily['weather'][0]['description']); ?>" class="icon" />
            </div>
            <div class="xl-2 s-12 m-6 no-padding-top h140 text-center">
                <h5>Current</h5>
                <h5 class="temp"><?php echo convertKtoC($daily['main']['temp']); ?>&deg;C</h5>
            </div>
            <div class="xl-2 s-6 m-3 text-center">
                <h5>Low</h5>
                <h5><?php echo convertKtoC($daily['main']['temp_min']); ?>&deg;C</h5>
            </div>
            <div class="xl-2 s-6 m-3 text-center">
                <h5>High</h5>
                <h5><?php echo convertKtoC($daily['main']['temp_max']); ?>&deg;C</h5>
            </div>
            <div class="xl-2 s-6 m-3 text-center">
                <h5>Humidity</h5>
                <h5><?php echo $daily['main']['humidity']; ?>%</h5>
            </div>
            <div class="xl-2 s-6 m-3 text-center">
                <h5>Wind</h5>
                <h5><?php echo $daily['wind']['speed']; ?> m/s</h5>
            </div>
            <div class="clear"></div>
            <?php } else { ?>
                <div class="xl-12">
                    <div class="alert alert-warning">
                        <p><strong>Oops!</strong> Query returned no results, simplify your term and <a href="/">try again</a>.</p>
                    </div>
                </div>
                <?php } ?>
                    <?php if ($forecast) {
                        // loop thru forecast array
                        $i = 0;
                        foreach($forecast['list'] as $key => $val) {                            
                            // skip the first iteration
                            if ($i++ < 1) continue;

                            // calculate average temp
                            $avg = ($val['temp']['min'] +  $val['temp']['max']) / 2;
                    ?>
                        <div class="xl-2 s-6 m-4 text-center">
                            <div class="card">
                                <ul>
                                    <li class="day">
                                        <?php echo gmdate("D", $val['dt']); ?>
                                    </li>
                                    <li class="month">
                                        <?php echo gmdate("M j", $val['dt']); ?>
                                    </li>
                                    <li><img src="http://openweathermap.org/img/w/<?php echo $val['weather'][0]['icon']; ?>.png" alt="<?php echo ucfirst($val['weather'][0]['description']); ?>" /></li>
                                    <li class="desc">
                                        <?php echo ucfirst($val['weather'][0]['description']); ?>
                                    </li>
                                    <li class="temp">
                                        <?php echo convertKtoC($avg); ?>&deg;C</li>
                                    <li>Low:
                                        <?php echo convertKtoC($val['temp']['min']); ?>&deg;C</li>
                                    <li>High:
                                        <?php echo convertKtoC($val['temp']['max']); ?>&deg;C</li>
                                    <li>Humidity:
                                        <?php echo $val['humidity']; ?>%</li>
                                    <li>Wind:
                                        <?php echo $val['speed']; ?> m/s</li>
                                </ul>
                            </div>
                        </div>
                        <?php } ?>
                            <?php } ?>
    </div>
    <?php include "includes/footer.php" ?>
