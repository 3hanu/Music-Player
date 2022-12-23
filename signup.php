<?php
include 'connection.php';

if(isset($_POST['submit'])){
    $username = mysqli_real_escape_string($con,$_POST['username']);
    $mail = mysqli_real_escape_string($con,$_POST['mail']);
    $pwd = mysqli_real_escape_string($con,$_POST['pwd']);

    $sql = "INSERT INTO `usertable`( `UserName`, `UserMail`, `Password`) VALUES ('$username','$mail','$pwd')";

    $query = mysqli_query($con,$sql);
    if(empty($query)){
        //echo "No Insertion";
    }
    else{
        //echo "Successful Insertion";
    }
}
?>
<!DOCTYPE html>
<head>
    <title>Signup Page</title>
    <link rel = "stylesheet" href = "style.css?v=15">
    <link rel = "stylesheet" href="https://fonts.googleapis.com/css?family=Sofia&effect=neon">
</head>
<body>
    <h1 class = "font-effect-neon">SIGNUP PAGE</h1><br>
    <div class = "login">
        <form action="" class="font-effect-neon" id="login" method="POST">
            <div>
                <label><b>Username</b></label><br>
                <input type="text" name = "username" id = "username" autocomplete="off" placeholder="Username"><br><br>
                <label><b>Email</b></label><br>
                <input type="text" name = "mail" id = "mail" autocomplete="off" placeholder="E-mail"><br><br>
                <label><b>Password</b></label><br>
                <input type="password" name = "pwd" id = "pwd" placeholder="Password"><br><br>
                <button type="submit"  disabled name="submit" id="signup" style="margin-bottom: 14px;">Signup</button><br>
            </div>
            <div id = "link">
                <a href="index.php" style="color: white;">Login Page</a>
            </div>
        </form>
    </div>
    <script>
        inputs = document.querySelectorAll('input');
        var input_arr;
        inputs.forEach(element => {
            element.addEventListener('input',function(){
            check_inputs()
        });
        });

    function check_inputs(){
        if(!inputs[0].value =="" && !inputs[1].value=="" && !inputs[2].value==""){
            document.querySelector('button').disabled = false;
        }
        else{
            document.querySelector('button').disabled = true;
        }
    }

    check_inputs();

    </script>
</body>
</html>





