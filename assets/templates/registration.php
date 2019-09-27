<!-- Start membership -->
<div class="main">
    <div class="mainHolder">
        <div class="membershipMain">
            <h2 id="app-message">
                <?php
                    echo general::getMessage();
                ?>
            </h2>
            <form class="membershipHolder" method="post">
                <h1 class="newItem">Membership</h1>
                <div class="inputHolder">
                    <label class="LMember">Username</label>
                    <div class="memInner">
                        <input type="text" name="username" maxlength="30" id="username" required placeholder="Insert your First Name..."/>
                    </div>
                </div>
                <div class="inputHolder">
                    <label class="LMember">First Name</label>
                    <div class="memInner">
                        <input type="text" name="firstname" maxlength="30" required placeholder="Insert your Last Name..."/>
                    </div>
                </div>
                <div class="inputHolder">
                    <label class="LMember">Last Name</label>
                    <div class="memInner">
                        <input type="text" name="lastname" maxlength="30" required placeholder="Insert your Address..."/>
                    </div>
                </div>
                <div class="inputHolder">
                    <label class="LMember">E-Mail</label>
                    <div class="memInner">
                        <input type="email" name="email" maxlength="30" id="email" required placeholder="Insert your E-Mail..."/>
                    </div>
                </div>
                <div class="inputHolder">
                    <label class="LMember">Password</label>
                    <div class="memInner">
                        <input type="password" id="password" name="password" maxlength="30" required placeholder="Insert your Password..."/>
                    </div>
                </div>
                <div class="inputHolder">
                    <label class="LMember">Confirm Password</label>
                    <div class="memInner">
                        <input type="password" id="cpassword" name="confPassword" maxlength="30" required placeholder="Insert your Password..."/>
                    </div>
                </div>
                <div class="inputHolder">
                    <div class="sendBotton">
                        <input id="memReg" type="submit" name="submit" value="Submit" />
                    </div>
                </div>
                <div id="form-warning">

                </div>
            </form>
        </div>
    </div>
</div>
<!-- End membership -->
<script>

    $('#username').keydown(function(event){
        if (event.keyCode == 32) {
            return false;
        }
    });

    $('form.membershipHolder input').click(function(){

        $('#form-warning').text('');

    });

    $('form.membershipHolder').submit(function(){

        // Check Password contains at least one char and one number
        var number_pattern = /\d{1}/;
        var char_pattern = /[A-Z]{1}/i;

        var password = $('#password').val();

        if( password.match(number_pattern) == null ) {
            $('#form-warning').text('Password must contain at least one Numeric Character.');
            return false;
        }

        if( password.match(char_pattern) == null ) {
            $('#form-warning').text('Password must contain at least one Alphabetic Character.');
            return false;
        }


        // Check Password and Confirm
        if( $('#password').val() != $('#cpassword').val() ){

            $('#form-warning').text('Password and Confirm are not match!');
            return false;
        }

    });

</script>
