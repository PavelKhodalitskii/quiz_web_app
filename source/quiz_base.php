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
        public static $questions = array();
        public $id;
        public $text;
        public $answers;

        function __construct($id, $text, $answers)
        {
            $this->id = $id;
            $this->text = $text;
            $this->answers = $answers;

            for ($i = 0; $i < count(Question::$questions); $i++) {
                if (Question::$questions[$i]['id'] == $id) {
                    unset(Question::$questions[$i]);
                }
            }
        }

        public static function get_next_question($previous_question_ids=null) {
            if (count(Question::$questions) == 0) {
                $path = "data/questions/questions.json";
                $questions_json = file_get_contents($path);
            
                if ($questions_json === false) {
                    die('Error reading the JSON file');
                }

                $question_json_data = json_decode($questions_json, true);

                foreach ($question_json_data as $question_json) {
                    array_push(Question::$questions, $question_json);
                }
            }

            $next_question_id = array_rand(Question::$questions);
            $next_question = Question::$questions[$next_question_id];
            
            $answers_json = $next_question['answers'];
            $answers = array();

            foreach ($answers_json as $answer) {
                $new_answer = new Answer($id=$answer['id'], $text=$answer['text']);
                array_push($answers, $new_answer);
            }

            $new_question = new Question($id=$next_question['id'], $text=$next_question['text'], $answers=$answers);
            return $new_question;
        }
    }

    function check_correctness($answers) {
    }
?>