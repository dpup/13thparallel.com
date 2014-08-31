<?

//======================================================================================================
//  13r2a.php - 13th RSS1.0 2 Anything - vs1.0
//  copyright(c)2002 Daniel Pupius (13thparallel.org)
//======================================================================================================
//
//           - processes an RSS1.0 document using templates.
//           - uses two templates "maintemplate" and "itemtemplate", these can be specified in the
//             querystring or a default template can be specified in this file
//           - "maintemplate" wraps the entire feed while "itemtemplate" is used to format the
//             items in a feed
//           - in the templates you specify values that you want to insert into the document
//             using "tags" in the form <**13r2a tagname **> (where ** is really a ?)
//
//           - the tags that can be used in the maintemplate are:
//                         feedTitle             - main feed title specified in the "channel" tag
//                         feedLink              - main link
//                         feedDescription       - description of the feed
//                         imageURL              - location of a thumbnail image for the feed
//                         imageTitle            - title to go with the image
//                         imageLink             - link for image (normally used if you click image)
//                         theFeed               - where all the items are to go
//                         numItems              - an integer of how many items are in rss file
//                         xmlFile               - the url of the xml file being used
//                         pageURL               - link to current page without querystring (you'll need to manually add the querystring using the other variables))
//                         mainTemplate          - link to main template file
//                         itemTemplate          - link to item template file
//
//                         Future versions of this script will allow for custom tags or those from
//                         another RDF vocabulary (such as The Dublin Core)
//
//
//           - the tags that can be used in the itemtemplate are:
//                         itemTitle             - title of the item
//                         itemLink              - a link for that item
//                         itemDescription       - item's description
//                         itemNo                - item's position in list, starting at 1
//
//           - example:
//                         <a href="<**13r2a itemLink **>"><**rss2html itemTitle **></a>
//             (except replace "**" with "?")
//
//           - you can use this script as a stand alone file to generate an entire HTML file,
//             you could include the file using SSI or another PHP call, 
//             use templates to create a JS file that can be processed client side
//
//
//
// [the code here is still a bit messy, I will try and clean it up in future versions]
//
//                   
//
// (you may use & redistribute this script free-of-charge providing this comment is left intact, as is)
//======================================================================================================



if(!$url)
	$url="http://13thparallel.org/metadata/13rss1.xml";					//default url if none specified in querystring
if(!$maintemplate)
	$maintemplate="http://13thparallel.org/metadata/templates/standalone.main.template"; 	//default template if none specified in querystring
if(!$itemtemplate)
	$itemtemplate="http://13thparallel.org/metadata/templates/standalone.item.template"; 	//default template for item if none specified in querystring


//Some feeds may not have an image.  So we must specify the defaults
$defaultImageURL = "http://13thparallel.org/metadata/32x32.gif";				//default image file
$defaultImageTitle = "Powered by 13r2a from 13th Parallel";					//default image title
$defaultImageLink = "http://13thparallel.org/";							//default image link



//======================================================================================================

$insideitem = false;
$tag = "";
$title = "";
$description = "";
$link = "";
$count=0;

$insidechannel = false;
$ctag = "";
$ctitle = "";
$cdescription = "";
$clink = "";

$insideimage= false;
$itag = "";
$ititle = "";
$idescription = "";
$ilink = "";
$iurl = "";


$mainT = readFromFile($maintemplate);
$itemT = readFromFile($itemtemplate);


function readFromFile($file) {
	if(strpos($file,"://") === false) {							//see if the filename is local
		if(!file_exists($file)) {							//check to see if file exists
			$fileContents = "[the file '$file' does not exist]";

		} else if(fileowner($file) != fileowner("13r2a.php")) {				//check to see if you have permission to view the file
			$fileContents = "[you do not have permision to view '$file']";		//this stops people accessing things like /etc/passwd

		} else {
			$fp = fopen($file, "r");						//open file pointer
			$fileContents = fread($fp,filesize($file));				//read contents of file into a variable
			fclose($fp);								//close file pointer
		}
	} else {
		$fp = @fopen($file, "r");							//open url (supressing error)
		if($fp) {									//see if file pointer was established
			$fileContents = fread($fp,50000);					//read first 50,000 characters of file
			fclose($fp);								//close file pointer
		} else {
			$fileContents = "[the file '$file' does not exist]";
		}			
	}
	return $fileContents;
}

function startElement($parser, $tagName, $attrs) {
	global $insideitem, $tag, $insidechannel, $ctag, $insideimage, $itag, $count;
	$count++;

	if ($insideitem) {
		$tag = $tagName;

	} elseif ($insidechannel) {
		$ctag = $tagName;

	} elseif ($insideimage) {
		$itag = $tagName;

	} elseif ($tagName == "ITEM" || $tagName == "RSS:ITEM") {
	        $insideitem = true;

 	} elseif ($tagName == "CHANNEL" || $tagName == "RSS:CHANNEL") {
	        $insidechannel = true;

	} elseif ($tagName == "IMAGE" || $tagName == "RSS:IMAGE") {
	        $insideimage = true;
	}
}

