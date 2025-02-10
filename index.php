<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Practice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }
        h1, h2 {
            text-align: center;
        }
        .container {
            width: 80%;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        p {
            font-size: 18px;
            line-height: 1.6;
        }
        .output {
            background-color: #e9f7fe;
            padding: 10px;
            border-radius: 5px;
            margin: 10px 0;
            font-size: 16px;
            border: 1px solid #d1e7fd;
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Practice in company</h1>
        
        <h2>1 -> Round_1 -> task_1</h2>
        <div class="output">
            <?php
            $arrayOfElements = array('milk', 'beer', 'beer', 'milk', 'milk');
            foreach ($arrayOfElements as $element) {
                if ($element == 'milk') {
                    echo '<p>good</p>';
                } else {
                    echo '<p>bad</p>';
                }
            }
            ?>
        </div>

        <h2>2 -> Round_1 -> task_2</h2>
        <div class="output">
            <?php
            define('CHAR', '&');
            $w = isset($_GET['w']) ? (int)$_GET['w'] : 20;
            $h = isset($_GET['h']) ? (int)$_GET['h'] : 7;
            for ($i = 0; $i < $h; $i++) {
                echo str_repeat(CHAR, $w) . "<br>";
            }
            ?>
        </div>

        <h2>3 -> Round_3 -> task_3</h2>
        <div class="output">
            <?php
            $seconds = isset($_GET['w']) ? (int)$_GET['w'] : 0;
            echo $seconds . "<br>";
            $hours = floor($seconds / 3600);
            if ($hours >= 2) {
                echo "Осталось $hours часа";
            } elseif ($hours == 1) {
                echo "Остался 1 час";
            } else {
                echo "Осталось менее часа";
            }
            ?>
        </div>

        <h2>4 -> Round_2 -> task_4</h2>
        <div class="output">
            <?php
            $string = isset($_GET['w']) ? $_GET['w'] : "Hello, world";
            $length = strlen($string) + 2;
            echo str_repeat('*', $length) . "<br>";
            echo '*' . $string . '*' . "<br>";
            echo str_repeat('*', $length);
            ?>
        </div>

        <h2>5 -> Round_3 -> task_5</h2>
        <div class="output">
            <?php
            function validateInput() {
                if (!isset($_GET['w'])) {
                    return "Вы нажали 'Отмена'";
                }
                $input = $_GET['w'];
                if (is_numeric($input)) {
                    $number = (int)$input;
                    if ($number > 0) {
                        return "Вы ввели положительное число";
                    } elseif ($number < 0) {
                        return "Вы ввели отрицательное число";
                    } else {
                        return "Вы ввели ноль";
                    }
                } else {
                    return "Вы ввели не число";
                }
            }
            echo validateInput();
            ?>
        </div>

        <h2>6 -> Round_4 -> Insert data into database</h2>
        <div class="output">
            <?php
            
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "practice_db";

            
            $conn = new mysqli($servername, $username, $password, $dbname);

           
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            
            if (isset($_GET['message'])) {
                $message = $_GET['message'];
                
                
                $stmt = $conn->prepare("INSERT INTO messages (content) VALUES (?)");

                if ($stmt === false) {
                    
                    echo "Ошибка подготовки запроса: " . $conn->error;
                } else {
                    
                    $stmt->bind_param("s", $message);

                    if ($stmt->execute()) {
                        echo "Сообщение успешно добавлено!";
                    } else {
                        echo "Ошибка при выполнении запроса: " . $stmt->error;
                    }
                }
            }
            ?>
            <form action="" method="GET">
                <label for="message">Введите сообщение:</label><br>
                <input type="text" id="message" name="message" required><br><br>
                <input type="submit" value="Отправить">
            </form>
        </div>
    </div>

</body>
</html>
