<?php

$title = 'Register';

if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {

    if( ($use_https && $_SERVER['REQUEST_SCHEME'] == 'https') || !$use_https  ) {

        $query = "SELECT * FROM `users` WHERE `username` = '$_POST[username]'";
        $result = mysqli_query($db, $query);
        if( mysqli_num_rows($result) ) {
            general::setMessage('Another user registered with this Username. Please Enter new One.');
        }

        $query = "SELECT * FROM `users` WHERE `email` = '$_POST[email]'";
        $result = mysqli_query($db, $query);
        if( mysqli_num_rows($result) ) {
            general::setMessage('This Email Registered Later.');
        }

        user::register();
    }
    else {
        general::setMessage('To Register new user you must use https protocol.');
    }

}
