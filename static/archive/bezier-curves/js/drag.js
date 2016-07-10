//=======================================================\\
//                    13thparallel.org                   \\
//                   Copyright (c) 2002                  \\ 
//   see (13thparallel.org/?title=about) for more info   \\
//=======================================================\\
  
  function BrowserObject(){		// BRATTA'S CHECK BROWSER CODE
	this.ver=navigator.appVersion
	this.dom=document.getElementById?1:0
	this.ie6=(this.ver.indexOf("MSIE 6")>-1 && this.dom)?1:0;
	this.ie5=(this.ver.indexOf("MSIE 5")>-1 && this.dom)?1:0;
	this.ie4=(document.all && !this.dom)?1:0;

	this.ns5=(this.dom && parseInt(this.ver) >= 5) ?1:0;
	this.ns4=(document.layers && !this.dom)?1:0;
	//added
	this.ie4mac=this.ie4 && navigator.userAgent.indexOf("Mac")>-1
	this.ie5mac=this.ie5 && navigator.userAgent.indexOf("Mac")>-1
	this.ie55=(this.ver.indexOf("MSIE 5.5")>-1 && this.dom)?1:0; 
	this.ie=(this.ie5||this.ie4||this.ie4mac||this.ie5mac||this.ie6);
	this.nn=(this.ns5||this.ns4);
	this.bw=(this.ie || this.nn)
	return this
  }

  var browser = new BrowserObject();



