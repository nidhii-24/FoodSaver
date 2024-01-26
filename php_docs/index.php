<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>FoodSaver</title>

    <!-- Favicon, CSS & JS -->
    <link rel="icon" href="../assets/logobg.png" type="image/png" sizes="16x16">
    <link rel="stylesheet" href="../styles/common.css">
    <link rel="stylesheet" href="../styles/main.css">
    <script src="js/client.js" defer></script>

    <!-- Font Awesome icons CDN -->
    <script src="https://use.fontawesome.com/4e51920be5.js"></script>

</head>

<body onload=controlButton()>

<div id="navbar" class="navbar">
    <ul>
        <?php
        // Start or resume the session
        session_start();

        if (isset($_SESSION["username"])) {
            // User is logged in
            echo '<li><a href="signout.php">Sign Out</a></li>';
            echo '<li><a href="#">' . $_SESSION["username"] . '</a></li>';
        } else {
            // User is not logged in
            echo '<li><a href="signup.html" id="sign-in-button">SIGN IN</a></li>';
        }
        ?>
        <li><a href="#contact">CONTACT</a></li>
        <li><a href="#recipe">RECIPE</a></li>
        <li><a href="#home">HOME</a></li>
        <li><a href="register.html">REGISTER</a></li>
        <img src="../assets/logobg.png" class="navbar-logo">
    </ul>
</div>


    <!-- Heading -->
    <header class="showcase">
        <div class="content">
            <img src="../assets/logobg.png" class="logo" alt="FeedOn">
        </div>
    </header>

    <!-- Donation Form -->
    <!--<a href="donation.php" class="donation-btn center" target="_blank" id="donation-button">MAKE DONATION</a>-->
    <li><a href="donation.php" class="donation-btn center" target="_blank" id="donation-button">MAKE DONATION</a></li>

    <!-- Donation Inbox -->
    <a href="inbox.php" class="inbox-btn center" target="_blank" id="inbox-button">
        INBOX
        <span id="numOfUnread" class="badge">
        </span>
    </a>

    <!-- Tabs: Feed, Charities, Restaurants -->
    <section id="home" class="bg-light">
        <div class="container center tab">
            <button onclick="listAllMatches()">Donation Match</button>
            <button onclick="redirectToCharities()">Charities</button>
            <button onclick="redirectToRestaurants()">Restaurants</button>

    <script>
        function redirectToRestaurants() {
            // Redirect to restaurant.php
            window.location.href = 'restaurant.php';
        }
        function redirectToCharities() {
            // Redirect to restaurant.php
            window.location.href = 'charity.php';
        }
    </script>
        </div>

        <div class="data container"></div>

        <hr class="center">

    </section>

    <!-- Contact Details -->
    <section class="bg-light" id="contact">
        <div class="container center">

            <h2>Get in Touch</h2>
            <p>To find out more, just drop us a line!</p>

            <a href="tel:+999999999"><i class="fa fa-phone"></i></a>

            <a href="" target="_blank"><i class="fa fa-map-marker"></i></a>

            <a href="mailto:contact@feedon.com"><i class="fa fa-envelope"></i></a>

            <a href="https://www.linkedin.com" target="_blank"><i class="fa fa-linkedin"></i></a>

        </div>
    </section>

    <!-- Footer -->
    <footer class="center bg-dark">
        <p>FoodSaver &copy; 2023</p>
    </footer>

</body>

</html>