/************************************************************
             INPUT FIELD MESSAGE CUSTOMIZATION
************************************************************/
 //var VERIFIED = false;

/*document.addEventListener("DOMContentLoaded", function() {
    var elements = document.getElementsByTagName("INPUT");

    for (var i = 0; i < elements.length; i++) {
        elements[i].oninvalid = invalidHandler;/*function(e) {
           e.target.setCustomValidity("");
           if (!e.target.validity.valid && this.getAttribute("id") == "username") {
                e.target.setCustomValidity("Inserire nome utente valido");
            }
        };*/

       /* elements[i].oninput = function(evt) {//remove message while writing input field
            evt.target.setCustomValidity("");
        };

        elements[i].onblur = function(evt) {//set right color
            evt.target.style.borderColor = "rgb(179, 230, 255, 0.32)";
        };
    }
})*/

/*document.addEventListener("DOMContentLoaded", function() {
    var elements = document.getElementsByTagName("INPUT");

    for (var i = 0; i < elements.length; i++) {
        elements[i].oninvalid = invalidHandler;//set message and wrong color

        elements[i].oninput = function(evt) {//remove message while writing input field
            evt.target.setCustomValidity("");
        };

        elements[i].onblur = function(evt) {//set right color
            evt.target.style.borderColor = "rgb(179, 230, 255, 0.32)";
        };
    }
})*/

/*function invalidHandler(evt){
    evt.target.setCustomValidity("");

    if(!evt.target.validity.valid){
        switch (this.getAttribute("id")){
            case "username" :
            case "signin_username": 
                evt.target.setCustomValidity("Inserire nome utente valido");
                return;

            case "password" :
            case "signin_passwd" :
                evt.target.setCustomValidity("Inserire la password");
                return;

            case "conf_signin_passwd" :
                evt.target.setCustomValidity("Ripetere la password");
                return;

            case "email":
                evt.target.setCustomValidity("Inserire una mail valida");
                return;
        }
    }
}*/

function invalidHandler(evt){//set message and wrong color
    //evt.target.setCustomValidity("");
    var field = evt.target;
    field.style.borderColor = "rgb(179, 0, 0)";
    

    if(field.validity.valueMissing){
        
        switch (this.getAttribute("id")){
            case "username" :
            case "signin_username": 
                field.setCustomValidity("Inserire nome utente valido");
                return;

            case "password" :
            case "signin_passwd" :
                field.setCustomValidity("Inserire la password");
                return;

            case "conf_signin_passwd" :
                field.setCustomValidity("Ripetere la password");
                return;

            case "email":
                field.setCustomValidity("Inserire una mail valida");
                return;
        }
    }
}


/*function invalidPasswd(evt){

    if(this.value.length > 8 && exist()){
        document.getElementsByClassName("warningPasswd")[0].style.display = "none";
    }
    
    if(this.value.length < 8 && !exist()){//messaggio di 
        var warningDiv = document.createElement("div");
        warningDiv.setAttribute("class", "warningPasswd");
        var warningDiv = document.createElement("div");
        warningDiv.setAttribute("class", "warningPasswd");
        var warningSpan = document.createElement("span");
        warningSpan.textContent = "Inserire almeno 8 caratteri";
        warningDiv.appendChild(warningSpan);

        var passwdFieldDiv = document.getElementsByClassName(this.id); //il div esterno ha come la classe l'id dell'input
        passwdFieldDiv[0].appendChild(warningDiv);
        INDEX++;
    }
}

function exist(){
    if(document.getElementsByClassName("warningPasswd"))
        return true;
    else
        return false;
}*/