<?php

include_once "database.php";

$page = isset($_POST["page"]) && !empty( $_POST["page"] ) ? $_POST["page"] : 1;
$offset = ($page - 1) * 5;

$query = "SELECT * FROM task limit $offset, 5";
$result = mysqli_query($connection, $query);
if(!$result){
    die('Query Error'. mysqli_error($connection));
}
$json = [];
while($row = mysqli_fetch_array($result)){
    $json[] = [
        'id'=> $row['id'],
        'name'=> $row['name'],
        'description'=> $row['description'],
    ];    
}
$response = [
    'task'=> $json,
    'message'=> 'Matches found',
    'status'=> 'success',
    'code' => '200',
];

$jsonstring = json_encode($response);
echo $jsonstring;