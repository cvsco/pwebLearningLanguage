function AdminEventHandler(){}

AdminEventHandler.begin = 
	function(){
		var formAdd = document.getElementById("formAdd");
		var formChange = document.getElementById("formChange");
		
		formAdd.onsubmit = function(evt){
			evt.preventDefault();
			FormManagerAdmin.setValues(evt.target);
		}


		formChange.onsubmit = function(evt){
			evt.preventDefault();
			FormManagerAdmin.setSearchValues();
		}
	}

AdminEventHandler.handleTextFields = 
	function(){
		var typesSelect = document.getElementById('addTypes');
		var type = typesSelect.options[typesSelect.selectedIndex].value;

		var answer = document.getElementById('addAnswer');
		var otherAnswer = document.getElementById('addOptions');

		//disable fields if type=audio
		if(type === "audio"){
			answer.setAttribute("disabled", "disabled");
			otherAnswer.setAttribute("disabled", "disabled");
		} 
		else {
			//no audio type, fields required
			answer.removeAttribute("disabled");
			otherAnswer.removeAttribute("disabled");

			answer.required = true;
			otherAnswer.required = false; //only if type='multiple' it is required			
			if(type === "multiple")
				otherAnswer.required = true;
		}		
	}

AdminEventHandler.setRightMessage =
	function(message){
		var mes = document.getElementById('message');
		mes.style.display = "block";
		mes.setAttribute("class", "right");
		
		var text = document.getElementById("textMessage");
		text.textContent = message;

		var img = document.getElementById("messageImg");
		img.setAttribute("class", "rightImg");

		displayMessage(mes, 0, 100); //display correct message for 4s
	}

AdminEventHandler.setErrorMessage =
	function(message){
		var err = document.getElementById('message');
		err.style.display = "block";
		err.setAttribute("class", "wrong");
		var text = document.getElementById("textMessage");
		text.textContent = message;

		var img = document.getElementById("messageImg");
		img.setAttribute("class", "wrongImg");

		displayMessage(err, 0, 100); //display wrong message for 4s
	}
	

//the message appears from the bottom up and disappears from the top down
function displayMessage(field, opacity, top){	
	var display = setInterval(function(){
		if(top === 91){
			clearInterval(display);
			setTimeout(closeMessage, 3000, field, 1, 91);
		}

		field.style.opacity = opacity;
		field.style.top = top + '%';
		
		opacity+=0.11;
		top-=1;

	}, 30);
}

function closeMessage(field, opacity, top){
	var close = setInterval(function(){
		if(top === 100){
			clearInterval(close);
			field.style.display = "none";
		}
		
		field.style.opacity = opacity;
		field.style.top = top + '%';
		
		opacity-=0.1;
		top+=1;

	}, 30);
}