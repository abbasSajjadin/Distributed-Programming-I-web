<!-- Start Menu -->
<nav>
    <div class="leftMenuHolder">
        <ul>
            <li><a href="index.php"><span class="fa fa-home"></span>Home</a></li>
            <?php if(!user::isLoggedIn() ): ?>
                <li><a href="index.php?op=registration"><span class="fa fa-registered"></span>Registration</a></li>
            <?php endif; ?>
            <li><a href="index.php"><span class="fa fa-phone"></span>Contact</a></li>
            <?php if(user::isLoggedIn() ): ?>
                <li><a href="index.php?op=logout"><span class="fa fa-sign-out"></span>Logout</a></li>
            <?php endif; ?>
        </ul>
    </div>
</nav>
<!-- End Menu -->