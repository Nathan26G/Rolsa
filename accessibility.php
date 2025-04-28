<?php
session_start();
if (isset($_POST['toggle_dark'])) {
    $_SESSION['dark_mode'] = !isset($_SESSION['dark_mode']) || !$_SESSION['dark_mode'];
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

$buttontheme = isset($_SESSION['dark_mode']) && $_SESSION['dark_mode'] ? 'button-dark' : 'button-normal';
?>
<html>

<head>
    <title>Accessibility</title>
    <link href="bulma.css" rel="stylesheet">
    <link href="home.css" rel="stylesheet">
</head>

<body id="Accessibility">
    <?php require 'include\navbar.php'; ?>
    <section class="section" id="title">
        <h1 class="title">Accessibility</h1>
        <h2 class="subtitle">bellow are options to make your experience with the website better for you</h2>
        <br>
    </section>
    <br>
    <div class="content is-normal">
        <h2>Options:</h2>
        <form method="post" style="background:none;">
            <label style="margin-right: 10px;" for="toggle_dark"><b>Toggle dark mode:</b></label>
            <button class="<?= $buttontheme ?>" type="submit" name="toggle_dark">Toggle</button>
        </form>
    </div>