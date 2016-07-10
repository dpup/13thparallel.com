//=======================================================\\
//                    13thparallel.org                   \\
//                   Copyright (c) 2002                  \\ 
//   see (13thparallel.org/?title=about) for more info   \\
//=======================================================\\

if(location.href.indexOf("13thparallel") == -1)
  
top.location.replace("http://13thparallel.org/?title=you_seem_to_have_come_from_a_page_that_is_a_rip");

var px = document.layers || window.opera ? "" : "px";

// basic object constructor
function make (id) {
	this.elm = document.getElementById ? document.getElementById(id) : document.all ? document.all[id] : null;
	if (!this.elm) return null;
	this.css = this.elm.style;
	this.obj = id + 'Obj';
	eval(this.obj + ' = this');
	this.x = this.elm.offsetLeft ? this.elm.offsetLeft : 0;
	this.y = this.elm.offsetTop ? this.elm.offsetTop : 0;
	this.w = this.elm.offsetWidth ? this.elm.offsetWidth : 0;
	this.h = this.elm.offsetHeight ? this.elm.offsetHeight : 0;
}

make.prototype.show = function() {
	this.css.visibility = "visible";
}

make.prototype.hide = function() {
	this.css.visibility = "hidden";
}

make.prototype.moveTo = function(x, y) {
	if (x != null) {
		x = Math.round(x);
		this.x = x;
		this.css.left = x + px;
	}
	if (y != null) {
		y = Math.round(y);
		this.y = y;
		this.css.top = y + px;
	}
}

make.prototype.moveBy = function(x, y) {
	this.moveTo(this.x + x, this.y + y);
}

make.prototype.getW = function() {
	if (this.elm.offsetWidth) return this.elm.offsetWidth;
	else if (parseInt(this.css.width)) return parseInt(this.css.width);
	else return 0;
}

make.prototype.setW = function(num) {
	this.css.width = num + px;
}

make.prototype.getH = function() {
	if (this.elm.offsetHeight) return this.elm.offsetHeight;
	else if (parseInt(this.css.height)) return parseInt(this.css.height);
	else return 0;
}

make.prototype.setH = function(num) {
	this.css.height = num + px;
}

// measure page width and height (the viewable canvas area)
function getCanvas() {
	if (document.width) this.w = document.width;
	else if (document.documentElement && document.documentElement.clientWidth) this.w = document.documentElement.clientWidth;
	else if (document.body && document.body.clientWidth) this.w = document.body.clientWidth;
	else if (window.innerWidth) this.w = window.innerWidth;
	else this.w = 0;
	
	if (document.height) this.h = document.height;
	else if (document.documentElement && document.documentElement.clientHeight) this.h = document.documentElement.clientHeight;
	else if (document.body && document.body.clientHeight) this.h = document.body.clientHeight;
	else if (window.innerHeight) this.h = window.innerHeight;
	else this.h = 0;
	return this;
}

// measure the left position of an element, relative to the page
// note that the element does not need to have any css positioning
function getPageLeft(elm) {
	var x = 0;
	while (elm.offsetParent && typeof elm.offsetLeft != "undefined") {
		x += elm.offsetLeft;
		elm = elm.offsetParent;
	}
	return x;
}

// measure the top position of an element, relative to the page
// note that the element does not need to have any css positioning
function getPageTop(elm) {
	var y = 0;
	while (elm.offsetParent && typeof elm.offsetTop != "undefined") {
		y += elm.offsetTop;
		elm = elm.offsetParent;
	}
	return y;
}

// end
