<?php

class Veiculos {
    
    public $mysqli;
    public $veiculos = array();
    public $veiculo;
    
    public function __construct($novo_mysqli) {
        $this->mysqli = $novo_mysqli;
    }
    
    public function gravar_veiculo($veiculo) {
        $sqlGravar = "INSERT INTO veiculos (placa, marca, modelo, hora_entrada, hora_saida) VALUES ('{$veiculo['placa']}',"
                                                                                                . " '{$veiculo['marca']}',"
                                                                                                . " '{$veiculo['modelo']}',"
                                                                                                . " '{$veiculo['hora_entrada']}',"
                                                                                                . " '{$veiculo['hora_saida']}')";
        $this->mysqli->query($sqlGravar);
    }
    
    public function buscar_veiculos() {
        $sqlBusca = 'SELECT * FROM veiculos';
        $resultado = $this->mysqli->query($sqlBusca);

        $this->veiculos = array();

        while ($veiculo = mysqli_fetch_assoc($resultado)) {
            $this->veiculos[] = $veiculo;
        }
    }
    
    public function buscar_veiculo($id) {
        $sqlBusca = "SELECT * FROM veiculos WHERE id = " . $id;
        $resultado = $this->mysqli->query($sqlBusca);
        $this->veiculo = mysqli_fetch_assoc($resultado);
    }

    public function editar_veiculo($veiculo) {
        $sqlEditar = "UPDATE veiculos SET placa        = '{$veiculo['placa']}',"
                                      . " marca        = '{$veiculo['marca']}',"
                                      . " modelo       = '{$veiculo['modelo']}',"
                                      . " hora_entrada = '{$veiculo['hora_entrada']}',"
                                      . " hora_saida   = '{$veiculo['hora_saida']}' WHERE id = '{$veiculo['id']}'";
        $resultado = $this->mysqli->query($sqlEditar);
        return $resultado;
    }
    
    public function duplicar_veiculo($id) {
        $sqlDuplicar = "INSERT INTO veiculos (placa, marca, modelo, hora_entrada, hora_saida) SELECT placa, marca, modelo, hora_entrada, hora_saida FROM veiculos WHERE id = " . $id;
        $resultado = $this->mysqli->query($sqlDuplicar);
        return $resultado;
    }

    public function remover_veiculo($id) {
        $sqlRemover = "DELETE FROM veiculos WHERE id = " . $id;
        $resultado = $this->mysqli->query($sqlRemover);
        return $resultado;
    }
    
    public function gravar_anexo($anexo) {
        $sqlGravar = "INSERT INTO anexos_veiculos (veiculo_id, nome, arquivo) VALUES ('{$anexo['veiculo_id']}',"
                                                                                  . " '{$anexo['nome']}',"
                                                                                  . " '{$anexo['arquivo']}')";
        $this->mysqli->query($sqlGravar);
    }

    public function buscar_anexos($veiculo_id) {
        $sql = "SELECT * FROM anexos_veiculos WHERE veiculo_id = {$veiculo_id}";
        $resultado = $this->mysqli->query($sql);
        $anexos = array();
        while ($anexo = mysqli_fetch_assoc($resultado)) {
            $anexos[] = $anexo;
        }
        return $anexos;
    }
}
