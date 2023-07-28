/******************************************************************
    MESSAGE AND COLOR CUSTOMIZATION WHEN SUBMIT EMPTY INPUT FIELD 
                                  &
                  PASSWORD COMPARE IN FORM SIGNIN
                                  &
                   MENAGE EMAIL OR USERNAME DUPLICATE
*******************************************************************/
function FormManager(){}

FormManager.DEFAULT_METHOD = "GET";
FormManager.URL_REQUEST = "./php/ajax/formCheck.php";
FormManager.ASYNC_TYPE = false; //must do synchronous request because after JSON response we must return false in case of error in submitHandler function
FormManager.CHECK = 0;

/*call addHandlers in onload event in the index.php file for manage forms 
FormManager.addHandlers(document.login); //login form
FormManager.addHandlers(document.signin); //signin form*/
FormManager.addHandlers =
    function (form){
        var elements = form.getElementsByTagName("INPUT");
    
        for (var i = 0; i < elements.length; i++) {
            elements[i].oninvalid = FormManager.invalidHandler;//set message and wrong color

            elements[i].oninput = function(evt) {//remove message while writing in input field
                evt.target.setCustomValidity("");
            };

            elements[i].onchange = function(evt) {//set right color
                evt.target.style.borderColor = "rgb(179, 230, 255, 0.32)";
            };

            elements[i].onblur = FormManager.checkConstraint;//check pattern of input

            if(form.name === "signin"){ //form submit signin
                form.onsubmit = FormManager.submitHandler;
            }
        }
    }

FormManager.invalidHandler =
    function(evt){
        evt.target.setCustomValidity("");

        //message and color customization
        var field = evt.target;
        field.style.borderColor = "rgb(204, 0, 0)";
        
        if(field.validity.valueMissing){

            switch (field.getAttribute("id")){
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
                    field.setCustomValidity("Inserire una email valida");
                    return;
            }
        }
    }

//when constraints are not respected
FormManager.checkConstraint = 
    function(evt){
        var field = evt.target;
        
        if(field.value == "" || field.textContent == null)
            return;

        field.setCustomValidity("");
        if (!field.checkValidity()){
         FormManager.invalidHandler(evt);
         return;
        }
    }

FormManager.submitHandler = 
    function(){
        if(!passwdCompare(this))//manage password compare
            return false;
        
        //menage email or username duplicate
        duplicateEmailUsername(this);
        
        if(FormManager.CHECK == 1)//set to 1 in case of email or username duplicate
            return false;
    }

function passwdCompare(form){
    var password = form.password;
    var repassword = form.conferma_password;

    if(password.value != repassword.value){
        //first delete other error messages
        deleteErrorMessage("email");
        deleteErrorMessage("username");

        //then set password error message
        repassword.style.borderColor = "rgb(179, 0, 0)";
        document.getElementsByClassName("signin_error_message")[0].style.display = "block";
        return false;
    }

    return true;
}

function duplicateEmailUsername(form){
    var queryString = "?emailRequired=" + form.email.value + "&usernameRequired=" + form.username.value;
    var url = FormManager.URL_REQUEST + queryString;
    var responseFunction = FormManager.onAjaxResponse;

    AjaxManager.performAjaxRequest(FormManager.DEFAULT_METHOD, url, FormManager.ASYNC_TYPE, null, responseFunction);
}

FormManager.onAjaxResponse = 
    function(response){

        switch(response.responseCode){
            case 0: //OK
                FormManager.CHECK = 0;
                return;

            case -1: //error: email already in db
                createErrorMessage("email", response.message);
                deleteErrorMessage("username");
                return;

            case -2://error: username already in db
                createErrorMessage("username", response.message);
                deleteErrorMessage("email");
                return;
        }
    }

function createErrorMessage(field, message){
    var fieldTarget = document.getElementsByClassName(field)[0];
    var errorMessage = fieldTarget.getElementsByClassName("error_message")[0];

    if(errorMessage != null){//if the error message already exists
        errorMessage.style.display = "block";
        return;
    }

    var warningDivElem = document.createElement("div");
    warningDivElem.setAttribute("class", "error_message");
    var warningSpanElem = document.createElement("span");
    warningSpanElem.textContent = message;
       
    warningDivElem.appendChild(warningSpanElem);
    document.getElementsByClassName(field)[0].appendChild(warningDivElem);
    FormManager.CHECK = 1;
}

function deleteErrorMessage(field){
    var fieldTarget = document.getElementsByClassName(field)[0];

    if(fieldTarget.getElementsByClassName("error_message")[0] == null)//if the error message don't exist return
        return;

    var errorMessage = fieldTarget.getElementsByClassName("error_message")[0];
    errorMessage.style.display = "none";
}

