<?php  

	class AjaxResponse{
		public $responseCode; // 0 all ok - 1 some errors - -1 some warning
		public $message;
		public $data;
		
		function AjaxResponse($responseCode = 1, $message = "Somenthing went wrong! Please try later.", $data = null){
			$this->responseCode = $responseCode;
			$this->message = $message;
			$this->data = null;
		}
	}

	class AccountStatData{
		public $username;
		public $light;
		public $streak;
		public $coin;
		public $photo;
		public $streakFreeze;
		public $coinsBet;

		function AccountDataCollection($username = null, $light = 0, $streak = 0, $coin = 0, $photo = null, $strekFreeze = null, $coinsBet = null){
			$this->username = $username;
			$this->light = $light;
			$this->streak = $streak;
			$this->coin = $coin;
			$this->photo = $photo;
			$this->streakFreeze = $streakFreeze;
			$this->coinsBet = $coinsBet;
		}
	}

	class TopicData{
		public $topicId; //topicID
		public $times; //number of times the argument was run
		public $lastTime; //helpful in TopicDashboard.js for calculate the percentage of the skill for the current topic

		function TopicData($topicId = null, $times = 0, $lastTime = null){
			$this->topicId = $topicId;
			$this->times = $times;
			$this->lastTime = $lastTime;
		}
	}

	class QuestionData{
		public $questionId;
		public $topic;
		public $type;
		public $rightAnswer;
		public $text;
		public $options;
		public $lang;

		function QuestionData($questionId = null, $topic = null, $type = null, $rightAnswer = null, $text = null, $options = null, $lang = null){
			$this->topic = $topic;
			$this->type = $type;
			$this->rightAnswer = $rightAnswer;
			$this->text = $text;
			$this->options = $options;
			$this->lang = $lang;
			$this->questionId = $questionId;
		}
	}

	class RankData{
		public $username;
		public $score;

		function RankData($username = null, $score = null){
			$this->username = $username;
			$this->score = $score;
		}
	}
?>