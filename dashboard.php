
<?php

require_once("db.php");
require_once("models/User.php");
require_once("dao/UserDAO.php");
require_once("dao/movieDAO.php");
$movieDao = new MovieDAO($conn, $BASE_URL);
$userDao = new UserDAO($conn, $BASE_URL);
$user = new User();
$userData = $userDao -> verifyToken(true);
$movies = $movieDao -> findById($userData -> id); 



?>

<?php

require_once 'templates/header.php';

?>

<div class="movies-container">
<div class="container-fluid" id='main-container'>
    <?php foreach($movies as $movie): ?>
        <?php require("templates/movie_card.php"); ?>
      <?php endforeach; ?>
</div>
</div>


<?php

require_once 'templates/footer.php';

?>

