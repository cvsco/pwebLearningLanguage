function PracticeDashboard(){}

PracticeDashboard.INDEX = 0;

PracticeDashboard.UPD_STREAK = 0; //used to update user streak
PracticeDashboard.UPD_XP = 1; //used to update user XP
PracticeDashboard.UPD_COIN = 2; //used to update user coins


PracticeDashboard.init = //initialize it after creating the array otherwise it is an error
		function(){
			PracticeDashboard.INDEX = PracticeDataLoader.QUESTIONS_ARRAY.length - 1;
		}

PracticeDashboard.removeContent =
	function(){
		var content = document.getElementById("practice_content");

		if(content === null)
			return;

		var section = document.getElementById("practice_section");
		if(section !== null)
			content.removeChild(section);
	}


PracticeDashboard.refreshData =
	function(data){
		//update user stat and progress if practice is ended
		if(PracticeDashboard.INDEX < 0){
			UpdateAccountStat.updateProgress(data[0].topic, data[0].lang);
			UpdateAccountStat.updateOtherStat(PracticeDashboard.UPD_XP);
			UpdateAccountStat.updateOtherStat(PracticeDashboard.UPD_STREAK);
			window.location.href = "./../php/homeLearn.php";
			return;
		}

		PracticeDashboard.removeContent(); //reset

		var i = PracticeDashboard.INDEX;

		//create practice section with related exercise and button
		PracticeDashboard.createPracticeSection();
		//var practiceSection = PracticeDashboard.createPracticeSection();
		var newExercise = PracticeDashboard.createExercise(data[i].type, data[i].text, data[i].options, data[i].lang);
		var checkButton = PracticeDashboard.createCheckButton();

		//insert elements into the document
		document.getElementById("practice_section").appendChild(newExercise);
		//practiceSection.appendChild(newExercise);
		document.getElementById("practice_section").appendChild(checkButton);
		//practiceSection.appendChild(checkButton);


		PracticeDashboard.begin(data[i].type, data[i].text, data[i].lang);
	}

PracticeDashboard.begin = 
	function(type, text, lang) {
		var textarea = document.getElementById("text");
	
		if(textarea !== null)
			document.getElementById("text").focus(); //set focus on textarea if exists
	
		if(type === "audio" || type === "translate")
			PracticeEventHandler.speak(text, lang, null); //start audio for listen exercises
	}

PracticeDashboard.createPracticeSection =
	function(){
		var section = document.createElement("div");
		section.setAttribute("id", "practice_section");

		document.getElementById("practice_content").appendChild(section);

		//return section;
	}

PracticeDashboard.createExercise =
	function(type, text, optionsString, lang){
		var exercise = document.createElement("div");
		exercise.setAttribute("id", type);

		switch(type){
			case "reverso":
				var sentence = createSentence(text);
				var textarea = createTextarea();
				
				exercise.appendChild(sentence);
				exercise.appendChild(textarea);
				return exercise;

			case "translate":
				var audioButton = createAudioButton(text, lang);
				var sentence = createSentence(text);
				var textarea = createTextarea();

				exercise.appendChild(audioButton);
				exercise.appendChild(sentence);
				exercise.appendChild(textarea);
				return exercise;

			case "audio":
				var audioButton = createAudioButton(text, lang);
				var slowAudioButton = createSlowAudioButton(text, lang); 
				var textarea = createTextarea();

				exercise.appendChild(audioButton);
				exercise.appendChild(slowAudioButton);
				exercise.appendChild(textarea);
				return exercise;

			case "multiple":
				var sentence = createSentence(text);
				var optionsList = createOptionsList(optionsString);

				exercise.appendChild(sentence);
				exercise.appendChild(optionsList);
				return exercise;
		}
	}

function createSentence(text){
	var sentenceElem = document.createElement("div");
	sentenceElem.setAttribute("class", "sentence");
	sentenceElem.textContent = text;

	return sentenceElem;
}

function createTextarea(){
	var textareaElem = document.createElement("textarea");
	textareaElem.setAttribute("id", "text");
	textareaElem.setAttribute("rows", "6");
	//textareaElem.setAttribute("autofocus", "autofocus");
	textareaElem.setAttribute("spellcheck", "false");
	textareaElem.setAttribute("autocomplete", "off");
	textareaElem.setAttribute("onInput", "PracticeEventHandler.enableButton()");

	return textareaElem;
}

function createAudioButton(text, lang){
	var audioElem = document.createElement("div");
	audioElem.setAttribute("class", "audio_button");
	audioElem.setAttribute("onClick", "PracticeEventHandler.speak(\'"+ text +"\', \'"+ lang +"\', "+ null + ")");
	
	var imgAudioElem = document.createElement("div");
	imgAudioElem.setAttribute("class", "img_audio_button");

	audioElem.appendChild(imgAudioElem);
	return audioElem;
}

