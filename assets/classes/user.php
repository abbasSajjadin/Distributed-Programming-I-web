<?php

class user
{
    static public function login(){

        global $db;
        $password = md5($_POST['password']);

        $query = "SELECT * FROM `users` WHERE `email` = '$_POST[username]' AND `password` = '$password'";

        $result = mysqli_query($db, $query);

        if( mysqli_num_rows($result) ) {

            $row = mysqli_fetch_assoc($result);

            $_SESSION['login']['user_id'] = $row['id'];
            $_SESSION['login']['username'] = $row['username'];
            $_SESSION['login']['email'] = $row['email'];
            $_SESSION['login']['first_name'] = $row['first_name'];
            $_SESSION['login']['last_name'] = $row['last_name'];
            $_SESSION['login']['activity'] = time();

            header('location: index.php');
            die;
        }
        else {
            general::setMessage('Username or Password is Wrong.');
        }

    }

	static public function logout()
    {
        unset($_SESSION['login']);

        header('location: index.php');
        die;
    }

    static public function checkLoginStatus()
    {
        global $delay;

        if( isset($_SESSION['login']) ) {

            $currentTime = time();

            // Check Time of Inactivity. if it is more than specific delay then logout the user.
            if( ($_SESSION['login']['activity'] + $delay) < $currentTime ) {

                self::logout();
            }

            // Save last page load time
            $_SESSION['login']['activity'] = $currentTime;
        }

    }

    static public function isLoggedIn()
    {
        if( isset($_SESSION['login']) ) {
            return true;
        }

        return false;
    }

    static public function register() {

        global $db;
        $date = time();

        $password = md5($_POST['password']);

        $query = "INSERT INTO `users` (`id`, `username`, `email`, `password`, `first_name`, `last_name`, `date`) VALUES (NULL, '$_POST[username]', '$_POST[email]', '$password', '$_POST[firstname]', '$_POST[lastname]', $date);";

        mysqli_query($db, $query);

        if( mysqli_affected_rows($db) ) {
            general::setMessage('You are Registered Successfully. Login Now.');
        }
    }
}
