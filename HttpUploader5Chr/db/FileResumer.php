<?php
/*
	文件续传对象。负责将文件块写到服务器指定目录中
	使用方法：
		$resumer = new FileResumer();
		$resumer->Resumer();
		
	更新记录：
		2012-03-30 创建
		2014-03-21 取消创建临时文件的操作，减少一次系统IO，直接读取临时文件。
		2014-04-09 
			修复Resumer方法中调用unlink($tmpPath);警告。
			新增CreateFile方法。
			增加文件块验证功能。
*/
class FileResumer
{
	var $m_FilePath;	//文件路径
	var $m_FileTemp;	//临时文件名称
	var $m_NameRemote;	//远程文件名称
	var $m_FileSize;	//文件大小
	var $m_FileMD5;		//文件MD5
	var $m_RangePos;	//文件起始位置
	var $m_RangeSize;	//文件块大小
	var $m_rangMD5;		//文件块的MD5值，用来做校验。
	
	function __construct($fpath="",$fsize="0",$md5="",$rangPos="0") 
	{
		//如果取值为空，请检查php.ini文件中upload_tmp_dir 配置是否为空。设置临时文件夹后必须要设置Everyone读写权限
		$this->m_FileTemp	= $fpath;//临时文件完整路径
		$this->m_FileSize	= intval($fsize);
		$this->m_FileMD5	= $md5;
		$this->m_RangePos	= intval($rangPos);
		$this->m_RangeSize	= filesize($this->m_FileTemp);//获取临时文件大小
	}
	
/*	function __construct($fsize,$md5,$rangPos) 
	{
		//如果取值为空，请检查php.ini文件中upload_tmp_dir 配置是否为空。设置临时文件夹后必须要设置Everyone读写权限
		$this->m_FileSize	= intval($fsize);
		$this->m_FileMD5	= $md5;
		$this->m_RangePos	= intval($rangPos);
	}*/
	
	//获取临时文件大小
	function GetRangeSize()
	{
		return $this->m_RangeSize;
	}
	
	/*
		获取临时文件路径
		参数：
			$fileInf
				FilePath d:\soft\md5.ext
				FileName md5.ext
		返回值：
			根据远程文件信息拼接的临时文件完整路径。
	*/
	function GetTempPath(&$fileInf)
	{
		$path = dirname($fileInf["FilePathRemote"])."\\";
		$path = $path.$fileInf["FileName"]."tmp";
		return $path;
	}

	//创建文件
	function CreateFile($path,$size)
	{
		$hfile = fopen($path,"wb");
		ftruncate($hfile,$size);
		fclose($hfile);
	}
	
	/*
		续传文件块
		逻辑：
			1.根据文件MD5获取服务器文件完整地址。
			2.将文件块写入服务器文件中
		参数：
			$md5 文件MD5。
	*/
	function Resumer()
	{
		$db = new HttpUploaderDB();
		$fileInf = $db->GetFileInfByMD5($this->m_FileMD5);

		//远程文件存在
		if( !is_null($fileInf) )
		{
			//$tmpPath = $this->GetTempPath($fileInf);
			//将临时文件移到远程文件文件夹
			//move_uploaded_file($this->m_FileTemp,$tmpPath);
			//将数据库中的UTF8编码转换成GB2312
			$fileInf["FilePathRemote"] = iconv("UTF-8", "GB2312", $fileInf["FilePathRemote"]);
					
			//远程文件不存在，创建
			if(!file_exists($fileInf["FilePathRemote"]))
			{
				$hfile = fopen($fileInf["FilePathRemote"],"wb");
				ftruncate($hfile,$this->m_FileSize);
				fclose($hfile);
			}
			
			//调试时打开下面的代码，计算文件块MD5，做文件校验用。
			//$this->m_rangMD5 = md5_file($this->m_FileTemp);
			//读取文件块数据
			$fHandle = fopen($this->m_FileTemp,"rb");
			$tempData = fread($fHandle,filesize($this->m_FileTemp));
			fclose($fHandle);
			
			//写入数据
			$hfile = fopen($fileInf["FilePathRemote"],"r+b");
			//定位到续传位置
			fseek($hfile, $this->m_RangePos,SEEK_SET);
			fwrite($hfile,$tempData);
			fclose($hfile);
			
			//删除临时文件
			//unlink($tmpPath);
		}
	}
	
	//定位超过2G的文件
	function fseek64(&$fh, $offset)
	{
		fseek($fh, 0, SEEK_SET);
	
		if ($offset <= PHP_INT_MAX)
		{
			return fseek($fh, $offset, SEEK_SET);
		}
	
		$t_offset   = PHP_INT_MAX;
		$offset     = $offset - $t_offset;
	
		while (fseek($fh, $t_offset, SEEK_CUR) === 0)
		{
			if ($offset > PHP_INT_MAX)
			{
				$t_offset   = PHP_INT_MAX;
				$offset     = $offset - $t_offset;
			}
			else if ($offset > 0)
			{
				$t_offset   = $offset;
				$offset     = 0;
			}
			else
			{
				return 0;
			}
		}
	
		return -1;
	}
}
?>