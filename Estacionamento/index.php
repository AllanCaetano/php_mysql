<?php
session_start();
include 'banco.php';
include 'ajudantes.php';
include 'classes/Veiculos.php';

$veiculos = new Veiculos($mysqli);

$exibir_tabela = TRUE;
$tem_erros = FALSE;
$erros_validacao = array();

if (tem_post()) {
    
    $veiculo = array();
    
    if (isset($_POST['placa']) && strlen($_POST['placa']) > 0) {
        $veiculo['placa'] = $_POST['placa'];
    } else {
        $tem_erros = TRUE;
        $erros_validacao['placa'] = 'O campo placa é obrigatorio.';
    }
    
    if (isset($_POST['marca']) && strlen($_POST['marca']) > 0) {
        $veiculo['marca'] = $_POST['marca'];
    } else {
        $tem_erros = TRUE;
        $erros_validacao['marca'] = 'O campo marca é obrigatorio.';
    }
    
    if (isset($_POST['modelo']) && strlen($_POST['modelo'])) {
        $veiculo['modelo'] = $_POST['modelo'];
    } else {
        $tem_erros = TRUE;
        $erros_validacao['modelo'] = 'O campo modelo é obrigatorio.';
    }
    
    if (isset($_POST['hora_entrada']) && strlen($_POST['hora_entrada']) > 0) {
        $veiculo['hora_entrada'] = $_POST['hora_entrada'];
    } else {
        $tem_erros = TRUE;
        $erros_validacao['hora_entrada'] = 'O campo hora de entrada é obrigatorio.';
    }
    
    if (isset($_POST['hora_saida']) && strlen($_POST['hora_saida']) > 0) {
        $veiculo['hora_saida'] = $_POST['hora_saida'];
    } else {
        $tem_erros = TRUE;
        $erros_validacao['hora_saida'] = 'O campo hora de saída é obrigatorio.';
    }
    
    if (!$tem_erros) {
        $veiculos->gravar_veiculo($veiculo);
        
        if (isset($_POST['lembrete']) && $_POST['lembrete'] == 1) {
            enviar_email($veiculo);
        }
        
        header('Location: index.php');
        die();
    }
}

$veiculo = array(
    'id'           => 0,
    'placa'        => (isset($_POST['placa'])) ? $_POST['placa'] : '',
    'marca'        => (isset($_POST['marca'])) ? $_POST['marca'] : '',
    'modelo'       => (isset($_POST['modelo'])) ? $_POST['modelo'] : '',
    'hora_entrada' => (isset($_POST['hora_entrada'])) ? $_POST['hora_entrada'] : '',
    'hora_saida'   => (isset($_POST['hora_saida'])) ? $_POST['hora_saida'] : ''
);

$veiculos->buscar_veiculos();

include 'template.php';
        