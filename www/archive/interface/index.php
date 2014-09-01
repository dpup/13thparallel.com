<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>

<!--          Copyright (c) 2002 13thparallel.org          -->
<!--   see (13thparallel.org/?title=about) for more info   -->
<!-- NO TEMPLATE -->

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta name="keywords" content="dhtml, tutorials, articles, profiles, scripts, learning, javascript, css, dom, w3c, xhtml, html, degradable, good looking, clean, graceful, monthly, e zine" /> 
<meta name="description" content="Monthly web development e-zine, includes profiles with leading members of the community, tutorials, scripts and much more." /> 
<meta name="author" content="Dan Pupius &amp; Michael van Ouwerkerk" />
<title>:: 13thparallel ::</title>

<link rel="stylesheet" type="text/css" media="print" href="style/print.css" />

<link rel="stylesheet" type="text/css" media="screen, tv" id="doubleplusgoodstyle" href="style/basic.css" />
<script type="text/javascript" src="js/header.js"></script>

</head>

<body>
<div id="divLoading" class="scripted"></div>

<script type="text/javascript" src="js/lib_basic.js"></script>
<script type="text/javascript" src="js/lib_animation.js"></script>
<script type="text/javascript" src="js/lib_columns.js"></script>
<script type="text/javascript" src="js/lib_functions.js"></script>
<script type="text/javascript" src="js/lib_cookies.js"></script>
<script type="text/javascript" src="js/13thfunctions.js"></script>

<script type="text/javascript">
// <![CDATA[
	// Grab variables from PHP
	//=========================

	var colWidth = 320;
	var colHeight = 320;
	var colSpace = 52;
	var currentCol = 0;
	var numCols = 0;
	var columns = null;
	var colTitles = null;
	var canvas = null;
	var objSlider = null;
	var objLink = null;

	//var curMonth = new Date(<% $now = time() - 12*24*60*60;	echo(date("Y",$now)); %>,<% echo(date("m",$now)-1); %>);
	var curMonth = new Date();
	var issue = new Date();
	var issueName = "current issue";
	var heading = "home";
	var chapter = "";
// ]]>
</script>

<div id="divCanvas">
	<div id="divLogo"><img src="images/logo_halfglobe.gif" width="285" height="56" alt="thirteenth parallel logo" /></div>
	
	<div id="divSiteContents">
		<a href="?title=news" class="contents">News</a> &nbsp;&nbsp;
		<a href="" class="contents">Current Issue</a> &nbsp;&nbsp;
		<a href="?title=archive" class="contents">Archive</a> &nbsp;&nbsp;
		<a href="http://forums.13thparallel.net" class="contents">Forums</a> &nbsp;&nbsp;
		<a href="?title=about" class="contents">About</a> &nbsp;&nbsp;
		<a href="?title=links" class="contents">Links</a>
	</div>
	<div id="divIssueContents">
		<a href="?issue=2002.01&amp;title=home" class="contents">Home</a> &nbsp;&nbsp;
		<a href="?issue=2002.01&amp;title=home" class="contents">Home</a> &nbsp;&nbsp;
		<a href="?issue=2002.01&amp;title=home" class="contents">Home</a>
	</div>
	<div id="divContentsToggle" class="scripted" onmouseover="window.status='toggle issue specific contents'; return true;" onmouseout="window.status='';"></div>
	
	<div id="divPage" class="columntext scripted">
		<div id="divPageSlider"></div>
	</div>
	
	<div id="divLocation" class="scripted"></div>
	<div id="divRuler"></div>
	<div id="divLinkBlock" class="scripted"></div>
	<div id="divLinks" class="scripted"></div>
	<div id="divTitles" class="scripted"></div>
	<div id="divMinus" class="scripted" title="decrease font size" onclick="Text.doSize(-1);" onmouseover="window.status='decrease font size';" onmouseout="window.status='';"></div>
	<div id="divPlus" class="scripted" title="increase font size" onclick="Text.doSize(1);" onmouseover="window.status='increase font size';" onmouseout="window.status='';"></div>
	<div id="divArrowLeft" class="scripted" onclick="scrollLeftArrow();" onmouseover="this.style.backgroundImage='URL(images/arrow_left2.gif)'; window.status='scroll left';" onmouseout="this.style.backgroundImage='URL(images/arrow_left.gif)'; window.status='';"></div>
	<div id="divArrowRight" class="scripted" onclick="scrollRightArrow();" onmouseover="this.style.backgroundImage='URL(images/arrow_right2.gif)'; window.status='scroll right';" onmouseout="this.style.backgroundImage='URL(images/arrow_right.gif)'; window.status='';"></div>
