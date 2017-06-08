<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Registration</title>
    </head>
    <body>
        <form action="" method="post">
            <fieldset>
                <legend>Login:</legend>
                <p><label>Username:* <input required type="text" name="username" size="30" maxlength="25"/></label></p>
                <p><label>Password:* <input required type="text" name="pass" size="30" maxlength="25"/></label></p>
                <p><label>Email:* <input required type="text" name="email" size="30" maxlength="30"/></label></p>
                <p><label>First Name:* <input required type="text" name="firstName" size="30"/></label></p>
                <p><label>Last Name:* <input required type="text" name="lastName" size="30"/></label></p>
                <p><label>Phone: <input type="text" name="phone" size="30" maxlength="11"/></label></p>        
            </fieldset>
            <p><input type="submit" name="submit" value="Submit"/></p>
        </form>
        
        
        <?php

            DEFINE('DB_USER', 'root');
            DEFINE('DB_PASSWORD', '');
            DEFINE('DB_HOST', 'localhost');
            DEFINE('DB_NAME', 'forum');

            //Connect
            $dbc = @mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die ('Could not connect to MySQL: ' . mysqli_connect_error() );

            //Encoding
            mysqli_set_charset($dbc, 'utf8');


            $err = "";


            //Validation
            if(!empty($_POST['username']))
            {
                $username = $_POST['username'];
                if(!ctype_alnum($_POST['username']))
                {
                    $err = $err . "Invalid Username <br>";
                }
                //Check if Username is already taken
                elseif(mysqli_num_rows(mysqli_query($dbc, "SELECT username, password FROM users WHERE username='$username'")))
                {
                    $err = $err . "Username Taken <br>";
                }
            }

            if(!empty($_POST['pass']) && strlen($_POST['pass']) < 8)
            {
                $err = $err . "Invalid Password <br>";

            }
            if(!empty($_POST['email']) && (strpos($_POST['email'], '@') == false || strpos($_POST['email'], '.') == false))
            {
                $err = $err . "Invalid Email Address <br>";

            }
            if(!empty($_POST['firstName']) && (ctype_space($_POST['firstName']) || !ctype_alpha($_POST['firstName'])))
            {
                $err = $err . "First Name can only contain letters <br>";

            }
            if(!empty($_POST['lastName']) && (ctype_space($_POST['lastName']) || !ctype_alpha($_POST['lastName'])))
            {
                $err = $err . "Last Name can only contain letters <br>";
            }

            if(!empty($_POST['phone']) && (ctype_space($_POST['phone']) || !ctype_digit($_POST['phone']) || strlen($_POST['phone']) < 10 || strlen($_POST['phone']) > 11))
            {
                $err = $err . "Invalid Phone Number <br>";

            }

            //Add to Database
            if(!empty($_POST['username']) && !empty($_POST['pass']) && !empty($_POST['email']) && !empty($_POST['firstName']) && !empty($_POST['lastName']) && $err == "")
            {
                $fName = $_POST['firstName'];
                $lName = $_POST['lastName'];
                $username = $_POST['username'];
                $pass = $_POST['pass'];
                $email = $_POST['email'];

                if(!empty($_POST['phone']))
                {
                    $phone = $_POST['phone'];    
                    $query = "INSERT INTO users (firstName, lastName, email, password, username, phone) VALUES ('$fName', '$lName', '$email', '$pass', '$username', '$phone')";
                }
                else 
                {
                    $query = "INSERT INTO users (firstName, lastName, email, password, username) VALUES ('$fName', '$lName', '$email', '$pass', '$username')";
                }

                mysqli_query($dbc, $query);
                header('Location: index.php');   

            }
            else {
                echo $err;
            }
        
        ?>
    </body>
</html>

