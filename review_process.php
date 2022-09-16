<?php


require_once("models/Movie.php");
require_once("models/Review.php");
require_once("dao/ReviewDAO.php");
require_once("dao/MovieDAO.php");
require_once("globals.php");

$movieDao = new MovieDAO($conn, $BASE_URL);
$userDao = new UserDAO($conn, $BASE_URL);
$type = filter_input(INPUT_POST, "type");
$userData = $userDao-> verifyToken();

if($type === "create"){
    $movies_id = filter_input(INPUT_POST, "movies_id");
    $rating = filter_input(INPUT_POST, "rating");
    $review = filter_input(INPUT_POST, "review");
    $review = trim($review);
    
    $movieData = $movieDao -> findById($movies_id);
    
    $reviewObject = new Review();
    $reviewDao = new ReviewDAO($conn, $BASE_URL);
    
    if($movieData){
        if(!empty($movies_id) && !empty($rating) && !empty($review) && !empty($userData->id)){
            $reviewObject -> movies_id = $movies_id;
            $reviewObject -> rating = $rating;
            $reviewObject -> review = $review;
            $reviewObject -> users_id = $userData -> id;
    
           $reviewDao -> create($reviewObject);
    
    }else {
        $message -> setMessage("Faltam informações", "error", "back");
    }
 } else {
    $message -> setMessage("Filme inexistente", "error", "index.php");
 }
    
    

}