function LearnDashboard(){}

LearnDashboard.LIGHTS_COUNTER = 0;


/***************************************************
						NAVBAR
****************************************************/

LearnDashboard.removeContent = 
	function(){
		var userStat = document.getElementById("user_stat_content");

		if(userStat != null)
			userStat.remove();
	}

LearnDashboard.refreshStatData =
	function(data){
		LearnDashboard.removeContent();
		var user_menu = document.createElement("div");
		user_menu.id = "user_stat_content";

		var newPhotoElem = LearnDashboard.createPhotoFlagElem("photo", data.photo, data.username);
		var newFlagElem = LearnDashboard.createPhotoFlagElem("flag");
		var newLightElem = LearnDashboard.createStatElem(data.light, "light");
		var newStreakElem = LearnDashboard.createStatElem(data.streak, "streak");
		var newCoinElem = LearnDashboard.createStatElem(data.coin, "coin");

		user_menu.appendChild(newPhotoElem);
		user_menu.appendChild(newFlagElem);
		user_menu.appendChild(newLightElem);
		user_menu.appendChild(newStreakElem);
		user_menu.appendChild(newCoinElem);
		document.getElementById("menu").appendChild(user_menu);
	}

LearnDashboard.createPhotoFlagElem =
	function (name, data = null, username = null){
		var item = document.createElement("div");
		item.setAttribute("id", name);
		item.setAttribute("class", "user_item");

		var image = document.createElement("div");
		if(name === "photo"){
			if(data === null)
				image.setAttribute("class", "user_item_image photo_image");

			var photoTooltip = createPhotoTooltip(username);
			item.appendChild(image);
			item.appendChild(photoTooltip);
			return item;
			//else{
			//photoImage.style.backgroundImage = 'url(\''. photoData .'\')';
		//}
		} 
		else{
			image.setAttribute("class", "user_item_image flag_image");
		}

		item.appendChild(image);

		return item;
	}

LearnDashboard.createStatElem =
	function(data, name){
		var item = document.createElement("div");
		item.setAttribute("id", name);
		item.setAttribute("class", "user_item");

		var image = document.createElement("div");//image field
		image.setAttribute("class", "user_item_image "+ name +"_image");

		var txt = document.createElement("span");//text field
		txt.setAttribute("class", "value");
		txt.textContent = data;

		var tooltipItem = createTooltip(name);//tooltip for coin, streak and light

		item.appendChild(image);
		item.appendChild(txt);
		item.appendChild(tooltipItem);

		return item;
	}

function createTooltip(name){
	var tooltip = document.createElement("div");
	tooltip.setAttribute("class", name+"_tooltip");

	var img = document.createElement("div");
	img.setAttribute("class", name+"_tooltip_img");

	var txt = document.createElement("div");
	txt.setAttribute("class", name+"_tooltip_txt");

	tooltip.appendChild(img);	
	tooltip.appendChild(txt);

	var title = document.createElement("h1");
	var description = document.createElement("p");

	switch(name){
		case "coin":
			description.textContent = "Spendi le monete collezionate nel negozio";
			var link = document.createElement("a");
			link.setAttribute("href", "./../php/homeShop.php");
			link.textContent = "VAI AL NEGOZIO";

			txt.appendChild(description);
			txt.appendChild(link);
			return tooltip;

		case "streak":
			title.textContent = "Streak";
			description.textContent = "Completa una lezione al giorno per aumentare la serie";

			txt.appendChild(title);
			txt.appendChild(description);
			return tooltip;

		case "light":
			title.textContent = "Light";
			description.textContent = "Raggiungi il 50% di un argomento per ottenere una lampadina, completalo per ottenerne un'altra";

			txt.appendChild(title);
			txt.appendChild(description);
			return tooltip;
	}
}

function createPhotoTooltip(username){
	var tooltip = document.createElement("div");
	tooltip.setAttribute("class", "photo_tooltip");
	
	var title = document.createElement("h1");//tooltip title 
	//title.textContent = "Gestisci il tuo account, " + username; //tenere
	title.textContent = "Welcome back " + username;
	
	//tenere
	/*var linkSet = document.createElement("a");
	linkSet.setAttribute("href", "");//link to settings
	linkSet.textContent = "Impostazioni";*/

	var linkLogout = document.createElement("a");
	linkLogout.setAttribute("href", "./../php/logout.php");//link logout
	linkLogout.textContent = "Esci";

	tooltip.appendChild(title);
	//tooltip.appendChild(linkSet); // tenere
	tooltip.appendChild(linkLogout);

	return tooltip;
}

/***********************************************************
						TOPIC
***********************************************************/

LearnDashboard.refreshTopicData = 
	function(data){
		for(var i=0; i<data.length; i++){			
			//set current topic skill
			var skill = document.getElementById("skill_topic_"+data[i].topicId);
			skill.style.width = LearnDashboard.setSkill(data[i].times, data[i].lastTime) + '%';
		}

		//update the number of lights
		UpdateAccountStat.updateLight(LearnDashboard.LIGHTS_COUNTER);
	}

LearnDashboard.setSkill =
	function(times, lastTime){
		if(times > 4 || times == 4){
			LearnDashboard.LIGHTS_COUNTER+=2;
			if(times > 4){
				var now = Date.now();
				var date = new Date(lastTime);
				var daysPeriod = (now-date.getTime())/(1000*60*60*24);
				if(daysPeriod > 30)//if 30 days have passed since the last exercise, the indicator go down to 75%
					return 75;
			}
			return 100;
		}

		if(times >= 2)
			LearnDashboard.LIGHTS_COUNTER+=1;

		return (times*25);
	}

/*************************************************************
						RANK
**************************************************************/
LearnDashboard.refreshRankData = 
	function(data){

		var rankHeader = LearnDashboard.createRankHeader(); 

		var userList = LearnDashboard.createUserList();

		for(var i=0; i<data.length; i++){
			var rankRow = LearnDashboard.createNewRankRow(data[i]);
			userList.appendChild(rankRow);
		}

		document.getElementById("rank").appendChild(rankHeader);
		document.getElementById("rank").appendChild(userList);
	}

LearnDashboard.createRankHeader =
	function(){
		if(document.getElementById("rank_header") != null) //if already exists
			return document.getElementById("rank_header");
	
		var header = document.createElement("h2");
		header.id = "rank_header";
		header.textContent = "Utente";

		var scoreHeader = document.createElement("span");
		scoreHeader.textContent = "XP Totali";

		header.appendChild(scoreHeader);
	
		return header;
}

LearnDashboard.createUserList = 
	function(){
		var listElem = document.createElement("ul");
		listElem.id = "rank_content";

		return listElem;
	}

LearnDashboard.createNewRankRow = 
	function(data){
		var row = document.createElement("li");
		row.className = "row";

		var name = document.createElement("div");
		name.className = "name";
		name.textContent = data.username;
		row.appendChild(name);

		var score = document.createElement("div");
		score.className = "score";
		score.textContent = data.score + 'XP';
		row.appendChild(score);

		return row;
	}