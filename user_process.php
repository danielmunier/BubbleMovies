<?php

require_once("models/User.php");
require_once("models/Message.php");
require_once("dao/UserDAO.php");
require_once("globals.php");
require_once("db.php");

$message = new Message($BASE_URL);

$userDao = new UserDAO($conn, $BASE_URL);
// Verifica o tipo do formulário (login || register)

$type = filter_input(INPUT_POST, 'type');

if($type === 'update') {


    // Resgata os dados do usuário
    $userData = $userDao -> verifyToken();

    // Aqui será os dados do post, em que o usuário irá alterar
    $name = filter_input(INPUT_POST, 'name');
    $lastname = filter_input(INPUT_POST, 'lastname');
    $bio = filter_input(INPUT_POST, 'bio');
    $email = filter_input(INPUT_POST, 'email');
    $id = filter_input(INPUT_POST, "id");

    // Cria um novo objeto de usuário
    $user = new User();

    $userData -> name = $name;
    $userData -> lastname = $lastname;
    $userData -> email = $email;
    $userData -> bio = $bio;

    //Upload da imagem

    // Aqui ele irá atualizar os dados do usuário no banco de dados e redirecionar para a página de perfil do usuário com uma mensagem de sucesso ou erro (caso o email já esteja cadastrado) 
    $userDao -> update($userData);
    
        

} else if ($type === 'changepassword') {
   $userData = $userDao -> verifyToken();
   $newpassword = filter_input(INPUT_POST, "password"); 
   
   $user = new User();
   $finalPassword = $user -> generatePassword($newpassword);
   $user -> password = $finalPassword;
   $user -> id = $userData -> id;

   $userDao -> changePassword($user);
   header('Location: ' . 'logout.php');


} else {
  $message->setMessage("Tipo de formulário inválido.", "error", "login.php");
  die();
}


