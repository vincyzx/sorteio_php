<?php
    //algoritimo que gera números para um sorteio
    $numeros = range(1, 60);

    //embaralha os números
    shuffle($numeros);
    
    $resultado = array();

    for($i = 0; $i < 6; $i++){
        //seleciona os 6 primeiros números
        $resultado[] = $numeros[$i];
    }
    //ordena os números selecionados
    sort($resultado);
    echo "Números sorteados:";
    foreach($resultado as $numero) {
        echo " $numero";
    }
    echo "<br>";
?>