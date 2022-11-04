<?php
// public function FunctionName($value='')
// {
// 	# code...
// }

function sampleFunction($param) {
	$_SESSION['url'] = $param;
	
	echo $_SESSION['url'];
}

?>