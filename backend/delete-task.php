<?php

include_once "database.php";

if(isset($_POST["id"]) && !empty($_POST["id"])) {

    $id = $_POST["id"];

    $query = $connection->prepare("DELETE FROM task WHERE id = ?");

    if ($query === false) {
        die("Error in the preparation of the query: " . $connection->error);
    }

    $query->bind_param("i", $id);
    $query->execute();

    $response = [
        'message'=> 'The task were deleted',
        'status'=> 'success',
        'code' => '200',
    ];

    $jsonstring = json_encode($response);
    echo $jsonstring;
}