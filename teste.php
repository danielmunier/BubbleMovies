<?php

include_once 'models/Message.php';

print_r($_SESSION);

if(!empty($_SESSION['msg'])){
    echo $_SESSION['msg'];
}else {
    echo "Não tem mensagem";
}