
<?php

require_once("db.php");
require_once("models/User.php");
require_once("dao/UserDAO.php");
require_once("dao/movieDAO.php");
$movieDao = new MovieDAO($conn, $BASE_URL);
$userDao = new UserDAO($conn, $BASE_URL);
$user = new User();
$userData = $userDao -> verifyToken(true);


?>

<?php

require_once 'templates/header.php';

?>


<div class="container-fluid" id='main-container'>
    <h1><?=  $movieDao -> findById($userData -> id) ?></h1>
</div>


<?php

require_once 'templates/footer.php';

?>

