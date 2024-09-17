<?php

include_once "database.php";
$query = "SELECT count(*) FROM task";
$result = mysqli_query($connection, $query);
if(!$result){
    die('Query Error: '. mysqli_error($connection));
}
$count = mysqli_fetch_column($result);

$response = [
    'count'=> $count,
    'message'=> 'Count of tasks',
    'status'=> 'success',
    'code' => '200',
];

$jsonstring = json_encode($response);
echo $jsonstring;