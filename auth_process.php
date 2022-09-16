<?php

require_once("./models/User.php");
require_once("./models/Message.php");
require_once("./dao/UserDAO.php");
require_once("./globals.php");
require_once("./db.php");

$message = new Message($BASE_URL);

$userDao = new UserDAO($conn, $BASE_URL);
// Verifica o tipo do formulário (login || register)


$type = filter_input(INPUT_POST, 'type'); 


// Verifica o tipo de requisição

if($type == "register"){

    $name = filter_input(INPUT_POST, 'name'); 
    $lastname = filter_input(INPUT_POST, 'lastname'); 
    $email = filter_input(INPUT_POST, 'email'); 
    $password = filter_input(INPUT_POST, 'password'); 
    $confirmpassword = filter_input(INPUT_POST, 'confirmpassword'); 
    
    // Verificando dados minimamente


    if($name && $lastname && $email && $password) {

        if($password === $confirmpassword) {

            if($userDao -> findbyEmail($email) === false){ // Verifica se o email já existe no banco de dados, se não existir irá criar um novo usuário
                $user = new User();

                $userToken = $user -> generateToken();
                $finalPassword = $user -> generatePassword($password); // Criptografa a senha com o algoritmo padrão(Recomendado)

                $user -> name = $name;
                $user -> lastname = $lastname;
                $user -> email = $email;
                $user -> password = $finalPassword;
                $user -> token = $userToken;

                $auth = true;

                $userDao -> create($user, $auth);



          /*       $message->setMessage("Usuário cadastrado", "success", "back"); */

                
            



            } else {
            $message->setMessage("Usuário já existente", "error", "back");

            }
           
        } else {
            $message->setMessage("Senhas não são iguais", "error", "back");
        }


    } else {

        // Enviar msg de erro
       
        $message -> setMessage("Preenchas todos os campos", "error", "back");
    }



}


if($type == "login"){
    $email = filter_input(INPUT_POST, 'email');
    $password = filter_input(INPUT_POST, 'password');

    if($userDao -> authenticateUser($email, $password)) {

        $message -> setMessage("Usuário autenticado", "success", "index.php");

    } else {
        $message -> setMessage("Usuários/Senhas incorretos", "error", "back");

    } 
}
