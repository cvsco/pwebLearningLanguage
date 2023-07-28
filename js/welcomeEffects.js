function begin(){
	var element = document.getElementsByName("level");

	for(var i=0; i<element.length; i++)
		if(element[i].checked){
			var label = document.getElementsByTagName("LABEL");
			label[i].setAttribute("class", "selected");
			break;
		}
}

function setStyle(){
	var element = document.getElementsByName("level");

	for(var i=0; i<element.length; i++)
		if(element[i].checked){
			var label = document.getElementsByTagName("LABEL");
			label[i].setAttribute("class", "selected");
		} 
		else{
			var label = document.getElementsByTagName("LABEL");
			label[i].setAttribute("class", "");
		}
}