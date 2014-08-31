<style>

.block { display: inline;  width:50px; height:1px; font-size:8px}

</style>

<?php


//accepts (hsb 0 to 1 and returns rgb 0 to 1)
function hsb2rgb($h,$s,$v) {

	//black
	if($v==0) return array(0,0,0);

	//greyscale
	if($s==0) return array($v,$v,$v);


	//red domain; green ascends
	if ($h < 1/6) {
		$offset = $h;
		$r = $v;
		$b = $v * (1 - $s);
		$g = $b + ($v - $b) * $offset * 6;


	//yellow domain; red descends
	} else if ($h < 2/6) {
		$offset = $h - 1/6;
		$g = $v;
		$b = $v * (1 - $s);
		$r = $g - ($v - $b) * $offset * 6;


	//green domain; blue ascends
	} else if($h < 3/6) {
		$offset = $h - 2/6;
		$g = $v;
		$r = $v * (1 - $s);
		$b = $r + ($v - $r) * $offset * 6;


	//cyan domain; green descends
	} else if($h < 4/6) {
		$offset = $h - 3/6;
		$b = $v;
		$r = $v * (1 - $s);
		$g = $b - ($v - $r) * $offset * 6;


	//blue domain; red ascends
	} else if($h < 5.0/6) {
		$offset = $h - 4/6;
		$b = $v;
		$g = $v * (1 - $s);
		$r = $g + ($v - $g) * $offset * 6;


	//magenta domain; blue descends
	} else {
		$offset = $h - 5/6;
		$r = $v;
		$g = $v * (1 - $s);
		$b = $r - ($v - $g) * $offset * 6;
	}

	if($r<0)$r=0;
	if($g<0)$g=0;
	if($b<0)$b=0;

	return array(round(255*$r),round(255*$g),round(255*$b));
}

function rgb2hex($rgb){
	if(!is_array($rgb) || count($rgb) != 3){
		echo "Argument must be an array with 3 integer elements";
		return false;
	}
	for($i=0;$i<count($rgb);$i++){
		if(strlen($hex[$i] = dechex($rgb[$i])) == 1){
		   $hex[$i] = "0".$hex[$i];
		}
	}
	return $hex;
}



$s = 0.55;
for($h=0;$h<=1;$h+=0.005) {
	$c1 = hsb2rgb($h,$s*3,0.3);
	$c2 = hsb2rgb($h,$s*3,0.5);
	$c3 = hsb2rgb($h,$s*2,0.7);
	$c4 = hsb2rgb($h,$s,0.95);
	$c5 = hsb2rgb($h,2*$s/3,0.85);
	$c6 = hsb2rgb($h,2*$s/3,0.95);
	$c7 = hsb2rgb($h,$s/2,0.9);
	$c8 = hsb2rgb($h,$s/4,0.9);
	$c9 = hsb2rgb($h,$s/10,0.99);


	for($i=1;$i<=9;$i++) {
		$var = "c$i";
		$c = $$var;

		$c = rgb2hex($c);

		$r = $c[0];
		$g = $c[1];
		$b = $c[2];

		echo "<div class=\"block\" style=\"background-color:#$r$g$b;\">#$r$g$b</div>";

	}


	echo "<br>\n";
}

?>