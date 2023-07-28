function PracticeDataLoader(){}

PracticeDataLoader.URL_REQUEST = './ajax/practiceDataLoader.php';
PracticeDataLoader.DEFAULT_METHOD = "GET";
PracticeDataLoader.ASYNC_TYPE = true;

PracticeDataLoader.QUESTIONS_ARRAY = null;


PracticeDataLoader.loadData =
	function(topicId){
		var queryText = "?topicId=" + topicId;
		var url = PracticeDataLoader.URL_REQUEST + queryText;
		var responseFunction = PracticeDataLoader.onAjaxResponse;

		AjaxManager.performAjaxRequest(PracticeDataLoader.DEFAULT_METHOD, url, PracticeDataLoader.ASYNC_TYPE, null, responseFunction);
	}

PracticeDataLoader.onAjaxResponse =
	function(response){
		if(response.responseCode != 0){
			PracticeDashboard.setEmpty();
		}

		PracticeDataLoader.QUESTIONS_ARRAY = response.data.slice(); //save questions
		PracticeDashboard.init(); //inizialize index value
		PracticeDashboard.refreshData(PracticeDataLoader.QUESTIONS_ARRAY); //arrange questions on the page
	}	