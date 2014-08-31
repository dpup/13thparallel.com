	//====================================\\
	// 13thParallel.org - Math Example    \\
	//   by Dan Pupius (www.pupius.net)   \\
	//====================================\\
	
	//quick function to shorten amount of code
	function getRef(name) { return document.getElementById(name); }

	function animate(curX,endX) {
		//only run scripts on DOM browsers
		if(!document.getElementById || !document.getElementsByTagName) return;
		
		//position box vertically
		getRef("divBox").style.top = 150 + "px";

		if(curX > endX) {	//finished animation
			getRef("divBox").style.left = endX + "px";

		} else {		//continie with animation
			getRef("divBox").style.left = curX + "px";
			setTimeout("animate(" + (curX+5) + "," + endX + ");",55);
		}
	}