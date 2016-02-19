<?php
session_start();

include 'banco.php';
include 'ajudantes.php';
include 'classes/Veiculos.php';

$veiculos = new Veiculos($mysqli);

$exibir_tabela = FALSE;
$tem_erros = FALSE;
$erros_validacao = array();

if ($_POST['atualizar']) {
    if (tem_post()) {
        $veiculo = array();

        $veiculo['id'] = $_POST['id'];

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
            $veiculos->editar_veiculo($veiculo);
            
            if (isset($_POST['lembrete']) && $_POST['lembrete'] == 1) {
                $anexos = $veiculos->buscar_anexos($veiculo['id']);
                enviar_email($veiculo, $anexos);
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

$veiculo['placa'] = isset($_POST['placa']) ? $_POST['placa'] : $veiculo['placa'];
$veiculo['marca'] = isset($_POST['marca']) ? $_POST['marca'] : $veiculo['marca'];
$veiculo['modelo'] = isset($_POST['modelo']) ? $_POST['modelo'] : $veiculo['modelo'];
$veiculo['hora_entrada'] = isset($_POST['hora_entrada']) ? $_POST['hora_entrada'] : $veiculo['hora_entrada'];
$veiculo['hora_saida'] = isset($_POST['hora_saida']) ? $_POST['hora_saida'] : $veiculo['hora_saida'];

$veiculos->buscar_veiculo($_GET['id']);
$veiculo = $veiculos->veiculo;

include 'template.php';
