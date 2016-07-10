//=======================================================\\
//                    13thparallel.org                   \\
//                   Copyright (c) 2002                  \\ 
//   see (13thparallel.org/?title=about) for more info   \\
//=======================================================\\


	make.prototype.moves = new Array();     //array of movements to be carried out in order
	make.prototype.cancelMoves = false;     //stop a movement that is currently being carried out
	make.prototype.moving = false;          //is the object currently moving?



	
	//====================================================================================
	// timeSlide() - uses a bezier curve controlled accelleration to move between 2 points
	//               over a given time period
	//====================================================================================
	// (x,y)     = destination coordinates
	// duration  = how long in ms to do the animation for
	// acc       = coefficient of accelleration -1 <= acc <= 1 (defualt = 0)
	//                 1 = start slow, get faster
	//                 0 = linear
	//                -1 = start fast and slow down to stop
	//    (if acc > 1 then it will go backwards before heading towards destination)
	// func      = a function to be called when animation has finished
	// cancel    = if true  - stops all other movements and does this one
	//             if false - (default) adds movement to end of slides array
	// timeout   = sets timeout speed (default = 5)
	//====================================================================================
	
	make.prototype.timeSlide = function(x,y,duration,acc,func,cancel,timeout) {
		if(!cancel) var cancel = false;
		if(!func) var func = "null";
		if(!timeout) var timeout = 5;
		if(!acc) var acc = 0;
		
		var startTime = new Date().valueOf();
		var endTime = startTime + duration;
		
		if(!this.moving) {	//object isn't already moving so start animation
			this.moving = true;
			this.timeSlideAux(this.x,this.y,x,y,acc,startTime,endTime,func,cancel,timeout);
		} else {
			if(cancel) {		//cancel other moves
				this.cancelMoves = true;
				this.moves = new Array();
			}
			//add this movement to array of movements
			var strExec = this.obj + ".timeSlide(" + x + "," + y + "," + duration + "," + acc + ",'" + func + "'," + cancel + "," + timeout + ")";
			this.moves.push(strExec);			
		}
	}
	
	make.prototype.timeSlideAux = function(startX,startY,endX,endY,acc,startTime,endTime,func,cancel,timeout) {
		var curTime = new Date().valueOf();
		if(this.cancelMoves) {
			this.moving = false;
			this.cancelMoves = false;
			if(this.moves[0]) eval(this.moves.shift());
			
		} else if(curTime >= endTime) {
			this.moveTo(endX,endY);
			this.moving = false;
			if(func) eval(func);
			if(this.moves[0]) eval(this.moves.shift());
			
		} else {
			var percent = (curTime - startTime) / (endTime - startTime); //percentage of way through animation
			var startPos = new coord(1,1);
			var endPos = new coord(0,0);	
					
			if(acc!=0) var c1 = new coord(0.5+(acc/2),0.5-(acc/2));
			else c1 = null;
			var pos = getBezier(percent,startPos,endPos,c1);
			var stage = pos.y;
	
			this.moveTo(((endX-startX)*stage)+startX,((endY-startY)*stage)+startY);
			//this.moveTo(((endX-startX)*pos.x)+startX,((endY-startY)*pos.y)+startY);

			var strExec = this.obj + ".timeSlideAux(" + startX + "," + startY + "," + endX + "," + endY + "," + acc + "," + startTime + "," + endTime + ",'" + func + "'," + cancel + "," + timeout + ")";
			setTimeout(strExec,timeout);
			
		}
	}
	

	//====================================================================================
	// bezierSlide() - like timeSlide but instead of a straight line it follows a
	//                 bezier curve
	//====================================================================================
	// (x,y)     = destination coordinates
	// duration  = how long in ms to do the animation for
	// acc       = coefficient of accelleration -1 <= acc <= 1 (defualt = 0)
	//               > 1 = start slow, get faster
	//                 0 = linear
	//               < 1 = start fast and slow down to stop
	//    (if acc > 1 then it will go backwards before heading towards destination)
	// C1x,C1y
	// C2x,C2y   = Bezier control points
	// func      = a function to be called when animation has finished
	// cancel    = if true  - stops all other movements and does this one
	//             if false - (default) adds movement to end of slides array
	// timeout   = sets timeout speed (default = 5)
	//====================================================================================
	
	make.prototype.bezierSlide = function(x,y,c1x,c1y,c2x,c2y,duration,acc,func,cancel,timeout) {
		if(!cancel) var cancel = false;
		if(!func) var func = "null";
		if(!timeout) var timeout = 5;
		if(!acc) var acc = 0;
		
		var startTime = new Date().valueOf();
		var endTime = startTime + duration;
		
		if(!this.moving) {	//object isn't already moving so start animation
			this.moving = true;
			this.bezierSlideAux(this.x,this.y,x,y,c1x,c1y,c2x,c2y,acc,startTime,endTime,func,cancel,timeout);
		} else {
			if(cancel) {		//cancel other moves
				this.cancelMoves = true;
				this.moves = new Array();
			}
			//add this movement to array of movements
			var strExec = this.obj + ".bezierSlide(" + x + "," + y + "," + c1x + "," + c1y + "," + c2x + "," + c2y + "," + duration + "," + acc + ",'" + func + "'," + cancel + "," + timeout + ")";
			this.moves.push(strExec);			
		}
	}
	
	make.prototype.bezierSlideAux = function(startX,startY,endX,endY,c1x,c1y,c2x,c2y,acc,startTime,endTime,func,cancel,timeout) {
		var curTime = new Date().valueOf();
		if(this.cancelMoves) {
			this.moving = false;
			this.cancelMoves = false;
			if(this.moves[0]) eval(this.moves.shift());
			
		} else if(curTime >= endTime) {
			this.moveTo(endX,endY);
			this.moving = false;
			if(func) eval(func);
			if(this.moves[0]) eval(this.moves.shift());
			
		} else {
			var percent = (curTime - startTime) / (endTime - startTime); //percentage of way through animation
			var startPos = new coord(0,0);
			var endPos = new coord(1,1);	
					
			if(acc!=0) var c1 = new coord(0.5-(acc/2),0.5+(acc/2));
			else c1 = null;
			var pos = getBezier(percent,startPos,endPos,c1);
			var stage = pos.y;
	
			var startPos = new coord(startX,startY);
			var endPos = new coord(endX,endY);
			var c1 = new coord(c1x,c1y);
			var c2 = new coord(c2x,c2y);
			var pos = getBezier(stage,startPos,endPos,c1,c2);
			this.moveTo(pos.x,pos.y);

			var strExec = this.obj + ".bezierSlideAux(" + startX + "," + startY + "," + endX + "," + endY + "," + c1x + "," + c1y + "," + c2x + "," + c2y + "," + acc + "," + startTime + "," + endTime + ",'" + func + "'," + cancel + "," + timeout + ")";
			setTimeout(strExec,timeout);
			
		}
	}


	
	//====================================================================================
	// doCancelMoves() - cancels all animations, unless true is past as an argument, in
	//                   which case all future moves are canceled and the current one is
	//                   allowed to finish
	//====================================================================================
	make.prototype.doCancelMoves = function(keepCurrent) {
		if(keepCurrent) this.cancelMoves = true;
		this.moves = new Array();
	}




	//====================================================================================
	// getBezier() - calculates a given position along a Bezier curve specified by 2,3 or
	//               4 control points.
	//====================================================================================

	//Bezier functions:
	B1 = function(t) { return (t*t*t); }
	B2 = function(t) { return (3*t*t*(1-t)); }
	B3 = function(t) { return (3*t*(1-t)*(1-t)); }
	B4 = function(t) { return ((1-t)*(1-t)*(1-t)); }
	
	//coordinate constructor
	coord = function (x,y) { if(!x) var x=0; if(!y) var y=0; return {x: x, y: y}; }
	
	//Finds the coordinates of a point at a certain stage through a bezier curve
	function getBezier(percent,startPos,endPos,control1,control2) {
		//if there aren't any extra control points plot a straight line, if there is only 1
		//make 2nd point same as 1st
		
		if(!control2 && !control1) var control2 = new coord(startPos.x + 3*(endPos.x-startPos.x)/4, startPos.y + 3*(endPos.y-startPos.y)/4);
		if(!control2) var control2 = control1;
		if(!control1) var control1 = new coord(startPos.x + (endPos.x-startPos.x)/4, startPos.y + (endPos.y-startPos.y)/4);
				
		var pos = new coord();
		pos.x = startPos.x * B1(percent) + control1.x * B2(percent) + control2.x * B3(percent) + endPos.x * B4(percent);
		pos.y = startPos.y * B1(percent) + control1.y * B2(percent) + control2.y * B3(percent) + endPos.y * B4(percent);
		
		return pos;
	}
