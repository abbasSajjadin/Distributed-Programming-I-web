<!doctype html>
<html>
<head>

<meta charset="utf-8">

<title><?php echo $title; ?></title>
<link href='https://fonts.googleapis.com/css?family=Alegreya Sans SC' rel='stylesheet'>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="assets/templates/style/style.css">

<script src="assets/templates/js/jquery.js"></script>
<script src="assets/templates/js/script.js"></script>

</head>

<body>
<!-- Start Top Shell -->
<div class="logoHolder">
    <div class="logoleft">
        Booking Appointments
    </div>
    <div class="logoleft rightSide">
        <div class="topMenuHalf">
            <?php if( !user::isLoggedIn() ): ?>
            <li class="topMenuHalf-Left">
                <a name="member" href="#dialog">Log in</a>
            </li>
            <?php else: ?>
                <span>Wellcome <?php echo $_SESSION['login']['first_name'].' '.$_SESSION['login']['last_name']; ?></span>
            <?php endif; ?>
        </div>

        <div id="boxes">
            <div id="dialog" class="window">
                <form id="login-form" method="post" action="index.php?op=login">
                    <h1 class="newItem">Login</h1>
                    <div class="labelName">
                        <label class="labelDesign">Username</label>
                        <div class="nameInner ">
                            <input class="userName" type="text" name="username" required placeholder="Username..."/>
                        </div>
                    </div>
                    <!--end1-->
                    <div class="labelName">
                        <label class="labelDesign extera" id="exteraLog">Password</label>
                        <div class="nameInner">
                            <input id="popupLonginMail" type="password" name="password" required placeholder="Password..."/>
                        </div>
                    </div>
                    <div class="clear"></div>
                    <div class="btLogHolder">
                        <a href="index.php?op=registration">Rgister</a>
                        <input  id="btlogin" type="submit" name="submit" value="Enter" />
                        <input id="btloginOut" class="close" type="submit" name="button" value="Exit" />
                    </div>
                </form>
            </div>

            <div id="bgCover"></div>
        </div>

    </div>
</div>
<?php
    include_once 'menu.php';
?>