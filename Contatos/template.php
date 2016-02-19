<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Gerenciador de Contatos</title>
    <link rel="stylesheet" type="text/css" href="../assets/css/estilo.css">
    <script type="text/javascript" src="../assets/js/jquery.min.js"></script>
    <script type="text/javascript" src="../assets/js/jquery.maskedinput.js"></script>
</head>
<body>
    <h1>Gerenciador de Contatos</h1>
    
    <?php include 'formulario.php'; ?>
    
    <?php if ($exibir_tabela): ?>
        <?php include 'tabela.php'; ?>
    <?php endif; ?>
    
    <script type="text/javascript">
        jQuery(function($){
            $("#nascimento").mask("99/99/9999");
            $("#telefone").mask("(99) 9999-9999");
        });    
    </script>
    
</body>
</html>
