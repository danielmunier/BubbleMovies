<?php


$conn = new PDO("mysql:dbname=moviesbubble;host=localhost", "root", "sokkenai");


$stmt = $conn -> prepare("SELECT * FROM users WHERE email = :id");

$id = "julinha@gmail.com";

$stmt -> bindParam("id", $id);


$stmt -> execute();


$data = $stmt -> fetchAll(PDO::FETCH_ASSOC);

print_r($data);