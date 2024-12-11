<?php
    class Answer {
        public $id;
        public $text = "";
        public $correct = FALSE;

        function __construct($id, $text, $correct)
        {
            $this->id = $id;
            $this->text = $text;
            $this->correct = $correct;
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

    class Quiz {
        public static $path = "data/statistics/results.json";
        private $questions_path = "data/questions/questions.json";

        public static function get_questions_data() {
            $path = "data/questions/questions.json";
            $questions_json = file_get_contents($path);
        
            if ($questions_json === false) {
                die('Error reading the JSON file');
            }

            $question_json_data = json_decode($questions_json, true);
            return $question_json_data;
        }

        public static function get_next_question($questions=null) {
            $existing_quesitons_ids = array();

            foreach ($questions as $question) {
                array_push($existing_quesitons_ids, $question['id']);
            }

            $question_json_data = Quiz::get_questions_data();
            $questions_set = array();
            foreach ($question_json_data as $question_json) {
                array_push($questions_set, $question_json);
            }

            if (count($questions) == count($questions_set)) {
                return NULL;
            }
            while (TRUE) {
                $next_question_id = array_rand($questions_set);
                if (in_array($next_question_id, $existing_quesitons_ids) == FALSE) {
                    break;
                }
            }

            $next_question = $questions_set[$next_question_id];
            $answers_json = $next_question['answers'];
            $answers = array();

            foreach ($answers_json as $answer) {
                $new_answer = new Answer($id=$answer['id'], $text=$answer['text'], $correct=$answer['correct']);
                array_push($answers, $new_answer);
            }

            $new_question = new Question($id=$next_question['id'], $text=$next_question['text'], $answers=$answers);
            return $new_question;
        }

        public static function get_results_stat() {
            $path = Quiz::$path;
            $labels_stat_content = file_get_contents($path);
            
            if ($labels_stat_content === false) {
                die('Error reading the JSON file');
            }

            $labels_stat = json_decode($labels_stat_content, true);

            return $labels_stat;
        }

        public static function increment_label($label) {
            $path = Quiz::$path;
            $labels_stat = Quiz::get_results_stat();
            $labels_stat[$label] = intval($labels_stat[$label]) + 1;
            $file = fopen($path, 'w');
            fwrite($file, json_encode($labels_stat));
            fclose($file);
        }

        public static function get_mark($points, $max_points) {
            $result = $points / $max_points;
            if ($result < 0.2):
                return 1;
            elseif ($result < 0.5):
                return 2;
            elseif ($result < 0.65):
                return 3;
            elseif ($result < 0.9):
                return 4;
            endif;
            return 5;
        }

        public static function get_max_points($questions) {
            $correct_answers = 0;
            foreach($questions as $question) {
                $answers = $question['answers'];
                foreach($answers as $answer) {
                    if ((bool)$answer['correct']) {
                        $correct_answers += 1;
                    }
                }
            }
            return $correct_answers;
        }

        public static function check_answers($questions, $given_answers) {
            if (count($given_answers) == 0) {
                return 0;
            }
            $result = 0;
            $count = 0;
            foreach($questions as $question) {
                $answers = $question['answers'];
                $given_answers_ids = $given_answers[$count];
                foreach($answers as $answer) {
                    foreach($given_answers_ids as $given_answer_id) {
                        if ($given_answer_id == $answer['id']) {
                            if ((bool)$answer['correct']) {
                                $result += 1;
                            }
                        } 
                    }
                }
                $count += 1;
            }
            return $result;
        }
    }
?>