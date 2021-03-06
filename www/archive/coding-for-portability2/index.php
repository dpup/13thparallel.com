<? include('/var/www/site/head.php') ?>

<h1>Coding For Portability, Part 2</h1>
<p class="author">By Tom Trenka, April 2002</p>

<h2>Introduction</h2>
<p>Last month, in Designing for Portability: the Utility of Namespacing, I talked about using the JavaScript intrinsic Object as a method of emulating namespaces
- and in the process, reviewed the basics of variable scoping.  These concepts were introduced as a method of containment: the idea that you can instantiate very few variables in the global (window) scope, and therefore have your code remain (fairly) independent.</p>
<p>This month I will be discussing the importance of planning, with a focus on using the principles behind Object-Oriented Programming to design and build your web application (by web application, I am referring to any use of scripting within a browser environment).  I will not be presenting any code examples, but don&#8217;t worry
- it&#8217;s looking like there are some great things coming from 13th Parallel down the pike, all of which will demonstrate, in some shape or form, the issues that I discuss in the Designing for Portability series.</p>
<h2>Planning your Application</h2>
<p>Of key importance in the planning of any application is the analysis of the problems (used here in the mathematical sense) the application is intended to solve.  Ask yourself the following questions:<br />
 - What is the application supposed to do?<br />
 - Are these goals realistic?  Are they possible?<br />
 - How does it accomplish its goals?<br />
 - What data does the application operate on, and with?<br />
 - How does the application communicate its action and interaction with the user?</p>
 
<p>These questions should be asked before anything else - if you haven&#8217;t defined the application, in full, before coding, you&#8217;re asking for trouble.  In my 5 years of experience as a programming professional (and 10 years before that as a hobby), I&#8217;ve seen and worked on a lot of different projects
- some planned well, some not planned at all - and the results invariably were an accurate reflection of the amount (and quality) of planning that went into it.  At the high point of the dot-com boom, it was estimated that 50% to 65% of all IT projects failed, whether completely, by going over budget, or going over deadlines.  Almost always, these failures were due to poor planning. Remember: it is a LOT harder to code something that isn&#8217;t clearly defined.</p>
<h2>Using reductive analysis</h2>
<p>OK, you&#8217;ve asked yourself the question above (and hopefully those questions have created new ones), and now you have a general idea of what the application is going to do, and how it will do it.  The next step is to break down each task the application performs into its most basic, atomic form.  This is a process known as &#8220;reductive analysis&#8221;.  The concept is that you take a problem, reduce it to a set of simpler problems, each of which is then subjected to the same process, ad infinitum
- until each resultant problem is stated in its most basic, elemental form.</p>
<p>If done properly (a lofty ideal that seldom occurs), each piece will end up being a component of your application, and you will have a specification (which you may want to document, for future reference) that is pretty complete.  In addition, you will have a set of tasks that can be easily coded.</p>
<h2>Look for patterns</h2>
<p>Once you&#8217;ve performed some sort of reductive analysis on your problem, the next step is to look for patterns.  These patterns are known as &#8220;design patterns&#8221;, and it is a pretty hot IT buzzword.  A commonly accepted definition of design patterns is as follows:</p>
<p>&#8220;A pattern is instructive information that captures the essential structure and insight of a successful family of proven solutions to a recurring problem that arises within a certain context and system of forces.&#8221; (Riehle and Zullighoven, Theory and Practice of Object Systems (journal))</p>
<p>This definition implies a lot of what a good design pattern represents.  Some characteristics of design patterns are:<br />
 - It solves a problem.<br />
 - The solution is not obvious.<br />
 - It is a proven concept.<br />
 - It describes a relationship.<br />
 - It has a significant human component.</p>
 
<p>Design patterns are a recurring phenomenon, and are usually subject to a rule of three; they can be identified in at least three separate systems within the same problem domain.</p>
<p>When defining a design pattern solution, you should follow some of the suggestions put forth by Brad Appleton in his paper &#8220;Patterns and Software: Essential Concepts and Terminology&#8221; (still available at
<a href="http://www.enteract.com/~bradapp/docs/patterns-intro.html" class="external">http://www.enteract.com/~bradapp/docs/patterns-intro.html</a>).  Some of these suggestions are:<br />
 1. &nbsp;<b>Name</b>.  Use a meaningful single word or short phrase that identifies the pattern and the structure it describes.  For instance, if you are dealing with a logical structure that represents an x/y value, call it &#8220;Point&#8221;; anyone who reads your code (including yourself) will instantly understand the abstract concept your code represents.<br />
 2. &nbsp;<b>Problem</b>.  A statement of the problem that describes the goals and objectives it wants to reach within the given context and forces.<br />
 3. &nbsp;<b>Context</b>.  The conditions under which the problem and solution seems to occur, and for which the solution is desirable.<br />
 4. &nbsp;<b>Forces</b>.  A description of all relevant forces and constraints, and how they interact and conflict with each other, with the goals to be achieved.<br />
 5. &nbsp;<b>Solution</b>.  A description of how to realize the desired outcome.</p>
 
