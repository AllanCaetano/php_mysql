<?php

class Contatos {
    
    public $mysqli;
    public $contatos = array();
    public $contato;
    
    public function __construct($novo_mysqli) {
        $this->mysqli = $novo_mysqli;
    }
    
    public function gravar_contato($contato) {
        $sqlGravar = "INSERT INTO contatos (nome, telefone, email, nascimento, favorito) VALUES ('{$contato['nome']}',"
                                                                                             . " '{$contato['telefone']}',"
                                                                                             . " '{$contato['email']}',"
                                                                                             . " '{$contato['nascimento']}',"
                                                                                             . " '{$contato['favorito']}')";
        $this->mysqli->query($sqlGravar);
    }
    
    public function buscar_contatos() {
        $sqlBusca = 'SELECT * FROM contatos';
        $resultado = $this->mysqli->query($sqlBusca);

        $this->contatos = array();

        while ($contato = mysqli_fetch_assoc($resultado)) {
            $this->contatos[] = $contato;
        }
    }
    
    public function buscar_contato($id) {
        $sqlBusca = "SELECT * FROM contatos WHERE id = " . $id;
        $resultado = $this->mysqli->query($sqlBusca);
        $this->contato = mysqli_fetch_assoc($resultado);
    }

    public function editar_contato($contato) {
        $sqlEditar = "UPDATE contatos SET nome       = '{$contato['nome']}',"
                                      . " telefone   = '{$contato['telefone']}',"
                                      . " email      = '{$contato['email']}',"
                                      . " nascimento = '{$contato['nascimento']}',"
                                      . " favorito   = '{$contato['favorito']}' WHERE id = '{$contato['id']}'";
        $this->mysqli->query($sqlEditar);
    }
    
    public function duplicar_contato($id) {
        $sqlDuplicar = "INSERT INTO contatos (nome, telefone, email, nascimento, favorito) SELECT nome, telefone, email, nascimento, favorito FROM contatos WHERE id = " . $id;
        $this->mysqli->query($sqlDuplicar);
    }

    public function remover_contato($id) {
        $sqlRemover = "DELETE FROM contatos WHERE id = " . $id;
        $resultado = $this->mysqli->query($sqlRemover);
        return $resultado;
    }
    
    public function gravar_anexo($anexo) {
        $sqlGravar = "INSERT INTO anexos_contatos (contato_id, nome, arquivo) VALUES ('{$anexo['contato_id']}',"
                                                                                  . " '{$anexo['nome']}',"
                                                                                  . " '{$anexo['arquivo']}')";
        $this->mysqli->query($sqlGravar);
    }

    function buscar_anexos($contato_id) {
        $sql = "SELECT * FROM anexos_contatos WHERE contato_id = {$contato_id}";
        $resultado = $this->mysqli->query($sql);
        $anexos = array();
        while ($anexo = mysqli_fetch_assoc($resultado)) {
            $anexos[] = $anexo;
        }
        return $anexos;
    }
}

