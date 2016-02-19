<?php
include 'banco.php';
include 'ajudantes.php';
include 'classes/Veiculos.php';

$veiculos = new Veiculos($mysqli);

$tem_erros = FALSE;
$erros_validacao = array();

if (tem_post()) {
    $veiculo_id = $_POST['veiculo_id'];
    
    if (!isset($_FILES['anexo'])) {
        $tem_erros = TRUE;
        $erros_validacao['anexo'] = 'Você deve selecionar um arquivo para anexar';
    } else {
        if (tratar_anexo($_FILES['anexo'])) {
            $anexo = array();
            $anexo['veiculo_id'] = $veiculo_id;
            $anexo['nome'] = $_FILES['anexo']['name'];
            $anexo['arquivo'] = $_FILES['anexo']['name'];
        } else {
            $tem_erros = TRUE;
            $erros_validacao['anexo'] = 'Envie apenas anexos no formato png ou jpg';
        }
    }
    
    if (!$tem_erros) {
        $veiculos->gravar_anexo($anexo);
    }
}

$veiculos->buscar_veiculo($_GET['id']);
$veiculo = $veiculos->veiculo;

$anexos = $veiculos->buscar_anexos($_GET['id']);

include 'template_estacionamento.php';