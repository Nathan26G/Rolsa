<?php
require 'include/auth.php';
?>
<html>

<head>
    <link href="nav.css" rel="stylesheet">
</head>

<body class="has-navbar-fixed-top">
    <?php $navbarClass = isset($_SESSION['dark_mode']) && $_SESSION['dark_mode'] ? 'is-dark' : 'is-primary'; ?>
    <nav id="navbar" class="navbar is-fixed-top <?= $navbarClass ?>" role="navigation" aria-label="main navigation">

        <div class="navbar-brand">
            <a class="navbar-item" href="index.php" class='logo'>
                <img src="images/RolsaLogo.png" alt="Logo" width="100px" height="100px"
                    xmlns="http://www.w3.org/2000/svg">
            </a>
        </div>


        <div id="navbarExampleTransparentExample" class="navbar-menu">
            <?php if (isLoggedIn()): ?>
                <div class="navbar-start">
                    <a class="navbar-item" href='consulation.php'> Our Services </a>
                    <a class="navbar-item" href='booking.php'> Booking</a>
                    <a class="navbar-item" href='energy-co2.php'> Energy/CO2 Usage </a>
                    <a class="navbar-item" href='accessibility.php'> Accessibility </a>
                    </script>
                </div>
                <div class="navbar-end">
                    <a class="navbar-item" href="logout.php"> Log Out </a>
                </div>
            <?php else: ?>
                <div class="navbar-start">
                    <a class="navbar-item" href='consulation.php'> Our Services </a>
                </div>
                <div class="navbar-end">
                    <a class="navbar-item" href="login.php"> Log in </a>
                    <a class="navbar-item" href="signup.php"> Sign up </a>
                </div>
        </div>
    <?php endif; ?>
    </nav>
</body>

</html>