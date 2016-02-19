<?php

include 'banco.php';
include 'classes/Veiculos.php';

$veiculos = new Veiculos($mysqli);

$veiculos->duplicar_veiculo($_GET['id']);

header('Location: index.php');