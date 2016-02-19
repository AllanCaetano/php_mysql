<?php

function tem_post() {
    if (count($_POST) > 0) {
        return TRUE;
    }
    return FALSE;
}

function tratar_anexo($anexo) {
    $padrao = '/^.+(\.png|\.jpg)$/';
    $resultado = preg_match($padrao, $anexo['name']);
    
    if (!$resultado) {
        return FALSE;
    }
    
    move_uploaded_file($anexo['tmp_name'], "anexos/{$anexo['name']}");
    return TRUE;
}

function enviar_email($veiculo, $anexos = array()) {
    include '../PHPMailer/PHPMailerAutoload.php';
    $obj_email = new PHPMailer(); // Instancia o objeto
    $obj_email->isSMTP();
    $obj_email->Host = "smtp.gmail.com";
    $obj_email->Port = 587;
    $obj_email->SMTPSecure = "tls";
    $obj_email->SMTPAuth = TRUE;
    $obj_email->Username = "email@gmail.com";
    $obj_email->Password = "senha";
    $obj_email->setFrom("email@gmail.com", "Avisador de Veículos");
    $obj_email->addAddress(EMAIL_NOTIFICACAO);
    $obj_email->CharSet = "UTF-8";
    $obj_email->Subject = "Veículo: {$veiculo['placa']}";
    $corpo = preparar_corpo_email($veiculo, $anexos);
    $obj_email->msgHTML($corpo);
    foreach ($anexos as $anexo) {
        $obj_email->addAttachment("anexos/{$anexo['arquivo']}");
    }
    $obj_email->send();
}

// Aqui é pego o conteudo processado do template_email
function preparar_corpo_email($veiculo, $anexos) {
    
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
