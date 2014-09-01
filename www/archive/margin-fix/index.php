<? include('/var/www/site/head.php') ?>

<h1>Internet Explorer Margin Fix</h1>
<p class="author">By David Schontzler, April 2002</p>

<p>
<strong>UPDATED: 13.04.2002</strong><br />
The elements should no longer "jump" to their new position. All the styling is fixed before the page loads.  The only constraint is that the <code>script</code> declaration be put <strong>after</strong> all <code>style</code> declarations.
</p>

<p>In Internet Explorer 5.x and backwards-compatible-mode Internet Explorer 6 on Windows platforms, the automatic horizontal <em title="as defined by the W3C in the CSS specs">margins</em> are not implemented correctly.  Setting the various forms of automatic left and right margins has no effect on the desired element.  This script will fix the bug in Internet Explorer without any modification to your HTML or CSS, making your pages display correctly.  For more details, check out the resources (see later).</p>

<p>NOTE: This is <em>not</em> a workaround which requires custom CSS or the like.  It will take a document that is setup with the correct CSS without any extra work by the user aside from adding the script to the page.</p>


<h2>Status</h2>

<p>This script is still considered beta, and changes can be made at any time.</p>




<h2>Compatibility</h2>

<p>The fix, made for Internet Explorer 5 &amp; 6, will setup the margins for every element in the document that uses <code>margin : auto</code>, <code>margin : <em>value</em> auto</code>, <code>margin-left : auto</code> &amp; <code>margin-right : auto</code>, <code>margin : <em>value</em> auto <em>value</em></code>, or <code>margin : <em>value</em> auto <em>value</em> auto</code>.</p>

<p>If Internet Explorer 6 standards-mode (or any other browser) is viewing the page, the script will have no effect or cause any errors.</p>

<p>The fix works for not only top-level elements but nested elements as well (see
<a href="examples.htm">examples</a>).</p>

<p class="note">Note:  This will only work for styles declared in stylesheets.  No <code>style</code> attributes in HTML elements will be parsed.  The script supports inline, linked, and imported (<code>@import</code>) stylesheets.</p>






<h2>Implementation</h2>

<p>The fix is easy to implement.  Just download (see later) the script and link to it with a <code>script</code> tag in the head of the document <strong>after every style declaration (inline, imported, &amp; linked)</strong>.  Example:</p>

<pre>&lt;script src=&quot;IEmarginFix.js&quot;
type=&quot;text/javascript&quot;&gt;&lt;/script&gt;</pre>

<p>It parses the stylesheet and automatically applies the fix to the margins (even when resized).  A sample document with an <em title="although it is recommended that you use linked stylesheets">inline style declaration</em> would be as follows:</p>

<pre>
&lt;html&gt;
&lt;head&gt;
<em>...</em>
&lt;style type=&quot;text/css&quot;&gt;
.myElement
{
	width : 30%;
	<strong>margin : auto;</strong>
	background : red;
}
&lt;/style&gt;
&lt;!-- all style declarations above this line --&gt;
<strong>&lt;script src=&quot;IEmarginFix.js&quot; type=&quot;text/javascript&quot;&gt;&lt;/script&gt;</strong>
&lt;/head&gt;

&lt;body&gt;
&lt;div class=&quot;myElement&quot;&gt;
  <em>... Content ...
</em>&lt;/div&gt;
&lt;/body&gt;
&lt;/html&gt;
</pre>






<h2>Examples</h2>

<p>The examples are viewable <a href="examples.htm">here</a>.</p>


<h2>Download</h2>

<p>Download the file here: <a href="IEmarginFix.js">IEmarginFix.js</a></p>



<h2>Resources</h2>

<p>For detailed information on defining margins, see the <a href="http://www.w3.org/TR/REC-CSS2/box.html#margin-properties" class="external">W3C CSS2 Reference: Box Model</a>.</p>

<p>Check out some of the W3C's CSS tests <a href="http://www.w3.org/Style/CSS/Test/CSS1/19990126/sec43.htm" class="external">here</a> (orange boxes) and <a href="http://www.w3.org/Style/CSS/Test/CSS1/19981002/sec5505.htm" class="external">here</a> (see the gray boxes) for some samples of automatic margins.</p>

<p>With the release of Internet Explorer 6.0, the CSS support has vastly improved and the various forms of <code>margin : auto</code> is now supported.  For information on enabling standards-mode in Internet Explorer 6.0, check out <a href="http://www.alistapart.com/stories/doctype/" class="external">Fixing your site with the right DOCTYPE</a> from A List Apart.</p>




<h2>Notes</h2>

<p>This document uses <a href="http://jigsaw.w3.org/css-validator/validator?uri=http://www.stilleye.com/scripts/marginfix" class="external">valid CSS</a>.  For this script to work properly, valid CSS is recommended.</p>

<p>It is always good to have <a href="http://validator.w3.org/check/referer" class="external">valid HTML</a> as well.</p>





<h2>Credits</h2>

<p>The script was written by David Schontzler and is copyright 2002.</p>

<p>Please report any bugs <a href="mailto:david%40stilleye.com">here</a>.</p>

<p>May be freely distributed under the <a href="http://www.fsf.org/copyleft/gpl.html" class="external">GNU General Public License</a>.</p>

<p>Permanent URL: <a href="http://www.stilleye.com/scripts/marginfix" class="external">http://www.stilleye.com/scripts/marginfix</a>.</p>
<? include('/var/www/site/foot.php') ?>
