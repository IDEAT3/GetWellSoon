<?php
        $servername = 'athena.nitc.ac.in';
        $username = 'b120771cs';
        $password = "b120771cs";
        $dbname = "db_b120771cs";
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
        }
?>

