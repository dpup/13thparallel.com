	//====================================\\
	// 13thParallel.org - Math Example    \\
	//   by Dan Pupius (www.pupius.net)   \\
	//====================================\\


	function degToRad(angle) { return ((angle*Math.PI) / 180); }
	function radToDeg(angle) { return ((angle*180) / Math.PI); }
	
	
	var num=20;												//holds number of blobss being animated
	var blobs = new Array(num);								//array that will store the blobs
	var maxX = 495;											//defines max bounds for the bouncing blobs
	var maxY = 295;
	function init() {
		var container = document.getElementById("divContainer");
		
		for(var i=0;i<num;i++) {							//make "num" blobs
			var blob = document.createElement("div");		//create blob element
			blob.className = "blob";						//set it's style
			blob.style.left = Math.round(Math.random()*maxX) + "px";	//move it to random position
			blob.style.top = Math.round(Math.random()*maxY) + "px";
			
			container.appendChild(blob);					//append it to the container div
			
			blobs[i] = { obj: blob,							//create a simple blob object
			             css: blob.style,
			             setPos: function(x,y) { this.css.left = parseInt(x) + "px"; this.css.top = parseInt(y) + "px"; },
			             x: function() { return parseInt(this.css.left); },
			             y: function() { return parseInt(this.css.top); },
			             speed: Math.round(Math.random()*10)+5,
			             angle: Math.round(Math.random()*360)
			            };		
		}
		
		animate();	
	}
	
	var gravity = 1;
	function animate() {
		for(var i=0;i<num;i++) {
			//calculate horizontal & vertical components of velocity
			var vx = blobs[i].speed * Math.cos(degToRad(blobs[i].angle));
			var vy = blobs[i].speed * Math.sin(degToRad(blobs[i].angle));
			
			//add gravitational effect
			
			//check to see if the blob needs to bouncing - if it does, cushion bounce
			if((blobs[i].x()<=0 && vx<=0) || (blobs[i].x()>=maxX && vx>=0)) vx *= -0.7;
			if((blobs[i].y()<=0 && vy<=0) || (blobs[i].y()>=maxY && vy>=0)) vy *= -0.6;
			
			//apply gravity
			vy += gravity;
									
			//update velocity
			blobs[i].speed = Math.sqrt((vx*vx)+(vy*vy));
			blobs[i].angle = radToDeg(Math.atan2(vy,vx));

			//move blob
			blobs[i].setPos(blobs[i].x()+vx,blobs[i].y()+vy);

		}
		//loop animation
		setTimeout("animate();",25);
	}

	function boost() {
		for(var i=0;i<num;i++) {
			blobs[i].speed = Math.random()*50 +10;		
			blobs[i].angle = Math.random()*365;	
		}
	}

	onload = init;