<html>

<head>
<title>Multiple feeds using server side includes</title>
<style type="text/css">

body {
	width:			100%;
	height:			100%;
	background-color:	#C0C0C0;
	color:			#000000;
	margin:			0px;
	padding:		0px;
	overflow:		auto;
}

a {
	text-decoration:	none;
}

.feed {
	position:		absolute;
	top:			10px;
	font:			normal 10px/12px arial,helvetica,sans-serif;
	width:			350px;
	border:			1px solid #666;
	padding:		5px;
}

.feedTitle {
	font:			bold 12px/14px arial,helvetica,sans-serif;
	text-align:		right;
}

.item {
	color:			#666;
	margin-bottom:		4px;
}

#feed1		{ left: 10px; background: #F3EEEE;}
#feed1 a	{ color: darkred; }
#feed1 a:hover 	{color: red; }

#feed2 		{ left: 370px; background: #EEEEF3;}
#feed2 a 	{ color: darkblue; }
#feed2 a:hover 	{color: blue; }

#feed3 		{ left: 730px; background: #EEF3EE;}
#feed3 a 	{ color: darkgreen; }
#feed3 a:hover 	{color: #66CC66; }

#feed4 		{ left: 1090px; background: #F3EEF3;}
#feed4 a 	{ color: #660033; }
#feed4 a:hover 	{color: #CC6699; }

#feed5 		{ left: 1450px; background: #F3F3EE;}
#feed5 a 	{ color: #CC6633; }
#feed5 a:hover 	{color: #FF9966; }

</style>
</head>

<body>

<div id="feed1" class="feed">
  <? include("http://13thparallel.com/archive/rss/metadata/13r2a.php?maintemplate=templates/includes.main.template&itemtemplate=templates/includes.item.template&url=13rss1.xml"); ?>
</div>

<div id="feed2" class="feed">
  <? include("http://13thparallel.com/archive/rss/metadata/13r2a.php?maintemplate=templates/includes.main.template&itemtemplate=templates/includes.item.template&url=http://www.nwfusion.com/rss/datacenter.xml"); ?>
</div>

<div id="feed3" class="feed">
  <? include("http://13thparallel.com/archive/rss/metadata/13r2a.php?maintemplate=templates/includes.main.template&itemtemplate=templates/includes.item.template&url=http://www.nwfusion.com/rss/vpns.xml"); ?>
</div>

<div id="feed4" class="feed">
  <? include("http://13thparallel.com/archive/rss/metadata/13r2a.php?maintemplate=templates/includes.main.template&itemtemplate=templates/includes.item.template&url=http://www.nwfusion.com/rss/cisco.xml"); ?>
</div>

<div id="feed5" class="feed">
  <? include("http://13thparallel.com/archive/rss/metadata/13r2a.php?maintemplate=templates/includes.main.template&itemtemplate=templates/includes.item.template&url=http://www.nwfusion.com/rss/microsoft.xml"); ?>
</div>

</body>

</html>
