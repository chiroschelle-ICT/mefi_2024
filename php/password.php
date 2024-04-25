<?php
   /*  $link = mysqli_connect("localhost", "chiroschelle2023_mefi", "a{)E{=^f(=3C51,vt;", "chiroschelle2023_mefi"); */
    
    // Killian localhost 
    $hostname = "localhost"; // C server name
    $username = "root"; //  username 
    $password = ""; //  password
    $database = "chiro_mefi"; // database name

    // Create connection
    $link = mysqli_connect($hostname, $username, $password, $database);

    // Check connection
    if (!$link) {
        die("Connection failed: " . mysqli_connect_error());
    }
    echo "Connected successfully";
?>