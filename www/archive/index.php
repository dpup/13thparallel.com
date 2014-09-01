<? include('/var/www/site/head.php') ?>

<h1>Archive</h1>

<ul id="list">
	<li class="tutorial"><a href="bezier-curves/">Bezi&eacute;r curves and JavaScript;</a> Daniel Pupius, January 2002</li>
	<li class="article"><a href="coding-for-portability1/">Coding for portability, Part 1;</a> Tom Trenka, March 2002</li>
	<li class="article"><a href="coding-for-portability2/">Coding for portability, Part 2;</a> Tom Trenka, April 2002</li>
	<li class="script"><a href="column-script/">Column Script;</a>  Michael van Ouwerkerk, January 2002</li>
	<li class="tutorial"><a href="dhtml-scrollbars/">DHTML Scrollbars;</a> Daniel Pupius, June 2002</li>
	<li class="article"><a href="seperating-structure/">Designing for standards: Separating structure, style and behaviour;</a> Daniel Pupius, February 2002</li>
	<li class="profile"><a href="doubleyou/">DoubleYou Interview;</a> Sergi Meseguer, March 2002</li>
	<li class="script"><a href="margin-fix/">Internet Explorer Margin Fix;</a> David Schontzler, April 2002</li>
	<li class="tutorial"><a href="maths-and-dhtml/">Mathematics and DHTML;</a> Daniel Pupius, February 2002</li>
	<li class="profile"><a href="multi-interview/">Multi-interview;</a> March 2002</li>
	<li class="tutorial"><a href="rdf/">An Introduction to the Resource Description Framework (RDF);</a> Daniel Pupius, June 2002</li>
	<li class="script"><a href="rss/">PHP RSS 1.0 Parser;</a> Daniel Pupius, June 2002</li>
	<li class="profile"><a href="scott-andrew/">Scott Andrew (profile &amp; interview);</a> January 2002</li>
	<li class="article"><a href="sig-slots/">Advanced JavaScript events with Signals and Slots;</a> Alex Russell, July 2002</li>
	<li class="tutorial"><a href="viewport/">The Viewport;</a>  Michael van Ouwerkerk, July 2002</li>
	<li class="article"><a href="who-are-we-designing-for/">Who are we designing for?;</a>  Daniel Pupius, March 2002</li>
</ul>

<p class="nojustify">Check out Michael's Viewport article in the <a href="interface/">original DHTML interface</a>.</p>

<form action="./" method="get" onsubmit="return false">
	<fieldset>
		<input type="checkbox" id="tutorial" value="1" checked="checked" /><label for="tutorial"> Tutorials</label><br />
		<input type="checkbox" id="script" value="1" checked="checked" /><label for="script"> Scripts</label><br />
		<input type="checkbox" id="article" value="1" checked="checked" /><label for="article"> Articles</label><br />
		<input type="checkbox" id="profile" value="1" checked="checked" /><label for="profile"> Profiles and interviews</label>
	</fieldset>
</form>
<script type="text/javascript">
// <![CDATA[
	function checkboxes() {
		var t = document.getElementById("tutorial").checked;
		var s = document.getElementById("script").checked;
		var a = document.getElementById("article").checked;
		var p = document.getElementById("profile").checked;

		var items = document.getElementById("list").getElementsByTagName("li");

		for(var i=0; i<items.length; i++) {

			if(items[i].className=="tutorial") {
				if(t) items[i].style.visibility = "visible";
				else  items[i].style.visibility = "hidden";
			}

			if(items[i].className=="script") {
				if(s) items[i].style.visibility = "visible";
				else  items[i].style.visibility = "hidden";
			}

			if(items[i].className=="article") {
				if(a) items[i].style.visibility = "visible";
				else  items[i].style.visibility = "hidden";
			}

			if(items[i].className=="profile") {
				if(p) items[i].style.visibility = "visible";
				else  items[i].style.visibility = "hidden";
			}
		}
	}


	Toolkit.Events.addListener(document.getElementById("tutorial"), "onclick", checkboxes);
	Toolkit.Events.addListener(document.getElementById("script"), "onclick", checkboxes);
	Toolkit.Events.addListener(document.getElementById("article"), "onclick", checkboxes);
	Toolkit.Events.addListener(document.getElementById("profile"), "onclick", checkboxes);

// ]]>
</script>
<? include('/var/www/site/foot.php') ?>
