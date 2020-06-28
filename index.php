<?php

$target_url='https://www.shutterstock.com/';

//curl session initialization

$handler=curl_init();
curl_setopt($handler,CURLOPT_URL,$target_url);

curl_setopt($handler,CURLOPT_RETURNTRANSFER,true);

//execute data

$source_code=curl_exec($handler);//return source code of targeted url
//close curl session

//now here we will be use pregmatch fun for refine mandatory data

$pattern='/<img[^>]+/';
$matches='';//using this variable we will store refined data

preg_match_all($pattern,$source_code,$matches);
/*echo '<pre>';
if (sizeof($matches)>1) {
	echo "nopeees";
}
else
{
print_r($matches);
}

if (!is_dir('downloads')) {
	
	mkdir('downloads');
}

//here we will  be create  a file (if file  not exist )  where we use write  mode 

	$file=fopen('downloads/scrapped.txt','w');
	foreach ($matches[0] as  $img) {
		if(fwrite($file,$img)===false){
			echo "string";
		}
	}*/
	$pattern='/src="([^"]+)/';
	$sr=file_get_contents('downloads/scrapped.txt');
	preg_match_all($pattern,$sr, $matches);
	echo '<pre>';
if (!is_dir('images')) {
	mkdir('images',0777);
}
	foreach ($matches[1] as $img_url) {

		$handler=curl_init();
		curl_setopt($handler,CURLOPT_URL,$img_url);
		curl_setopt($handler,CURLOPT_RETURNTRANSFER,true);
		$img=curl_exec($handler);

		$img_name=explode("/",$img_url);
		$img_name=end($img_name);
	file_put_contents($img_name,$img);
	}
//	print_r($matches);
//fclose($file);

?>