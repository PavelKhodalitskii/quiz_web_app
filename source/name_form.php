<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap">
</head>
    <div class="test_cont">
        <div class="greetings">
            <h1>Введите своё имя:</h1> 
            <form class="name_form" id='quiz_start_form' action="question.php" method="post">
                <input class="name_input" name="name" id="name" type="text" value="Альберт">
                <input class="start_button" type="submit" value="Начать">
            </form>
        </div>
    </div>
</html>