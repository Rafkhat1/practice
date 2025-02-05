<?php

require "db.php"; 

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


function generateRandomTemperatures($min, $max, $days = 7) {
    return array_map(fn() => rand($min, $max), range(1, $days));
}


$southData = generateRandomTemperatures(13, 25);
$westData = generateRandomTemperatures(13, 25);
$eastData = generateRandomTemperatures(13, 25);
$northData = generateRandomTemperatures(13, 25);


function insertWeatherData($pdo, $poleName, $data) {
    $stmt = $pdo->prepare("DELETE FROM weather_data WHERE pole_name = :pole_name");
    $stmt->execute(['pole_name' => $poleName]); // Удаляем старые данные

    $stmt = $pdo->prepare("INSERT INTO weather_data (pole_name, pole_data) VALUES (:pole_name, :pole_data)");
    foreach ($data as $temperature) {
        $stmt->execute(['pole_name' => $poleName, 'pole_data' => $temperature]);
    }
}


insertWeatherData($pdo, 'south', $southData);
insertWeatherData($pdo, 'west', $westData);
insertWeatherData($pdo, 'east', $eastData);
insertWeatherData($pdo, 'north', $northData);


function calculateAverage($pdo, $poleName) {
    $stmt = $pdo->prepare("SELECT AVG(pole_data) as avg_temp FROM weather_data WHERE pole_name = :pole_name");
    $stmt->execute(['pole_name' => $poleName]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return round($result['avg_temp'], 2);
}


function output($pdo) {
    echo "<h2>Средние температуры:</h2>";
    echo "Юг: " . calculateAverage($pdo, 'south') . "°C<br>";
    echo "Запад: " . calculateAverage($pdo, 'west') . "°C<br>";
    echo "Восток: " . calculateAverage($pdo, 'east') . "°C<br>";
    echo "Север: " . calculateAverage($pdo, 'north') . "°C<br>";
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Practice_In_Company</title>
</head>
<body>
    <header>Practice in Company</header>
    <main>
        <div class="firstDay">
            <h2>First Task</h2>
            <p><?php checkItems(); ?></p>
            <p><?php drawRectangle(); ?></p>
        </div>
        <div class="secondDay">
            <h2>Second Task</h2>
            <p><?php remainingWorkHours(); ?></p>
            <p><?php printBox(); ?></p>
            <p><?php validateNumber(); ?></p>
        </div>
        <div class="thirdDay">
            <h2>Weather Data</h2>
            <p><?php output($pdo); ?></p>
        </div>
    </main>
</body>
</html>
