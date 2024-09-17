<?php

include_once "database.php";

if(isset($_POST["name"]) && trim($_POST["name"]) != "" 
    && isset($_POST["description"]) && trim($_POST["description"]) != ""){
    
    $name = $_POST["name"];
    $description = $_POST["description"];

    $query = $connection->prepare("INSERT INTO task(name, description) VALUES (?, ?)");

    if ($query === false) {
        die("Error in the preparation of the query: " . $connection->error);
    }

    $query->bind_param("ss", $name, $description);
    $query->execute() or die('Query failed.');

    $query->close();

    $json = [
        'status'=> 'success',
        'message'=> 'Task added successfully',
        'code'=> '201',
    ];
    $jsonstring = json_encode($json);
    echo $jsonstring;
}else{
    $json = [
        'status'=> 'client error',
        'message'=> 'An error has occurred',
        'errors' => getErrors(),
        'code'=> '406',
    ];
    $jsonstring = json_encode($json);
    echo $jsonstring;
}

function getErrors() : Array {
    $errors = [];
    if(isset($_POST["name"]) && trim($_POST["name"]) == ""){
        array_push($errors, "The name must be entered.");
    }

    if(isset($_POST["description"]) && trim($_POST["description"]) == ""){
        array_push($errors, "The description must be entered.");
    }

    return $errors;
}