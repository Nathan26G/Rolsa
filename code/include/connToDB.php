<?php
function getDB()
{

    $db_host = "localhost";
    $db_name = "rolsadb";
    $db_user = "Rolsa_admin";
    $db_pass = "Rolsa-technologies-2025?";

    $conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

    if (mysqli_connect_error()) {
        echo mysqli_connect_error();
        exit;
    } 

    return $conn;
}