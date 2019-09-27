<!-- Start home -->
<div class="main">
    <di class="mainHolder">
        <form class="membershipMain" action="index.php?op=appointment" method="post">
            <h2 id="app-message">
                <?php
                    echo general::getMessage();
                ?>
            </h2>
            <?php if( !user::isLoggedIn() ): ?>
            Master is wait for you. To Booking please Sign in or Sign up.
            <?php else: ?>

                <?php if( appointment::hasRequest() ): ?>
                    <h1 id="bid-value" class="text-center big-text">Total Booking Requested Times: <?php echo appointment::getTotalRequestedTime(); ?> Minutes</h1>
                    <h1 id="bid-value" class="text-center big-text">Total Booking Assigned Times: <?php echo appointment::getTotalAssignedTime(); ?> Minutes</h1>

                    <?php if( appointment::hasUserRequested() ): ?>

                        <div id="winner">
                            User Booking Requested Time: <?php echo appointment::getUserRequestedTime(); ?>
                        </div>

                        <div id="winner">
                            User Booking Assigned Time: <?php echo appointment::getUserAssignedTime(); ?>
                        </div>

                        <div id="winner">
                            <?php $time = appointment::calcUserTime(); ?>
                            You Can Visit Professor From: <?php echo $time['from'] ?> to  <?php echo $time['to'] ?>
                        </div>

                        <div id="winner">
                            <a href="index.php?op=appointment" class="cancel">Cancel My Booking</a>
                        </div>

                    <?php else: ?>

                        <div id="winner">
                            Send Your Request!
                        </div>

                    <?php endif; ?>

                <?php else: ?>
                    <h1 id="form-warning" class="text-center big-text">There is no any Booked out Appointment in system.</h1>
                <?php endif; ?>

                <div id="threshold-holder">
                    <div id="threshold-container">
                        <label>My Request Time by Minute is: </label>
                        <input type="number" name="request" class="userName" value="" required>
                        <input type="submit" id="submit" value="Request" name="submit">
                    </div>
                </div>

            <?php endif; ?>
        </form>
    </di>
</div>
<!-- End home -->
