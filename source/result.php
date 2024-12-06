<?php
    require_once('config.php');

    $name = $_POST['name'];
    $questions = json_decode($_POST['questions']);
    $answers = json_decode($_POST['answers']);
    $result = 4
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Результат: Квиз! Насколько ты плохой веб-программист</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap">
</head>
<body>
<div class="background">
        <div class="question">
            <p>Поздравляем <?php echo $name?>! Ваш результат:<p>
            <p><?php echo $result ?>/<?php echo $MAX_QUESTIONS ?></p>
        </div>
    </div>
</body>
</html>