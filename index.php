<?php
/*print_r($_SERVER);
die;*/
/**** Bootstrap ****/

// We stored some parameters in Config.php.
require_once 'assets/config.php';

// Include database Class
require_once 'assets/classes/database.php';

// Call Connect to DB method.
$db = database::connect();

// We need Sessions for login operations.
session_start();

// General class operations like show and store flush messages.
require_once 'assets/classes/general.php';

// Init value for Message variable. By Default we haven`t any Message.
if( empty( $_SESSION['message'] ) ) {
    $_SESSION['message'] = '';
    //$redirect = false;
}

// We should check user activity to prevent operations when user does't have activity more than a specific time.
require_once 'assets/classes/user.php';

// This method checks user activity
user::checkLoginStatus();

// Decide Which operation should run?!
$op = null;
if ( isset( $_GET['op'] ) ) {
    $op = $_GET['op'];
}

if( $op ) {
    include_once 'assets/logics/'.$op.'.php';
}
// if operation isn`t specific then run default logic
else {
    include_once 'assets/logics/index.php';
}


// Include templates
include_once 'assets/templates/header.php';

// Include template by operation. we have dedicated template for each operation.
if( $op ) {
    include_once 'assets/templates/'.$op.'.php';
}
else {
    include_once 'assets/templates/index.php';
}
include_once 'assets/templates/footer.php';
