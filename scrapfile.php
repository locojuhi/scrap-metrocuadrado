<?php

$lines = $_FILES['scrapfile']["name"];
$myfile = fopen($lines, "r") or die("Unable to open file!");
echo fread($myfile,filesize("webdictionary.txt"));
fclose($myfile);
/*foreach ($lines as $line){
    echo $line;
}*/
    

