<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <?php
    $myfile = fopen("data.txt","w");
    fclose($myfile);
    ?>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1" >
    <link rel="stylesheet" href="loginPage.css">
    <title> Login keystroke </title>
    <script src="speedCheck.js" async></script>
</head>
<?php
session_start(); //starts the session
if($_SESSION['user']){ //checks if user is logged in
    print '<script>console.log("session started");</script>';
}
else{
    header("location:loginForm.php"); // redirects if user is not logged in
}
$user = $_SESSION['user']; //assigns user value
?>
<body>
<div class="login-page">
    <div class="form">
        <div class="login">
            <div class="login-header">
                <h3>Keystroke Entry</h3>
                <p>Please fill all the fields</p>
            </div>
        </div>
        <form action="keystroke_verification.php" method="post" enctype="multipart/form-data">
            <input id="textarea1"  onselectstart="return false" onpaste="return false;" onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false" autocomplete=off onkeyup="javascript:keypress('one')" name="textarea1"  placeholder="Enter your password"/>
            <input id="textarea2"  onselectstart="return false" onpaste="return false;" onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false" autocomplete=off onkeyup="javascript:keypress('two')" name="textarea2" rows="7" cols="66" placeholder="Enter your password"/>
            <input id="textarea3"  onselectstart="return false" onpaste="return false;" onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false" autocomplete=off onkeyup="javascript:keypress('three')" name="textarea3" rows="7" cols="66" placeholder="Enter your password"/>
            <input id="textarea4"  onselectstart="return false" onpaste="return false;" onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false" autocomplete=off onkeyup="javascript:keypress('four')" name="textarea4" rows="7" cols="66" placeholder="Enter your password"/>
            <input id="textarea5"  onselectstart="return false" onpaste="return false;" onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false" autocomplete=off onkeyup="javascript:keypress('five')" name="textarea5" rows="7" cols="66" placeholder="Enter your password"/>
            <input id="textarea6"  onselectstart="return false" onpaste="return false;" onCopy="return false" onCut="return false" onDrag="return false" onDrop="return false" autocomplete=off onkeyup="javascript:keypress('six')" name="textarea6" rows="7" cols="66" placeholder="Enter your password"/>

            <button type="submit" name="Submit"  id="final_submit">Final Submit</button>

            <p id="login_error_message"></p>
        </form>
    </div>
</div>




<script type="text/javascript">
    var diff = new Array(7);
    var i=new Array(7),d,x,curr=0;
    for (var k = 0; k < 7; k++) {
        diff[k] = new Array(100);
        //s[k]=new Array(100);
        i[k]=0;
    }
    function keypress (d)
    {
        //var x=document.getElementById(d);
        var evt = event || e; // for trans-browser compatibility
        var charCode = evt.which || evt.keyCode;
        d=new Date();
        curr=d.getTime();
        if(charCode==8)
        {
            alert('do not press backspace');
            window.location.href="login_keystroke.php";

        }
        else if(charCode!=9)
        {
            x+=" "+curr;
            console.log(x);
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.open("GET", "print.php?r=" + curr, true);
            xmlhttp.send();
        }
    }
</script>
</body>
</html>

