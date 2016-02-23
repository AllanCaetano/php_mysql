<?php 
session_start();

include 'banco.php';
include 'ajudantes.php';
include 'classes/Contatos.php';

$contatos = new Contatos($mysqli);

$exibir_tabela = TRUE;
$tem_erros = FALSE;
$erros_validacao = array();

if (tem_post()) {

    $contato = array();

    if (isset($_POST['nome']) && strlen($_POST['nome']) > 0) {
        $contato['nome'] = $_POST['nome'];
    } else {
        $tem_erros = TRUE;
        $erros_validacao['nome'] = 'O nome do contato é obrigatório.';
    }
    
    if (isset($_POST['telefone']) && strlen($_POST['telefone']) > 0) {
        $contato['telefone'] = $_POST['telefone'];
    } else {
        $tem_erros = TRUE;
        $erros_validacao['telefone'] = 'O telefone do contato é obrigatório.';
    }

    if (isset($_POST['email']) && strlen($_POST['email']) > 0) {
        if (valida_email($_POST['email'])) {
            $contato['email'] = $_POST['email'];
        } else {
            $tem_erros = TRUE;
            $erros_validacao['email'] = 'E-mail inválido.';
        }
    } else {
        $contato['email'] = '';
    }

    if (isset($_POST['nascimento']) && strlen($_POST['nascimento']) > 0) {
        if (valida_data($_POST['nascimento'])) {
            $contato['nascimento'] = traduz_data_para_banco($_POST['nascimento']);
        } else {
            $tem_erros = TRUE;
            $erros_validacao['nascimento'] = 'A data de nascimento não é uma data válida.';
        }
    } else {
        $contato['nascimento'] = '';
    }
    
    if (isset($_POST['favorito'])) {
        $contato['favorito'] = 1;
    } else {
        $contato['favorito'] = 0;
    }

    if (!$tem_erros) {
        $contatos->gravar_contato($contato);
        
        if (isset($_POST['lembrete']) && $_POST['lembrete'] == 1) {
            enviar_email($contato);
        }
        
        header('Location: index.php');
        die();
    }
}

$contato = array(
    'id'         => 0,
    'nome'       => (isset($_POST['nome'])) ? $_POST['nome'] : '',
    'telefone'   => (isset($_POST['telefone'])) ? $_POST['telefone'] : '',
    'email'      => (isset($_POST['email'])) ? $_POST['email'] : '',
    'nascimento' => (isset($_POST['nascimento'])) ? $_POST['nascimento'] : '',
    'favorito'   => (isset($_POST['favorito'])) ? $_POST['favorito'] : ''
);

$contatos->buscar_contatos();

include 'template.php';
