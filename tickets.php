<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>Tickets</title>
    </head>
    <body>
        
        
        <p> <a href="createTicket.php">Create New Ticket</a></p>

        <?php

            DEFINE('DB_USER', 'root');
            DEFINE('DB_PASSWORD', '');
            DEFINE('DB_HOST', 'localhost');
            DEFINE('DB_NAME', 'forum');

            //Connect
            $dbc = @mysqli_connect (DB_HOST, DB_USER, DB_PASSWORD, DB_NAME) OR die ('Could not connect to MySQL: ' . mysqli_connect_error() );

            //Encoding
            mysqli_set_charset($dbc, 'utf8');

            //Display Tickets
            $query = "SELECT message, ticketID FROM tickets";
            $result = mysqli_query($dbc, $query);
            $row = $result->fetch_all(MYSQLI_NUM);
            $count = count($row)-1;
            while ($count >= 0) {
                echo "<a href='ticketview.php?ticket=" . $row[$count][1] . "'>" . $row[$count][0] . "<a/> <br> <br>";
                $count--;
            }
        
        ?>
    </body>
</html>

