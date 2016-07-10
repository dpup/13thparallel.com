//Stolen from ALA 'cause I'm lazy -- Dan

function getWindowHeight() {
	var windowHeight = 0;
	if (typeof(window.innerHeight) == 'number') {
		windowHeight = window.innerHeight;
	}
	else {
		if (document.documentElement && document.documentElement.clientHeight) {
			windowHeight = document.documentElement.clientHeight;
		}
		else {
			if (document.body && document.body.clientHeight) {
				windowHeight = document.body.clientHeight;
			}
		}
	}
	return windowHeight;
}
function setFooter() {
	if (document.getElementById) {
		var windowHeight = getWindowHeight();
		if (windowHeight > 0) {
			var contentHeight = document.getElementById('body').offsetHeight;
			var footerElement = document.getElementById('footer');
			var footerHeight  = footerElement.offsetHeight;
			if (windowHeight - (contentHeight + footerHeight) >= 0) {
				footerElement.style.top = (windowHeight - (contentHeight + footerHeight)) + 'px';
			}
			else {
				footerElement.style.top = '0px';
			}
		}
	}
}

Toolkit.Events.addListener(window, "onload", setFooter);
Toolkit.Events.addListener(window, "onresize", setFooter);



var offstyles = new Array();
function setupforms() {
	if(!document.getElementsByTagName) return false;

	var elements = document.getElementsByTagName("input");
	for(var i=0;i<elements.length;i++) {
		if(elements[i].type=="text") {
			offstyles[elements[i].name] = elements[i].className;
			elements[i].onfocus = function() { this.className = this.className + " active";}
			elements[i].onblur = function() { this.className = offstyles[this.name]; }
		}
	}

	elements = document.getElementsByTagName("textarea");
	for(var k=0;k<elements.length;k++) {
		offstyles[elements[k].name] = elements[k].className;
		elements[k].onfocus = function() { this.className = this.className + " active";}
		elements[k].onblur = function() { this.className = offstyles[this.name]; }
	}
	return true;
}