<?php

$conn = new PDO("mysql:dbname=moviesbubble;host=localhost", "root", "sokkenai");




$stmt = $conn -> prepare("UPDATE users SET name = :name, lastname = :lastname, email = :email, password = :password, image = :image, bio = :bio, token = :token WHERE id = :id");

$id = 2;

$name = 'Julia';
$lastname = 'Santos';
$email = 'julinha@gmail.com';
$password = '123';
$image = 'new_example.png';
$bio = 'updated bio example';
$token = '1okdjui1290usadiouasd';


$stmt -> bindParam(":name", $name);
$stmt -> bindParam(":lastname", $lastname);
$stmt -> bindParam(":email", $email);
$stmt -> bindParam(":password", $password);
$stmt -> bindParam(":image", $image);
$stmt -> bindParam(":bio", $bio);
$stmt -> bindParam(":token", $token);
$stmt -> bindParam(":id", $id);

$stmt -> execute();