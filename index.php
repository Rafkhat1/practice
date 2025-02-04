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


function remainingWorkHours() {
    if (!isset($_GET['w'])) {
        return;
    }

    $seconds = (int)$_GET['w'];
    echo $seconds . "<br>";

    $hours = floor($seconds / 3600);

    if ($hours >= 2) {
        echo "Осталось $hours часов";
    } elseif ($hours == 1) {
        echo "Остался 1 час";
    } else {
        echo "Осталось менее часа";
    }
    echo "<br><br>";
}


function printBox() {
    if (!isset($_GET['text'])) {
        return;
    }

    $text = trim($_GET['text']);
    $length = mb_strlen($text) + 4; 

    echo str_repeat("*", $length) . "<br>";
    echo "* " . $text . " *<br>";
    echo str_repeat("*", $length) . "<br><br>";
}


function validateNumber() {
    if (!isset($_GET['num'])) {
        return;
    }

    $num = $_GET['num'];

    if ($num === "") {
        echo "Вы нажали \"Отмена\"";
    } elseif (!is_numeric($num)) {
        echo "Вы ввели не число";
    } else {
        $num = (int)$num;
        if ($num > 0) {
            echo "Вы ввели положительное число";
        } elseif ($num < 0) {
            echo "Вы ввели отрицательное число";
        } else {
            echo "Вы ввели ноль";
        }
    }
    echo "<br><br>";
}


remainingWorkHours();
printBox();
validateNumber();



?>



