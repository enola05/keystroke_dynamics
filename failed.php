<!DOCTYPE html>


<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8" name="viewport" content="width=device-width, initial-scale=1" >
    <title>Login_identification</title>
    <link rel="stylesheet" href="loginPage.css">
    <title> identification </title>
    <script type="text/javascript">
        function buttonclick(){
            window.location="logout.php"
        }
        function buttonn(){
            window.location="login_keystroke.php"
        }

    </script>
</head>
<body>
<div class="login-page">
    <div class="form">
        <form class="login-form" >
            <div class="login-header" >
                <label id="percentage_value"> NO </label>
            </div>
            <hr>
            <p id="instructions">Description will be given from ML and javascript calculations</p><hr>
            <button type="button" name="proceed_button" id="proceed_button" onclick="buttonn()"  >Re- enter Keystroke</button><hr>
            <button type="button" name="home_button" id="home_button" onclick="buttonclick()">logout</button>
        </form>
    </div></div>
</body>
</html>