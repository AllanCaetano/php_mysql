<h1>Placa: <?php echo $veiculo['placa']; ?></h1>

<p>
    <strong>Marca: </strong>
    <?php echo $veiculo['marca']; ?>
</p>

<p>
    <strong>Modelo: </strong>
    <?php echo $veiculo['modelo']; ?>
</p>

<p>
    <strong>Hora de entrada: </strong>
    <?php echo $veiculo['hora_entrada']; ?>
</p>

<p>
    <strong>Hora de saída: </strong>
    <?php echo $veiculo['hora_saida']; ?>
</p>

<?php if (count($anexos) > 0): ?>
    <p>
        <strong>Atenção!</strong>
        Este veículo contém anexos!
    </p>
<?php endif; ?>
