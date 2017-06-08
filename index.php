<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
    </head>
    <body>
        <form action="" method="post">
            <fieldset>
                <legend>Login:</legend>
                <p><label>Username:* <input required type="text" name="username" size="30" maxlength="25"/></label></p>
                <p><label>Password:* <input required type="text" name="pass" size="30" maxlength="25"/></label></p>
            </fieldset>
            <p><input type="submit" name="submit" value="Submit"/></p>
        </form>
        
        <p> <a href="register.php">Register</a></p>
        
        
        <?php
            
            DEFINE('DB_USER', 'root');
            DEFINE('DB_PASSWORD', '');
            DEFINE('DB_HOST', 'localhost');
            DEFINE('DB_NAME', 'forum');

            //Connect
            $dbc = @mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die ('Could not connect to MySQL: ' . mysqli_connect_error() );

            //Encoding
            mysqli_set_charset($dbc, 'utf8');        


            //Validate Username & Password
            if(!empty($_POST['username']) && !empty($_POST['pass']))
            {
                $username = $_POST['username'];
                $pass = $_POST['pass'];
                $query = "SELECT username, password FROM users WHERE username='$username' AND password='$pass'";
                $result = mysqli_query($dbc, $query);
                if (mysqli_num_rows($result) == 1)
                {
                    header('Location: tickets.php');   
                }
                else
                {
                    echo "Incorrect Login";
                }

            }


        ?>
    </body>
</html>

