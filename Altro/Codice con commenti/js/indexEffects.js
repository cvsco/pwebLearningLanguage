var NUM_BACKGROUND_WALLPAPER = 3;

function begin(){
	var randomindex = Math.floor(Math.random()*NUM_BACKGROUND_WALLPAPER);
	
	document.getElementById("bg-image").style.backgroundImage = "url('./css/img/index/index_background_" + randomindex + ".jpg')";
	/*var timer = setInterval(function(){
		var i = 0;
		for(; i<=1; i++)

	}, 10000);*/
	
} 

/************************************************************
			EFFETTO ROTAZIONE FORM LogIn SignIn
*************************************************************/
var OP = 0; //opacity

function viewLoginSignin(firstForm, secondForm){
	var ff = document.getElementById(firstForm);
	OP=0.9;
			
	var turn = setInterval(function(){
		if(OP<=0.1){
			clearInterval(turn);
			ff.style.display = "none";

			var sf = document.getElementById(secondForm);
			sf.style.display = "block";
			OP = 0.1;

			var emerge = setInterval(function(){
				if(OP>=1){
					sf.style.opacity = OP;
					clearInterval(emerge);
				}

				/*sf.style.opacity = OP;
				OP+=0.1; 
				sf.style.transition = "transform 0.5s ease";
				sf.style.transform = "perspective("+0+") "+ "scaleZ("+0.1+") "+ "rotateY("+0+"deg)";*/
				transitionInOut(0, sf); //OUT
			}, 45);
		}
				
		/*ff.style.opacity = OP;
		OP-=0.1;
		ff.style.transition = "transform 0.5s ease";
		ff.style.transform = "perspective("+100+'rem)'+ "scaleZ("+1.4+") rotateY("+45+"deg)";*/
		transitionInOut(1, ff); //IN
	}, 45);
}


function transitionInOut(index, form){
	if(index==1){
		form.style.opacity = OP;
		OP-=0.1;
		form.style.transition = "transform 0.5s ease";
		form.style.transform = "perspective("+100+'rem)'+ "scaleZ("+1.4+") rotateY("+45+"deg)";
	}
	else{
		form.style.opacity = OP;
		OP+=0.1;
		form.style.transition = "transform 0.5s ease";
		form.style.transform = "perspective("+0+") "+ "scaleZ("+0.1+") "+ "rotateY("+0+"deg)";
	}

}