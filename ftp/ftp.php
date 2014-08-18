<?php
/********************************************
 * MODULE:FTP类
 *******************************************/
class ftp
{
	public $off;                          // 返回操作状态(成功/失败)
	public $conn_id;                      // FTP连接

	/**
	 * 方法：FTP连接
	 * @FTP_HOST -- FTP主机
	 * @FTP_PORT -- 端口
	 * @FTP_USER -- 用户名
	 * @FTP_PASS -- 密码
	 */
	function __construct($FTP_HOST,$FTP_PORT,$FTP_USER,$FTP_PASS)
	{
		$this->conn_id = @ftp_connect($FTP_HOST,$FTP_PORT) or die("FTP服务器连接失败");
		@ftp_login($this->conn_id,$FTP_USER,$FTP_PASS) or die("FTP服务器登陆失败");
		@ftp_pasv($this->conn_id,1); // 打开被动模拟
	}

	/**
	 * 方法：上传文件
	 * @path    -- 本地路径
	 * @newpath -- 上传路径
	 * @type    -- 若目标目录不存在则新建
	 */
	function up_file($path,$newpath,$type=true)
	{
		if($type) $this->dir_mkdirs($newpath);
		$this->off = @ftp_put($this->conn_id,$newpath,$path,FTP_BINARY);
		if(!$this->off) echo "文件上传失败,请检查权限及路径是否正确！";
	}

	/**
	 * 方法：移动文件
	 * @path    -- 原路径
	 * @newpath -- 新路径
	 * @type    -- 若目标目录不存在则新建
	 */
	function move_file($path,$newpath,$type=true)
	{
		if($type) $this->dir_mkdirs($newpath);
		$this->off = @ftp_rename($this->conn_id,$path,$newpath);
		if(!$this->off) echo "文件移动失败,请检查权限及原路径是否正确！";
	}

	/**
	 * 方法：复制文件
	 * 说明：由于FTP无复制命令,本方法变通操作为：下载后再上传到新的路径
	 * @path    -- 原路径
	 * @newpath -- 新路径
	 * @type    -- 若目标目录不存在则新建
	 */
	function copy_file($path,$newpath,$type=true)
	{
		$downpath = "c:/tmp.dat";
		$this->off = @ftp_get($this->conn_id,$downpath,$path,FTP_BINARY);// 下载
		if(!$this->off) echo "文件复制失败,请检查权限及原路径是否正确！";
		$this->up_file($downpath,$newpath,$type);
	}

	/**
	 * 方法：删除文件
	 * @path -- 路径
	 */
	function del_file($path)
	{
		$this->off = @ftp_delete($this->conn_id,$path);
		if(!$this->off) echo "文件删除失败,请检查权限及路径是否正确！";
	}

	/**
	 * 方法：生成目录
	 * @path -- 路径
	 */
	function dir_mkdirs($path)
	{
		$path_arr  = explode('/',$path);              // 取目录数组
		$file_name = array_pop($path_arr);            // 弹出文件名
		$path_div  = count($path_arr);                // 取层数

		foreach($path_arr as $val)                    // 创建目录
		{
			if(@ftp_chdir($this->conn_id,$val) == FALSE)
			{
				$tmp = @ftp_mkdir($this->conn_id,$val);
				if($tmp == FALSE)
				{
					echo "目录创建失败,请检查权限及路径是否正确！";
					exit;
				}
				@ftp_chdir($this->conn_id,$val);
			}
		}

		for($i=1;$i<=$path_div;$i++)                  // 回退到根
		{
			@ftp_cdup($this->conn_id);
		}
	}

	/**
	 * 方法：关闭FTP连接
	 */
	function close()
	{
		@ftp_close($this->conn_id);
	}
}

// create directory through FTP connection
function FtpMkdir($path, $newDir) {

	$server='ftp.yourserver.com'; // ftp server
	$connection = ftp_connect($server); // connection


	// login to ftp server
	$user = "me";
	$pass = "password";
	$result = ftp_login($connection, $user, $pass);

	// check if connection was made
	if ((!$connection) || (!$result)) {
		return false;
		exit();
	} else {
		ftp_chdir($connection, $path); // go to destination dir
		if(ftp_mkdir($connection,$newDir)) { // create directory
			return $newDir;
		} else {
			return false;       
		}
		ftp_close($conn_id); // close connection
	}

}

// class class_ftp end

/************************************** 测试 ***********************************
  $ftp = new ftp('222.13.67.42',21,'hlj','123456');          // 打开FTP连接
  $ftp->up_file('aa.wav','test/13548957217/bb.wav');         // 上传文件
//$ftp->move_file('aaa/aaa.php','aaa.php');                // 移动文件
//$ftp->copy_file('aaa.php','aaa/aaa.php');                // 复制文件
//$ftp->del_file('aaa.php');                               // 删除文件
$ftp->close();                                             // 关闭FTP连接
//******************************************************************************/
