function split_pane_class(){
	this.domNode = null;
	this.dragBar = null;
	this.dragBarWidth = 4;
	this.isvert = true;
	this.canResize = false;
	this.pane1obj = null;
	this.pane2obj = null;

	// janky movement related stuff
	this.lastX = 0;
	this.lastY = 0;
	this.currentX = 0;
	this.currentY = 0;

	// signals
	this.resizePane1 = function(width, height, left, top){}
	this.resizePane2 = function(width, height, left, top){}
	this.resizePane1By = function(width, height){}
	this.resizePane2By = function(width, height){}

	// handle resizing of the container function
	this.resizeContainer = function(width, height){
		width = parseInt(width);
		height = parseInt(height);
		var diffw = width - parseInt(this.domNode.style.width);
		var diffh = height - parseInt(this.domNode.style.height);
		if(this.isvert){
			this.dragBar.style.height=height+"px";
			__sig__.emit(this.resizePane1By, 0, diffh);
			__sig__.emit(this.resizePane2By, diffw, diffh);
		}else{
			this.dragBar.style.width=width+"px";
			__sig__.emit(this.resizePane1By, diffw, 0);
			__sig__.emit(this.resizePane2By, diffw, diffh);
		}
		this.domNode.style.width=width+"px";
		this.domNode.style.height=height+"px";
	}

	// handle internal resizing
	this.doPaneResize = function(evt){
		this.lastX = this.currentX;
		this.currentX = evt.clientX;
		this.lastY = this.currentY;
		this.currentY = evt.clientY;
		if(this.canResize){
			if(this.isvert){
				var dsl = parseInt(this.dragBar.style.left);
				var diffx = parseInt(this.lastX) - parseInt(this.currentX);
				if((dsl>0)||(diffx<0)){
					var th = parseInt(this.domNode.style.height);
					this.dragBar.style.left = dsl-diffx+"px";
					var dsl = parseInt(this.dragBar.style.left);
					__sig__.emit(this.resizePane1, dsl, th, 0, 0);
					__sig__.emit(this.resizePane2, (parseInt(this.domNode.style.width) - (dsl+this.dragBarWidth)), th, dsl+this.dragBarWidth, 0);
				}
			}else{
				var dst = parseInt(this.dragBar.style.top);
				var diffy = parseInt(this.lastY) - parseInt(this.currentY);
				if((dst>0)||(diffy<0)){
					var tw = parseInt(this.domNode.style.width);
					this.dragBar.style.top = dst-diffy+"px";
					var dst = parseInt(this.dragBar.style.top);
					__sig__.emit(this.resizePane1, tw, dst, 0, 0);
					__sig__.emit(this.resizePane2, tw, (parseInt(this.domNode.style.height) - (dst+this.dragBarWidth)), 0, dst+this.dragBarWidth);
				}
			}
		}
	}
}

function pane_class(node){
	this.domNode = node;
	this.domNode.style.border = "1px solid #d4d4d4";
	this.resize = function(width, height){
		this.domNode.style.width = parseInt(width)+"px";
		this.domNode.style.height = parseInt(height)+"px";
		if(arguments.length>2){
			this.domNode.style.left = parseInt(arguments[2])+"px";
			this.domNode.style.top = parseInt(arguments[3])+"px";
		}
	}

	this.resizeBy = function(width, height){
		this.domNode.style.width = parseInt(this.domNode.style.width)+parseInt(width)+"px";
		this.domNode.style.height = parseInt(this.domNode.style.height)+parseInt(height)+"px";
	}
}

// factory function for split panes
function pane_generator(width, height){
	var pane = new split_pane_class();

	// we default to a vertical split bar, existance of optional third argument turns horizontal
	if(arguments.length>2){
		pane.isvert = false;
	}

	// create DOM nodes
	var main = document.createElement("div");
	pane.domNode = main;
	reg_obj(pane, main);
	main.style.width = parseInt(width)+"px";
	main.style.height = parseInt(height)+"px";
	main.style.position = "absolute";
	main.style.overflow = "hidden";
	main.style.border = "1px inset #d4d4d4";

	main.onmousemove = function(evt){ var nevt=null;if(document.all){nevt=event;}else{nevt=evt;} reg_arr[parseInt(this.getAttribute('obj_id'))].doPaneResize(nevt);}

	//main.onmousemove = function(evt){reg_arr[parseInt(this.getAttribute('obj_id'))].doPaneResize(evt);}
	main.onmouseup = function(evt){reg_arr[parseInt(this.getAttribute('obj_id'))].canResize=false;}

	var p1 = document.createElement("div");
	p1.style.position = "absolute";
	p1obj = new pane_class(p1);
	__sig__.connect(pane, pane.resizePane1, p1obj, p1obj.resize);
	__sig__.connect(pane, pane.resizePane1By, p1obj, p1obj.resizeBy);

	var bar = document.createElement("div");
	pane.dragBar = bar;
	bar.style.position = "absolute";
	bar.style.border = "1px solid #d4d4d4";
	bar.style.backgroundColor = "#F6F6F6";
	bar.onmousedown = function(evt){reg_arr[parseInt(this.parentNode.getAttribute('obj_id'))].canResize=true;}

	var p2 = document.createElement("div");
	p2.style.position = "absolute";
	p2obj = new pane_class(p2);
	__sig__.connect(pane, pane.resizePane2, p2obj, p2obj.resize);
	__sig__.connect(pane, pane.resizePane2By, p2obj, p2obj.resizeBy);

	// set up default formatting, 50% to each pane
	var pheight = 0;
	var pwidth = 0;
	if(pane.isvert){
		pwidth = (width/2)-(pane.dragBarWidth/2);
		pheight = height;
		bar.style.height = parseInt(height)+"px";
		bar.style.width = pane.dragBarWidth+"px";
	}else{
		pheight = (height/2)-(pane.dragBarWidth/2);
		pwidth = width;
		bar.style.width = parseInt(width)+"px";
		bar.style.height = pane.dragBarWidth+"px";
	}
	p1obj.resize(pwidth, pheight, 0, 0);

	p1.style.left = "0px";
	p1.style.top = "0px";

	
	if(pane.isvert){
		bar.style.left = p1.style.width;
		bar.style.top = "0px";
		var p2l = parseInt(p1.style.width)+pane.dragBarWidth+"px";
		p2obj.resize(pwidth, pheight, p2l, 0);
	}else{
		bar.style.top = p1.style.height;
		bar.style.left = "0px";
		var p2t = parseInt(p1.style.height)+pane.dragBarWidth+"px";
		p2obj.resize(pwidth, pheight, 0, p2t);
	}

	main.appendChild(p1);
	main.appendChild(bar);
	main.appendChild(p2);
	pane.pane1obj = p1obj;
	pane.pane2obj = p2obj;

	return pane;
}

// tie object and node togeather in registry
var reg_arr = new Array();
function reg_obj(obj, domNode){
	domNode.setAttribute("obj_id", reg_arr.length);
	reg_arr[reg_arr.length]=obj;
}
