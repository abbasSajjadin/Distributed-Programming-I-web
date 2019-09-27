<?php

class general
{
    static public function setMessage($message) {

        global $redirect;

        $_SESSION['message'] = $message;
        $redirect = true;

        header('location: index.php');
        die;
    }

    static public function getMessage() {

        $message = $_SESSION['message'];

        if( isset($message ) ) {
            // We Delete Message after show
            unset( $_SESSION['message'] );

            // Don't redirect because we sent message.
            //$redirect = false;

            return $message;
        }

        return '';
    }
}
