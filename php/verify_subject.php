<?php
session_start();
if (isset($_SESSION['userID']) && $_SESSION['userLevel'] == 1) {

    $con = mysqli_connect('localhost', 'root', '', 'smartetuition') or die(mysqli_error($con));

    $q = "SELECT * FROM ";
}
