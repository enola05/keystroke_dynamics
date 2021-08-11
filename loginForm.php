<!DOCTYPE html>
<!--html lang="en" dir="ltr" >
<head>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1" >
    <title>Person Identification -  Login!</title>
    <link rel="stylesheet" href="loginPage.css">

</head>
<body>

<h2>Login Process </h2>
<p id="instructions">Please fill below fields . It is to <span>identify 'YOU' as 'YOU'!</span></p>
<hr>


<form class="login_form" action="loginForm.php" method="POST">
    <h3>Login form</h3>
    <label for="login_email" class = "label-text">E-mail id:<br><input type="email" name="login_email" id="login_email" value="" required></label>
    <label for="login_password" class="label-text">Enter Password:<br><input type="password" name="login_password" id="login_password" value="" required></label>
    <div class="label-text">
        <input type="submit" name="submit" value="Submit" id="log_submit">
        <input type="reset" name="reset" value="Clear">
    </div>
    <p id="login_error_message"></p>
</form>
<hr>
</body>
</html-->

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="loginPage.css">
    <title> CSS Login Screen Tutorial </title>
</head>
<body>
<body>
<div class="login-page">
    <div class="form">
        <div class="login">
            <div class="login-header">
                <h3>Sign In</h3>
                <p>Please enter your credentials to login.</p>
            </div>
        </div>
        <form class="login-form" action="loginForm.php" method="POST">
            <input type="email" name="login_email" id="login_email" placeholder="email"/>
            <input type="password" name="login_password" id="login_password" placeholder="password"/>
            <button type="submit" name="submit" value="Submit" id="log_submit">login</button>
            <p class="message">Not registered? <a href="register.php">Create an account</a></p>
            <p id="login_error_message"></p>
        </form>
    </div>
</div>
</body>
</body>
</html>


<?php

if(isset($_POST['submit'])) {
    session_start();

    $conn = mysqli_connect("localhost", "root", "") or die(mysqli_error()); //Connect to server
    mysqli_select_db($conn, "keystrokee") or die("Cannot connect to database"); //Connect to database

    $username = $_POST['login_email'];
    $password = $_POST['login_password'];

    $query = mysqli_query($conn, "SELECT * from users WHERE email='$username'"); //Query the users table if there are matching rows equal to $username
    $exists = mysqli_num_rows($query); //Checks if username exists
    $table_users = "";
    $table_password = "";
    $bool = True;
    if ($exists > 0) //IF there are no returning rows or no existing username
    {
        while ($row = mysqli_fetch_assoc($query)) //display all rows from query
        {
            $table_users = $row['email']; // the first username row is passed on to $table_users, and so on until the query is finished
            $table_password = $row['password'];
            $done = $row['done'];
            $bool = false;
// the first password row is passed on to $table_users, and so on until the query is finished

        }

        //   Print $username.$password. $table_users.$table_password;

        if (($username == $table_users) && ($password == $table_password)) // checks if there are any matching fields
        {
            // Print 'Hello';
            session_start();
            $_SESSION['user'] = $username;
            $_SESSION['password'] = $password;//set the username in a session. This serves as a global variable
            print '<script>alert("logged in Successfully!!");</script>';
            print '<script>window.location.assign("login_keystroke.php");</script>';
        } else {
            session_destroy();
            print '<script>console.log("logged inot Successfully!!");</script>';
            print '<script>
        var error = document.querySelector("#login_error_message");
        error.innerHTML = "Incorrect Password!!!";
        error.style.color = "#00e676";</script>'; //Prompts the user
            // redirects to login.php
        }

    }
    else
    {
        print '<script>
        var error = document.querySelector("#login_error_message");
        error.innerHTML = "We do not know you!!!!!";
        error.style.color = "#00e676";</script>';
    }
}
?>
