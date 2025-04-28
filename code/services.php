<?php
session_start();
?>
<html>

<head>
    <title>Our services</title>
    <link href="bulma.css" rel="stylesheet">
    <link href="home.css" rel="stylesheet">
</head>

<body id="services">
    <?php require 'include\navbar.php'; ?>
    <section class="section" id="title">
        <h1 class="title">Our services</h1>
        <h2 class="subtitle">Navigate bellow to read up on the services we provide</h2>
        <br>
    </section>
    <br>
    <nav class="nav">
        <div>
            <a href="consulation.php">Consultation</a> 
            <a href="solarpanal.php">Solar panels</a> 
            <a href="evcharging.php">Electric vehicle charging stations</a> 
            <a href="smartmeter.php">Smart meter installation</a>
        </div>
    </nav>