<div>(Taken and paraphrased from &#8220;Analyzing Requirements and Defining Solution Architectures&#8221;, Microsoft Press)</div>
<p>Why would we look for patterns?  In real world terms, the answer is simple: by nature, we programmers are lazy, and hate writing more code than we have to ;) ; no, the idea is to write code that is as reusable as possible.  </p>
<p>Let&#8217;s take an example.  I&#8217;m sure some of you have run across a web site somewhere that preloads a number of images (say, 20), and the author defined twenty different variables, each of which goes through at least 3 statements to accomplish the preloading.  Image preloading would be a great candidate for a design pattern solution; instead of rewriting the same lines 20 times, you simply define a function, maybe something like this:</p>
<pre>Preloader = function(path) {
    var img = new Image() ;
    img.src = path ;
    return ;
}</pre>
<p>Simple enough, right?  Well, now instead of rewriting the same code 20 times, we can simply call the function, and let the pattern handle it for us.  And you can continually put this function in your code without alteration: a perfect example of reusability, which is one of the primary goals of Object Oriented Programming.</p>
<p>Some design patterns have already been implemented for you, thanks to the World Wide Web Consortium; for instance, the DOM methods Node.getElementById() is a design pattern that solves the problem of getting a handle to a node in your document.  When possible, you should use those patterns as opposed to writing your own; that&#8217;s what they are there for, and rewriting them does you and your program little good.</p>
<h2>Planning your Architecture</h2>
<p>Now that you have a clear idea of your problem, and the recurring patterns within your problem, you are ready for the next step: devising the architecture that will serve as the framework within which your solution will be deployed.  This may be as simple as a short code block placed within the HEAD of your document, or it may warrant a much more complex, full blown Application Programming Interface (API).  Either way, one of your main guidelines should be to keep it as simple as possible.  One of the prime reasons for the failure of a project is the creation of an extremely complex program to handle a fairly simple task.  As one of my teachers, the composer Thea Musgrave, once told me:  your solution (in this context, a piece of music) should sound complex, but be simple.  When translated to coding practices:  your program should &#8220;feel&#8221; complex, but be as simple as possible.  For examples of this, I would suggest you peruse some of the DHTML experiments Dan Pupius has at his excellent
<a href="http://www.endoflow.com" class="external">endoflow.com</a>, or some of the experiments Brent Gustafson wrote at
<a href="http://xlat.assembler.org" class="external"> Assembler.org</a>.</p>
<p>The concept of architecture, as applied to programming practices, has always been a subject of great debate.  I would suggest that you try to plan yours using the n-tier model: separate the solutions of your problem through organization into logical tiers that communicate and interact with each other.</p>
<p>The n-tier concept is simple.  Solutions tend to fall into a number of different categories; there are purely logical solutions (such as mathematical manipulations), solutions that deal with a user interface (such as animations, validation of form elements, and whatnot), data solutions (solutions that deal with the manipulation and storage/retrieval of data), and more.  </p>
<p>Each one of these categories can be thought of as a &#8220;tier&#8221; (also known as a layer).  If you can plan and separate your solutions into a set of different tiers, each of which has a standardized way of communicating with each other, you have gone a long way to reusability and abstraction, key concepts that allow for faster and cleaner coding.</p>
<p>Standard practices define a number of different semantic tiers- there is the Data layer, which represents data storage and retrieval; the UI layer, which represents the elements (and manipulation of those elements) which the user directly interacts with; the Business layer, which defines and codifies the business logic with which a company does it&#8217;s transactions, and so on.  In a typical JavaScript application, these three layers are usually the norm.  The Business layer is often the equivalent of a &#8220;main()&#8221; method, or the actual program itself; the UI layer deals with the I/O from the user, and the Data layer deals expressly with data manipulation and storage.</p>
<p>With this in mind, when creating the framework for your application, you should decide which layer a particular solution belongs in, and keep it as isolated as possible.  For instance, a method in your Data layer should never expect an HTML node as a parameter; that is up to the Business layer, which facilitates the communication between your Data layer and your UI layer.  Similarly, your UI layer should never expect a Data unit as a parameter.  Only in the Business layer should you combine the two; that is the purpose of it.</p>
<h2>Where to go from here</h2>
<p>At this point you will have (hopefully) planned your application to the point where you can begin coding.  We&#8217;ve discussed design patterns (which most of your individual methods will be based on), reductive analysis (from which you&#8217;ll have found your design patterns), and a model for organizing and isolating the logical structure of your program.  Documentation is always a bonus; I know that it is time-consuming, but if you expect your application to be somewhat persistent (i.e. in use for more than 6 months), you&#8217;ll thank yourself for doing it.</p>
<p>With a good architecture plan, you&#8217;ll be able to create code that lends itself to reusability-
so that the next time you begin an application, instead of coding everything from scratch, you&#8217;ll be able to say &#8220;wait a minute...I already wrote a method that handles this!&#8221;-
copy it directly into your code, and call it good.  Without a rewrite.</p>
<p>Next month, I will talk a little more about the n-Tier architecture - in the context of a full-blown API library.  Good things come to those who wait...</p>
<? include('/var/www/site/foot.php') ?>
