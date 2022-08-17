<?php

require_once("models/User.php");
require_once("models/Message.php");

class UserDAO implements UserDAOInterface {
    private $conn;
    private $url;
    private $message;

    public function __construct(PDO $conn, $url){
        $this->conn = $conn;
        $this->url = $url;
        $this ->message = new Message($url);
    }

    public function buildUser($data){

        $user = new User();

        $user -> id = $data['id'];
        $user -> name = $data['name'];
        $user -> lastname = $data['lastname'];
        $user -> email = $data['email'];
        $user -> password = $data['password'];
        $user -> image = $data['image'];
        $user -> bio = $data['bio'];
        $user -> token = $data['token'];

        return $user;

    }
    public function create(User $user, $authUser = false){  // Cria um novo usuário no banco de dados
        $stmt = $this -> conn -> prepare("INSERT INTO users (name, lastname, email, password, image, bio, token) VALUES (:name, :lastname, :email, :password, :image, :bio, :token)");

        $stmt -> bindParam(':name', $user -> name);
        $stmt -> bindParam(':lastname', $user -> lastname);
        $stmt -> bindParam(':email', $user -> email);
        $stmt -> bindParam(':password', $user -> password);
        $stmt -> bindParam(':image', $user -> image);
        $stmt -> bindParam(':bio', $user -> bio);
        $stmt -> bindParam(':token', $user -> token);
        
        $stmt -> execute();

        // Autentica o usuário caso o auth seja true. Para isso, ele cria uma sessão com o token do usuário
        if($authUser) {
            $this -> setTokenToSession($user -> token);

        }

    }
    public function update(User $user, $redirect = true){
        $stmt = $this -> conn -> prepare("UPDATE users SET 
            name = :name,
            lastname = :lastname,
            email = :email,
            password = :password,
            image = :image,
            bio = :bio,
            token = :token
            WHERE id = :id");
        
        $stmt -> bindParam(':id', $user -> id);
        $stmt -> bindParam(':name', $user -> name);
        $stmt -> bindParam(':lastname', $user -> lastname);
        $stmt -> bindParam(':email', $user -> email);
        $stmt -> bindParam(':password', $user -> password);
        $stmt -> bindParam(':image', $user -> image);
        $stmt -> bindParam(':bio', $user -> bio);
        $stmt -> bindParam(':token', $user -> token);
        
        $stmt -> execute();

        if($redirect) {
            $this -> message -> setMessage('Usuário atualizado com sucesso!', 'success');
            

        }


    }
    public function findByToken($token){
        
        if($token != "") {
            $stmt = $this -> conn -> prepare("SELECT * FROM users WHERE token = :token");

            $stmt -> bindParam(":token", $token);
            $stmt -> execute();

            if($stmt -> rowCount() > 0) {
                $data = $stmt -> fetch(); 
                $user = $this -> buildUser($data);

                return $user; 

            } else {
                return false;
            }
        } else {
            return false;
        }

    }
    public function verifyToken($protected = false){

        if(!empty($_SESSION['token'])) {
            $token = $_SESSION['token'];
            $user = $this -> findByToken($token);

            if($user) {
                return $user;
            } else if ($protected) {
                $this -> message -> setMessage("Faça a autenticação primeiro", "error");
            }


        } else if ($protected) {
            $this -> message -> setMessage("Faça a autenticação primeiro", "error");
        }

    }
    public function setTokenToSession($token, $redirect = true){
        $_SESSION["token"] = $token;

        if($redirect) {
            // Redirecionará para o perfil do User

            $this -> message -> setMessage("Bem-vindo", "success", "editprofile.php"); // Futuramente, redirecionar para o index.php

        } 

    }

    public function destroyToken() {
        //Remove o token da sessão do usuário
        $_SESSION["token"] = "";

        // Redireciona para o index.php
        $this -> message ->setMessage("Deslogado", "success", "index.php");


    }
    public function authenticateUser($email, $password){
        $user = $this -> findByEmail($email);

        if($user) {
            // Verifica se as senhas batem
            if(password_verify($password, $user->password)) {
                $token = $user -> generateToken();
                $this -> setTokenToSession($token, false);

                // Atualiza o token do usuário
                $user -> token = $token;
                $this -> update($user, false);

                return true;

            }else {
                $this -> message -> setMessage("Senha incorreta", "error");
            }
        } else {
            $this -> message -> setMessage("Usuário não encontrado", "error");
        }

    }
    public function findByEmail($email){

        if($email != "") {
            $stmt = $this -> conn -> prepare("SELECT * FROM users WHERE email = :email");

            $stmt -> bindParam(":email", $email);
            $stmt -> execute();

            if($stmt -> rowCount() > 0) { // Se a contagem retornar alguma linha (se existe algum usuário com esse email) 
                $data = $stmt -> fetch(); // Pega a primeira linha do resultado
                $user = $this -> buildUser($data); // Constroi o objeto User
                /* return $this;  */// Retorna o objeto User
                return $user;

            } else {
                return false;
            }
        } else {
            return false;
        }


    }
    public function findById($id){

    }
    public function changePassword(User $user){

    }
/*     public function verifyPassword(User $user) {
        $stmt = $this -> conn -> prepare("SELECT password FROM users WHERE id = :id");

    } */
}