function PracticeEventHandler(){}

PracticeEventHandler.SYNTH = window.speechSynthesis;

PracticeEventHandler.speak =
	function(text, lang, rate) {
		if(PracticeEventHandler.SYNTH.speaking){
			console.error('speechSynthesis.speaking');
			return;
		}

		if(text !== ''){
			var utterThis = PracticeEventHandler.selectLanguage(text, lang);

			if(rate != null)
				utterThis.rate = rate; //set speed
		
			utterThis.onend = function(evt){
				console.log('SpeechSynthesisUtterance.onend');
			}

			PracticeEventHandler.SYNTH.speak(utterThis);
		}
	}

PracticeEventHandler.selectLanguage =
	function(text, lang){
		switch(lang){
			case "eng":
				var utter = new SpeechSynthesisUtterance(text);
				utter.lang = 'en-US';
				return utter;

			//case ...
		}
	}

PracticeEventHandler.setStyle =
	function(){
		var optionElem = document.getElementsByName("option");
	
		for(var i=0; i<optionElem.length; i++){
			if(optionElem[i].checked){
				var label = document.getElementsByTagName("LABEL");
				label[i].setAttribute("id", "selected");
				PracticeEventHandler.enableButton(); //enable check button
			} 
			else{
				var label = document.getElementsByTagName("LABEL");
				label[i].removeAttribute("id");
			}
		}
	}

PracticeEventHandler.enableButton = 
	function(){
		var button = document.getElementById("submit_button");

		if(button.getAttribute("disabled") != null){
			button.removeAttribute("disabled");

			//set, confirm response by 'enter' key
			var  type = PracticeDataLoader.QUESTIONS_ARRAY[PracticeDashboard.INDEX].type;
			if(type !== "multiple")
				document.getElementById("text").addEventListener("keydown", PracticeEventHandler.keyConfirm); 
		}
	}

PracticeEventHandler.keyConfirm = //need for press 'enter' to confirm the answer
	function(evt){
		var keyCode = evt.keyCode;
  		
  		if (keyCode === 13) { 
    		evt.preventDefault();
    		document.getElementById('text').setAttribute("disabled", "disabled");

    		document.getElementById('submit_button').focus();
    		document.getElementById('submit_button').addEventListener("keydown", PracticeEventHandler.keyNextQuestion);
    		
    		PracticeEventHandler.answerCheck();
  			return false;
  		}
	}

PracticeEventHandler.keyNextQuestion = 
	function(evt){
		var keyCode = evt.keyCode;
  		if (keyCode === 13) {
  			evt.preventDefault();
  			PracticeDashboard.refreshData(PracticeDataLoader.QUESTIONS_ARRAY);
  		}
	}

PracticeEventHandler.answerCheck =
	function(){
		var i = PracticeDashboard.INDEX;
		var currentQuestion = PracticeDataLoader.QUESTIONS_ARRAY[i];

		switch(PracticeDataLoader.QUESTIONS_ARRAY[i].type){
			case "audio":
				var rightAnswer = PracticeDataLoader.QUESTIONS_ARRAY[i].text;
				var answer = document.getElementById("text").value;
				
				audioCheck(rightAnswer, answer);
				return;

			case "multiple":
				var rightAnswer = PracticeDataLoader.QUESTIONS_ARRAY[i].rightAnswer;
				var labelSelected = document.getElementById("selected");
				var answer = labelSelected.textContent; //take text of the option selected

				multipleCheck(rightAnswer, answer);
				return;

			case "reverso":
			case "translate":
				var rightAnswer = PracticeDataLoader.QUESTIONS_ARRAY[i].rightAnswer;
				var answer = document.getElementById("text").value;

				var otherAnsw = null;
				if(PracticeDataLoader.QUESTIONS_ARRAY[i].options != null){	//create array of other possible right answeres
					otherAnsw = Array.from(PracticeDataLoader.QUESTIONS_ARRAY[i].options.split("-"));
				}

				reversoTranslateCheck(rightAnswer, answer, otherAnsw);
				return;
		}
	}

function audioCheck(rightAnswer, answer){
	answer = answer.replace(/[.,;?!":'-]+/g, ''); //remove punctuation
	answer = answer.replace(/\s+/g, ' '); //remove multiple whitespace
	answer = answer.replace(/(^\s+|\s+$)/g, ''); //remove whitespace beggining/end string
	rightAnswer = rightAnswer.replace(/[.,;?!":'-]+/g, '');
	rightAnswer = rightAnswer.replace(/(^\s+|\s+$)/g, '');

	if(rightAnswer.localeCompare(answer, undefined, {sensitivity: "base"}) == 0) //compare case insensitive
		PracticeDashboard.setRight();
	else
		PracticeDashboard.setWrong();
}

function multipleCheck(rightAnswer, answer){
	if(rightAnswer === answer)
		PracticeDashboard.setRight();
	else
		PracticeDashboard.setWrong();
}

function reversoTranslateCheck(rightAnswer, answer, otherAnsw){
	answer = answer.replace(/[.,;?!":'-]+/g, ''); //remove punctuation
	answer = answer.replace(/\s+/g, ' '); //remove multiple whitespace
	answer = answer.replace(/(^\s+|\s+$)/g, ''); //remove whitespace beggining/end string
	rightAnswer = rightAnswer.replace(/[.,;?!":'-]+/g, '');
	rightAnswer = rightAnswer.replace(/(^\s+|\s+$)/g, '');
	
	if(rightAnswer.localeCompare(answer, undefined, {sensitivity: "base"}) == 0){
		PracticeDashboard.setRight();
		return;
	}
	
	if(otherAnsw !== null){
		for(var i=0; i<otherAnsw.length; i++){
			otherAnsw[i] = otherAnsw[i].replace(/[.,;?!":'-]+/g, '');
			if(otherAnsw[i].localeCompare(answer, undefined, {sensitivity: "base"}) == 0){
				PracticeDashboard.setRight();
				return;
			}
		}
	}

	PracticeDashboard.setWrong();
}