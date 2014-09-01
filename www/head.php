<?

$file = $_SERVER['REQUEST_URI'];

if(strpos($file, "archive") > -1) $section = 1;
else if(strpos($file, "about") > -1) $section = 2;
else $section = 0;

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<!--
  Title:        Thirteenth Parallel (Archive / Temp Site)
  Description:  Interface for the temporary site put up to hold 13th's old content

  Creator:      Dan Pupius <http://pupius.co.uk>
  Date:         2005-01-14
  Rights:       Copyright (c)2002-2005 Daniel Pupius
-->
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title><?= $title ?>Thirteenth Parallel</title>
    <meta http-equiv="Content-type" content="text/html; charset=iso-8859-1" />
    <meta name="copyright" content="Copyright (c)2002-2005 Thirteenth Parallel, All Rights Reserved" />
    <link rel="stylesheet" type="text/css" href="/styles/13.css" />
    <script type="text/javascript" src="/js/Toolkit.js"></script>
    <script type="text/javascript" src="/js/Toolkit.Events.js"></script>
    <script type="text/javascript" src="/js/stuff.js"></script>
  </head>

  <body>
    <p id="title"><em>Thirteenth Parallel <?= $file ?></em></p>

    <div id="menu">
      <ul>
        <li><a href="/blog/"<?= ($section==0)?' class="active"':'' ?>>Home</a></li>
        <li><a href="/archive/"<?= ($section==1)?' class="active"':'' ?>>Archive</a></li>
        <li><a href="/about/"<?= ($section==2)?' class="active"':'' ?>>About</a></li>
      </ul>
    </div>

    <div id="body">
