function UpdateAccountStat(){}

UpdateAccountStat.URL_REQUEST = "./ajax/updateAccountStat.php";
UpdateAccountStat.ASYNC_TYPE = false;
UpdateAccountStat.DEFAULT_METHOD = "GET";

UpdateAccountStat.SUCCESS_RESPONSE = 0;
UpdateAccountStat.ERROR_RESPONSE = 1;

UpdateAccountStat.updateLight =
	function(lightNumber){
		var queryString = "?lightNumber=" + lightNumber;
		var url = UpdateAccountStat.URL_REQUEST + queryString;
		var responseFunction = UpdateAccountStat.onAjaxResponse;

		AjaxManager.performAjaxRequest(UpdateAccountStat.DEFAULT_METHOD, url, UpdateAccountStat.ASYNC_TYPE, null, responseFunction);
	}

UpdateAccountStat.updateOtherStat = 
	function(updateType){
		var queryString = "?updateType=" + updateType;
		var url = UpdateAccountStat.URL_REQUEST + queryString;
		var responseFunction = UpdateAccountStat.onAjaxResponse;

		AjaxManager.performAjaxRequest(UpdateAccountStat.DEFAULT_METHOD, url, UpdateAccountStat.ASYNC_TYPE, null, responseFunction);
	}

UpdateAccountStat.updateProgress = 
	function(topicId, lang){
		var queryString = "?topicId=" + topicId + "&lang=" + lang;
		var url = UpdateAccountStat.URL_REQUEST + queryString;
		var responseFunction = UpdateAccountStat.onAjaxResponse;

		AjaxManager.performAjaxRequest(UpdateAccountStat.DEFAULT_METHOD, url, UpdateAccountStat.ASYNC_TYPE, null, responseFunction);
	}

UpdateAccountStat.onAjaxResponse =
	function(response){
		if(response.responseCode == UpdateAccountStat.SUCCESS_RESPONSE){
			return;
		}
		
		if(response.responseCode == UpdateAccountStat.ERROR_RESPONSE)
			alert("ERRORE: Si è verificato un problema durante la comunicazione con il server");
	}