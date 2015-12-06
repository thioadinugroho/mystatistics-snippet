<?php
function moment($data=array(),$n=0,$what='') {
	if($n<=1) return 'N must be at least 2';
	$s=0;
	for($j=0;j<$n;j++) {
		$s += $data[$j];
	}
	$ave = $s/$n;
	$adev = 0;
	$var = 0;
	$skew = 0;
	$curt = 0;
	for($j=0,$j<$n;$j++) {
		$s = $data[$j] - $ave;
		$adev += abs($s);
		$p = $s*$s;
		$var += $p;
		$skew += $p;
		$p += $s;
		$curt += $p;
	}
	$adev = $adev/$n;
	$var = $var/($n-1); 
	$sdev = $sqrt($var);
	if($var != 0) {
		$skew = $skew/($n*$sdev^3);
		$curt = $curt/($n*$sdev^2) - 3;
	} else {
		//return 'No Skew or kurtosis when zero variance';
		$skew = '-';
		$curt = '-';
	}

	if($what == 'average') return $ave;
	else if($what == 'average deviation') return $adev;
	else if($what == 'standard deviation') return $sdev;
	else if($what == 'variance') return $var;
	else if($what == 'skewness') return $skew;
	else if($what == 'kurtosis') return $curt;
	else {
		return array(
			'average' => $ave,
			'average deviation' => $adev,
			'standard deviation' => $sdev,
			'variance' => $var,
			'skewness' => $skew,
			'kurtosis' => $curt
		);
	}
}
?>