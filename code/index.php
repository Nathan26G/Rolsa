<?php
session_start();
?>
<html>

<head>
    <title>Rolsa Technologies</title>
    <link href="bulma.css" rel="stylesheet">
    <link href="home.css" rel="stylesheet">
</head>

<body>
    <?php require 'include\navbar.php'; ?>
    <section class="hero is-large">
        <div class="hero-body" id="slogan">
            <p class="title">Rolsa Technologies</p>
            <p class="subtitle"><b>Helping make your life greener</b></p>
            <img src="images/RolsaLogo.png" alt="Logo" width="500px">
        </div>
    </section>
    <section class="hero is-link">
        <div class="hero-body" id="info">
            <div class="container has-text-centered">
                <h4 class="subtitle is-medium">
                    <u><b>About the company and this website</b></u>
                    <br><br>
                    Rolsa technologies is a green technology company in the Newcastle/Gateshead area, we provide multiple types of
                    services including solar panel installation/maintenance, installing electric vehicle charging stations and
                    managing smart home energy. 
                    <br><br>We wish to inform you all about green energy and green energy sources/devices, what types there
                    are, how it benefits you, how it benefits the planet and how <b>You</b> can get involved and book an appointment with us.
                </h4>
            </div>
        </div>
    </section>
</body>

</html>