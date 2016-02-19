<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <title>Gerenciador do Estacionamento</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/estilo.css">
    <script type="text/javascript" src="../assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="../assets/js/jquery.maskedinput.js"></script>
</head>
<body>
    <h1>Gerenciador do Estacionamento</h1>
    
    <?php include 'formulario.php'; ?>
    
    <?php if ($exibir_tabela): ?>
        <?php include 'tabela.php'; ?>
    <?php endif; ?>

    <script type="text/javascript">
        jQuery(function($){
            $("#placa").mask("aaa-9999");
            $("#hora_entrada").mask("99:99");
            $("#hora_saida").mask("99:99");
        });    
    </script>
    
</body>
</html> 

