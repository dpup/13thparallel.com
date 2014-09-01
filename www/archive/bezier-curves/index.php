<? include('/var/www/site/head.php') ?>

<h1>Bezi&eacute;r curves and JavaScript</h1>
<p class="author">By Daniel Pupius, January 2002</p>

<p>You&#8217;ve no doubt already heard of Bezi&eacute;r curves and seen them being used in graphics
packages and computer games.&nbsp; You may have even thought of using them to
perform animations and transitions in DHTML, but maybe you were daunted by the
complex mathematics involved.</p>

<p>While the underlying principles are
reasonably advanced, it is not necessary for you to understand the Bezi&eacute;r
Functions in order to use them.</p>

<p>Bezi&eacute;r functions can be used to generate a wide range of shapes,
including 2D &amp; 3D lines and 3D patches for modeling.&nbsp; This tutorial
shows you how to use a cubic Bezi&eacute;r curve in 2-dimensions and uses the
Bernstein Basis Function to calculate the points on the curve.</p>

<h2>The Maths</h2>
<p>The Bernstein Basis Function is as follows:<br />
<br />1 = t + (1 - t)<br />
<br />
Obvious right?&nbsp; Try it out, substitute any value for t and you will find this equation holds true.</p>

<p>Now, we use this function as a parametric method for generating the complex
curves.&nbsp; For a quadratic (2nd order) Bezi&eacute;r curve we square both sides:<br />
<br />1<sup>2</sup> = (t + (1 - t))<sup>2</sup><br />
&#187; 1 = t<sup>2</sup> + 2t(1 - t) + (1 - t)<sup>2</sup><br />
<br />
And for a cubic (3rd order) curve we cube both sides:<br />
<br />
1<sup>3</sup> = (t + (1 - t))<sup>3</sup><br />
&#187; 1 = (t + (1 - t)) . (t<sup>2</sup> + 2t(1 - t) + (1 - t)<sup>2</sup>)<br />
&#187; 1 = t<sup>3</sup> + 3t<sup>2</sup>(1 - t) + 3t(1 - t)<sup>2</sup> + (1 - t)<sup>3</sup><br />
<br />
<img src="images/bezier.gif" width="122" height="170" alt="Bezier curve" class="right" />While it 
is possible to simplify this equation more, for the purpose of this
we want it in terms of t and (1 - t).&nbsp; You should also note the way we
order the equation.<br />
<br />
The cubic equation can be split up to give us 4 Bezi&eacute;r functions:<br />
<br />
B<sub>1</sub>(t) = t<sup>3</sup><br />
B<sub>2</sub>(t) = 3t<sup>2</sup>(1 - t)<br />
B<sub>3</sub>(t) = 3t(1 - t)<sup>2</sup><br />
B<sub>4</sub>(t) = (1 - t)<sup>3</sup><br />
<br />
In a quadratic (2nd order) curve there would only be 3 functions and in a quartic (4th order) there would be 5.<br />
<br />
Now, a cubic Bezi&eacute;r curve is defined by 4 control points.&nbsp; The first being the
start point, the next 2 define the shape of the curve and the final point is the
end point.<br />
<br />
To find a particular point on the curve we use the following equation:<br />
<br />
p = C<sub>1</sub>.B<sub>1</sub>(d) + C<sub>2</sub>.B<sub>2</sub>(d) + C<sub>3</sub>.B<sub>3</sub>(d) + C<sub>4</sub>.B<sub>4</sub>(d)<br />
&nbsp; where:<br />
&nbsp;&nbsp;&nbsp;&nbsp; C<sub>i</sub>  are the control points<br />
&nbsp;&nbsp;&nbsp;&nbsp; B<sub>i</sub>  are the Bezi&eacute;r functions<br />
&nbsp;&nbsp;&nbsp;&nbsp; d is a percentage of the distance along the curve
(between 0 and 1)<br />
&nbsp;&nbsp;&nbsp;&nbsp; p is the point in 2D space</p>



<h2>Bezi&eacute;r Curves in JavaScript</h2>

