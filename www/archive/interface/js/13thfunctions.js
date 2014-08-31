//=======================================================\\
//                    13thparallel.org                   \\
//                   Copyright (c) 2002                  \\ 
//   see (13thparallel.org/?title=about) for more info   \\
//=======================================================\\


function init() {
	
	// Position the canvas div
	setCanvas();
	window.onresize = setCanvas;

	// Set fontsize
	Text.size = parseInt(GetCookie ("fontsize", 11));
	document.getElementById("divPage").style.fontSize = Text.size + Text.unit;
	document.getElementById("divSizer").style.fontSize = Text.size + Text.unit;

	// Split content into columns
	columns = Columns.splitText(document.getElementById('divContent').innerHTML, colWidth, colHeight);
	while (columns.length < 2) columns.push("<p>&nbsp;</p>");
	numCols = columns.length - 1;
		
	// Place columns in div tags and create links
	doColumnsAndLinks();
	
	// Extract the column titles
	colTitles = getColumnTitles();
	
	// Setting the UI controls
	document.getElementById("divTitles").innerHTML = ": navigate";
	document.getElementById("divContentsToggle").innerHTML = '<a href="#" onclick="toggleContents(); return false;" class="contents" id="anchorArrow">&#187;</a>';
	
	// Hide loading cover
	document.getElementById("divLoading").style.visibility = "hidden";

	// Scroll to chapter specified by URI
	scrollToChapter(chapter);

	// Fix Location Bar
	setLocationBar();

	// Sort out issue specific contents AND site contents
	objSiteContents = new make("divSiteContents");
	objIssueContents = new make("divIssueContents");
	objToggContents = new make("divContentsToggle");

	if(heading != "home" && issueName != "information") {
		objIssueContents.show();
		objToggContents.show();
		objIssueContents.moveTo(15 - objIssueContents.elm.offsetWidth, objIssueContents.elm.offsetTop);
	}
	
	// Get rid of pesky outlines
	destroyEvilLinkOutlines();
}

window.onload = init;

// Position the canvas div
function setCanvas() {
	canvas = new getCanvas();
	var canvasLeft = (canvas.w - document.getElementById("divCanvas").offsetWidth) / 2;
	var canvasTop = (canvas.h - document.getElementById("divCanvas").offsetHeight) / 3;
	if (canvasLeft < 0) canvasLeft = 0;
	if (canvasTop < 0) canvasTop = 0;
	document.getElementById("divCanvas").style.left = canvasLeft + "px";
	document.getElementById("divCanvas").style.top = canvasTop + "px";
}


// Text object for changing text size
var Text = {
	size : parseInt(GetCookie("fontsize", 11)),
	unit : "px",
	
	doSize : function(num) {
		Text.size += num;
		if (Text.size < 1) Text.size = 1;
		SetCookie ("fontsize", Text.size, 24*365);
		document.getElementById("divPage").style.fontSize = Text.size + Text.unit;
		document.getElementById("divSizer").style.fontSize = Text.size + Text.unit;
		init();
		if (currentCol > columns.length - 2) {
			currentCol = columns.length - 2;
			objLink.moveTo(32 + currentCol*10, objLink.y);
			objSlider.moveTo(-currentCol*360, objSlider.y);
			setLocationBar();
		}
	}
}


// Place columns in div tags and create links
function doColumnsAndLinks() {
	var tx = "";
	var links = '<img src="images/1x1.gif" height="1" width="31" alt="" />';
	for (var i=0; i<columns.length; i++) {
		tx += '<div id="divColumn' + i + '" style="position: absolute; top: 0px; left: ' + (i*(colWidth+colSpace)+colSpace) + 'px; width: ' + colWidth + 'px; height: ' + colHeight + 'px;">'
		tx += columns[i];
		tx += '</div>';
		links += '<a href="#" onclick="scrollTo('+i+'); return false;" onmouseover="showTitle('+i+'); window.status=\'\'; return true;" onmouseout="resetTitle(); window.status=\'\';"><img src="images/nav_square.gif" border="0" height="12" width="10" alt="" /></a>';
	}
	objSlider = new make("divPageSlider");
	objLink = new make("divLinkBlock");
	objSlider.elm.innerHTML = tx;
	
	var tempLinks = document.getElementById("divLinks");
	tempLinks.innerHTML = links;
	document.getElementById("divTitles").style.left = tempLinks.offsetLeft + tempLinks.offsetWidth + 1 + "px";
}


