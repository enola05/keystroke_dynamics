
<?php
    print '<script>console.log("inside validate");</script>';
    session_start(); //starts the session
    if ($_SESSION['user']) { //checks if user is logged in
    } else {
        header("loginForm.php"); // redirects if user is not logged in
    }
    $user = $_SESSION['user']; //assigns user value
    //print '<script>console.log(';echo json_encode($_SESSION);');</script>';


    $conn=mysqli_connect("localhost", "root", "") or die(mysqli_error()); //Connect to server
    mysqli_select_db($conn,"keystrokee") or die("Cannot connect to database"); //Connect to database
    $query = mysqli_query($conn,"SELECT * from users WHERE email='$user'"); //Query the users table if there are matching rows equal to $username
    while ($row = mysqli_fetch_assoc($query)) //display all rows from query
    {
        $table_password = $row['password']; // the first password row is passed on to $table_users, and so on until the query is finished
        $done = $row['done'];
    }


    $id1 = $_POST['textarea1'];
    $id2 = $_POST['textarea2'];
    $id3 = $_POST['textarea3'];
    $id4 = $_POST['textarea4'];
    $id5 = $_POST['textarea5'];
    $id6 = $_POST['textarea6'];
    $time_data = array();

    if ($id1 == $id2 && $id3 == $id4 && $id5==$id6 && $id1 == $id3 && $id1==$id5 &&  $id1 != "") {
    //if($id1==$id2&&$id3==$id4&&$id5==$id6&&$id1==$id3&&$id1==$id5&&$id1!=""&&$table_password==$id1){

        $myfile = fopen("data.txt", "r");
        $str = fread($myfile, filesize("data.txt"));


        $c = 0;
        for ($i = 0; $i < strlen($str); $i++) {
            if ($str[$i] == ',')
                $c = $c + 1;
        }

        if ($c == strlen($table_password) * 6) {
            $name = strstr($user, '@', true);
            $str = $name . "," . strlen($table_password) . "," . $str;

            $arr = explode(".", $str);    // since we later explode using comma as delimiter I need to convert str to an array, that's all
            //print_r ($arr);


            $file = fopen("timing.csv", "a");

            foreach ($arr as $line) {
                fputcsv($file, explode(',', $line));  // each array becomes a row in excel
            }

            fclose($file);

            fclose($myfile);

            $myfile = fopen("data.txt", "w");  // to empty that file
            fclose($myfile);


            print '<script>
			alert("you are successfully entered the logistics");
			window.location.assign("loginForm.php");
            <!--window.location.assign("profile.php");--></script>';// redirects to register.php
            $done_update = mysqli_query($conn,"update users set done=1 WHERE email='$user'"); //Query the users table if there are matching rows equal to $username
        } else {
            $myfile = fopen("data.txt", "w") or die("Unable to open file!");
            fclose($myfile);

            print '<script>console.log("length error");</script>';
            print '<script>
			alert("you could not register ! sorry!length error");
			window.location.assign("speedCheck.php");</script>'; // redirects to register.php
        }
    } else {
        // erase the contents of the file!
        $myfile = fopen("data.txt", "w") or die("Unable to open file!");
        fclose($myfile);

        print '<script>console.log("falied id if");</script>';
        print '<script>
		alert("you could not register! sorry!falied id if");
		window.location.assign("speedCheck.php");</script>'; // redirects to register.php

    }

?>