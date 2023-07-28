function FormManagerAdmin(){}

FormManagerAdmin.URL_REQUEST = "./../php/ajax/formAdminInsert.php";
FormManagerAdmin.SEARCH_REQUEST = "./../php/ajax/formAdminSearch.php";
FormManagerAdmin.DEFAULT_METHOD = "GET";
FormManagerAdmin.ASYNC_TYPE = true;

FormManagerAdmin.TEXT = null;
FormManagerAdmin.TOPIC = null;
FormManagerAdmin.LANG = null;
FormManagerAdmin.TYPE = null;
FormManagerAdmin.ANSWER = null;
FormManagerAdmin.OTHER_ANSWERS = null;
FormManagerAdmin.QUESTION_ID = null;


FormManagerAdmin.setValues =
	function(form){
		FormManagerAdmin.QUESTION_ID = null;
		if(form.name == "formChange"){
			var id = form.id;
			FormManagerAdmin.QUESTION_ID = parseInt(id);
		}

		var selectItems = form.getElementsByTagName("select");
		var textItems = form.getElementsByTagName("textarea");
		
		FormManagerAdmin.TYPE = selectItems[0].value;
		FormManagerAdmin.TOPIC = selectItems[1].value;
		FormManagerAdmin.LANG = selectItems[2].value;
		FormManagerAdmin.TEXT = textItems[0].value;
		FormManagerAdmin.TEXT = fixText(FormManagerAdmin.TEXT, null);
		
		
		if(FormManagerAdmin.TYPE !== "audio"){
			FormManagerAdmin.ANSWER = textItems[1].value;
			FormManagerAdmin.ANSWER = fixText(FormManagerAdmin.ANSWER , null);

			FormManagerAdmin.OTHER_ANSWERS = textItems[2].value;
			FormManagerAdmin.OTHER_ANSWERS = fixText(FormManagerAdmin.OTHER_ANSWERS, FormManagerAdmin.TYPE);

			if(FormManagerAdmin.TYPE === "multiple") //OTHER_ANSWERS is required when type='multiple'
				FormManagerAdmin.OTHER_ANSWERS = FormManagerAdmin.OTHER_ANSWERS + '-' + FormManagerAdmin.ANSWER; //add answer to the other possible options
			else if(FormManagerAdmin.OTHER_ANSWERS === '')
					FormManagerAdmin.OTHER_ANSWERS = null;
		}

		FormManagerAdmin.insertData();
	}

FormManagerAdmin.insertData = 
	function(){
		var queryString = "?type=" + FormManagerAdmin.TYPE + "&topic=" + FormManagerAdmin.TOPIC + "&lang=" + FormManagerAdmin.LANG
							+ "&text=" + FormManagerAdmin.TEXT + "&answer=" + FormManagerAdmin.ANSWER 
							+ "&otherAnswer=" + FormManagerAdmin.OTHER_ANSWERS + "&questionId=" + FormManagerAdmin.QUESTION_ID;
		var url = FormManagerAdmin.URL_REQUEST + queryString;
		var responseFunction = FormManagerAdmin.onAjaxResponse;

		AjaxManager.performAjaxRequest(FormManagerAdmin.DEFAULT_METHOD, url, FormManagerAdmin.ASYNC_TYPE, null, responseFunction);
	}

FormManagerAdmin.onAjaxResponse =	
	function(response){
		if(response.responseCode === -1){//question already present
			AdminEventHandler.setErrorMessage(response.message); 
			return;
		}

		AdminEventHandler.setRightMessage(response.message);
	}

function fixText(text, type){
	if(text.search('-') !== -1){ //when other answer is set
		text = text.split('-');

		if(type === "multiple" && text.length > 2){
			AdminEventHandler.setErrorMessage("Tipo 'multiple' inserire solo due risposte addizionali");
			throw new Error();
		}

		for(var i=0; i<text.length; i++){//delete whitespace for every string
			text[i] = text[i].replace(/\s+/g, ' ');
			text[i] = text[i].replace(/(^\s+|\s+$)/g, '');
		}

		text = text.toString();
		text = text.replace(/\,/g, '-');
		return text;
	}

	text = text.replace(/\s+/g, ' '); //remove multiple whitespace
	text = text.replace(/(^\s+|\s+$)/g, ''); //remove all whitespace beginning/end string

	return text;
}

/*******************************************************************
						SEARCH SECTION
********************************************************************/

FormManagerAdmin.setSearchValues = 
	function(){
		FormManagerAdmin.TYPE = document.getElementById("changeTypes").value;
		FormManagerAdmin.TOPIC = document.getElementById("changeTopics").value;
		FormManagerAdmin.LANG = document.getElementById("changeLang").value;
		FormManagerAdmin.TEXT = document.getElementById("changeText").value;

		FormManagerAdmin.TEXT = fixText(FormManagerAdmin.TEXT, null);

		FormManagerAdmin.searchData();
	}

FormManagerAdmin.searchData =
	function(){
		var queryString = "?type=" + FormManagerAdmin.TYPE + "&topic=" + FormManagerAdmin.TOPIC 
							+ "&lang=" + FormManagerAdmin.LANG + "&text=" + FormManagerAdmin.TEXT;
		
		var url = FormManagerAdmin.SEARCH_REQUEST + queryString;
		var responseFunction = FormManagerAdmin.onSearchAjaxResponse;

		AjaxManager.performAjaxRequest(FormManagerAdmin.DEFAULT_METHOD, url, FormManagerAdmin.ASYNC_TYPE, null, responseFunction);
	}

FormManagerAdmin.onSearchAjaxResponse = 
	function(response){
		if(response.responseCode === -1){ //question not found, set empty result
			AdminEventHandler.setErrorMessage(response.message); 
			return;
		}

		AdminSearchDashboard.refreshData(response.data);
	}


