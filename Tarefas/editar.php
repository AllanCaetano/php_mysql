<?php
session_start();
include 'banco.php';
include 'ajudantes.php';
include 'classes/Tarefas.php';

$tarefas = new Tarefas($mysqli);

$exibir_tabela = FALSE;
$tem_erros = FALSE;
$erros_validacao = array();

// Submit atualizar
if ($_POST['atualizar']) {
    if (tem_post()) {
        
        $tarefa = array();
        $tarefa['id'] = $_POST['id'];
        
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

        if (isset($_POST['prazo'])) {
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
        
        // Se não tem erros
        if (!$tem_erros) {
            $tarefas->editar_tarefa($tarefa);
            
            if (isset($_POST['lembrete']) && $_POST['lembrete'] == 1) {
                $anexos = $tarefas->buscar_anexos($tarefa['id']);
                enviar_email($tarefa, $anexos);
            }
            
            header('Location: index.php');
            die();
        }
    }
}

if ($_POST['cancelar']) {
    header('Location: index.php');
    die();
}

$tarefa['nome'] = (isset($_POST['nome'])) ? $_POST['nome'] : $tarefa['nome'];
$tarefa['descricao'] = (isset($_POST['descricao'])) ? $_POST['descricao'] : $tarefa['descricao'];
$tarefa['prazo'] = (isset($_POST['prazo'])) ? $_POST['prazo'] : $tarefa['prazo'];
$tarefa['prioridade'] = (isset($_POST['prioridade'])) ? $_POST['prioridade'] : $tarefa['prioridade'];
$tarefa['concluida'] = (isset($_POST['concluida'])) ? $_POST['concluida'] : $tarefa['concluida'];

$tarefas->buscar_tarefa($_GET['id']);
$tarefa = $tarefas->tarefa;

include 'template.php';
        