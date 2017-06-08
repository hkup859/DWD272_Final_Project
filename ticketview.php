<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Ticket</title>
    </head>
    <body>
        
        <?php
                  
            DEFINE('DB_USER', 'root');
            DEFINE('DB_PASSWORD', '');
            DEFINE('DB_HOST', 'localhost');
            DEFINE('DB_NAME', 'forum');

            //Connect
            $dbc = @mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die ('Could not connect to MySQL: ' . mysqli_connect_error() );

            //Encoding
            mysqli_set_charset($dbc, 'utf8');
            
            
            
            //Gets the Ticket
            $query = "SELECT message, userID FROM tickets WHERE ticketID=" . $_GET['ticket'];
            $result = mysqli_query($dbc, $query);
            $ticketRow = $result->fetch_all(MYSQLI_NUM);
            
            //Gets the username of the ticket's creator
            $userID = $ticketRow[0][1];
            $userQuery = "SELECT username FROM users WHERE userID='$userID'";
            $userResult = mysqli_query($dbc, $userQuery);
            $userRow = $userResult->fetch_all(MYSQLI_NUM);
            $username = $userRow[0][0];
            
            //Display Ticket
            echo "Ticket: #" . $_GET['ticket'] . "<br><br><br>";
            echo "User: " . $username . "<br>";
            echo "Message: " . $ticketRow[0][0] . "<br> <br>";

            //Get Comments
            $ticketNum = $_GET['ticket'];
            $commentQuery = "SELECT message, userID FROM comments WHERE ticketID='$ticketNum'";
            $result = mysqli_query($dbc, $commentQuery);
            $commentRow = $result->fetch_all(MYSQLI_NUM);

            //Loop to display comments
            $max = count($commentRow)-1;
            $counter = 0;
            if($max >= 0)                    
            {

                while ($counter <= $max) 
                {
                    //Get User
                    $userID = $commentRow[$counter][1];
                    $userQuery = "SELECT username FROM users WHERE userID='$userID'";
                    $userResult = mysqli_query($dbc, $userQuery);
                    $userRow = $userResult->fetch_all(MYSQLI_NUM);
                    $username = $userRow[0][0];
                    
                    //Display Comment
                    echo $username . " - "  . $commentRow[$counter][0] . "<br> <br>";
                    $counter++;
                }
            }
            echo "<a href='createComment.php?ticket=" . $ticketNum . "'>  Add Comment<a/> <br> <br>";
         ?>
        <p> <a href="tickets.php">Back to Tickets</a></p>

 </body>
</html>