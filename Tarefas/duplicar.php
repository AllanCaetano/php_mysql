<?php

include 'banco.php';
include 'classes/Tarefas.php';

$tarefas = new Tarefas($mysqli);

$tarefas->duplicar_tarefa($_GET['id']);

header('Location: index.php');
