<?php

require_once("models/Movie.php");
require_once("models/Message.php");
require_once("models/User.php");

class MovieDAO implements MovieDAOInterface {
    private $conn;
    private $url;
    private $message;

    public function __construct(PDO $conn, $url)
    {
        
    }

    public function buildMovie($data) {

    }
    public function findAll() {

    }
    public function getLatestMovies() {

    }
    public function getMoviesByCategory()
    {
        
    }
    public function getMoviesByUserId($id)
    {
        
    }
    public function findById($id)
    {
        
    }
    public function findByTitle($title)
    {
        
    }
    public function create(Movie $movie)
    {
        
    }
    public function update(Movie $movie){

    }
    public function destroy(Movie $movie) {

    }


}

