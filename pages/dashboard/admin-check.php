<?php
session_start();
$admin = (isset($_SESSION['user_type']) && $_SESSION['user_type'] == 'Admin') ? true : false;
if(!$admin){ 
    session_destroy();
	header('location: https://www.flutters.ovh/pages/login/sign_in/sign_in?message=Veuillez vous connecter avec un compte admin.');
	exit;
} ?>

