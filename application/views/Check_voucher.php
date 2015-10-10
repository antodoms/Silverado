<?php
	function ServerCheckCode($var1)
	{
		$sect1 = (($var1[0] * $var1[1] + $var1[2]) * $var1[3] + $var1[4]) % 26;     //works
		$sect2 = (($var1[5] * $var1[6] + $var1[7]) * $var1[8] + $var1[9]) % 26;     //works
		if ($sect1 == (ord($var1[10]) - 65) && $sect2 == (ord($var1[11]) - 65))
		{
			echo "pass";
			return true;
		}
		else
		{
			echo "fail";
			return false;
		}
	}

	if(isset($_GET['code'])) {
		$code = $_GET['code'];


		$sect1 = (($code[0] * $code[1] + $code[2]) * $code[3] + $code[4]) % 26;     //works
		$sect2 = (($code[5] * $code[6] + $code[7]) * $code[8] + $code[9]) % 26;     //works
		if ($sect1 == (ord($code[10]) - 65) && $sect2 == (ord($code[11]) - 65))
		{
			echo "pass";
			return true;
		}
		else
		{
			echo "fail";
			return false;
		}
	}

	echo "HELLO WORLD";
	print "HELLO WORLD2";
?>