// Extract the column titles
function getColumnTitles() {
	var headers = new Array();
	var titles = new Array();
	var img = null;
	
	for (var i = 0; i < 100; i++) {
		if (!document.getElementById("divColumn" + i)) break;
		
		for (var j = 1; j <= 6; j++) {
			headers = document.getElementById("divColumn" + i).getElementsByTagName("h" + j);
			if (!headers || headers.length == 0) continue;
			
			img = headers[0].getElementsByTagName("img")[0];
			
			if (img && img.title) {
				titles[i] = img.title.toLowerCase();
				break;
			}
			else if (img && img.alt) {
				titles[i] = img.alt.toLowerCase();
				break;
			}
			else {
				titles[i] = headers[0].innerHTML.toLowerCase();
				break;
			}
		}
		if (!titles[i] && i == 0) titles[i] = "navigate";
		if (!titles[i] && i != 0) titles[i] = titles[i-1];
	}
	return titles;
}


// Takes a chapter name and scrolls to it (if it exists).
function scrollToChapter(c) {
	chapter = c;
	// Set it to scroll to the right chapter.
	var i = 0;
	while (colTitles[i] != chapter && i < colTitles.length) { i++; }
	if (i != colTitles.length) scrollTo(i);
	return false;
}


// Fix Location Bar
function setLocationBar() {
	if (currentCol != 0) chapter = colTitles[currentCol];
	else chapter = "";
	
	//set up location bar:
	objLocation = new make("divLocation");
	var strLocation = '&nbsp;&nbsp;&nbsp;&nbsp;<strong>';
	if(issue=="none" || issue=="") {
		strLocation += '<a href="/?title=' + heading;
	} else if(!heading || heading=="home" ) {
		var monthNo = issue.getMonth()+1;
		if(monthNo < 10) monthNo = "0" + monthNo;
		strLocation += '<a href="/?issue=' + issue.getFullYear() + "." + monthNo;
	} else {
		var monthNo = issue.getMonth()+1;
		if(monthNo < 10) monthNo = "0" + monthNo;
		strLocation += '<a href="/?issue=' + issue.getFullYear() + "." + monthNo + '&amp;title=' + heading;
	}

	if(chapter) strLocation  += '&chapter=' + chapter;
	strLocation += '">location</a>:';
	strLocation += '</strong> &nbsp;' + issueName + ' &#187; ' + heading.replace(/\_/," ");
	if(chapter) strLocation += ' &#187; ' + chapter.replace(/\_/," ");
	
	objLocation.elm.innerHTML = strLocation;
}


// Get rid of pesky outlines
function destroyEvilLinkOutlines() {
	var lnks = document.links ? document.links : document.getElementsByTagName ? document.getElementsByTagName("a") : null;
	if (lnks) {
		for (var m = 0; lnks[m]; m++) {
			lnks[m].onfocus = function(){ this.blur() };
		}
	}
}


function scrollTo(i) {
	if (columns.length > 2) {
		currentCol = i;
		if (currentCol < 0) currentCol = 0;
		if (currentCol >= numCols - 1) currentCol = numCols - 1;
		setPos();
	}
}


function scrollLeftArrow() {
	if (currentCol > 0) {
		currentCol--;
		setPos();
	}
}


function scrollRightArrow() {
	if (currentCol < numCols - 1) {
		currentCol++;
		setPos();
	}
}


function setPos() {
	objLink.timeSlide(32 + currentCol*10, objLink.y, 1500, -0.999, null, true);
	objSlider.timeSlide(-currentCol*(colWidth+colSpace), objSlider.y, 1500, -0.999, null, true);
	setLocationBar();
}


function showTitle(num) {
	document.getElementById("divTitles").innerHTML = ":&nbsp;" + colTitles[num];
}


function resetTitle() {
	document.getElementById("divTitles").innerHTML = ": navigate";
}

	
function openPrintVersion() {
	var url = "printversion.php" + location.search;
	var newWindow = window.open(url);
	newWindow.focus();
}


// Toggle issue specific contents
var contentState = false;
function toggleContents() {
	if (contentState) {
		objIssueContents.timeSlide(15-objIssueContents.elm.offsetWidth, objIssueContents.elm.offsetTop, 1500, -0.999, null, true);
		objSiteContents.timeSlide(15, objSiteContents.elm.offsetTop, 1500, -0.999, null, true);
		contentState = false;
		document.getElementById("anchorArrow").innerHTML = "&#187;";
	}
	else {
		objIssueContents.timeSlide(15, objIssueContents.elm.offsetTop, 1500, -0.999, null, true);
		objSiteContents.timeSlide(0-objSiteContents.elm.offsetWidth, objSiteContents.elm.offsetTop, 1500, -0.999, null, true);
		contentState = true;
		document.getElementById("anchorArrow").innerHTML = "&#171;";
	}
}

// Precache the images used for rollovers and that are inserted by innerHTML
precache("images/nav_text.gif");
precache("images/nav_square.gif");

var arrow_left_off = precache("images/arrow_left.gif");
var arrow_left_on = precache("images/arrow_left2.gif");
var arrow_right_off = precache("images/arrow_right.gif");
var arrow_right_on = precache("images/arrow_right2.gif");


// $ # ^ % % A % * P ^ O * & % C * & A ^ L % ^ $ Y ^ % * P & ^ S % $ & E # # %
