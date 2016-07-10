	//====================================\\
	// 13thParallel.org Beziér Curve Code \\
	//   by Dan Pupius (www.pupius.net)   \\
	//====================================\\
	
	coord = function (x,y) { if(!x) var x=0; if(!y) var y=0; return {x: x, y: y}; }
	
	B1 = function(t) { return (t*t*t); }
	B2 = function(t) { return (3*t*t*(1-t)); } 
	B3 = function(t) { return (3*t*(1-t)*(1-t)); }
	B4 = function(t) { return ((1-t)*(1-t)*(1-t)); }

	function getBezier(percent,C1,C2,C3,C4) {
		var pos = new coord();
		pos.x = C1.x * B1(percent) + C2.x * B2(percent) +C3.x * B3(percent) + C4.x * B4(percent);
		pos.y = C1.y * B1(percent) + C2.y * B2(percent) + C3.y * B3(percent) + C4.y * B4(percent);
		return pos; 
	}
	
	//Control Points
	P1 = coord(50,50);
	P2 = coord(300,50);
	P3 = coord(50,300);
	P4 = coord(300,300);

	stage=0;
	dir=0;	
	function doCurve() {
		//change direction of motion at each end of the curve
		if(stage>1) dir=1;
		if(stage<0) dir=0;
		
		//increment to next step
		if(dir==0) stage+=0.01;
		else stage-=0.01;
		
		//find position on bezier curve
		var curpos = getBezier(stage,P1,P2,P3,P4)
		
		//set position of box
		if(document.getElementById) {
			document.getElementById("divbox").style.top = Math.round(curpos.y) + "px";		
			document.getElementById("divbox").style.left = Math.round(curpos.x) + "px";
		} else if(document.layers) {
			document.layers["divbox"].top = Math.round(curpos.y);		
			document.layers["divbox"].left = Math.round(curpos.x);
		} else if(document.all) {
			document.all["divbox"].style.top = Math.round(curpos.y);		
			document.all["divbox"].style.left = Math.round(curpos.x);
		}
		
		setTimeout("doCurve()",20);
	}
	onload = doCurve;
