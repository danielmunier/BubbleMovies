<?php

require_once('globals.php');
require_once("db.php");
require_once("models/Message.php");
require_once("dao/UserDAO.php");

$message = new Message($BASE_URL);
$flassMessage = $message -> getMessage();
/* var_dump($flashMessage['msg']); */

if(!empty($flassMessage["msg"])) {
    // Limpa a mensagem
    $message -> clearMessage();
}

$userDao = new UserDAO($conn, $BASE_URL);

$userData = $userDao -> verifyToken(false);


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="img/icon.png" type="image/x-icon">
    <!-- Estilo -->
    <link rel="stylesheet" href="css/styles.css">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- Font awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css">

    <title>Bubble Movies</title>
</head>
<body>

<header>
        <nav id="main-navbar" class="navbar navbar-expand-lg">
            <a href="<?= $BASE_URL ?>" class="navbar-brand">
            <img src="<?= $BASE_URL ?>/img/icon.png" alt="Bubble Movies" id='logo'>
            <span id='moviebubble-title'>Bubble Movies</span>
        </a>
        <button class="navbar-toggler" type='button' data-toggle="collapse" data-target="$navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation" >
            <i class="fas fa-bars"></i>
        </button>
        <form action="" method="get" id='search-form' class="form-inline my-2 my-lg-0">
            <input type="text" name='q' id='search' class='form-control mr-sm-2' type='search' placeholder='Search' aria-label='Search'>
            <button type="submit" class='btn my-2 my-sm-0' type="submit">
                <i class='fas fa-search'></i>
            </button>
        </form>
        <div class="collapse navbar-collapse" id='navbar'>
            <ul class="navbar-nav">
        <?php if($userData):?>


            <li class="nav-item">
                <a href="<?= $BASE_URL ?>dasboard.php" class="nav-link">Meus Filmes</a>
            </li>


            <li class="nav-item">
                <a href="<?= $BASE_URL ?>auth.php" class="nav-link"> Adicionar Filme </a>
            </li>

            <li class="nav-item">
                <a href="<?= $BASE_URL ?>editprofile.php"><?= $userData -> name ?> </a>
                
            </li>

            <li class="nav-item">
                <a href="<?= $BASE_URL ?>logout.php" class="nav-link">Sair</a>
            </li>
      


            <?php else:?>
                <li class="nav-item">
                    <a href="<?= $BASE_URL ?>auth.php" class="nav-link">Login / Register</a>
                </li>
                <?php endif;?>
            </ul>
        </div>
        </nav>

    </header>

    <?php if(!empty($flassMessage["msg"])): ?>
    <div class="msg-container">
      <p class="msg <?= $flassMessage["type"] ?>"><?= $flassMessage["msg"] ?></p>
    </div>
  <?php endif; ?>


