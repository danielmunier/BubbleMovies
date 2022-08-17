<?php

$conn = new PDO("mysql:dbname=moviesbubble;host=localhost", "", ""); /* PREENCHER */


// Habilita erros PDO

$conn -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // PDO::ERRMODE_EXCEPTION = lança exceções
$conn -> setAttribute(PDO::ATTR_EMULATE_PREPARES, false); // Para evitar SQL Injection 