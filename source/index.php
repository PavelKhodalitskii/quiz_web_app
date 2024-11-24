<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Квиз! Насколько ты плохой веб-программист</title>
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap">
</head>
<body>
    <div class="background">
        <div class="greetings">
            <h1>Введите своё имя:</h1>        
            <form class="name_form" id='quiz_start_form' action="question.php" method="post">
                <input class="name_input" name="name" id="name" type="text" value="Альберт">
                <input class="start_button" type="submit" value="Начать">
                <input type="hidden" name="question_number", value="1">
            </form>
        </div>
    </div>
</body>
<!-- <script>
    document.getElementById('quiz_start_form').addEventListener('submit', function(event) {
        event.preventDefault();
        let formData = new FormData(this);
        formData.set("question_number", "1");

        for(let [name, value] of formData) {
            alert(`${name} = ${value}`); // key1=value1, потом key2=value2
        }

        let response = fetch('question.php', {
            method: "POST",
            body: formData
        });
    });
</script> -->
</html>