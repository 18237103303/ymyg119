<?php
header('Content-type:text/html;charset=utf-8');
/*对图片上传进行处理*/	
$info=$_FILES['download'];		
//错误处理  0——没有错误发生，文件上传成功。  1——上传的文件超过了 php.ini 中 upload_max_filesize 选项限制的值。 2——上传文件的大小超过了 HTML 表单中 MAX_FILE_SIZE 选项指定的值。  3——文件只有部分被上传。  4——没有文件被上传。 
$error='';
if($info['error']==4){$error='没有文件上传';}//有文件上传 
if($info['error']==3){$error='文件没有全部上传';}//全部上传了 
if($info['error']==1){$error='文件上传超出服务器大小';}//不超过服务器端文件大小限制 
if($info['error']==2){$error='文件上传超出客户端大小';}//不超过客户端文件大小限制 
if($info['size']<=0){$error='经核查上传的文件不是有效文件';}//确实是文件 
/* 图片上传路径修改 */						 
 //生成文件名字
$fname=time().rand(100,999);
$shij=date('y-m-d');
$dir=is_dir('./001/'.$shij);
$dirjd='./001/'.$shij;
$path=str_replace('/','\\',$dirjd);
if(!$dir){$mkdir=mkdir($path,777,true);if(!$mkdir){$error='文件创建失败 请检查权限';}}
$tmpname=move_uploaded_file($info['tmp_name'],$path.'/'.$fname.'.jpg');
if($tmpname==false){$error='文件写入失败';}
//图片大小设置
$maxSize  = 2*1024*1024; //上传的文件大小限制 (0-不做限制)

if($maxSize<$info['size']){$error='文件过大请重新选择';}
if($error){
	echo $error;exit;	
}else{
	$res=array();
	$res['name']=$info['name'];
	$res['dir']=$savepath='/001/'.$shij.'/'.$fname.'.jpg';
    $savename=$info['name'];
/*    $id=session('Q_USER');
    $db = mysql_connect('localhost', 'root', 'root');
    mysql_select_db('lx_pm', $db);
    $query = "INSERT INTO lx_file (,savename, savepath)VALUES ('$savename', '$savepath')";
    mysql_query($query, $db);
    mysql_close($db);
    var_dump($info);*/
    echo json_encode($res);
}






//上传的图片是否存在   判断是用户是否有过上传 后台有用户上传的删除记录