
<?php		
						
	$filename = $_FILES["file"]["tmp_name"];
	$handle = fopen($filename, "r"); 
	$contents = fread($handle, filesize($filename)); //do tuka
	echo $contents;
	
	$line= $contents;
	echo "<br>";
	if(mb_detect_encoding($line, "UTF-8") == TRUE){
		$flag = 1;
	}
	echo "<b>Detect UTF-8: </b>" . $flag;
	echo "<br>";
	
	//words
	$str = explode(" ", $line);
	echo "<b>Broj na zborovi:</b> " . count($str);
	echo "<br>";
	
	//numbers
	$counter1 = 0;
	foreach($str as $el){
		if(is_numeric($el))
			$counter1 ++;
	}
	echo "<b>Broj na broevi:</b> " . $counter1 . "\n";
	echo "<br>";
	
	//reading time
	$contents = preg_replace("#[[:punct:]]#", "", $contents);
	$str_bez_interp = explode(" ", $contents);
	echo "<b>Reading time</b>: ";
	if(count($str_bez_interp)<275){
		echo "Less than a minute";	
	}
	else if(count($str_bez_interp)==275){
		echo "For a minute";
	}
		else{
	$temp = count($str_bez_interp)/275;
		echo "Approximately " . round($temp, 1) . " min";
	}
	echo "<br>";	
	
	//speaking time
	$contents = preg_replace("#[[:punct:]]#", "", $contents);
	$str_bez_interp = explode(" ", $contents);
	echo "<b>Speaking time</b>: ";
	if(count($str_bez_interp)<180){
		echo "Less than a minute";	
	}
	else if(count($str_bez_interp)==180){
		echo "For a minute";	
	}
	else{
		$temp = count($str_bez_interp)/180;
		echo "Approximately " . round($temp, 1) . " min";
	}
	echo "<br>";
	
	//sentences
	$remove_new_line = preg_replace('/[\ \n]+/', ' ', $contents);
	function countSentences($str){
		return preg_match_all('/[^\s](\.|\!|\?)(?!\w)/', $str, $match);
	}								
	$res = countSentences($remove_new_line);
	echo "<b>Sentences: </b>" . $res; 
	echo "<br>";
	
	//short words
	$counter1 = 0;
	foreach($str as $s){
		if(ceil(strlen($s)/2)>=1 && ceil(strlen($s)/2)<=3)
			$counter1 += 1;
	}
	
	echo "<b>Short words: </b>" . $counter1;
	echo "<br>";
	
	//long words
	$counter2 = 0;
	foreach($str as $s){
		if(ceil(strlen($s)/2)>=7)
			$counter2 += 1;
	}
	
	echo "<b>Long words: </b>" . $counter2;
	echo "<br>";
	
	//whitespaces
	$count_whitespaces = substr_count($contents, " ");
	$count_newline = substr_count($contents, "\n");
	$whitespaces = $count_whitespaces + $count_newline;
	$whitespaces = $whitespaces - 1;
	echo "<b>Whitespaces:</b>" . $whitespaces;
	echo "<br>";
	
	//chars(with spaces)
	$brisi_nov_red = str_replace("\n", "", $contents);
	$no_spaces = ceil(strlen($brisi_nov_red)/2) - $whitespaces;
	$pom = $no_spaces + $whitespaces;
	echo "<b>Characters with spaces: </b>" . $pom;
	echo "<br>";
	
	//chars(without spaces)
	$brisi_nov_red = str_replace("\n", "", $contents);
	$no_spaces = ceil(strlen($brisi_nov_red)/2) - $whitespaces;
	echo "<b>Characters without spaces: </b>" . $no_spaces;
	echo "<br>";
	
	//longest sentence
	$niza = array();
	$sum = 0;
	foreach($str as $s){
		if(preg_match('/[.!?;]/u', $s)){
			$niza[] = $sum;
			$sum = 0;
		}
		else{
			$sum += floor(strlen($s)/2);
		}
	}
	
	echo "<b>Longest sentence: </b>" . max($niza);
	echo "<br>";
	
	//shortest sentence
	$niza = array();
	$sum = 0;
	foreach($str as $s){
		if(preg_match('/[.!?;]/u', $s)){
			$niza[] = $sum;
			$sum = 0;
		}
		else{
			$sum += floor(strlen($s)/2);
		}
	}
	
	echo "<b>Shortest sentence: </b>" . min($niza);
	echo "<br>";
	
	//average words length
	$sum = 0;
	foreach($str as $s){
		$sum += floor(strlen($s)/2);
	}
	$pom1 = $sum/count($str);
	echo "<b>Average words length: </b>" . number_format((float)$pom1, 2, '.', '');
	
?>