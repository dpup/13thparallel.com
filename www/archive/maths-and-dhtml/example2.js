	//====================================\\
	// 13thParallel.org - Math Example    \\
	//   by Dan Pupius (www.pupius.net)   \\
	//====================================\\
	
	//quick function to shorten amount of code
	function getRef(name) { return document.getElementById(name); }


	function animate(startX,endX,duration,startTime,endTime) {
		//only run scripts on DOM browsers
		if(!document.getElementById || !document.getElementsByTagName) return;


		//startTime and endTime are not passed to the function manually, but
		//are set up the first time the function is called

		if(!startTime) var startTime = new Date().valueOf();
		if(!endTime) var endTime = startTime + duration;
		
		var curTime = new Date().valueOf();


		//position box vertically
		getRef("divBox").style.top = 150 + "px";

		if(curTime > endTime) {	//finished animation
			getRef("divBox").style.left = endX + "px";

		} else {		//continue with animation

			//first we calculate how far through the animation we should be
			var percent = (curTime - startTime) / (endTime - startTime);

			//we can then use this to calculate how far the box SHOULD HAVE travelled by now
			var curX = (percent * (endX - startX)) + startX;
 
			//update the position of the box
			getRef("divBox").style.left = curX + "px";

			//recall the animate function
			setTimeout("animate(" + startX + "," + endX + "," + duration + "," + startTime + "," + endTime + ");",10);
		}
	}