
<?php

require_once 'templates/header.php';
require_once("dao/UserDAO.php");

$userDao = new UserDao($conn, $BASE_URL);

$userData = $userDao -> verifyToken(true); // Vericia 


?>


<div class="container-fluid" id='main-container'>
    <h1>Edição do perfil</h1>
</div>


<?php

require_once 'templates/footer.php';

?>
