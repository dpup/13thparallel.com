// viewport example2 - measuring the viewport size

function addProperty( sProperty ) {
	sContent += "<tr>\n\t<td>" + sProperty + "</td>"; 
}

function testProperty( property ) {
	sContent += "\t<td>" + property + "</td>\n</tr>";
}

var sContent = "<div id='divData'><table width='300'>";
sContent += "<tr><td colspan='2'>This is a div with absolute positioning. "
sContent += "The following measurements were taken before this div was created.</td></tr>";

sContent += "<tr><td colspan='2'>&nbsp;</td></tr>";

// documentElement clientWidth and clientHeight
addProperty( "document.documentElement.clientWidth" );
if( document.documentElement ) testProperty( document.documentElement.clientWidth )
else testProperty( undefined );

addProperty( "document.documentElement.clientHeight" );
if( document.documentElement ) testProperty( document.documentElement.clientHeight )
else testProperty( undefined );

sContent += "<tr><td colspan='2'>&nbsp;</td></tr>";

// body clientWidth and clientHeight
addProperty( "document.body.clientWidth" );
if( document.body ) testProperty( document.body.clientWidth )
else testProperty( undefined );

addProperty( "document.body.clientHeight" );
if( document.body ) testProperty( document.body.clientHeight )
else testProperty( undefined );

sContent += "<tr><td colspan='2'>&nbsp;</td></tr>";

// window innerWidth and innerHeight
addProperty( "window.innerWidth" );
testProperty( window.innerWidth );

addProperty( "window.innerHeight" );
testProperty( window.innerHeight );


sContent += "</table></div>";
document.write( sContent );

// end