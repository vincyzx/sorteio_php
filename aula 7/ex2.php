<?php
    $nomes = ["João" => 21, "Maria" => 19, "Karilu" => 40];

    echo"<pre>";
    print_r($nomes);
    echo"</pre>";
    echo"<br>";

    foreach($nomes as $nomes => $idade){
        echo"$nomes tem $idade anos. <br>";
    }
?>