</div>

<div id="divSizer" class="columntext scripted"></div>

<div id="divContent" class="columntext">
<h1><img src="images/titles/viewport.gif" width="250" height="35" alt="The Viewport" /></h1>

<p>The area of your window where the contents are shown is called the viewport. 
When positioning a popup menu or something relative to the 
mouse cursor, it is very useful to know how big the viewport is without its scrollbars. 
With that information, you can make sure your positioned elements are completely visible.
</p>

<p>I&#8217;ve tried to keep the code in the examples short and without any crossbrowser workarounds. So, 
to view the examples you will need a browser that supports a little of DOM level 1, and iframes.
</p>

<span class="colbreak"></span>
<h2>width and height</h2>

<p>Let&#8217;s start with an example that shows what might happen when you position an 
element without checking how large the viewport is.
</p>

<p><a href="tutorial/2002.06.viewport.example1.htm" title="Example 1 - opens in a new window." 
onclick="if(window.popup) popup( 'tutorial/2002.06.viewport.example1.htm', '', 300, 300, 'c', 'c', 'no', 'no', 'yes' ); return false;">Example 1</a>: 
shows a div element when mousing over a link. The div is always positioned in the same place. 
If this example works the way I intended it, only part of the div is visible, the rest is cut 
off by the viewport&#8217;s edge.
</p>

<p>The code for getting the viewport size is different across browsers. 
Here are the most commonly used properties:
</p>

<pre>document.documentElement.clientWidth
document.body.clientWidth
window.innerWidth - 18

document.documentElement.clientHeight
document.body.clientHeight
window.innerHeight - 18</pre>

<p><a href="tutorial/2002.06.viewport.example2.htm" title="Example 2 - opens in the same window.">Example 2</a>: 
is a testcase where you can check how your browser handles these properties. 
(does not automatically open in a new window)
</p>

<p>The document.documentElement.clientWidth/Height is used by IE6 in strict mode, otherwise 
it uses document.body.clientWidth/Height. Mozilla also uses document.body.clientWidth/Height 
and supports the Netscape 4 properties window.innerWidth/Height as well. Opera also supports 
window.innerWidth/Height, though it&#8217;s a little buggy there.
</p>

<p>Note that window.innerWidth/Height does not exactly get the viewport size the way we 
want it, because these properties add the space for the scrollbar if it is visible. 
As far as I know, there is no reliable way to test if scrollbars are visible. 
Also, the size of scrollbars varies over different platforms and user settings, 
therefore we&#8217;ll take a safe bet and guess it at 18 pixels, and subtract that.
</p>

<p>Now that we know what to look for, it&#8217;s easy to write a simple script 
that tries each property until it finds one that exists and has a non-zero value. 
Note that instead of browser sniffing, this code uses object detection:
</p>

<pre>getViewportWidth = function() {
  var width = 0;
  if( document.documentElement &amp;&amp; 
  document.documentElement.clientWidth ) {
    width = document.documentElement.clientWidth;
  }
  else if( document.body &amp;&amp; 
  document.body.clientWidth ) {
    width = document.body.clientWidth;
  }
  else if( window.innerWidth ) {
    width = window.innerWidth - 18;
  }
  return width;
};

getViewportHeight = function() {
  var height = 0;
  if( document.documentElement &amp;&amp; 
  document.documentElement.clientHeight ) {
    height = document.documentElement.clientHeight;
  }
  else if( document.body &amp;&amp; 
  document.body.clientHeight ) {
    height = document.body.clientHeight;
  }
  else if( window.innerHeight ) {
    height = window.innerHeight - 18;
  }
  return height;
};</pre>

<p><a href="tutorial/2002.06.viewport.example3.htm" title="Example 3 - opens in a new window." 
onclick="if(window.popup) popup( 'tutorial/2002.06.viewport.example3.htm', '', 300, 300, 'c', 'c', 'no', 'no', 'yes' ); return false;">Example 3</a>: 
uses these two functions. It shows a div element when mousing over a link, and when the div is positioned 
there is a check to make sure it is placed inside the viewport.
</p>

<p>Remember that these functions must be called after the page has finished loading. Because getViewportWidth() 
and getViewportHeight() access the body element, the body must have completed loading, otherwise the width 
and height readings may be wrong.
</p>

<p><a href="tutorial/2002.06.viewport.example4.htm" title="Example 4 - opens in a new window." 
onclick="if(window.popup) popup( 'tutorial/2002.06.viewport.example4.htm', '', 300, 300, 'c', 'c', 'no', 'no', 'yes' ); return false;">Example 4</a>: 
shows how to center the div horizontally and vertically. By running 
the positioning function onresize, the div remains centered when you 
change the size of the window.
</p>

