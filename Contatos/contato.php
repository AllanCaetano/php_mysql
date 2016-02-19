<?php
include 'banco.php';
include 'ajudantes.php';
include 'classes/Contatos.php';

$contatos = new Contatos($mysqli);

$tem_erros = FALSE;
$erros_validacao = array();

if (tem_post()) {
    $contato_id = $_POST['contato_id'];
    
    if (! isset($_FILES['anexo'])) {
        $tem_erros = TRUE;
        $erros_validacao['anexo'] = 'Você deve selecionar um arquivo para anexar';
    } else {
        if (tratar_anexo($_FILES['anexo'])) {
            $anexo = array();
            $anexo['contato_id'] = $contato_id;
            $anexo['nome'] = $_FILES['anexo']['name'];
            $anexo['arquivo'] = $_FILES['anexo']['name'];
        } else {
            $tem_erros = TRUE;
            $erros_validacao['anexo'] = 'Envie apenas anexos no formato png ou jpg';
        }
    }
    
    if (!$tem_erros) {
        $contatos->gravar_anexo($anexo);
    }
}

$contatos->buscar_contato($_GET['id']);
$contato = $contatos->contato;

$anexos = $contatos->buscar_anexos($_GET['id']);

include 'template_contato.php';