<?php

include_once "database.php";

if(isset($_POST["search"]) && !empty($_POST["search"])) {
    
    $search = $_POST["search"]; 

    $query = "SELECT * FROM task WHERE name LIKE '$search%'";
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

}else{
    $response = [
        'task'=> [],
        'message'=> 'No matches found',
        'status'=> 'success',
        'code' => '200',
    ];
    $jsonstring = json_encode($response);
    echo $jsonstring;
}