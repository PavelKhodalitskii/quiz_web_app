<?php
    require_once('quiz_base.php');

    $name = $_POST['name'];
    $question_number = $_POST['question_number'];

    function get_next_question($previous_question_ids=null) {
        // if ($previous_question_ids[0]) 
        // {
        //     return new Question($previous_question_ids[0] + 1, "Виталий вы бизнесмэн", array(new Answer(1, 'Да'), new Answer(2, 'Пэльмээнь'), new Answer(3, 'Три'), new Answer(4, 'Четыре'), new Answer(5, 'Пять'), new Answer(6, 'Шесть')));
        // } 
        // else 
        // {
        //     return new Question(1, "Виталий вы бизнесмэн", array(new Answer(1, 'Да'), new Answer(2, 'Пэльмээнь'), new Answer(3, 'Три'), new Answer(4, 'Четыре'), new Answer(5, 'Пять'), new Answer(6, 'Шесть')));
        // }
        return new Question(1, "Виталий вы бизнесмэн", array(new Answer(1, 'Да'), new Answer(2, 'Пэльмээнь'), new Answer(3, 'Три'), new Answer(4, 'Четыре'), new Answer(5, 'Пять'), new Answer(6, 'Шесть')));
    }

    if (isset($_POST['questions']) && isset($_POST['answers'])) {
        $questions = json_decode($questions);
        $answers = json_decode($answers);
        array_push($questions, get_next_question($questions));
    } else {
        $questions = array();
        $answers = array();
        array_push($questions, get_next_question($questions));
    }
    $current_question = end($questions);
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
    <div class="background">
        <div class="question" id="question">
            <form id="question_form" method='post' action='question.php'>
            <input type="hidden" name="name" value=<?php echo $name?>>
            <input type="hidden" name="question_number" value=<?php echo intval($question_number) + 1?>>
            </form>
        </div>
    </div>
</body>
</html>

<script>
    function select_answer(el) {
        checkbox = el.getElementsByID('checkbox');
        console.log(checkbox.id);
    }

    const question_number = <?php echo $question_number; ?>;
    const current_question = <?php echo json_encode($current_question); ?>;
    const questionForm = document.getElementById('question_form');
    questionForm.innerHTML += `<div class="question_number"><span>Вопрос №${question_number}</span></div>`;
    questionForm.innerHTML += `<strong>${current_question.text}</strong>`;

    const formDiv = document.createElement('div');
    formDiv.className = "form_div";
    const answerListContiner = document.createElement('div');
    answerListContiner.className = "answers_list_continer"  

    for (let answer of current_question.answers) {
        const answerDiv = document.createElement('div');
        answerDiv.className = 'answer_container';
        answerDiv.addEventListener('click', function (e) {
            select_answer(e);
        });

        const answerInput = document.createElement('input');
        answerInput.type = "checkbox";
        answerInput.id = `checkbox_${answer.id}`;
        answerInput.value = `${answer.text}`;
        
        const label = `<label for="${answer.id}">${answer.text}</label>`;
        answerDiv.appendChild(answerInput);
        answerDiv.innerHTML += label;
        answerListContiner.appendChild(answerDiv);
    }
    formDiv.appendChild(answerListContiner)
    const nextQuestionButton = document.createElement('input');
    nextQuestionButton.type = 'submit';
    nextQuestionButton.value = 'Далее';
    nextQuestionButton.className = 'start_button';
    formDiv.appendChild(nextQuestionButton)
    questionForm.appendChild(formDiv);
</script>