function endElement($parser, $tagName) {
	global $output, $items, $count, $itemT, $insideitem, $tag, $title, $description, $link, $insidechannel, $ctag, $ctitle, $clink, $cdescription, $insideimage, $itag, $ititle, $ilink, $idescription, $iurl;
	
	if ($tagName == "ITEM" || $tagName == "RSS:ITEM") {
		$item = $itemT;
		$item = preg_replace("/<\?13r2a\s+itemTitle\s*\?>/", htmlspecialchars(trim($title)), $item);
		$item = preg_replace("/<\?13r2a\s+itemLink\s*\?>/", trim($link), $item);
		$item = preg_replace("/<\?13r2a\s+itemDescription\s*\?>/", htmlspecialchars(trim($description)), $item);
		$item = preg_replace("/<\?13r2a\s+itemNo\s*\?>/", $count, $item);

		$items .= $item;

		$title = "";
		$description = "";
		$link = "";
		$insideitem = false;

	} elseif ($tagName == "CHANNEL" || $tagName == "RSS:CHANNEL") {

		$output = preg_replace("/<\?13r2a\s+feedTitle\s*\?>/", htmlspecialchars(trim($ctitle)), $output);
		$output = preg_replace("/<\?13r2a\s+feedLink\s*\?>/", trim($clink), $output);
		$output = preg_replace("/<\?13r2a\s+feedDescription\s*\?>/", htmlspecialchars(trim($cdescription)), $output);

		$ctitle = "";
		$cdescription = "";
		$clink = "";
		$insidechannel = false;

	} elseif (($tagName == "IMAGE" || $tagName == "RSS:IMAGE") && !$insidechannel) {

		$output = preg_replace("/<\?13r2a\s+imageTitle\s*\?>/", htmlspecialchars(trim($ititle)), $output);
		$output = preg_replace("/<\?13r2a\s+imageLink\s*\?>/", trim($ilink), $output);
		$output = preg_replace("/<\?13r2a\s+imageURL\s*\?>/", trim($iurl), $output);
		$output = preg_replace("/<\?13r2a\s+imageDescription\s*\?>/", htmlspecialchars(trim($idescription)), $output);

		$ititle = "";
		$idescription = "";
		$ilink = "";
		$insideimage = false;
	}
}


function characterData($parser, $data) {
	global $insideitem, $tag, $title, $description, $link, $insidechannel, $ctag, $ctitle, $clink, $cdescription, $insideimage, $itag, $ititle, $ilink, $idescription, $iurl;

	$data = preg_replace("/\s+/"," ",str_replace("\t"," ",str_replace("\r"," ",str_replace("\n"," ",$data))));

	if ($insideitem) {
        	switch ($tag) {
			case "TITLE":
			case "RSS:TITLE":
				$title .= $data;
				break;
			case "DESCRIPTION":
			case "RSS:DESCRIPTION":
				$description .= $data;
				break;
			case "LINK":
			case "RSS:LINK":
				$link .= $data;
			break;
		}

	} elseif ($insidechannel) {
        	switch ($ctag) {
			case "TITLE":
			case "RSS:TITLE":
				$ctitle .= $data;
				break;
			case "DESCRIPTION":
			case "RSS:DESCRIPTION":
				$cdescription .= $data;
				break;
			case "LINK":
			case "RSS:LINK":
				$clink .= $data;
			break;
		}

	} elseif ($insideimage) {
        	switch ($itag) {
			case "TITLE":
			case "TITLE":
				$ititle .= $data;
				break;
			case "DESCRIPTION":
			case "RSS:DESCRIPTION":
				$idescription .= $data;
				break;
			case "LINK":
			case "RSS:LINK":
				$ilink .= $data;
				break;
			case "URL":
			case "RSS:URL":
				$iurl .= $data;
				break;
		}
	}
}



$output = $mainT;
$items = "";

// Create an XML parser
$xml_parser = xml_parser_create();

// Set the functions to handle opening and closing tags
xml_set_element_handler($xml_parser, "startElement", "endElement");

// Set the function to handle blocks of character data
xml_set_character_data_handler($xml_parser, "characterData");

// Open the XML file for reading
$fp = fopen("$url","r") or die("Unable to read RSS file.");

// Read the XML file 4KB at a time
while ($data = fread($fp, 4096))    // Parse each 4KB chunk with the XML parser created above
    xml_parse($xml_parser, $data, feof($fp))        // Handle errors in parsing
        or die(sprintf("XML error: %s at line %d",
             xml_error_string(xml_get_error_code($xml_parser)),
             xml_get_current_line_number($xml_parser)));

// Close the XML file
fclose($fp);

// Free up memory used by the XML parser
xml_parser_free($xml_parser);


$output = preg_replace("/<\?13r2a\s+theFeed\s*\?>/", $items, $output);
$output = preg_replace("/<\?13r2a\s+numItems\s*\?>/", $count, $output);
$output = preg_replace("/<\?13r2a\s+xmlFile\s*\?>/", $url, $output);
$output = preg_replace("/<\?13r2a\s+mainTemplate\s*\?>/", $maintemplate, $output);
$output = preg_replace("/<\?13r2a\s+itemTemplate\s*\?>/", $itemtemplate, $output);
$output = preg_replace("/<\?13r2a\s+pageURL\s*\?>/", "http://" . $HTTP_HOST . $PHP_SELF, $output);

if($iurl=="") {
	$output = preg_replace("/<\?13r2a\s+imageTitle\s*\?>/", htmlspecialchars(trim($defaultImageTitle)), $output);
	$output = preg_replace("/<\?13r2a\s+imageLink\s*\?>/", trim($defaultImageLink), $output);
	$output = preg_replace("/<\?13r2a\s+imageURL\s*\?>/", trim($defaultImageURL), $output);
	$output = preg_replace("/<\?13r2a\s+imageDescription\s*\?>/", " ", $output);
}

echo $output;

?>
