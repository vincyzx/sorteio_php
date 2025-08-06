<?php
    for($i = 1; $i <= 10; $i++){
        echo "<h2>Tabuada do $i</h2>";
        for($j = 1; $j <= 10; $j++){
            $resultado = $i * $j;
            echo "$i x $j = $resultado<br>";
        }
    }
?>