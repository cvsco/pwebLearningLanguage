function ShopDataLoader(){}

ShopDataLoader.URL_REQUEST = "./../php/ajax/shopDataLoader.php";
ShopDataLoader.DEFAULT_METHOD = "GET";
ShopDataLoader.ASYNC_TYPE = false;
ShopDataLoader.POWERUP_TYPE = 0;
ShopDataLoader.STREAK_BUTTON_INDEX = 0;
ShopDataLoader.COIN_BUTTON_INDEX = 1;
ShopDataLoader.NAVBAR_USER_DATA = 0;

ShopDataLoader.updatePowerupData = 
	function(powerupType){
		var queryString = "?powerupType=" + powerupType;
		var url = ShopDataLoader.URL_REQUEST + queryString;
		var responseFunction = ShopDataLoader.onAjaxResponse;
		ShopDataLoader.POWERUP_TYPE = powerupType;
			
		AjaxManager.performAjaxRequest(ShopDataLoader.DEFAULT_METHOD, url, ShopDataLoader.ASYNC_TYPE, null, responseFunction);
	}

ShopDataLoader.onAjaxResponse =
	function(response){
		switch(response.responseCode){
			case -1:
				ShopDataLoader.disableButton(ShopDataLoader.STREAK_BUTTON_INDEX);//disabled freeze button
				break;

			case -2:
				ShopDataLoader.disableButton(ShopDataLoader.COIN_BUTTON_INDEX);//disabled bet button
				break;

			case -3:
				ShopDataLoader.disableButton(ShopDataLoader.STREAK_BUTTON_INDEX);
				ShopDataLoader.disableButton(ShopDataLoader.COIN_BUTTON_INDEX);//disabled bet button
				break;

			case 1:
				alert(response.message);
				break; 
		}
		
		AccountDataLoader.loadData(ShopDataLoader.NAVBAR_USER_DATA); //resfresh navbar
	}

ShopDataLoader.disableButton =
	function(index){
		var button = document.getElementsByClassName("buyButton")[index];
		button.disabled = true;
	}

