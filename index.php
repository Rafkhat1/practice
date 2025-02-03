<?php

function checkItems() {
    $items = ['milk', 'beer', 'beer', 'milk', 'milk'];
    
    foreach ($items as $item) {
        if ($item === 'milk') {
            echo "good<br>";
        } elseif ($item === 'beer') {
            echo "bad<br>";
        }
    }
}


function drawRectangle() {
    define("SYMBOL", "&");

    
    $w = isset($_GET['w']) ? (int)$_GET['w'] : 10;
    $h = isset($_GET['h']) ? (int)$_GET['h'] : 5;

    
    for ($i = 0; $i < $h; $i++) {
        echo str_repeat(SYMBOL, $w) . "<br>";
    }
}


checkItems();
echo "<br>"; 
drawRectangle();
?>



