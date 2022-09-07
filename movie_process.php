<?php


require_once("models/User.php");
require_once("models/Message.php");
require_once("dao/movieDAO.php");
require_once("dao/UserDAO.php");
require_once("globals.php");
require_once("db.php");

$movieDAO = new movieDao($conn, $BASE_URL);
$userDao = new UserDao($conn, $BASE_URL);

$message = new Message($conn);

$type = filter_input(INPUT_POST, 'type');

$userData = $userDao -> verifyToken();


if($type === 'create') {
    $description = filter_input(INPUT_POST, "description");
    $length = filter_input(INPUT_POST, "length");
    $title = filter_input(INPUT_POST, "title");
    $trailer = filter_input(INPUT_POST, "trailer");
    $category = filter_input(INPUT_POST, "category");

    $movie = new Movie();

    $movie -> title = $title;
    $movie -> description = $description;
    $movie -> trailer = $trailer;
    $movie -> category = $category;
    $movie -> length = $length;

    // Upload da imagem
    $image = $_FILES['image'];
    var_dump($image);


    if(!empty($title) && !empty($description) && !empty($category)){

    }else {
        $message -> setMessage("Faltando informações", 'error', 'back');
    }

}