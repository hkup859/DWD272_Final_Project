<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Comment Page</title>
    </head>
    <body>
        
        <form action="" method="post">
                    <fieldset>
                        <legend>Comment:</legend>
                        <p><label>Username:* <input required type="text" name="username" size="30" maxlength="25"/></label></p>
                        <p><label>Password:* <input required type="text" name="pass" size="30" maxlength="25"/></label></p>
                        <p><label>Message:* <input required type="text" name="message" size="100" maxlength="250"/></label></p>
                        

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
                       
                //Get Ticket Number
                $ticketNum = $_GET['ticket'];
                
                //Validation
                if(!empty($_POST['message']) && !empty($_POST['username']) && !empty($_POST['pass']))
                {
                    
                    //Validate Username & Password
                    $username = $_POST['username'];
                    $pass = $_POST['pass'];
                    $usernameQuery = "SELECT username, userID FROM users WHERE username='$username' AND password='$pass'";
                    $result = mysqli_query($dbc, $usernameQuery);
                    if (mysqli_num_rows($result) == 1)
                    {
                        $row = $result->fetch_all(MYSQLI_NUM);
                        $userID = $row[0][1];
                        $message = $_POST['message'];
                        $query = "INSERT INTO comments (ticketID, message, userID) VALUES ('$ticketNum', '$message', '$userID')";
                        mysqli_query($dbc, $query);
                        header("Location: ticketView.php?ticket=" . $ticketNum);   
                    }
                    else
                    {
                        echo "Verification Invalid";
                    }  
                }
              
                echo "<p> <a href='ticketView.php?ticket=$ticketNum'>Back to Ticket</a></p>";
        ?>
    </body>
</html>

