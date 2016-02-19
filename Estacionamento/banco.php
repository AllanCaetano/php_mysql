<?php

include 'config.php';
 
 $mysqli = new mysqli(BD_SERVIDOR, BD_USUARIO, BD_SENHA, BD_BANCO);
 
 if ($mysqli->connect_errno) {
    echo 'Problemas para conectar no Banco. Verifique os dados';
    die();
}

