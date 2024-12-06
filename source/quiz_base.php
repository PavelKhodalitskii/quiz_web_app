<?php
    require_once('config.php');

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

        public static function get_next_question($previous_question_ids=null) {
            $next_question = random_int(0, 255);

            $path = sprintf("%s/questions/questions.json", $DATA_STORE_PATH);
            $questions_json = file_get_contents($path);
            
            if ($questions_json === false) {
                die('Error reading the JSON file');
            }

            $question_json_data = json_decode($json, true);

            foreach ($question_json_data as $question_json) {
                echo $question_json;
            }

            return new Question(1, "Виталий вы бизнесмэн?", array(new Answer(1, 'Да'), new Answer(2, 'Пэльмээнь'), new Answer(3, 'Три'), new Answer(4, 'Четыре'), new Answer(5, 'Пять'), new Answer(6, 'Шесть')));
        }
    }

    function check_correctness($answers) {
    }
?>