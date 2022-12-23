<?php
include 'connection.php';
session_start();
$ismatch = false;
$isemail = false;
$ispwd = false;
if(isset($_POST['submit'])){
    $mail = mysqli_real_escape_string($con,$_POST['mail']);
    $pwd = mysqli_real_escape_string($con,$_POST['pwd']);

    $sql = "SELECT * FROM `usertable` WHERE `usermail` = '$mail'";
    $query = mysqli_query($con,$sql);
    $num = mysqli_num_rows($query);
    $res = mysqli_fetch_array($query);

    if(isset($query)){
        if(empty($res[2])){
            $ismatch = true;
            $isemail = true;
        }
        else{
            if($res[3] === $pwd){
                echo "login";
                session_regenerate_id();
                $_SESSION['login']=true;
                $_SESSION['email']=$res[2];
                $_SESSION['pwd']=$res[3];
                header('location:welcome.php');
            }
            else{
                $ismatch = true;
                $ispwd = true;
            }
        }
    }
}
?>
<!DOCTYPE html>
<head>
    <title>Login Page</title>
    <link rel = "stylesheet" href = "style.css?v=1">
    <link rel = "stylesheet" href="https://fonts.googleapis.com/css?family=Sofia&effect=neon">
</head>
<body>
    <h1 class = "font-effect-neon">LOGIN PAGE</h1><br>
    <div class = "login">
        <form class = "font-effect-neon" name="login" method="post" action="">
            <div>
                <label><b>Email</b></label><br>
                <input type="text" name = "mail" id = "mail" placeholder="E-mail" autocomplete="off" value="<?php if($ismatch){ echo $mail; }?>">
                <br><br>
                <div class='Login_Box_validate_box' id='Login_up_Box_email_validate'></div>
                <label><b>Password</b></label><br>
                <input type="password" name = "pwd" id = "pwd" placeholder="Password" value="<?php if($ismatch){ echo $pwd; }?>">
                <br><br>
                <?php if($isemail){
                    echo  "<p class='error'>Invalid Email or password</p>";
                }?>
                <?php if($ispwd){
                    echo  "<p class='error'>Invalid Password</p>";
                }?>
                <button disabled type="submit" name="submit" >Login</button><br><br>
            </div>
            <div id = "link">
                <a href="signup.php" style="color: white;">Create Account</a>
            </div>
        </form>
    </div>
    <script src="jquery-3.6.1.js"></script>
    <script>
         $('#mail').on({ 'input': Login_email_validate, keypress: Login_email_validate });
            function email_check(email) {
                var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                if (!regex.test(email)) {
                    return true;
                }
            }
            function Login_email_validate() {
                var email_var = $('#mail').val()

                if (email_var == '' || email_var == ' ') {
                    $('#mail').css('outline-color', 'red')
                    $('#mail').focus()
                    $('#Login_up_Box_email_validate').html('<p>*Required</p>')
                    $('#Login_up_Box_email_validate').show()
                    Login_email_status = false;
                    console.log("Null");
                }
                else {
                    if (email_check(email_var)) {
                        $('#mail').css('outline-color', 'red')
                        $('#mail').focus()
                        $('#Login_up_Box_email_validate').html('<p>*Invaild Email</p>')
                        $('#Login_up_Box_email_validate').show()
                        Login_email_status = false;
                        console.log("Not Valid Email")
                    }
                    else {
                        $('#mail').css('outline-color', 'green')
                        $('#mail').focus()
                        $('#Login_up_Box_email_validate').hide()
                        Login_email_status = true;
                        console.log("Valid Email")
                    }
                }
            }
    </script>
    <script src="javascript.js"></script>
</body>
</html>