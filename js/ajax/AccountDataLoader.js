function AccountDataLoader(){}

AccountDataLoader.URL_REQUEST = "./../php/ajax/accountDataLoader.php";
AccountDataLoader.DEFAULT_METHOD = "GET";
AccountDataLoader.ASYNC_TYPE = false;
AccountDataLoader.SEARCH_TYPE = 0;



AccountDataLoader.loadData =
	function(searchType){
		var queryString = "?searchType=" + searchType;
		var url = AccountDataLoader.URL_REQUEST + queryString;
		var responseFunction = AccountDataLoader.onAjaxResponse;
		AccountDataLoader.SEARCH_TYPE = searchType;
			
		AjaxManager.performAjaxRequest(AccountDataLoader.DEFAULT_METHOD, url, AccountDataLoader.ASYNC_TYPE, null, responseFunction);
	}

AccountDataLoader.onAjaxResponse =
	function(response){

		switch(AccountDataLoader.SEARCH_TYPE){
			case 0:
				LearnDashboard.refreshStatData(response.data);
				return;

			case 1:
				if(response.responseCode == 0)
					LearnDashboard.refreshTopicData(response.data);
				return;

			case 5:
				LearnDashboard.refreshRankData(response.data);
				return;
		}	
	} 