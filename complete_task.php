<?php
session_start();
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $id =  $_POST['id'];
    $is_completed = isset($_POST['is_completed']) ? 1 : 0;
    $stmt = $conn->prepare("UPDATE tasks 
    SET is_completed = :is_completed
    WHERE id = :id");

    $stmt->bindParam(":is_completed", $is_completed);
    $stmt->bindParam(":id", $id);

    try {
        $stmt->execute();
        echo "Successfully Completed!";
    } catch (\Throwable $th) {
        echo "Something went wrong. Please try again later.";
    }

}

?>