<?php
session_start();

$conn = mysqli_connect("localhost", "root", "") or die(mysqli_error()); //Connect to server
mysqli_select_db($conn, "keystrokee") or die("Cannot connect to database"); //Connect to database
$username=$_SESSION['user'];
$name = strstr($username, '@', true);
//$password=$_SESSION['password'];

$query = mysqli_query($conn, "SELECT * from users WHERE email='$username'"); //Query the users table if there are matching rows equal to $username
$exists = mysqli_num_rows($query); //Checks if username exists
$table_users = "";
$table_password = "";

if ($exists > 0) //IF there are no returning rows or no existing username
{
    while ($row = mysqli_fetch_assoc($query)) //display all rows from query
    {
        $table_users = $row['email']; // the first username row is passed on to $table_users, and so on until the query is finished
        $table_password = $row['password'];
        $done = $row['done'];
    }
    //if ($password == $table_password) {
        $myfile = fopen("data.txt", "r");
        $l = filesize("data.txt");
        $str = fread($myfile, $l);
        $str = "" . $str;
        $arr = explode(",", $str);
//echo $str;
//echo "password  correct";
        fclose($myfile);
        $myfile = fopen("data.txt", "w");
        fclose($myfile);
//print_r($arr);


        if ($done == 1) {
            $res = shell_exec("\"C:/Program Files/R/R-4.1.0/bin/i386/Rscript.exe\" C:/xampp/htdocs/xampp/person_identification_by_keystrokes/rscripts/user_identification_euclidean.R $name $str 2>&1");
            $res3 = shell_exec("\"C:/Program Files/R/R-4.1.0/bin/i386/Rscript.exe\" C:/xampp/htdocs/xampp/person_identification_by_keystrokes/rscripts/user_identification.R $name $str 2>&1");
            $res4 = shell_exec("\"C:/Program Files/R/R-4.1.0/bin/i386/Rscript.exe\" C:/xampp/htdocs/xampp/person_identification_by_keystrokes/rscripts/user_identification_median.R $name $str 2>&1");
            echo $res . "<br>" . $res3 . "<br>" . $res4;
//echo $res;
            $res2 = $res;
            $res = substr($res, 5, 3);
//print $res;

            $_SESSION['user'] = $username; //set the username in a session. This serves as a global variable
            $_SESSION['str'] = $res2;
            $_SESSION['strn'] = $res3;

            $_SESSION['strm'] = $res4;
            $_SESSION['user'] = $username; //set the username in a session. This serves as a global variable

            print '<script>
    window.location.assign("profile.php");</script>';
        } else {
            $_SESSION['user'] = $username; //set the username in a session. This serves as a global variable
            Print '<script>
							alert("Enter keystoke information for secure access!");
							window.location.assign("speedCheck.php");</script>';

        }

   // }
}
?>