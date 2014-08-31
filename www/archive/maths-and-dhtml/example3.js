	//====================================\\
	// 13thParallel.org    Circle Example \\
	//   by Dan Pupius (www.pupius.net)   \\
	//====================================\\
	
	function degToRad(angle) { return ((angle*Math.PI) / 180); }
	function radToDeg(angle) { return ((angle*180) / Math.PI); }


	function init() {
		//only run scripts on DOM browsers
		if(!document.getElementById || !document.getElementsByTagName) return;

		objBox = new make("divBox");		//create DHTML object using the 13th api (global variable)
		canvas = new getCanvas();		//create object with page dimentions in (global variable)
		
		animate();				//call animation function	
	}

	
	var speed=5;					//number of degrees incremented per iteration
	var radius=100;					//set the radius of the circle (same as the hypotenuse)


	function animate(step) {
		if(!step) step=0;			//set step to 0 if it isn't already specified
		if(step>360) step=0;			//if we've gone round the circle once reset it to zero 

		//===============================================\\
		// From trig:                                    \\
		//               adjacent=hypotenuse*cos(angle)  \\
		//               opposite=hypotenuse*sin(angle)  \\
		//===============================================\\

		//so calculate x and y (converting angle into radians)
		var x = radius * Math.cos(degToRad(step));
		var y = radius * Math.sin(degToRad(step));

		//move box to point on circle (centered on the middle of the page)
		objBox.moveTo((canvas.w/2) + x, (canvas.h/2) + y);

		//recall function while incrementing step y 5-degrees each time
		setTimeout("animate(" + (step+speed) + ");",55);
	}


	onload=init;