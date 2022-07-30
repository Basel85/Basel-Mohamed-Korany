<?php
// check if user authenticated
if(!empty($_SESSION['user'])){
    // prevent authenticated user to show login page
    header('location:index.php');die;
}