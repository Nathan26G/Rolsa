<?php
session_start();

require 'include/connToDB.php';
require 'include/url-redirect.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['BookingID'])) {
    $BookingID = $_POST['BookingID'];
    $_SESSION['BookingID'] = $BookingID;


    if (!isset($_SESSION['BookingID'])) {
        die("BookingID not set in session.");
    }

    $conn = getDB();
    $sql = "DELETE FROM bookings WHERE bookingID = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "i", $BookingID);

    if (mysqli_stmt_execute($stmt)) {
        $_SESSION['deleted'] = 'Booking deleted';
        redirect("/currentbooking.php");
        exit();
    }
};
