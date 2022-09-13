<?php

require_once("db.php");
require_once("models/Movie.php");
require_once("models/Message.php");
require_once("models/User.php");

class MovieDAO implements MovieDAOInterface {
    private $conn;
    private $url;
    private $message;

    public function __construct(PDO $conn, $url)
    {
        $this -> conn = $conn;
        $this -> url = $url;
        $this -> message = new Message($url);



        
    }

    public function buildMovie($data) {

        $movie = new Movie();

        $movie -> id = $data['id'];
        $movie -> title = $data['title'];
        $movie -> description = $data['description'];
        $movie -> image = $data['image'];
        $movie -> trailer = $data['trailer'];
        $movie -> category = $data['category'];
        $movie -> length = $data['length'];
        $movie -> users_id = $data['users_id'];

        return $movie;
    }
    public function findAll() {

    }
    public function getLatestMovies() {
        $stmt = $this -> conn -> query("SELECT * FROM movies ORDER BY id DESC");
        $stmt -> execute();

        
        if($stmt -> rowCount() > 0){
            $allMovies = $stmt -> fetchAll();

            foreach($allMovies as $movie) {
                $movies[] = $this -> buildMovie($movie);
            }
            
        }
       
        return $movies;

    }
    public function getMoviesByCategory($category){
        $stmt = $this -> conn -> prepare("SELECT * FROM movies WHERE category = :category");
        $stmt -> bindParam(':category', $category);
        $stmt -> execute();

        $movies = [];
        $allMovies = $stmt -> fetchAll();
        foreach($allMovies as $movie) {
            $movies[] = $this -> buildMovie($movie);

        }
        return $movies;
    }
        
    
    public function getMoviesByUserId($id){
        $stmt = $this -> conn -> prepare("SELECT * FROM movies WHERE users_id = :id");
        $stmt -> bindParam(':id', $id);
        $stmt -> execute();


        $movieId = $stmt -> fetchAll();
       foreach($movieId as $movie){
           $movies[] = $this -> buildMovie($movie);

       }

        return $movies;
        
    }
    public function findById($id){
        $movie = [];
        $stmt = $this->conn->prepare("SELECT * FROM movies
                                      WHERE id = :id");
  
        $stmt->bindParam(":id", $id);
  
        $stmt->execute();
  
        if($stmt->rowCount() > 0) {
  
          $movieData = $stmt->fetch();
  
          $movie = $this->buildMovie($movieData);
  
          return $movie;
  
        } else {
  
          return false;
  
        }

       
    }

    public function findByTitle($title)
    {
        
    }
    public function create(Movie $movie){
        $stmt = $this -> conn -> prepare("INSERT INTO movies(
            title, description, image, trailer, category, length, users_id
        ) 
        VALUES (
            :title, :description, :image, :trailer, :category, :length, :users_id
        )");
        
        $stmt -> bindParam(":title", $movie -> title);
        $stmt -> bindParam(":description", $movie -> description);
        $stmt -> bindParam(":image", $movie -> image);
        $stmt -> bindParam(":trailer", $movie -> trailer);
        $stmt -> bindParam(":category", $movie -> category);
        $stmt -> bindParam(":length", $movie -> length);
        $stmt -> bindParam(":users_id", $movie -> users_id);

        $stmt -> execute();

        $this -> message -> setMessage("Filme cadastrado com sucesso!", "success", "index.php");
        
    }
    public function update(Movie $movie){

    }
    public function destroy(Movie $movie) {
        $stmt = $this -> conn -> prepare("DELETE FROM movies WHERE id = :id");
        $stmt -> bindParam(":id", $movie -> id);

        $stmt -> execute();
        

    }


}

$movie = new MovieDAO($conn, $BASE_URL);

