// 13thparallel header script

addStyleSheet = function(href, media) {
	if (document.getElementsByTagName && document.createElement) {
		var head = document.getElementsByTagName("head")[0];
		if (!head || !head.appendChild) return false;
		
		var link = document.createElement("link");
		link.rel = "stylesheet";
		link.type = "text/css";
		if (media) link.media = media;
		link.href = href;
		link = head.appendChild(link);
		
		return true;
	}
	return false;
}


if (document.getElementById 
&& document.getElementsByTagName 
&& document.createElement 
&& typeof document.getElementsByTagName("head")[0].innerHTML != "undefined"
&& !(window.showModalDialog && navigator.userAgent.toLowerCase().indexOf("mac") > -1)){

	// Disabling the basic sylesheet and creating a new one for the dynamic interface.
	// It would be easier to set a new value to the href of the link with the basic stylesheet,
	// but the href property is officially read-only, so we'll treat it as such.
	document.getElementById("doubleplusgoodstyle").disabled = true;
	addStyleSheet("style/thirteenth.css", "screen, tv");
	
	// Explorer tweak to remove the vertical scrollbar.
	if (window.showModalDialog) document.getElementsByTagName("html")[0].style.overflow = "hidden";
}

// end