<span class="colbreak"></span>
<h2>scrollX and scrollY</h2>

<p>Knowing the size of the viewport is only half of the deal. What happens when the document is scrolled?
</p>

<p><a href="tutorial/2002.06.viewport.example5.htm" title="Example 5 - opens in a new window." 
onclick="if(window.popup) popup( 'tutorial/2002.06.viewport.example5.htm', '', 300, 300, 'c', 'c', 'yes', 'no', 'yes' ); return false;">Example 5</a>: 
shows a div bouncing between the left edge of the viewport and the right. 
When the document is scrolled, the div is no longer positioned where it was intended.
</p>

<p>So what&#8217;s the problem? Well, the div was positioned relative to the top 
left corner of the document. When the document was scrolled, the top left corner 
moved as well. So to position the div element relative to the viewport, the amount of 
pixels scrolled must be added when setting the left and top of the div.
</p>

<p>These are the different properties that give the scrolled distance of the document:
</p>

<pre>document.documentElement.scrollLeft
document.body.scrollLeft
window.pageXOffset
window.scrollX

document.documentElement.scrollTop
document.body.scrollTop
window.pageYOffset
window.scrollY</pre>

<p><a href="tutorial/2002.06.viewport.example6.htm" title="Example 6 - opens in the same window." >Example 6</a>: 
is a test case where you can check how your browser handles these properties.
(does not automatically open in a new window)
</p>

<p>The above test shows that in compatibility mode, Explorer 6 has the scrolling information 
sitting on the body element while the values on the documentElement are 0. In strict mode, 
the situation is reversed: the scrolled values are found on the documentElement and the 
values on the body are 0.
</p>

<p>All the other browsers that support a bit of DHTML also support at least one of the properties 
mentioned above, and they all give correct values for as far as I could check. 
Even Netscape 4 and Explorer 4 support these, so this is not just something for 5th generation browsers.
It&#8217;s easy to write a simple script that tries each of these properties until it finds one that exists and is not 0:
</p>

<pre>getViewportScrollX = function() {
  var scrollX = 0;
  if( document.documentElement &amp;&amp; 
  document.documentElement.scrollLeft ) {
    scrollX = document.documentElement.scrollLeft;
  }
  else if( document.body &amp;&amp; 
  document.body.scrollLeft ) {
    scrollX = document.body.scrollLeft;
  }
  else if( window.pageXOffset ) {
    scrollX = window.pageXOffset;
  }
  else if( window.scrollX ) {
    scrollX = window.scrollX;
  }
  return scrollX;
};

getViewportScrollY = function() {
  var scrollY = 0;
  if( document.documentElement &amp;&amp; 
  document.documentElement.scrollTop ) {
    scrollY = document.documentElement.scrollTop;
  }
  else if( document.body &amp;&amp; 
  document.body.scrollTop ) {
    scrollY = document.body.scrollTop;
  }
  else if( window.pageYOffset ) {
    scrollY = window.pageYOffset;
  }
  else if( window.scrollY ) {
    scrollY = window.scrollY;
  }
  return scrollY;
};</pre>

<p><a href="tutorial/2002.06.viewport.example7.htm" title="Example 7 - opens in a new window." 
onclick="if(window.popup) popup( 'tutorial/2002.06.viewport.example7.htm', '', 300, 300, 'c', 'c', 'yes', 'no', 'yes' ); return false;">Example 7</a>: 
shows a div element bouncing between the left edge of the viewport and the right. 
Every time the position of the div is updated, there is a check to see if the document 
has been scrolled and an adjustment is made if necessary.
</p>

<span class="colbreak"></span>
<h2>standardisation</h2>

<p>As you may have noticed, the code shown in this tutorial cannot be found in any of the currently 
available <a href="http://www.w3.org/" title="The World Wide Web Consortium">W3C</a> specifications. 
In fact, these techniques have not been standardised by the people of the W3C, and maybe 
they should not be expected to do that in the immediate future. The W3C is more concerned with XML, CSS 
and other technologies for accessibility and document structure, and a good deal more beside that. 
Measuring the size of the viewport of a window seems outside their area of interest, they are more 
concerned with the document in the viewport.
</p>

<span class="colbreak"></span>
<h2>conclusion &amp; credits</h2>

<p>I&#8217;ve shown that it&#8217;s pretty easy to get the viewport width and height, but 
that some browsers give different readings because they handle scrollbars in another way. 
Regardless of the differences, these readings are still very useful. Getting the 
position of the scrolled content has solid support in many browsers.
</p>