function createSlowAudioButton(text, lang){
	var slowAudioElem = document.createElement("div");
	slowAudioElem.setAttribute("class", "slow_audio_button");
	slowAudioElem.setAttribute("onClick", "PracticeEventHandler.speak(\'"+ text +"\', \'"+ lang +"\', "+ 0.3 + ")");

	var imgAudioElem = document.createElement("div");
	imgAudioElem.setAttribute("class", "img_slow_audio_button");

	slowAudioElem.appendChild(imgAudioElem);
	return slowAudioElem;
}


function createOptionsList(optionsString){
	var optionsElem = document.createElement("div");
	optionsElem.setAttribute("id", "options");

	var optionsArray = Array.from(optionsString.split("-")); //convert string to array
	optionsArray = shuffle(optionsArray); //shuffle the possible choices


	var index = 0;
	do{
		var label = document.createElement("label");

		var input = document.createElement("input");
		input.setAttribute("type", "radio");
		input.setAttribute("name", "option");
		input.setAttribute("onchange", "PracticeEventHandler.setStyle()");//set style for the selected option

		label.textContent = optionsArray[index];

		label.appendChild(input);
		optionsElem.appendChild(label);

		index++;
	}
	while(index !== 3); //there are 3 choices

	return optionsElem;
}

function shuffle(array) {
  var currentIndex = array.length;

  //while remain elements to shuffle
  while (currentIndex !== 0) {

    //pick a remaining element
    var randomIndex = Math.floor(Math.random() * currentIndex);
    currentIndex -= 1;

    //and swap it with the current element
    var temporaryValue = array[currentIndex];
    array[currentIndex] = array[randomIndex];
    array[randomIndex] = temporaryValue;
  }

  return array;
}

 PracticeDashboard.createCheckButton =
 	function(){
 		var button = document.createElement("button");
 		button.setAttribute("id", "submit_button");
 		button.setAttribute("disabled", "disabled");
 		button.setAttribute("onClick", "PracticeEventHandler.answerCheck()");
 		button.textContent = "Controlla";

 		return button;
 	}

/***************************************************************
					METHODS FOR VERIFING ANSWER
****************************************************************/
PracticeDashboard.changeButton =
 	function(index){
 		var button = document.getElementById("submit_button");
 		button.setAttribute("onClick", "PracticeDashboard.refreshData(PracticeDataLoader.QUESTIONS_ARRAY)");
 		button.textContent = "Continua";
 	}

PracticeDashboard.responseMessage = 
	function(result){
		var response = document.createElement("div");
		response.setAttribute("id", "response");
		response.setAttribute("class", result);
		response.style.display = "block";
		
		var img = document.createElement("div");
		img.setAttribute("id", "response_image");
		img.setAttribute("class", result+"Img");

		var title = document.createElement("h1");
		title.setAttribute("id", "title");

		response.appendChild(img);
		response.appendChild(title);

		if(result === "wrong"){
			var question = PracticeDataLoader.QUESTIONS_ARRAY[PracticeDashboard.INDEX];
			title.textContent = "Soluzione: "+ ((question.type === "audio") ? question.text : question.rightAnswer);
		}
		else
			title.textContent = "Risposta esatta";
		

		document.getElementById("practice_section").appendChild(response);
	}

PracticeDashboard.updateLoadbar = 
	function(){
		var loadbar = document.getElementById("content_loadbar");
		var loadbarWidth = parseInt(loadbar.style.width); 
		loadbar.style.width = loadbarWidth+10 + '%';
	}

PracticeDashboard.setRight =
 	function(){
 		PracticeDashboard.INDEX--; 

		//create right message and insert it into the document
		PracticeDashboard.responseMessage("right"); 

		PracticeDashboard.updateLoadbar();
		PracticeDashboard.changeButton(PracticeDashboard.INDEX); //create continue button to load next question
 	}

PracticeDashboard.setWrong = 
 	function(){
 		PracticeDashboard.changeButton(PracticeDashboard.INDEX);

		//create error message and insert it into the document
		PracticeDashboard.responseMessage("wrong"); 

		//insert the wrong question at the beginning of the array
		var wrongQuestion = PracticeDataLoader.QUESTIONS_ARRAY[PracticeDashboard.INDEX];
		PracticeDataLoader.QUESTIONS_ARRAY.splice(PracticeDashboard.INDEX, 1); 
		PracticeDataLoader.QUESTIONS_ARRAY.unshift(wrongQuestion); 
 	}
