
<!DOCTYPE html>
<html lang="en" dir="ltr">
<?php
session_start(); //starts the session
if($_SESSION['user']){ //checks if user is logged in
}
else{
    header("location:loginForm.php"); // redirects if user is not logged in
}
$user = $_SESSION['user']; //assigns user value
if(isset($_SESSION['str'])&& isset($_SESSION['strn'])&& isset($_SESSION['strm'])){
    $res=$_SESSION['str'];
    $resn=$_SESSION['strn'];
    $resm=$_SESSION['strm'];
}
?>
<head>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1" >
    <title>Login_identification</title>
    <link rel="stylesheet" href="identification_login.css">

</head>

<body>

    <?php
    $count=0;
    if(isset($_SESSION['str'])){
        if(strpos($res, "yes")!==false)
            $count=$count+1;
        if(strpos($resn, "yes")!==false)
            $count=$count+1;
        if(strpos($resm, "yes")!==false)
            $count=$count+1;

        //Print "The input has passed ".$count." out of three predictive algorithms";
        if(strpos($res, "yes")!==false ||( strpos($resn, "yes")!==false &&strpos($resm, "yes")!==false))
        {
            //Print "<br>It has passed the ensemble criteria!!Yippe!!";
            Print '<script>	window.location.assign("identification_login.php");</script>';
        }

        else
        {
            //Print '<script>alert("It has failed the ensemble criteria! Sorry")</script>';
            Print '<script>	window.location.assign("failed.php");</script>';


        }

    }
    else{
        Print "Enter your keystroke";
        Print '<script>	window.location.assign("login_keystroke.php");</script>';
    }
    ?>

</body>
</html>
