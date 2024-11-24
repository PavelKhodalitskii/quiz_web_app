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
?>