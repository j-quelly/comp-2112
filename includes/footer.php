</main>
<script id="daily-template" type="text/template">
    <div class="xl-12">
        <h2 class="location"><?php echo $daily['name']; ?>, <?php echo $daily['sys']['country']; ?></h2>
        <img class="flag" />
    </div>
    <div class="xl-2 s-12 m-6 no-padding-top h140 text-center">
        <h3 class="description"></h3>
        <img class="icon" />
    </div>
    <div class="xl-2 s-12 m-6 no-padding-top h140 text-center">
        <h5>Current</h5>
        <h5 class="temp"></h5>
    </div>
    <div class="xl-2 s-6 m-3 text-center">
        <h5>Low</h5>
        <h5 class="min-temp"></h5>
    </div>
    <div class="xl-2 s-6 m-3 text-center">
        <h5>High</h5>
        <h5 class="max-temp"></h5>
    </div>
    <div class="xl-2 s-6 m-3 text-center">
        <h5>Humidity</h5>
        <h5 class="humidity"></h5>
    </div>
    <div class="xl-2 s-6 m-3 text-center">
        <h5>Wind</h5>
        <h5 class="wind"></h5>
    </div>
    <div class="clear"></div>
</script>
<script id="forecast-template" type="text/template">
    <div class="xl-2 s-6 m-4 text-center">
        <div class="card">
            <ul>
                <li class="day"></li>
                <li class="month"></li>
                <li><img class="card-icon" /></li>
                <li class="desc"></li>
                <li class="temp"></li>
                <li class="min-temp"></li>
                <li class="max-temp"></li>
                <li class="humidity"></li>
                <li class="wind"></li>
            </ul>
        </div>
    </div>
</script>
<script id="error-template" type="text/template">
    <div class="xl-12">
        <div class="alert alert-warning">
            <p><strong>Oops!</strong> Query returned no results, simplify your term and <a href="/">try again</a>.</p>
        </div>
    </div>
</script>
<!-- <script src="js/main2.js"></script> -->
</body>

</html>
