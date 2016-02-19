<?php
include 'banco.php';
include 'ajudantes.php';
include 'classes/Tarefas.php';

$tarefas = new Tarefas($mysqli);

$tem_erros = FALSE;
$erros_validacao = array();

if (tem_post()) {
    $tarefa_id = $_POST['tarefa_id'];
    
    if (!isset($_FILES['anexo'])) {
        $tem_erros = TRUE;
        $erros_validacao['anexo'] = 'Você deve selecionar um arquivo para anexar';
    } else {
        if (tratar_anexo($_FILES['anexo'])) {
            $anexo = array();
            $anexo['tarefa_id'] = $tarefa_id;
            $anexo['nome'] = $_FILES['anexo']['name'];
            $anexo['arquivo'] = $_FILES['anexo']['name'];
        } else {
            $tem_erros = TRUE;
            $erros_validacao['anexo'] = 'Envie apenas anexos no formato zip ou pdf';
        }
    }
    
    if (!$tem_erros) {
        $tarefas->gravar_anexo($anexo);
    }
}

$tarefas->buscar_tarefa($_GET['id']);
$tarefa = $tarefas->tarefa;

$anexos = $tarefas->buscar_anexos($_GET['id']);

include 'template_tarefa.php';