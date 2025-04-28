<?php 

require 'include/connToDB.php';

$conn = getDB();

if($conn){
    echo 'connection success';
} else {
    echo 'FAIL';
}