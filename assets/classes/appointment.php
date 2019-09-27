<?php

class appointment
{
    static public function hasRequest(){

        global $db;
        $query = "SELECT * FROM `booking`";

        $result = mysqli_query($db, $query);

        // We need at least one accepted request.
        if( mysqli_num_rows($result) ) {
            return true;
        }

        return false;
    }

    static public function getTotalRequestedTime(){

        global $db;

        $query = "SELECT sum(`requested_time`) AS `total_request` FROM `booking`";

        $result = mysqli_query($db, $query);

        if( mysqli_num_rows($result) ) {

            // Find threshold that is One last till the end
            $row = mysqli_fetch_assoc($result);

            return $row['total_request'];

        }

        return false;
    }

    static public function getTotalAssignedTime(){

        global $db;

        $query = "SELECT sum(`assigned_time`) AS `total_assigned` FROM `booking`";

        $result = mysqli_query($db, $query);

        if( mysqli_num_rows($result) ) {

            // Find threshold that is One last till the end
            $row = mysqli_fetch_assoc($result);

            return $row['total_assigned'];

        }

        return false;
    }

    static public function hasUserRequested() {

        global $db;

        $user_id = $_SESSION['login']['user_id'];
        $query = "SELECT * FROM `booking` WHERE `user_id` = $user_id";

        $result = mysqli_query($db, $query);

        if( mysqli_num_rows($result) ) {
            return true;
        }

        return false;
    }

    static public function getUserRequestedTime() {

        global $db;

        $user_id = $_SESSION['login']['user_id'];
        $query = "SELECT * FROM `booking` WHERE `user_id` = $user_id";

        $result = mysqli_query($db, $query);

        if( mysqli_num_rows($result) ) {
            $row = mysqli_fetch_array($result);

            return $row['requested_time'];
        }

        return false;

    }

    static public function getUserAssignedTime() {

        global $db;

        $user_id = $_SESSION['login']['user_id'];
        $query = "SELECT * FROM `booking` WHERE `user_id` = $user_id";

        $result = mysqli_query($db, $query);

        if( mysqli_num_rows($result) ) {
            $row = mysqli_fetch_array($result);

            return $row['assigned_time'];
        }

        return false;

    }

    static public function insertBooking($time) {

        global $db;

        $user_id = $_SESSION['login']['user_id'];

        $query = "INSERT INTO `booking` (`id`, `user_id`, `requested_time`) VALUES (NULL, '$user_id', '$time')";

        mysqli_query($db, $query);

        if( mysqli_affected_rows($db) ) {
            return true;
        }

        return false;
    }

    static public function redistributeTimes() {

        global $db, $total_time;

        $user_id = $_SESSION['login']['user_id'];
        $query = "SELECT * FROM `booking` ORDER BY `id` DESC LIMIT 1";

        $result = mysqli_query($db, $query);

        $row = mysqli_fetch_assoc($result);

        // if we was have empty time and a request is added in system
        if( $row['assigned_time'] == null || $row['assigned_time'] == "" ) {

            // if sum of requests is less than $total_time
            $total_requested_time = appointment::getTotalRequestedTime();
            if( $total_requested_time <= $total_time ) {

                $query = "UPDATE `booking` SET `assigned_time` = '$row[requested_time]' WHERE id = '$row[id]'";

                if( mysqli_query($db, $query) ) {
                    return $row['requested_time'];
                }

                return false;

            }
            else {

                $query = "SELECT * FROM `booking`";

                $result = mysqli_query($db, $query);

                $num_of_requests = mysqli_num_rows($result);

                $assigned_times = array();

                for($i = 1 ; $i <= $num_of_requests; $i ++) {
                    $row = mysqli_fetch_array($result);
                    $assigned_times[] = [
                        'id' => $row['id'],
                        'assigned_time' => $row['requested_time'] / $total_requested_time * $total_time
                    ];
                }


                foreach($assigned_times as $item) {
                    $query = "UPDATE `booking` SET `assigned_time` = '$item[assigned_time]' WHERE id = '$item[id]'";
                    mysqli_query($db, $query);

                    if( !mysqli_query($db, $query) ) {
                        return false;
                    }
                }

                return true;
            }

        }
        else {

            $query = "SELECT * FROM `booking`";

            $result = mysqli_query($db, $query);

            $num_of_requests = mysqli_num_rows($result);

            for($i = 1 ; $i <= $num_of_requests; $i ++) {

                $row = mysqli_fetch_assoc($result);

                $query = "UPDATE `booking` SET `assigned_time` = '$row[requested_time]' WHERE id = '$row[id]'";

                if( !mysqli_query($db, $query) ) {
                    return false;
                }

            }

        }
    }

    static public function remainedTime() {

        global $total_time;

        return $total_time - self::getTotalAssignedTime();
    }

    static public function removeUserBooking() {

        global $db;

        $user_id = $_SESSION['login']['user_id'];

        $query = "DELETE FROM `booking` WHERE `user_id` = '$user_id'";

        if( mysqli_query($db, $query) ) {
            return true;
        }

        return false;
    }

    static public function calcUserTime() {

        global $db, $start_time;

        $user_id = $_SESSION['login']['user_id'];

        $query = "SELECT * FROM `booking`";

        $result = mysqli_query($db, $query);

        $num_of_requests = mysqli_num_rows($result);

        $user_start_time = $start_time;

        for($i = 1 ; $i <= $num_of_requests; $i ++) {

            $row = mysqli_fetch_assoc($result);

            if( $row['user_id'] == $user_id ) {
                return [
                    'from' => $user_start_time,
                    'to' => self::sumTime($user_start_time, $row['assigned_time'])
                ];
            }
            $user_start_time = self::sumTime($user_start_time, $row['assigned_time']);

        }

    }

    static public function sumTime($time, $minute) {

        $hours = floor($minute / 60);
        $minutes = ($minute % 60);

        $time = explode(":", $time);

        $time[0] = $time[0] + $hours;
        $time[1] = $time[1] + $minutes;

        return $time[0].':'.$time[1];

    }
}
