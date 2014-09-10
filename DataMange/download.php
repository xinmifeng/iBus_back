<?php
if(empty($_GET['img'])) {
	header("HTTP/1.0 404 Not Found");
	return;
}

$basename=$_GET['img'];
$filename = './'.$basename;

//$mime = ($mime = getimagesize($filename)) ? $mime['mime'] : $mime;

$size = filesize($filename);

$fp   = fopen($filename, "rb");
if (!($size && $fp)) {
	// Error.
	return;
}

header("Content-type: " . "text/plain");
header("Content-Length: " . $size);
// NOTE: Possible header injection via $basename
header("Content-Disposition: attachment; filename=" . $basename);
header('Content-Transfer-Encoding: binary');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
fpassthru($fp);

?>
