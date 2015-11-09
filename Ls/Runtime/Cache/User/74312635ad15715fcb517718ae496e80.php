<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta name="description" content="Xenon Boostrap Admin Panel" />
	<meta name="author" content="" />
	<title>登陆</title>
	<link rel="stylesheet" href="/Public/admin/assets/css/wail.css">
	<link rel="stylesheet" href="/Public/admin/assets/css/fonts/linecons/css/linecons.css">
	<link rel="stylesheet" href="/Public/admin/assets/css/fonts/fontawesome/css/font-awesome.min.css">
	<link rel="stylesheet" href="/Public/admin/assets/css/bootstrap.css">
	<link rel="stylesheet" href="/Public/admin/assets/css/xenon-core.css">
	<link rel="stylesheet" href="/Public/admin/assets/css/xenon-forms.css">
	<link rel="stylesheet" href="/Public/admin/assets/css/xenon-components.css">
	<link rel="stylesheet" href="/Public/admin/assets/css/xenon-skins.css">
	<link rel="stylesheet" href="/Public/admin/assets/css/custom.css">
	<script src="/Public/admin/assets/js/jquery-1.11.1.min.js"></script>

	<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!--[if lt IE 9]>
		<script src="assets/js/html5shiv.min.js"></script>
		<script src="assets/js/respond.min.js"></script>
	<![endif]-->
<style>
.tixing{border:1px solid red;margin-bottom:0px;}
</style>
	
</head>
<body class="page-body login-page login-light">
	<div class="login-container">
		<div class="row">
			<div class="col-sm-6">
				<script type="text/javascript">
					jQuery(document).ready(function($)
					{
						setTimeout(function(){ $(".fade-in-effect").addClass('in'); }, 1);
					});
					$(function(){
					var as2= $("form").find('#yzm').val('');
					$("div[name=tj]").click(function(){
					var as= $("form").find('#username').val();
				 	var as1= $("form").find('#passwd').val();
				 	var as2= $("form").find('#yzm').val();
					if(!as){$('#username').attr('placeholder','不能为空');
					$('#username').addClass('tixing');
					$(".reloadverify").click();
					}
					if(!as1){$('#passwd').attr('placeholder','不能为空');
					$('#passwd').addClass('tixing');
					$(".reloadverify").click();
					}
					if(!as2){$('#yzm').attr('placeholder','不能为空');
					$('#yzm').addClass('tixing');
					}
					if(as&&as1&&as2){					
					$.post("<?php echo U('Index/verify');?>",{
					code:as2,
					},function(data){
					if(data==1){$("form").submit();}else{
						$('#yzts').show();
                        $('.verifyimg').trigger('click');
					}
					})
					}									
					})
//					$('#username').keyup(function(){
//                                            $('span').css('display','none');
//                                            $('.info-links  p').hide();
//					var a= $(this).val().replace(/\W/g,'');
//					$('#username').val(a);
//					$('#username').removeClass('tixing');
//					})
					$('#passwd').keyup(function(){
                                            $('span').css('display','none');
                                            $('.info-links  p').hide();
					var a= $(this).val().replace(/\W/g,'');
                        $('#passwd').val(a);
					$('#passwd').removeClass('tixing');
					})
				
				$('#yzm').keyup(function(){
                                    $('span').css('display','none');
                                    $('.info-links p').hide();
					var a= $(this).val().replace(/\W/g,'');
					$('#yzm').val(a);
					$('#yzm').removeClass('tixing');
					})
		 	var verifyimg = $(".verifyimg").attr("src");
            $(".reloadverify").click(function(){
                if( verifyimg.indexOf('?')>0){
                    $(".verifyimg").attr("src", verifyimg+'&random='+Math.random());
                }else{
                    $(".verifyimg").attr("src", verifyimg.replace(/\?.*$/,'')+'?'+Math.random());
                }
            });
					})
				</script>
				
				<!-- Errors container -->
				<div class="errors-container">
				</div>
				<!-- Add class "fade-in-effect" for login form effect -->
				<form method="post" role="form" action="<?php echo U('Index/index');?>" id="login" class="login-form fade-in-effect">
					<div class="login-header" style="margin-bottom: 3%;">
						<a href="##" class="logo">
							<img style="width: 40%;" src="/Public/admin/assets/images/index_12.png" alt="优煤易购" width="80" />
						</a>
					</div>
					<div class="form-group">
						<label class="control-label" for="username"></label>
						<input type="text"  class="form-control " name="username" id="username" placeholder="username" autocomplete="off" />
					</div>
					
					<div class="form-group">
						<label class="control-label " for="passwd"></label>
						<input type="password" class="form-control" name="passwd" id="passwd"  placeholder="password" autocomplete="off" />
					</div>
					
					 <label class="control-label">				
						<input  type="text" class="form-contro2" name="yzm" id="yzm" style="width:35%;height:35px;margin-bottom:10px;"  placeholder="验证码" />
					
					<img  class="verifyimg reloadverify" alt="点击切换" src="<?php echo U('verify');?>" style="cursor:pointer;width:35%;height:40px;margin-left:10%;">
					</label>
					
					
					<div class="form-group">
						<div type="submit" name="tj" class="btn btn-primary  btn-block text-left">
							<i class="fa-lock"></i>
							登陆
						</div>
					</div>
					
					<div class="login-footer">
					
						
						<div class="info-links">
				<?php if($pand == 1231): ?><span  style="color:red;">权限不足</span><?php endif; ?>
				<?php if($pand == 123): ?><span  style="color:red;">用户不存在</span><?php endif; ?>
				<?php if($pand == 1230): ?><span  style="color:red;">用户密码不对</span><?php endif; ?>
                            <?php if($jg): ?><span  style="color:red;"><?php echo ($jg); ?></span><?php endif; ?>
				<p id="yzts" style="color:red;display:none;">验证码不正确</p>
							<!-- -<a href="#">Privacy Policy</a> -->
						</div>
					<a href="###">请妥善 保管您的密码</a>
					</div>
					
				</form>
				
				<!-- External login -->
				<div class="external-login">
					<a href="###" class="facebook">
						<i class="fa-facebook"></i>
						密码丢失 请联系您的上级进行找回
					</a>
					
					<!-- 
					<a href="#" class="twitter">
						<i class="fa-twitter"></i>
						Login with Twitter
					</a>
					
					<a href="#" class="gplus">
						<i class="fa-google-plus"></i>
						Login with Google Plus
					</a>
					 -->
				</div>
				
			</div>
			
		</div>
		
	</div>



	<!-- Bottom Scripts -->
	<script src="/Public/admin/assets/js/bootstrap.min.js"></script>
	<script src="/Public/admin/assets/js/TweenMax.min.js"></script>
	<script src="/Public/admin/assets/js/resizeable.js"></script>
	<script src="/Public/admin/assets/js/joinable.js"></script>
	<script src="/Public/admin/assets/js/xenon-api.js"></script>
	<script src="/Public/admin/assets/js/xenon-toggles.js"></script>
	<!-- <script src="/Public/admin/assets/js/jquery-validate/jquery.validate.min.js"></script> -->
	<script src="/Public/admin/assets/js/toastr/toastr.min.js"></script>


	<!-- JavaScripts initializations and stuff -->
	<script src="/Public/admin/assets/js/xenon-custom.js"></script>

</body>
</html>