var cZIndex = 100;
  function makeDragObject(el, objName, dragtarget, minX, maxX, minY, maxY, on, off, move) { 
  
     function f_x() {
       if(!browser.ie) return parseInt(this.css.left);
       else return this.css.pixelLeft;
     }  
  
     function f_y() {
       if(!browser.ie) return parseInt(this.css.top);
       else return this.css.pixelTop;
     }
  
     function f_height() {
       if(browser.ie) return this.obj.offsetHeight;
       else return parseInt(this.css.height);
     }

     function f_setHeight(h) {
       if(h<=0) this.css.height = 1;
       else  this.css.height = h;
     }

     function f_setWidth(w) {
       if(w<=0) this.css.width = 1;
       else  this.css.width = w;
     }

     function f_width() {
       if(browser.ie) return this.obj.offsetWidth;
       else return parseInt(this.css.width);
     }
  
     function f_moveMe(x,y) {
       if(this.dragtarget) {
         this.dragtarget.moveMe(x,y);
       } else {
         y = parseInt(y);
         x = parseInt(x);
         if(y > eval(this.maxY) - this.height()) y = eval(this.maxY) - this.height();
         if(y < eval(this.minY)) y = eval(this.minY);
         if(x > eval(this.maxX) - this.width()) x = eval(this.maxX) - this.width();
         if(x < eval(this.minX)) x = eval(this.minX);
         this.css.top = y;
         this.css.left = x;
       }
     }
  
     function f_show() {
       this.css.visibility = "visible";
     }

     function f_hide() {
       this.css.visibility = "hidden";
     }

     function f_dragX() {
       if(this.dragtarget) return this.dragtarget.x();
       else return this.x();
     }

     function f_dragY() {
       if(this.dragtarget) return this.dragtarget.y();
       else return this.y();
     }

    
     if(browser.dom) {
       this.css = document.getElementById(el).style;
       this.obj = document.getElementById(el);
     } else if(browser.ie) {
       this.css = document.all[el].style;
       this.obj = document.all[el];      
     }

     this.moveMe = f_moveMe;
     this.show = f_show;
     this.hide = f_hide;
     this.setHeight = f_setHeight;
     this.setWidth = f_setWidth;
     this.y = f_y;
     this.x = f_x;    
     this.height = f_height;
     this.width = f_width;
     this.startX = this.x()
     this.startY = this.y();
     this.dragX = f_dragX;
     this.dragY = f_dragY;
    
    
     this.name = objName;
     this.moving = false;

     if(!minX) minX = "0";
     if(!minY) minY = "0";
     if(!maxX) maxX = "document.body.offsetWidth-18";
     if(!maxY) maxY = "document.body.offsetHeight-4";
   
     this.drag = false;
     this.clickedX = 0;
     this.clickedY = 0;
     this.lastX = this.x();
     this.lastY = this.y();
     this.minY = minY;
     this.maxY = maxY;
     this.minX = minX;
     this.maxX = maxX;      
     this.obj.onmouseover = mouseOver;
     this.obj.onmouseout = mouseOut;

     if(on) this.on = on;
     else this.on = function() { }
     if(off) this.off = off;
     else this.off = function() { }
     if(move) this.move = move;
     else this.move = function() { }

     if(dragtarget) {
       this.dragtarget = new DhtmlObject(dragtarget, this.name + ".dragtarget");
       this.dragtarget.moveMe = f_moveMe;
       this.dragtarget.minY = this.minY;
       this.dragtarget.maxY = this.maxY;
       this.dragtarget.minX = this.minX;
       this.dragtarget.maxX = this.maxX;         
     }
     
     return this;
  }
  


  isDown = false;
  var mx = 0; var my = 0;
  
  function mouseUp(){
    isDown = false;
    for(var i=0; i<objDragger.length;i++){
      if(objDragger[i].isOver && objDragger[i].drag)
        stopDrag(i);
    }
  }
  
  function mouseDown(e){
    if(browser.nn) { x = e.pageX; y = e.pageY; }
    else { x = event.x; y = event.y; }
    isDown = true;
    for(var i=0; i<objDragger.length;i++){
      if(objDragger[i].isOver) {
        objDragger[i].drag=true;
        objDragger[i].clickedX = x - objDragger[i].x();
        objDragger[i].clickedY = y - objDragger[i].y();
        if(objDragger[i].dragtarget) { 
          objDragger[i].clickedX -= objDragger[i].dragtarget.x();
          objDragger[i].clickedY -= objDragger[i].dragtarget.y();
        }
        objDragger[num].on();
        cZIndex++;
        if(!objDragger[i].dragtarget) objDragger[i].css.zIndex=cZIndex;
        else objDragger[i].dragtarget.css.zIndex=cZIndex;
      }
    }
  }
  
  function mouseMove(e){
    if(browser.nn) { x = e.pageX; y = e.pageY; }
    else { x = event.x; y = event.y; }
    mx = x; my = y;
    for(i=0; i<objDragger.length;i++){
      if(objDragger[i].drag) {
        objDragger[i].moveMe(x-objDragger[i].clickedX,y-objDragger[i].clickedY);
        objDragger[i].move();
        if(!objDragger[i].isOver && !isDown && objDragger[i].drag) stopDrag(i);
      }
    }  
    return false; 
  }

  function mouseOver(e){
    if(browser.nn) type = e.target.name;
    else type = window.event.srcElement.tagName;
    if(type =="DIV" || browser.nn) {
      if(browser.nn) num = e.target.id.substr(10,2);
      else if(browser.ie) num = window.event.srcElement.id.substr(10,2);
      else num = 0;
      if(browser.nn) for(i=0; i<objDragger.length;i++) objDragger[i].isOver = true;
      else objDragger[parseInt(num)].isOver = true
    }
  }
  
  function mouseOut(e){
    if(browser.nn) type = e.target.name;
    else type = window.event.srcElement.tagName;
    if(type =="DIV" || browser.nn) {
      if(browser.nn) num = e.target.id.substr(10,2);
      else if(browser.ie) num = window.event.srcElement.id.substr(10,2);
      else num = 0;
      if(browser.nn) for(i=0; i<objDragger.length;i++) objDragger[i].isOver = false;	
      else objDragger[parseInt(num)].isOver = false;
    }
  }  
  
  function stopDrag(num) {
    objDragger[num].drag = false;
    objDragger[num].off();
  }