<?php

include_once "database.php";

if(isset($_POST["id"]) && trim($_POST["id"]) != ""
    && isset($_POST["name"]) && trim($_POST["name"]) != "" 
    && isset($_POST["description"]) && trim($_POST["description"]) != ""){
    
    $id = $_POST["id"];
    $name = $_POST["name"];
    $description = $_POST["description"];
    
    $query = $connection->prepare("UPDATE task SET name = ?, description = ? WHERE id = ?");
    
    if ($query === false) {
        die("Error in the preparation of the query: " . $connection->error);
    }

    $query->bind_param("ssi", $name, $description, $id);
    $query->execute();
    $query->close();

    $json = [
        'status'=> 'success',
        'message'=> 'Task Update successfully',
        'code'=> '200',
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