<?php 
    $index = true;
    include "includes/head.php"
?>
    <section class="container" id="search-container">
        <div class="xl-12" id="question">
            <h2>What's your city?</h2>
        </div>
        <form action="results.php" method="post" id="search-form">
            <div class="xl-12">
                <input type="text" name="q" id="q" placeholder="Barrie, Ontario, Canada" required>
            </div>
            <div class="xl-12 text-right">
                <input type="submit" value="See Results">
            </div>
        </form>
    </section>
    <div class="container" id="search-results">
        <!-- content goes here -->
    </div>
    <?php include "includes/footer.php" ?>
