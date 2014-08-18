<?php
	require_once('ftp.php');
	$ftp = new ftp('112.124.182.184',21,'hxw0070568','123qwe');          // 打开FTP连接
	$ftp->up_file('ftp.php','test/13548957217/bb.wav');         // 上传文件
	echo 'zliu';
?>
