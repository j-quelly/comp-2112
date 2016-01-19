<?php include "includes/head.php" ?>

<section class="container">  

    <div class="xl-12">
        <h2>What's your city?</h2>
    </div>

    <form action="results.php" method="post" id="search">
        <div class="xl-12">
            <input type="text" name="q" placeholder="Barrie, Ontario, Canada" required>
        </div>
        <div class="xl-12"> 
            <input type="submit" value="Go"> 
        </div>
    </form>   

</section>     

<?php include "includes/footer.php" ?>           