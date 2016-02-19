<?php

function traduz_prioridade($codigo) {
    switch ($codigo) {
        case 1:
            $prioridade = 'Baixa';
            break;
        case 2:
            $prioridade = 'Média';
            break;
        case 3:
            $prioridade = 'Alta';
            break;
    }
    return $prioridade;
}

function traduz_concluida($codigo) {
    if ($codigo == 0) {
        $concluida = 'Não';
    } else {
        $concluida = 'Sim';
    }
    return $concluida;
}

function traduz_data_para_banco($data) {
    if ($data == "") {
        return "";
    }
    $dados = explode("/", $data);
    $data_mysql = "{$dados[2]}-{$dados[1]}-{$dados[0]}";
    
    return $data_mysql;
}

function traduz_data_para_exibir($data) {
    if ($data == "" || $data == "0000-00-00") {
        return "";
    }
    $dados = explode("-", $data);
    $data_exibir = "{$dados[2]}/{$dados[1]}/{$dados[0]}";
    
    return $data_exibir;
}

function tem_post() {
    if (count($_POST) > 0) {
        return TRUE;
    }
    return FALSE;
}

function validar_data($data) {
    $dados = explode('/', $data);
    
    $dia = $dados[0];
    $mes = $dados[1];
    $ano = $dados[2];
    
    $resultado = checkdate($mes, $dia, $ano);
    return $resultado;
}

function tratar_anexo($anexo) {
    $padrao = '/^.+(\.pdf|\.zip)$/';
    $resultado = preg_match($padrao, $anexo['name']);
    
    if (!$resultado) {
        return FALSE;
    }
    
    move_uploaded_file($anexo['tmp_name'], "anexos/{$anexo['name']}");
    return TRUE;
}

function enviar_email($tarefa, $anexos = array()) {
    include '../PHPMailer/PHPMailerAutoload.php';
    $obj_email = new PHPMailer(); // Instancia o objeto
    $obj_email->isSMTP();
    $obj_email->Host = "smtp.gmail.com";
    $obj_email->Port = 587;
    $obj_email->SMTPSecure = "tls";
    $obj_email->SMTPAuth = TRUE;
    $obj_email->Username = "email@gmail.com";
    $obj_email->Password = "senha";
    $obj_email->setFrom("email@gmail.com", "Avisador de Tarefas");
    $obj_email->addAddress(EMAIL_NOTIFICACAO);
    $obj_email->CharSet = "UTF-8";
    $obj_email->Subject = "Aviso da tarefa: {$tarefa['nome']}";
    $corpo = preparar_corpo_email($tarefa, $anexos);
    $obj_email->msgHTML($corpo);
    foreach ($anexos as $anexo) {
        $obj_email->addAttachment("anexos/{$anexo['arquivo']}");
    }
    $obj_email->send();
}

// Aqui é pego o conteudo processado do template_email
function preparar_corpo_email($tarefa, $anexos) {
    
    // Impedi que o processamento vá para o navevador
    ob_start();
    
    // Inclui o arquivo template_email
    include 'template_email.php';
    
    // Guarda o conteudo do arquivo em uma variavel
    $corpo = ob_get_contents();
    
    // Os processamentos voltam a ir para o navegador
    ob_end_clean();
    
    return $corpo;
}
