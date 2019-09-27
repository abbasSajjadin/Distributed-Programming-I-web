<?php

if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {


    if( ($use_https && $_SERVER['REQUEST_SCHEME'] == 'https') || !$use_https ) {
        user::login();
    }
    else {
        general::setMessage('To login you must use https protocol.');
    }

}