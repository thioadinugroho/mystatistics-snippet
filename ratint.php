<?php
function ratint($xa=array(),$ya=array(),$x=0) {
	$n = count($xa);
	$nmax = 10;
	$tiny = 1E-25;
	$c = array();
	$d = array();

	$ns = 1;
	$hh = abs($x-$xa(0));

	for($i=0,$i<$n;$i++) {
		$h = abs($x-$xa[$i]);
		if($h == 0) {
			$y = $ya($i);
			$dy = 0;
			return array('Y' => $y, 'Dy' => $dy);
		} else if($h < $hh) {
			$ns = $i;
			$hh = $h;
		}
		$c[$i] = $ya[$i];
		$d[$i] = $ya[$i]+$tiny;
	}

	$y = $ya[$ns];

	for($m=0;$m<$n;$m++) {
		for($i=0;$i<$n-$m;$i++) {
			$w = $c[$i+1] - $d[$i];
			$h = $xa[$i+$m] - $x;
			$t = ($xa[$i] - $x)*$d[$i]/$h;
			$dd = $t - $c[$i+1];
			$d[$i] = $c[$i+1]*$dd;
			$c[$i] = $t*$dd;
		}
		if(2*$ns < $n-$m) $dy = $c[$ns + 1];
		else {
			$dy = $d[$ns];
			$ns -= 1;
		}
		$y += $dt;
	}
	return array('Y' => $y, 'Dy' => $dy);
}
?>