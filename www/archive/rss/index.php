<? include('/var/www/site/head.php') ?>

<h1>PHP RSS 1.0 Parser</h1>
<p class="author">By Daniel Pupius, June 2002</p>

<p><b>13th RSS 1.0 to anything (13r2a) version 1.0</b></p>
<p>The RDF tutorial (read it first!) covers something called RDF Site Summary (RSS)
which is used for syndication, news feeds and sharing content.&nbsp; This
component is a PHP script which parses a RSS 1.0 XML file using templates, thus
you could output HTML, WML, or even JavaScript.&nbsp; The PHP script can be
downloaded and run locally or you can link to it from here (as long as you
provide a link back) specifying the XML file and the templates you want to use.</p>
<p><b>A lot of the news feeds out on the web are still using RSS 0.91, they
are not compatible with this script.</b></p>
<p>This page shows you how to use the <a href="13r2a.phps">PHP script</a>.</p>

<h2>Making templates</h2>
<p>The parser uses two template files that are specified in the query string,
&quot;maintemplate&quot;, which wraps the feed and displays information about the
channel, and then &quot;itemtemplate&quot; which is used to format each of the
individual items in the news feed.</p>
<p>To use the RSS variables in the template we use custom tags in the format:</p>
<pre>&lt;?13r2a <i>tagname</i> ?&gt;</pre>
<p>The tags that can appear in the main template are:<br />
&nbsp;- <b>feedTitle</b> - main feed title specified in the "channel" tag<br />
&nbsp;- <b>feedLink</b> - main link<br />
&nbsp;- <b>feedDescription</b> - description of the feed<br />
&nbsp;- <b>imageURL</b> - location of a thumbnail image for the feed<br />
&nbsp;- <b>imageTitle</b> - title to go with the image<br />
&nbsp;- <b>imageDescription</b> - (haven't really thought of a use for this one)<br />
&nbsp;- <b>imageLink</b> - link for image (normally used if you click image)<br />
&nbsp;- <b>theFeed</b> - where all the items are to go (from other template)<br />
&nbsp;- <b>numItems</b> - how many items are the RSS file<br />
&nbsp;- <b>xmlFile</b> - the raw XML file being used</p>
<p>The tags that can be used by the item template are:<br />
&nbsp;- <b>itemTitle</b> - title of item<br />
&nbsp;- <b>itemDescription</b> - the main description text for item<br />
&nbsp;- <b>itemLink</b> - corresponding link<br />
&nbsp;- <b>itemNo</b> - item's position in list (starts at 1)</p>
<p>So, in the main template you might have the line:</p>
<pre>&lt;h1&gt;&lt;a href=&quot;<b>&lt;?13r2a feedLink ?&gt;</b>&quot;&gt;
<b>&lt;?13r2a feedTitle ?&gt;</b>&lt;/a&gt;&lt;/h1&gt;</pre>
<p>Note that the tags are case sensitive.&nbsp; More detailed template examples
can be seen below.</p>
<p>[Future versions of this script will allow for custom tags or those from another RDF vocabulary, such as The Dublin Core, and also more complex
template tags with attributes and logic.]</p>
<p>The script can cope with remote files for both the templates and the XML/RSS
files.&nbsp; This means that you don't actually need to be able to run the PHP
script to use it.&nbsp; The paths that are specified in the query string are
relative to the PHP script.&nbsp; So, if you are running the script on your own
server then &quot;/templates/mymaintemplate.htm&quot; is fine, however if you
are using the script remotely (i.e. by linking to the script running on
13thparallel) then you need to specify the full URL in the query string, e.g.
&quot;http://www.mydomain.com/rss/templates/mymaintemplate.htm&quot;.</p>


<h2>Example 1: stand alone</h2>
<p>This example uses the two templates and the PHP script to create a standalone
page.&nbsp; The main downside is that you will need to specify the full URL and
query string and the 13r2a tags need to be placed in the main HTML file.</p>
<p><a href="metadata/13r2a.php?maintemplate=templates%2Fstandalone.main.template&amp;itemtemplate=templates%2Fstandalone.item.template&amp;url=http%3A%2F%2Fwww.nwfusion.com%2Frss%2Fhowto.xml">See
it in action</a></p>
<p>View: <a href="metadata/templates/standalone.main.template">main template</a>, 
<a href="metadata/templates/standalone.item.template">item template</a></p>


<h2>Example 2: included page</h2>
<p>Here we use minimal template files and then a php include() to paste the
parsed file into another document.&nbsp; This is generally more convenient
method than creating a stand alone page.&nbsp; You could similarly use an SSI or an ASP include to reference the page.</p>
<p><a href="metadata/includes.php">See it in action</a></p>
<p>View: <a href="metadata/templates/includes.main.template">main template</a>, 
<a href="metadata/templates/includes.item.template">item template</a>, 
<a href="includes.phps">includes.php</a></p>
<p>Note the way the templates are specified in the query string.</p>


<h2>Example 3: JavaScript</h2>
<p>With this example we create the templates in such a way that the PHP script
outputs a JavaScript file with the parsed RSS inside.&nbsp; The way I've done it
here is to create an object that holds all the RSS fields, including an array of
objects for the items.&nbsp; To display the RSS file we simply document.write()
the variables and loop through the array.&nbsp; While document.write() isn't the
nicest way to insert content into a document using JavaScript, it is easy and
will work in version 4 browsers.</p>
<p><a href="metadata/javascript.htm">See it in action</a></p>
<p>View: <a href="metadata/templates/javascript.main.template">main template</a>,
<a href="metadata/templates/javascript.item.template">item template</a></p>
<p>This is the most flexible method if you can't run PHP scripts yourself.&nbsp;
In the &lt;script&gt; tag's src attribute you can reference the PHP script
running on our server.&nbsp; In the query string simply specify full paths to
the XML file you want to display and your template files.&nbsp; e.g:</p>
<pre>&lt;script type=&quot;text/javascript&quot;
src=&quot;http://13thparallel.org/metadata/13r2a.php?
maintemplate=http://yourdomain.com/
templates/javascript.main.template&amp;
itemtemplate=http://yourdomain.com/
templates/javascript.item.template&amp;
url=http://http://yourdomain.com/
mynews.rss&quot;&gt;&lt;/script&gt;</pre>
<p>The example shown here simply displays the RSS fields, however with a bit of
imagination there are some pretty dynamic ways you could use this facility.</p>


<h2>Conclusion</h2>
<p>Well, this is only version 1.0 of the script so bare with me, I'm sure there
are a few bugs that need fixing and features that would be useful.&nbsp; If it
turns out people are actually using this script then I'll continue development
and make it better.&nbsp; There are also plans for an ASP version.</p>
<p>Syndication and news feeds aren't the only use for RSS.&nbsp; It can be a
useful, standards-compliant tool for managing your own information.&nbsp; For
example, an RSS file would be the perfect way to store descriptions of your
photos.</p>
<? include('/var/www/site/foot.php') ?>
