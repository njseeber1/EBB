<FONT FACE="Arial, Verdana, Helvetiva">
<B>
PHP Form-Result:
</B>
<P>
<?

	if ($HTTP_GET_VARS) {

		$a = $HTTP_GET_VARS["eingabe"];
		$b = $HTTP_GET_VARS["artist"];
		$c = $HTTP_GET_VARS["zahlmethode"];
		$d = $HTTP_GET_VARS["zutat"];
		$e = $HTTP_GET_VARS["blabla"];
		$f = $HTTP_GET_VARS["widget"];
		
	}

	if ($HTTP_POST_VARS) {

		$a = $HTTP_POST_VARS["eingabe"];
		$b = $HTTP_POST_VARS["artist"];
		$c = $HTTP_POST_VARS["zahlmethode"];
		$d = $HTTP_POST_VARS["zutat"];
		$e = $HTTP_POST_VARS["blabla"];
		$f = $HTTP_POST_VARS["widget"];
	}


	if ($HTTP_POST_VARS or $HTTP_GET_VARS) {

		echo $a;
		echo "<P>";
		
		if (count($b)) 
		{
		  for ($i=0;$i<count($b);print($b[$i++]." "));
		}
		echo "<P>";
		
		echo $c;
		echo "<P>";
		
		if (count($d)) 
		{
		  for ($i=0;$i<count($d);print($d[$i++]." "));
		}
		echo "<P>";
		
		echo $e;
		echo "<P>";
		
		echo $f;

	}
?>

<P>
<B>
	<A HREF=test.html TARGET=xx>Testlink</A>
</B>

