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
    $movie -> users_id = $userData -> id;
    
    // Upload da imagem
    if(isset($_FILES['image']) && !empty($_FILES["image"]['tmp_name'])) {
        $image = $_FILES["image"];
        $imageTypes = ['image/jpeg', 'image/jpg', 'image/png'];
        $jpgArray = ['image/jpeg', 'image/jpg'];

        if(in_array($image['type'], $imageTypes)) {

            if(in_array($image['type'], $jpgArray)) {
                
                $imageFile = imagecreatefromjpeg($image['tmp_name']);
            } else {

                $imageFile = imagecreatefrompng($image['tmp_name']);
            }
            $imageName = $movie -> imageGenerateName();
            $path = "./img/movies/" . $imageName;

            imagejpeg($imageFile, $path, 100);         

            $movie -> image = $imageName;

           
        } else {
            $message -> setMessage("Formato de imagem inválido", "error", "back");
        }

    }
    $movieDAO -> create($movie);
 var_dump($imageName);
    // display the image
 
    
    
    if(!empty($title) && !empty($description) && !empty($category)){

    }else {
        $message -> setMessage("Faltando informações", 'error', 'back');
    }

}