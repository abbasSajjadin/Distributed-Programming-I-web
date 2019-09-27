<?php

require_once 'assets/classes/appointment.php';

if( $_SERVER['REQUEST_METHOD'] == 'POST' ) {

    $request = $_POST['request'];

    if($request > 0 && $request <= $total_time) {

        $remained_time = appointment::remainedTime();

        if($remained_time >= 0) {
            if( appointment::insertBooking($request) ) {

                $assigned_time = appointment::redistributeTimes();
                if( $assigned_time ) {
                    general::setMessage('Booking has been Successfully Done.');
                }
            }
            else {
                general::setMessage('Problem on insert Request Time.');
            }
        }
        else {
            general::setMessage('There is not enough time for Booking.');
        }

    }
    else {
        general::setMessage('Request Time is not valid. This must be greater than 0 Minute and less than '. $total_time.' Minutes');
    }

}
else {
    if( appointment::removeUserBooking() ) {

        if( appointment::redistributeTimes() ) {
            general::setMessage('Your Booking has Removed && Redistributed Successfully.');
        }
        general::setMessage('Your Booking has Removed Successfully but doesn`t Redistributed.');
    }
    else {
        general::setMessage('A problem on Remove your booking.');
    }
}
