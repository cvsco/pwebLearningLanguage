var synth = window.speechSynthesis;

var textArea = document.getElementById("text").textContent;
/*var txtFra = document.getElementById("textFra").textContent;
var txtDeu = document.getElementById("textDeu").textContent;
var txtIta = document.getElementById("textIta").textContent;*/

function speak(){
	if(synth.speaking){
		//console.error('speechSynthesis.speaking');
		return;
	}

	if()

	if(txt !== ''){
		var utterThis = selectLanguageUS();
		
		utterThis.onend = function(evt){
			console.log('SpeechSynthesisUtterance.onend');
		}

		utterThis.onerror = function(){
			console.log('SpeechSynthesisUtterance.onerror');
		}

		synth.speak(utterThis);
	}
}

function selectLanguageFR(){
	var utter = new SpeechSynthesisUtterance(txtFra);
	utter.lang = 'fr-FR';
	return utter;
}

function selectLanguageUS(){
	var utter = new SpeechSynthesisUtterance(txt);
	utter.lang = 'en-US';
	return utter;
}

function selectLanguageDE(){
	var utter = new SpeechSynthesisUtterance(txtDeu);
	utter.lang = 'de-DE';
	return utter;
}

function selectLanguageIT(){
	var utter = new SpeechSynthesisUtterance(txtIta);
	utter.lang = 'it-IT';
	var voices = speechSynthesis.getVoices();
	for(var i = 0; i < voices.length; i++) {
	   if(voices[i].name == 'Microsoft Elsa Desktop - Italian (Italy)')
    		utter.voice = voices[i];
    	break;
    }
	return utter;
}