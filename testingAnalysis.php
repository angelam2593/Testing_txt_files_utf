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
	$line = str_replace("\n", " ", $line);
	$str = explode(" ", $line);
	$counter1 = 0;
	foreach($str as $el){
		if(is_numeric($el))
			continue;
		else
			$counter1++;
	}
	echo "<b>Broj na zborovi:</b> " . $counter1;
	echo "<br>";
	
	//numbers
	$counter2 = 0;
	foreach($str as $el){
		if(is_numeric($el))
			$counter2 ++;
	}
	echo "<b>Broj na broevi:</b> " . $counter2 . "\n";
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
	$counter3 = 0;
	foreach($str as $s){
		if(preg_match('/[.!?;]/u', $s)){
			$counter3 += 1;
		}
	}
	echo "<b>Sentences: </b>" . $counter3; 
	echo "<br>";
	
	//short words
	$counter4 = 0;
	$str_i = preg_replace('#[[:punct:]]#', '', $str);
	foreach($str_i as $s){
		if(is_numeric($s))
			continue;
		if(ceil(strlen($s)/2)>=1 && ceil(strlen($s)/2)<=3)
		{
			$counter4 += 1;
			//echo $s . " ";
		}
	}
	
	echo "<b>Short words: </b>" . $counter4;
	echo "<br>";
	
	//long words
	$counter5 = 0;
	$str_i = preg_replace('#[[:punct:]]#', '', $str);
	foreach($str_i as $s){
		if(ceil(strlen($s)/2)>=7)
		{
			$counter5 += 1;
			//echo $s . " ";
		}
		
	}
	
	echo "<b>Long words: </b>" . $counter5;
	echo "<br>";
	
	//whitespaces
	$count_whitespaces = substr_count($contents, " ");
	$count_newline = substr_count($contents, "\n");
	$whitespaces = $count_whitespaces + $count_newline;
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
		if(preg_match('/[.!?]/u', $s)){
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
		if(preg_match('/[.!?]/u', $s)){
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
	$str_i = preg_replace('#[[:punct:]]#', '', $str);
	foreach($str_i as $s){
		$sum += floor(strlen($s)/2);
	}
	$pom1 = $sum/count($str_i);
	echo "<b>Average words length: </b>" . number_format((float)$pom1, 2, '.', '');
	
?>
