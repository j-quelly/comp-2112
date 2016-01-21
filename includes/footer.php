</main>
<footer>
</footer>
<script id="daily-template" type="x-template">
    <div class="xl-12">
        <h2 class="location"><?php echo $daily['name']; ?>, <?php echo $daily['sys']['country']; ?></h2>
        <img class="flag" />
    </div>
    <div class="xl-12 no-padding-bottom">
        <h3 class="description"></h3>
    </div>
    <div class="xl-2 s-6 no-padding-top text-center">
        <img class="icon" />
    </div>
    <div class="xl-2 s-6 no-padding-top">
        <h5>Current</h5>
        <h5 class="temp"></h5>
    </div>
    <div class="xl-2 s-6 text-center">
        <h5>Max Temp</h5>
        <h5 class="max-temp"></h5>
    </div>
    <div class="xl-2 s-6 text-center">
        <h5>Min Temp</h5>
        <h5 class="min-temp"></h5>
    </div>
    <div class="xl-2 s-6 text-center">
        <h5>Humidity</h5>
        <h5 class="humidity"></h5>
    </div>
    <div class="xl-2 s-6 text-center">
        <h5>Wind</h5>
        <h5 class="wind"></h5>
    </div>
    <div class="clear"></div>
</script>
<script id="forecast-template" type="x-template">
    <div class="xl-2 text-center">
        <div class="card">
            <ul>
                <li class="day"></li>
                <li class="month"></li>
                <li><img class="card-icon" /></li>
                <li class="desc"></li>
                <li class="temp"></li>
                <li></li>
                <li></li>
                <li></li>
                <li></li>
            </ul>
        </div>
    </div>
</script>
<script src="js/main2.js"></script>
</body>

</html>
