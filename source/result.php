<?php
    require_once('config.php');
    require_once('quiz_base.php');

    $name = $_POST['name'];
    $questions = json_decode($_POST['questions'], true);
    $answers = json_decode($_POST['answers']);

    $result_points = Quiz::check_answers($questions, $answers);
    $stats = Quiz::get_results_stat();
    $sum = 0;
    foreach ($stats as $amount) {
        $sum += $amount;
    }

    $max_points = Quiz::get_max_points($questions);
    $mark = Quiz::get_mark($result_points, $max_points);
    $percentage = $result_points/$max_points*100;
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap">
</head>
<body>
    <div class="test_cont">
        <div class="result">
            <h1>Поздравляем <?php echo $name?>! Ваш результат:</h1>
            <p><?php echo $result_points ?>/<?php echo $max_points ?>, <?php echo round($percentage, 2) ?>%</p>
            <b>Ваша оценка: <?php echo $mark?></b>
            <p>Распределение оценок:</p>
            <canvas id="resultsDia"></canvas>
            <button class="start_button" id="restartButton">Пройти заного</button>
        </div>
    </div>
</body>
</html>

<script>
    const stats = <?php echo json_encode($stats); ?>;
    const sum = <?php echo $sum; ?>;
    const canvas = document.getElementById("resultsDia");
    const ctx = canvas.getContext("2d");
    ctx.fillStyle = "red";

    const canvasWidth = canvas.width;
    const canvasHeight = canvas.height;

    const columnWidth = canvasWidth / 5 - ((6*5)/5);

    for (let i=0; i<5; i++) {
        ctx.fillStyle = "red";
        const label = String(i+1);
        const columnHeight = canvasHeight * (Number(stats[label]) / Number(sum));
        let x = i*columnWidth + 5*(i+1);
        let y = canvasHeight - columnHeight;
        ctx.fillRect(x, y, columnWidth, columnHeight);
        ctx.fillStyle = "white";
        ctx.fillText(i + 1, x + columnWidth / 2 - 3, y + columnHeight / 2);
    }

    const restartButton = document.getElementById("restartButton");
    restartButton.onclick = function() {window.top.location.href = "index.php";}
</script>