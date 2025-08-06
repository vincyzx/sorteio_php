<?php
    $contador = 1;
    $soma = 0;
    while($contador <= 5){
        $contador++;
        $soma = $soma + $contador;
        echo" - $contador";
    }
    echo"<br> soma de todos esses números = $soma";    
?>