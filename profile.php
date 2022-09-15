<?php

require_once("templates/header.php");
require_once("dao/movieDAO.php");
$movie = new MovieDAO($conn, $BASE_URL);
$userDao = new UserDAO($conn, $BASE_URL);
$user = new User();

$id = filter_input(INPUT_GET, "id");

$user = $userDao -> findById($id);

if(!$user){
    header("Location: " . $BASE_URL);
    exit;
}

?>


<div class="container mt-5">
    
    <div class="row d-flex justify-content-center">
        
        <div class="col-md-7">
            
            <div class="card p-3 py-4">
                
                <div class="text-center">
                    <img src="<?= $BASE_URL ?>img/users/<?= $userData->image ?>" width="300" class="rounded-circle">
                </div>
                
                <div class="text-center mt-3">
                    <h5 class="mt-2 mb-0"><?= $user -> name ?></h5>
                    <span>UI/UX Designer</span>
                    
                    <div class="px-4 mt-1">
                        <p class="fonts">Consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. </p>
                    
                    </div>
                    
       
                    
                    <div class="buttons">
                        
                        <button class="btn btn-outline-primary px-4">Message</button>
                        <button class="btn btn-primary px-4 ms-3">Contact</button>
                    </div>
                    
                    
                </div>
                
               
                
                
            </div>
            
        </div>
        
    </div>
    
</div>


<?php

require_once("templates/footer.php");

?>