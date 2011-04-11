<?php

	$text = $_REQUEST['Body'];
	
	if('128.6.168.245'==$_SERVER['REMOTE_ADDR']) $text = '1+2';
	
	
	$text = urlencode($text);
//	echo $text;
	
	$appid = 'PK89LV-86XH66GHRG';
	
	$wolfram = 'http://api.wolframalpha.com/v2/query?input='.$text.'&appid='.$appid.'&format=plaintext';
	$wolfram = simplexml_load_file(rawurlencode((string)$wolfram));
//	print_r($wolfram);
	
	$text = False;

 	$i = 0;
	for($i; $i < sizeof($wolfram); $i++){
		if ($wolfram->pod[$i]->attributes()->primary) {
			$text = $wolfram->pod[$i]->subpod->plaintext;
//			echo $text;
			break;
		}
	}
	
	if(!$text) $text = $wolfram->pod[0]->subpod->plaintext;
	
//	echo $text;
	
    header("content-type: text/xml");
    echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
?>
<Response>
    <Sms><?php echo $text ?></Sms>
</Response>