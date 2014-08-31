<?
//show results page
if($_POST["body"] != "") {

$name = htmlentities(stripslashes($_POST["name"]));
if($name=="") $name = "Unknown dude";

$email = htmlentities(stripslashes($_POST["email"]));
if($email=="") $email = "noone@nodomain.com";

$subject = htmlentities(stripslashes($_POST["subject"]));
if($subject=="") $subject = "No Subject";

$body = str_replace("\t"," &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;",str_replace("  "," &nbsp;",nl2br(htmlentities(stripslashes($_POST["body"])))));


$reply_subject = rawurlencode("Re: $subject");
$reply_body = explode("\n",$body);
foreach($reply_body as $key => $val) {
	$reply_body[$key] = ">   $val";
}
$reply_body = rawurlencode(implode("\n",$reply_body));


//create html email

$message = "<p>Message recieved from <strong>{$_SERVER['REMOTE_ADDR']}</strong> at <strong>" . Date("H:i:s") . "</strong> on <strong>" . Date("j F Y") . "</strong></p>\n";
$message.= "<p><strong>name:</strong><br />$name</p>\n";
$message.= "<p><strong>email:</strong><br /><a href=\"mailto:$email?subject=$reply_subject&body=$reply_body\">$email</a></p>\n";
$message.= "<p><strong>subject:</strong><br />$subject</p>\n";
$message.= "<hr />";
$message.= "<p>$body</p>";

//create headers
$headers = "From: $email\r\n";
$headers.= "MIME-Version: 1.0\r\n";
$headers.= "Content-type: text/html; charset=iso-8859-1\r\n";

//send the email
mail("dan@13thparallel.com", "Thirteenth Parallel Contact Form", "<style>* { font-family: sans-serif; } </style>".$message, $headers);



?>
<h1>Message Sent</h1>
<p>Thanks for getting in touch with us, we'll try and pick up the message and reply as soon as possible!  
For your records, here's a copy of the email we just recieved:</p>

<pre>
<?= $message ?>
</pre>


<?

//show email form
} else {
?>


<h1>Contact</h1>
<p class="author">Get in touch with us</p>

<form id="frm" action="./" method="post" onsubmit="return checkform()">
	<p>
		<label for="frmname">Name</label>:<br />
		<input class="medium" type="text" name="name" id="frmname" />
	</p>

	<p>
		<label for="frmemail">Email</label>:<br />
		<input class="medium" type="text" name="email" id="frmemail" />
	</p>

	<p>
		<label for="frmsubject">Subject</label>:<br />
		<input class="large" type="text" name="subject" id="frmsubject"/>
	</p>

	<p>
		<label for="frmbody">Message</label>:<br />
		<textarea class="large" name="body" id="frmbody" rows="10" cols="25"></textarea>
	</p>

	<p><input class="button" type="submit" value="Send Email" /></p>
</form>
<script type="text/javascript">
// <![CDATA[

	function checkform() {
		if(document.forms["frm"].frmbody.value=="") {
			alert("Please don't submit empty messages.  Thanks.");
			return false;
		}
		
		if(document.forms["frm"].frmname.value=="" && !confirm("If you submit the form now I won't know who you are because you haven't entered a name.\n\nDo you want to submit the form anyway??")) {
			document.forms["frm"].frmname.focus();
			return false
		}
		
		if(document.forms["frm"].frmemail.value=="" && !confirm("Are you sure you want to submit the form without telling me your email address?  If you do, I won't be able to reply!\n\nDo you want to submit the form anyway??")) {
			document.forms["frm"].frmemail.focus();
			return false
		}

		return true;
	}

	Toolkit.Events.addListener(window,"onload",function() {setupforms();if(document.forms["frm"]) document.forms["frm"].frmname.focus();});
// ]]>
</script>

<? } ?>
