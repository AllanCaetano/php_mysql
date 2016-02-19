<?php

include 'banco.php';
include 'classes/Contatos.php';

$contatos = new Contatos($mysqli);

$contatos->duplicar_contato($_GET['id']);

header('Location: index.php');