<p>The four example functions shown in the article were written so they would fit 
in the text. For the 13th API (the new library we&#8217;re working on) I&#8217;ve put 
all the functionality in one function with longer and fewer lines, because I find that 
easier to work with.
</p>

<p>Finally, if you spot any errors in this article, or still have questions after reading it, 
please contact us in the <a href="http://13thparallel.net/forums/">forums</a>. 
All feedback is much appreciated.
</p>

<p>I would like to thank Garrett Smith (<a href="http://www.dhtmlkitchen.com/">dhtmlkitchen</a>) 
for the great help he has given to tweak this article for the Macintosh.
</p>

<span class="colbreak"></span>
<h2>references</h2>

<p>These are links to the official documentation from Microsoft and Mozilla.
</p>

<p><a href="http://msdn.microsoft.com/library/default.asp?url=/library/en-us/dnie60/html/cssenhancements.asp">CSS 
enhancements in Internet Explorer 6</a> documents how the Doctype declaration affects Explorer 6. 
This goes deeper into the differences between Strict and Compatibility mode.
</p>

<p>There is also documentation in different places regarding the
<a href="http://msdn.microsoft.com/workshop/author/dhtml/reference/properties/clientwidth.asp">clientWidth</a>, 
<a href="http://msdn.microsoft.com/workshop/author/dhtml/reference/properties/scrollleft.asp">scrollLeft</a>, 
<a href="http://www.mozilla.org/docs/dom/domref/dom_window_ref28.html">innerWidth</a> and 
<a href="http://www.mozilla.org/docs/dom/domref/dom_window_ref80.html">pageXOffset</a> properties.
</p>



<span class="colbreak"></span>
<h2>examples</h2>

<p>Here&#8217;s a list of all the examples used in this tutorial:
</p>

<p><a href="tutorial/2002.06.viewport.example1.htm" title="Example 1 - opens in a new window." 
onclick="if(window.popup) popup( 'tutorial/2002.06.viewport.example1.htm', '', 300, 300, 'c', 'c', 'no', 'no', 'yes' ); return false;">Example 1</a>: 
shows a div element when mousing over a link. The div is always positioned in the same place.
</p>

<p><a href="tutorial/2002.06.viewport.example2.htm" title="Example 2 - opens in the same window.">Example 2</a>: 
is a testcase where you can check how your browser handles the properties for getting the viewport size.
(does not automatically open in a new window)
</p>

<p><a href="tutorial/2002.06.viewport.example3.htm" title="Example 3 - opens in a new window." 
onclick="if(window.popup) popup( 'tutorial/2002.06.viewport.example3.htm', '', 300, 300, 'c', 'c', 'no', 'no', 'yes' ); return false;">Example 3</a>: 
shows a div element when mousing over a link. When the div is positioned, 
there is a check to make sure it is placed inside the viewport.
</p>

<p><a href="tutorial/2002.06.viewport.example4.htm" title="Example 4 - opens in a new window." 
onclick="if(window.popup) popup( 'tutorial/2002.06.viewport.example4.htm', '', 300, 300, 'c', 'c', 'no', 'no', 'yes' ); return false;">Example 4</a>: 
shows how to center the div horizontally and vertically. By running 
the positioning function onresize, the div remains centered when you 
change the size of the window.
</p>

<p><a href="tutorial/2002.06.viewport.example5.htm" title="Example 5 - opens in a new window." 
onclick="if(window.popup) popup( 'tutorial/2002.06.viewport.example5.htm', '', 300, 300, 'c', 'c', 'yes', 'no', 'yes' ); return false;">Example 5</a>: 
shows a div bouncing between the left edge of the viewport and the right. 
When the document is scrolled, the div is no longer positioned where it was intended.
</p>

<p><a href="tutorial/2002.06.viewport.example6.htm" title="Example 6 - opens in the same window." >Example 6</a>: 
is a test case where you can check how your browser handles the properties for getting 
the scrolled position of the content.
(does not automatically open in a new window)
</p>

<p><a href="tutorial/2002.06.viewport.example7.htm" title="Example 7 - opens in a new window." 
onclick="if(window.popup) popup( 'tutorial/2002.06.viewport.example7.htm', '', 300, 300, 'c', 'c', 'yes', 'no', 'yes' ); return false;">Example 7</a>: 
shows a div element bouncing between the left edge of the viewport and the right. 
Every time the position of the div is updated, there is a check to see if the document 
has been scrolled and an adjustment is made if necessary.
</p>
</div>

</body>
</html>
