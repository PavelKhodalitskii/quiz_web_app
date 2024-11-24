<?php
    class Answer {
        public $id;
        public $text = "";

        function __construct($id, $text)
        {
            $this->id = $id;
            $this->text = $text;
        }
    }

    class Question {
        public $id;
        public $text;
        public $answers;

        function __construct($id, $text, $answers)
        {
            $this->id = $id;
            $this->text = $text;
            $this->answers = $answers;
        }
    }
    $answers = array(new Answer(1, 'Да'), new Answer(2, 'Пэльмээнь'), new Answer(3, 'Три'), new Answer(4, 'Четыре'), new Answer(5, 'Пять'), new Answer(6, 'Шесть'));
    $quest_1 = new Question(1, 'Виталий вы бизнесмэн?', $answers);
    $questions = array($quest_1, $quest_1, $quest_1, $quest_1, $quest_1, $quest_1, $quest_1, $quest_1, $quest_1, $quest_1, $quest_1, $quest_1);
?>

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
    <!-- <div class='test_bg'> -->
    <form class="questions_form" action="results.php" method="post">
        <div id="questions_list" class="questions_list">
        </div>
        <input class="start_button" type="submit" value="Получить результат!">
    </form>
</body>
</html>

<script>
    console.log('test')
    const questions = <?php echo json_encode($questions, $depth=2); ?>;
    console.log('test')
    const questionsDiv = document.getElementById('questions_list')

    let counter = 0
    for (let question of questions) {
        counter += 1
        const questionDiv = document.createElement('div')
        questionDiv.className = "question"
        questionDiv.innerHTML += `<div class="question_number"><span>Вопрос №${counter}</span></div>`
        questionDiv.innerHTML += `<strong>${question.text}</strong>`

        const answersDiv = document.createElement('div')     
        answersDiv.className = "answers_list_container"

        // const unorderedList = document.createElement('ul')
        // unorderedList.className = "answers_list"

        for (let answer of question.answers) {
            // const answerLi = document.createElement('li')
            // answerLi.innerHTML += `<input type='checkbox' value=${answer.text}>`
            // unorderedList.appendChild(answerLi)
            const answerDiv = document.createElement('div')
            const answerInput = document.createElement('input')
            answerInput.type = "checkbox"
            answerInput.id = `${answer.id}`
            answerInput.value = `${answer.text}`
            
            const label = `<label for="${answer.id}">${answer.text}</label>`
            answerDiv.appendChild(answerInput)
            answerDiv.innerHTML += label
            answersDiv.appendChild(answerDiv)
        }
            
        // answersDiv.appendChild(unorderedList)
        questionDiv.appendChild(answersDiv)
        questionsDiv.appendChild(questionDiv)
    }
</script> 
