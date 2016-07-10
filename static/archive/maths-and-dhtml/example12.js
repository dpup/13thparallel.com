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
			blob.style.left = "0px";
			blob.style.top = "190px";
			
			container.appendChild(blob);					//append it to the container div
			
			blobs[i] = { obj: blob,							//create a simple blob object
			             css: blob.style,
			             setPos: function(x,y) { this.css.left = parseInt(x) + "px"; this.css.top = parseInt(y) + "px"; },
			             x: function() { return parseInt(this.css.left); },
			             y: function() { return parseInt(this.css.top); },
			             speed: Math.round(Math.random()*15)+10,
			             angle: Math.round(Math.random()*-70)-10,
			             friction: Math.random()
			            };		
		}
		
		animate();	
	}
	
	var current = 0;

	function animate() {
		current = (Math.random()*2)-1;
		for(var i=0;i<num;i++) {

			//check to see if the blob needs to bouncing
			if(blobs[i].x()>maxX || blobs[i].y()>maxY) {
				blobs[i].setPos(0,190);
				blobs[i].speed = Math.round(Math.random()*15)+10;
			        blobs[i].angle = Math.round(Math.random()*-70)-10;
			}

			//calculate horizontal & vertical components of velocity
			var vx = blobs[i].speed * Math.cos(degToRad(blobs[i].angle));
			var vy = blobs[i].speed * Math.sin(degToRad(blobs[i].angle));
			
			if(blobs[i].y() < 190) vy += 1;
			else {
				vx *= 0.9;
				vx += current;
				vy *= 0.80;
				vy += 0.4;
			}
			
			//update velocity
			blobs[i].speed = Math.sqrt((vx*vx)+(vy*vy));
			blobs[i].angle = radToDeg(Math.atan2(vy,vx));

			//move blob
			blobs[i].setPos(blobs[i].x()+vx,blobs[i].y()+vy);

		}
		//loop animation
		setTimeout("animate();",25);
	}

	onload = init;