<?php 
session_start();

include 'banco.php';
include 'ajudantes.php';
include 'classes/Contatos.php';

$contatos = new Contatos($mysqli);
 
$exibir_tabela = FALSE;
$tem_erros = FALSE;
$erros_validacao = array();

 if ($_POST['atualizar']) {
    if (tem_post()) {
        $contato = array();
        
        $contato['id'] = $_POST['id'];
        
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
            $contatos->editar_contato($contato);
            
            if (isset($_POST['lembrete']) && $_POST['lembrete'] == 1) {
                $anexos = $contatos->buscar_anexos($contato['id']);
                enviar_email($contato, $anexos);
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

$contato['nome'] = (isset($_POST['nome'])) ? $_POST['nome'] : $contato['nome'];
$contato['telefone'] = (isset($_POST['telefone'])) ? $_POST['telefone'] : $contato['telefone'];
$contato['email'] = (isset($_POST['email'])) ? $_POST['email'] : $contato['email'];
$contato['nascimento'] = (isset($_POST['nascimento'])) ? $_POST['nascimento'] : $contato['nascimento'];
$contato['favorito'] = (isset($_POST['favorito'])) ? $_POST['favorito'] : $contato['favorito'];

$contatos->buscar_contato($_GET['id']);
$contato = $contatos->contato;

include 'template.php';