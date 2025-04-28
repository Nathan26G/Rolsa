<?php
session_start();
$buttontheme = isset($_SESSION['dark_mode']) && $_SESSION['dark_mode'] ? 'button-dark' : 'button-normal';

require 'include/connToDB.php';
require 'include/url-redirect.php';

$deleted = $_SESSION['deleted'] ?? '';
unset($_SESSION['deleted']);

$CustomerID = $_SESSION['CustomerID'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['BookingID'])) {
    $_SESSION['BookingID'] = $_POST['BookingID'];
}

$bookings = [];


$conn = getDB();

$sql = "SELECT * FROM bookings WHERE CustomerID = ?";
$stmt = mysqli_prepare($conn, $sql);

if ($stmt === false) {
    error_log(mysqli_error($conn));
    $_SESSION['error'] = "An error has occurred";
    return;
} else {
    mysqli_stmt_bind_param($stmt, "i", $CustomerID);

    if (mysqli_stmt_execute($stmt)) {
        $result = mysqli_stmt_get_result($stmt);
        $bookings = mysqli_fetch_all($result, MYSQLI_ASSOC);
    }
}
?>
<html>

<head>
    <title>Current Bookings</title>
    <link href="bulma.css" rel="stylesheet">
    <link href="home.css" rel="stylesheet">
</head>

<body id="booking">
    <?php require 'include\navbar.php'; ?>
    <section class="section" id="title">
        <h1 class="title">Current Bookings</h1>
        <h2 class="subtitle">Your Current bookings:</h2>
        <br>
    </section>
    <br>
    <?php if (!empty($bookings)) { ?>
        <div id="scroll">
            <?php foreach ($bookings as $booking) { ?>
                <div class="block" id="bookings">
                    <strong>
                        <p><u><?= $booking["Service"]; ?></u></p>
                        <p><?= $booking["DateTime"]; ?></p>
                        <p><?= $booking["Address"]; ?></p>
                    </strong>
                    <form method="POST" action="delbooking.php" style="background:none;" onsubmit="return confirm('Are you sure you want to delete this booking?');">
                        <input type="hidden" name="BookingID" value="<?= $booking['BookingID']; ?>">
                        <button class="<?= $buttontheme ?>" type="submit">Delete</button>
                    </form>
                </div>
            <?php } ?>
            <h1 id="deleted"><b><?= $deleted ?></b></h1>
        </div>
    <?php } else { ?>
        <h1 class="title" id="empty">No bookings found for this customer.</h1>
    <?php } ?>
</body>

</html>