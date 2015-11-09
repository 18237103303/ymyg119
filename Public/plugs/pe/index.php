<!doctype html>
<html>
<head>
<meta charset="utf-8">
<script src="http://libs.baidu.com/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript" src="./uploadify/jquery.uploadify.min.js"></script>	
<link href="./uploadify/uploadify.css" rel="stylesheet" type="text/css">
</head>
<body>
	<div class="upload-img-box" name="tpxr">           
        <input type="file" name="uploadify" id="uploadify" />
		<div id="tp"><div>
    </div>


				
					<script type="text/javascript">
								//上传图片
							    /* 初始化上传插件 */
								$("#uploadify").uploadify({
							        "height"          : 30,
								    "width"           : 120,
									//显示的高度和宽度，默认 height 30；width 120
							        "swf"             : "./uploadify/uploadify.swf",
									 //指定swf文件
							        "fileObjName"     : "download",
									//文件上传对象的名字 共后台处理使用
							        "buttonText"      : "上传附件",
									 //按钮显示的文字
							        "uploader"        : "./yz.php",
									 //后台处理的页面							       
							        'removeTimeout'	  : 1,	
									'fileTypeDesc'       : '请选择jpg,png格式文件',
									'fileTypeExts'       : '*.jpg;*.png;',									
									//上传完成后显示到显示设置个数的时间
							        "onUploadSuccess" : uploadFile1,
									//文件上传成功是触发
							        'onFallback' : function() {
							            alert('未检测到兼容版本的Flash.');
							        }
							    });
								
								function uploadFile1(file, data){								
								var obj = JSON.parse(data);	
								
									var dir=obj.dir;
									var name=obj.name;
							        if(dir!=null){
							        	$('#tp').html(
										'<img src="'+dir+'"/><p>"'+name+'"</p>'								
							        	);
							        } else{
										alert(data);
									}							        
							    }
								</script>
</body>
</html>							
								
								