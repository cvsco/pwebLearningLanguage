function AdminSearchDashboard(){}

AdminSearchDashboard.TYPE_OPTIONS = ["audio", "multiple", "reverso", "translate"];
AdminSearchDashboard.TOPIC_OPTIONS = ["Basi", "Cibo", "Animali", "Possessivi", "Pronomi oggetto", "Colori",
									 "Presente", "Aggettivi", "Avverbi", "Scuola", "Viaggi", "Pronomi indefiniti",
									 "Passato", "Infinito", "Presente perfetto", "Participio", "Pronomi relativi", "Oggetti",
									 "Pronomi riflessivi", "Futuro", "Verbi modali", "Condizionale perfetto", "Scienza", "Attributi"];
AdminSearchDashboard.LANG_OPTIONS = ["english"];

AdminSearchDashboard.SECTIONS = 1;

AdminSearchDashboard.removeContent =
	function(){
		var list = document.getElementById("questionList");
		if(list !== null)
			list.remove();
	}

AdminSearchDashboard.refreshData = 
	function(data){
		AdminSearchDashboard.removeContent();

		var questionList = AdminSearchDashboard.createListElem();

		for(var i=0; i<data.length; i++){
			var questionElem = AdminSearchDashboard.createQuestionElem(data[i]);
			questionList.appendChild(questionElem);
		}

		var searchResultSection = document.createElement("div");
		searchResultSection.id = "searchResult";

		searchResultSection.appendChild(questionList);
		document.body.appendChild(searchResultSection);
		window.scrollTo(0, 1500);
	}

AdminSearchDashboard.createListElem = 
	function(){
		var listElem = document.createElement("ul");
		listElem.setAttribute("id", "questionList");
		
		return listElem;
	}

AdminSearchDashboard.createQuestionElem =
	function(data){
		var questionElem = document.createElement("li");
		questionElem.setAttribute("class", "questionElem");

		questionElem.appendChild(AdminSearchDashboard.createForm(data));
		return questionElem;
	}

AdminSearchDashboard.createForm = 
	function(data){
		var form = document.createElement("form");
		form.name = "formChange";
		form.id =  data.questionId+"_question";
		form.addEventListener("submit", function(evt){
			evt.preventDefault();
			FormManagerAdmin.setValues(evt.target);
		}); 

		form.appendChild(AdminSearchDashboard.createFormType(data.type));
		form.appendChild(AdminSearchDashboard.createFormTopic(data.topic));
		form.appendChild(AdminSearchDashboard.createFormLang(data.lang));
		form.appendChild(AdminSearchDashboard.createFormText(data.text, "Testo dell'esercizio:"));
		form.appendChild(AdminSearchDashboard.createFormText(data.rightAnswer, "Risposta esatta:"));
		form.appendChild(AdminSearchDashboard.createFormText(data.options, "Altre risposte:"));	
		form.appendChild(AdminSearchDashboard.createFormButton());	

		return form;
	}

AdminSearchDashboard.createFormType = 
	function(type){
		var label = document.createElement("label");
		label.textContent = "Tipo:";

		var selectType = document.createElement("select");
		selectType.className = "questionTypes";

		for(var i=0; i<AdminSearchDashboard.TYPE_OPTIONS.length; i++){
			var option = document.createElement("option");
			option.value = AdminSearchDashboard.TYPE_OPTIONS[i];
			option.textContent = AdminSearchDashboard.TYPE_OPTIONS[i];

			if(AdminSearchDashboard.TYPE_OPTIONS[i] == type)
				option.selected = true;

			selectType.appendChild(option);
		}		

		label.appendChild(selectType);
		return label;
	}

AdminSearchDashboard.createFormTopic = 
	function(topic){
		var label = document.createElement("label");
		label.textContent = "Argomento:";

		var selectTopic = document.createElement("select");
		selectTopic.className = "questionTopics";

		AdminSearchDashboard.SECTIONS = 1;
		
		for(var i=0; i<AdminSearchDashboard.TOPIC_OPTIONS.length; i++){
			if(i === 0){ //insert first section title
				var section = document.createElement("optgroup");
				section.label = "Section-" + AdminSearchDashboard.SECTIONS;
				selectTopic.appendChild(section);
				AdminSearchDashboard.SECTIONS++;
			}

			var option = document.createElement("option");
			option.value = i+1;
			option.textContent = AdminSearchDashboard.TOPIC_OPTIONS[i];

			if(AdminSearchDashboard.TOPIC_OPTIONS[i] == topic)
				option.selected = true;

			selectTopic.appendChild(option);
			
			if(i!=0 && (i%6 == 0) && AdminSearchDashboard.SECTIONS <= 4){ //insert other sections titles
				var section = document.createElement("optgroup");
				section.label = "Section-" + AdminSearchDashboard.SECTIONS;
				selectTopic.appendChild(section);
				AdminSearchDashboard.SECTIONS++;
			}
		}

		label.appendChild(selectTopic);
		return label;
	}

AdminSearchDashboard.createFormLang = 
	function(lang){
		var label = document.createElement("label");
		label.textContent = "Lingua:";

		var selectLang = document.createElement("select");
		selectLang.className = "questionLang";

		for(var i=0; i<AdminSearchDashboard.LANG_OPTIONS.length; i++){
			var option = document.createElement("option");
			option.value = AdminSearchDashboard.LANG_OPTIONS[i].substring(0, 3);
			option.textContent = AdminSearchDashboard.LANG_OPTIONS[i];

			if(AdminSearchDashboard.LANG_OPTIONS[i] == lang)
				option.selected = true;

			selectLang.appendChild(option);
		}

		label.appendChild(selectLang);
		return label;
	}

AdminSearchDashboard.createFormText =
	function(text, title){
		var label = document.createElement("label");
		label.textContent = title;

		var textarea = document.createElement("textarea");
		textarea.textContent = text;
		
		label.appendChild(textarea);
		return label;
	}

AdminSearchDashboard.createFormButton = 
	function(){
		var container = document.createElement("div");
		container.className = "subButton";

		var input = document.createElement("input");
		input.className = "submitUpdate";
		input.type = "submit";
		input.value = "Modifica";

		container.appendChild(input);
		return container;
	}