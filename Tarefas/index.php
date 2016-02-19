<?php
session_start();
include 'banco.php';
include 'ajudantes.php';
include 'classes/Tarefas.php';

$tarefas = new Tarefas($mysqli);

$exibir_tabela = TRUE;
$tem_erros = FALSE;
$erros_validacao = array();

if (tem_post()) {
    
    $tarefa = array();
    
    if (isset($_POST['nome']) && strlen($_POST['nome']) > 0) {
        $tarefa['nome'] = $_POST['nome'];
    } else {
        $tem_erros = TRUE;
        $erros_validacao['nome'] = 'O nome da tarefa é obrigatório.';
    }
    
    if (isset($_POST['descricao'])) {
        $tarefa['descricao'] = $_POST['descricao'];
    } else {
        $tarefa['descricao'] = '';
    }
    
    if (isset($_POST['prazo']) && strlen($_POST['prazo']) > 0) {
        if (validar_data($_POST['prazo'])) {
            $tarefa['prazo'] = traduz_data_para_banco($_POST['prazo']);
        } else {
            $tem_erros = TRUE;
            $erros_validacao['prazo'] = 'O prazo não é uma data válida.';
        } 
    } else {
        $tarefa['prazo'] = '';
    }
    
    $tarefa['prioridade'] = $_POST['prioridade'];
    
    if (isset($_POST['concluida'])) {
        $tarefa['concluida'] = 1;
    } else {
        $tarefa['concluida'] = 0;
    }
    
    if (!$tem_erros) {
        $tarefas->gravar_tarefa($tarefa);
        
        if (isset($_POST['lembrete']) && $_POST['lembrete'] == 1) {
            enviar_email($tarefa);
        }
        
        header('Location: index.php');
        die();
    }
}

$tarefa = array(
    'id'         => 0,
    'nome'       => (isset($_POST['nome'])) ? $_POST['nome'] : '',
    'descricao'  => (isset($_POST['descricao'])) ? $_POST['descricao'] : '',
    'prazo'      => (isset($_POST['prazo'])) ? traduz_data_para_banco($_POST['prazo']) : '',
    'prioridade' => (isset($_POST['prioridade'])) ? $_POST['prioridade'] : 1,
    'concluida'  => (isset($_POST['concluida'])) ? $_POST['concluida'] : ''
);

$tarefas->buscar_tarefas();

include 'template.php';
        