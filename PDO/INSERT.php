<?php


$conn = new PDO("mysql:dbname=moviesbubble;host=localhost", "root", "sokkenai");



$stmt = $conn -> prepare("INSERT INTO users (name, lastname, email, password, image, bio, token) VALUES (:name, :lastname, :email, :password, :image, :bio, :token)");


$name = 'Julia';
$lastname = 'Santos';
$email = 'email@gmail.com';
$password = '123';
$image = 'example.png';
$bio = 'example bio';
$token = '1okdjui1290usadiouasd';


$stmt -> bindParam(":name", $name);
$stmt -> bindParam(":lastname", $lastname);
$stmt -> bindParam(":email", $email);
$stmt -> bindParam(":password", $password);
$stmt -> bindParam(":image", $image);
$stmt -> bindParam(":bio", $bio);
$stmt -> bindParam(":token", $token);

$stmt -> execute();
