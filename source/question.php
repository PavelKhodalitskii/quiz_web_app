<?php
    require_once('quiz_base.php');
    require_once('config.php');

    $next = "question.php";
    $name = $_POST["name"];
    if (isset($_POST['question_number'])) {
        $question_number = $_POST['question_number'];
    } else {
        $question_number = 1;
    }

    if (isset($_POST['questions']) && isset($_POST['answers'])) {
        $questions = json_decode($_POST['questions'], TRUE);
        $answers = json_decode($_POST['answers']);
    } else {
        $questions = array();
        $answers = array();
    }

    if (intval($question_number) >= $MAX_QUESTIONS) {
        $next="result.php";
    }

    $current_question = Quiz::get_next_question($questions)
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Ubuntu:wght@700&display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap">
</head>
    <div class="test_cont">
        <div class="question" id="question">
            <form id="question_form" method='post' action=<?php echo $next?>>
                <input type="hidden" name="name" value=<?php echo $name?>> 
                <input type="hidden" name="question_number" value=<?php echo intval($question_number) + 1; ?>>
            </form>
        </div>
    </div>
</html>

<script>
    let givenAnswers = [];

    let questions = <?php echo json_encode($questions); ?>;
    console.log(questions);
    let answers = <?php echo json_encode($answers); ?>;
    console.log(answers);

    function select_answer(event) {
        element = event.srcElement;
        if (element.id.startsWith('answer')) {
            answer_id = element.id.slice(7, element.id.length)
            if (givenAnswers.includes(answer_id)) {
                element.className = "answer_button";
            } else {
                element.className = "answer_button_selected";
                givenAnswers.push(answer_id)
            }
        }
    }

    function get_additional_data(currentQuestion, givenAnswers) {
        let questions = <?php echo json_encode($questions); ?>;
        let answers = <?php echo json_encode($answers); ?>;
        questions.push(currentQuestion);
        answers.push(givenAnswers);
        let additionalData = {
            "questions": questions,
            "answers": answers
        };
        return additionalData;
    }

    const questionNumber = <?php echo $question_number; ?>;
    const currentQuestion = <?php echo json_encode($current_question); ?>;

    const questionForm = document.getElementById('question_form');
    questionForm.innerHTML += `<div class="question_number"><span>Вопрос №${questionNumber}</span></div>`;
    questionForm.innerHTML += `<strong>${currentQuestion.text}</strong>`;

    const formDiv = document.createElement('div');
    formDiv.className = "form_div";

    const answerListContiner = document.createElement('div');
    answerListContiner.className = "answers_list_continer"  

    for (let answer of currentQuestion.answers) {
        const answerButton = document.createElement('input');
        answerButton.type = "button";
        answerButton.value = answer.text;
        answerButton.className = 'answer_button';
        answerButton.id = `answer_${answer.id}`;
        answerButton.addEventListener('click', function (e) {
            select_answer(e);
        });
        answerListContiner.appendChild(answerButton);
    }

    formDiv.appendChild(answerListContiner);
    const nextQuestionButton = document.createElement('input');
    nextQuestionButton.type = 'submit';
    nextQuestionButton.value = 'Далее';
    nextQuestionButton.className = 'start_button';

    questionForm.addEventListener('submit', function (e) {
        e.preventDefault()
        let additionalData = get_additional_data(currentQuestion, givenAnswers);

        const hiddenInputQuestions = document.createElement('input');
        hiddenInputQuestions.type = "hidden";
        hiddenInputQuestions.name = "questions";
        hiddenInputQuestions.value = JSON.stringify(additionalData.questions);
        this.appendChild(hiddenInputQuestions);

        const hiddenInputAnswers = document.createElement('input');
        hiddenInputAnswers.type = "hidden";
        hiddenInputAnswers.name = "answers";
        hiddenInputAnswers.value = JSON.stringify(additionalData.answers);
        this.appendChild(hiddenInputAnswers);


        this.submit();
    });
    
    formDiv.appendChild(nextQuestionButton)
    questionForm.appendChild(formDiv);
</script>