<p>To use Bezi&eacute;r Curves in JavaScript, we&#8217;ll begin by defining a custom type to represent the
position of a point in 2D space:</p>

<pre class="code">coord = function (x,y) {
   if(!x) var x=0;
   if(!y) var y=0;
   return {x: x, y: y};
}</pre>

<p>In order to make it easier to program, we then need to define the Bezi&eacute;r
Base Functions (see above):</p>

<pre class="code">function B1(t) { return t*t*t }
function B2(t) { return 3*t*t*(1-t) }
function B3(t) { return 3*t*(1-t)*(1-t) }
function B4(t) { return (1-t)*(1-t)*(1-t) }</pre>

<p>We can then define the control points of the Bezi&eacute;r curve as a coord datatype:</p>

<pre class="code">C1 = coord(50,100);
C2 = coord(-50,200);
C3 = coord(150,400);
C4 = coord(500,300);</pre>

<p>Now using the equation described above we can find a point half way along the
Bezi&eacute;r curve using the following code:</p>

<pre class="code">var pos = new coord();
pos.x = C1.x * B1(0.5) + C2.x * B2(0.5) + C3.x * B3(0.5) + C4.x * B4(0.5);
pos.y = C1.y * B1(0.5) + C2.y * B2(0.5) + C3.y * B3(0.5) + C4.y * B4(0.5);</pre>
		

<p>Putting this together we get the following function:</p>

<pre class="code">//====================================\\
// 13thParallel.org Bezi&eacute;r Curve Code \\
//   by Dan Pupius (www.pupius.net)   \\
//====================================\\

coord = function (x,y) {
  if(!x) var x=0;
  if(!y) var y=0;
  return {x: x, y: y};
}

function B1(t) { return t*t*t }
function B2(t) { return 3*t*t*(1-t) }
function B3(t) { return 3*t*(1-t)*(1-t) }
function B4(t) { return (1-t)*(1-t)*(1-t) }

function getBezier(percent,C1,C2,C3,C4) {
  var pos = new coord();
  pos.x = C1.x*B1(percent) + C2.x*B2(percent) + C3.x*B3(percent) + C4.x*B4(percent);
  pos.y = C1.y*B1(percent) + C2.y*B2(percent) + C3.y*B3(percent) + C4.y*B4(percent);
  return pos;
}</pre>

<p>Remember percent has to be between 0 and 1.</p>



<h2>Examples</h2>

<p><a href="example1.htm">Example
1</a>: Shows you how to use the
getBezier function to animate a nice
curve.<br />
<br />
<a href="example2.htm">Example
2</a>:
Uses one curve to define the point on another curve, gives a bouncing ball
effect (same method as used in the 13th API's timeSlide() function)<br />
<br />
<a href="example3.htm">Example
3</a>: Allows you to play with a
Bezi&eacute;r curve.<br />
<br />
<a href="http://3dhtml.netzministerium.de/examples/beziercube3d.html" class="external">Example 4</a>: a bouncing 3d cube courtesy of the guys over at <a href="http://3dhtml.netzministerium.de" class="external">Netzministerium</a>, uses their 3dhtml 
API.
</p>



<h2>References</h2>

<p>This tutorial offers a very basic introduction to Bezi&eacute;r curves, just enough
to understand how the functions work.&nbsp; As well as helping me write this
tutorial, the links below provide some more detailed information on the maths
and use of Bezi&eacute;r curves.&nbsp;<br />
<br />
<a href="http://www.gamedev.net/reference/articles/article888.asp" class="external">Unraveling Bezi&eacute;r Splines</a> by Justin Reynen (<a href="http://www.gamedev.net/" class="external">Gamedev.net</a>)<br />
<a href="http://www.cee.hw.ac.uk/~ian/hyper00/curvesurf/bezier.html" class="external">Bezi&eacute;r Curves</a> and
<a href="http://www.cee.hw.ac.uk/~ian/hyper00/curvesurf/morebez.html" class="external">More on Bezi&eacute;r Curves</a> by Ian E. Aitchison</p>
<? include('/var/www/site/foot.php') ?>
