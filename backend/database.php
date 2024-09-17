<?php

mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

$connection = mysqli_connect(
    "localhost",
    "task_user",
    "password",
    "task_app",
);

//if($connection){
//    echo "Database is connected.";
//}

if (!$connection) {
    die("Connection failed: " . mysqli_connect_error());
}