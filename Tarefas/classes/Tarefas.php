<?php

class Tarefas {
    
    public $mysqli;
    public $tarefas = array();
    public $tarefa;

    public function __construct($novo_mysqli) {
        $this->mysqli = $novo_mysqli;
    }
    
    public function gravar_tarefa($tarefa) {
        $sqlGravar = "INSERT INTO tarefas (nome, descricao, prazo, prioridade, concluida) VALUES ('{$tarefa['nome']}',"
                                                                                              . " '{$tarefa['descricao']}',"
                                                                                              . " '{$tarefa['prazo']}',"
                                                                                              . " '{$tarefa['prioridade']}',"
                                                                                              . " '{$tarefa['concluida']}')";
        $this->mysqli->query($sqlGravar);
    }
    
    public function buscar_tarefas() {
        $sqlBusca = "SELECT * FROM tarefas";
        $resultado = $this->mysqli->query($sqlBusca);

        $this->tarefas = array();

        while ($tarefa = mysqli_fetch_assoc($resultado)) {
            $this->tarefas[] = $tarefa;
        }
    }
    
    public function buscar_tarefa($id) {
        $sqlBusca = "SELECT * FROM tarefas WHERE id = " . $id;
        $resultado = $this->mysqli->query($sqlBusca);
        $this->tarefa =  mysqli_fetch_assoc($resultado);
    }
    
    public function editar_tarefa($tarefa) {
        $sqlEditar = "UPDATE tarefas SET nome       = '{$tarefa['nome']}',"
                                     . " descricao  = '{$tarefa['descricao']}',"
                                     . " prioridade = '{$tarefa['prioridade']}',"
                                     . " prazo      = '{$tarefa['prazo']}',"
                                     . " concluida  = '{$tarefa['concluida']}' WHERE id = '{$tarefa['id']}'";
        $this->mysqli->query($sqlEditar);
    }
    
    public function duplicar_tarefa($id) {
        $sqlDuplicar = "INSERT INTO tarefas (nome, descricao, prioridade, prazo, concluida)"
                    . " SELECT nome, descricao, prioridade, prazo, concluida FROM tarefas WHERE id = " . $id;
        $this->mysqli->query($sqlDuplicar);
    }
    
    public function remover_tarefa($id) {
        $sqlRemover = "DELETE FROM tarefas WHERE id = " . $id;
        $this->mysqli->query($sqlRemover);
    }
    
    public function gravar_anexo($anexo) {
        $sqlGravar = "INSERT INTO anexos_tarefas (tarefa_id, nome, arquivo) VALUES ('{$anexo['tarefa_id']}',"
                                                                                . " '{$anexo['nome']}',"
                                                                                . " '{$anexo['arquivo']}')";
        $this->mysqli->query($sqlGravar);
    }

    public function buscar_anexos($tarefa_id) {
        $sql = "SELECT * FROM anexos_tarefas WHERE tarefa_id = {$tarefa_id}";
        $resultado = $this->mysqli->query($sql);

        $anexos = array();

        while ($anexo = mysqli_fetch_assoc($resultado)) {
            $anexos[] = $anexo;
        }
        return $anexos;
    }
}