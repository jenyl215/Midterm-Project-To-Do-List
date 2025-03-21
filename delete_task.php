<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $id =  $_POST['id'];
    $stmt = $conn->prepare("DELETE FROM tasks 
    WHERE id = :id");

    $stmt->bindParam(":id", $id);

    try {
        $stmt->execute();
        echo "Successfully Deleted!";
    } catch (\Throwable $th) {
        echo "Something went wrong. Please try again later.";
    }

}

?>