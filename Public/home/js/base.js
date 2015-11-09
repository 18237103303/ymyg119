// JavaScript Document

/******/
 $(function(){
	var n=0;
	$(".kefu .right").width(0);

	$(".kefu .left").click(function(){
		if(n==0){
			$(".kefu").animate({width:"187px"},500);
			$(".kefu .right").animate({width:"152px"},500);
			n=1;
		}else{
			$(".kefu .right").animate({width:"0px"},500);
			$(".kefu").animate({width:"35px"},500);
			n=0;	
		}
	})
})


$(function(){
	$("ul li .top").click(function(){
		$(this).siblings(".hidetext").slideToggle(1000);
		$(this).children().find(".img2").toggle();
		$(this).children().find(".img1").toggle();
		})
	})

$(function(){
	$(".fxbox .fx .box").hover(function(){
		$(this).children(".btna").addClass("current");
		$(this).children(".hidebox").show();
		},
		function(){
		$(this).children(".btna").removeClass("current");
		$(this).children(".hidebox").hide();
		})
})


$(function(){ 
$('.fxbox .fx .box a.topa').click(function(){
$('html,body').animate({scrollTop: '0px'}, 800);}); 
});


$(function(){
	$(".mei .money .liang .jia").click(function(){
	var n=$(this).siblings(".num").val();
	n++;
	$(this).siblings(".num").val(n);
	})
	$(".mei .money .liang .jian").click(function(){
	var n=$(this).siblings(".num").val();
	if(n<2){
		n==1;
		}else{
			n--;
			$(this).siblings(".num").val(n);
		}
	})
})

$(function(){ 
$('.fxbox .fx .box .hidebox .cun .cpbox .mei span.close').click(function(){
	$(this).parents(".fxbox .fx .box .hidebox .cun .cpbox .mei").hide(); 
});
$('.fxbox .fx .box .hidebox .cun b.close').click(function(){
	$(this).parents(".fxbox .fx .box .hidebox .cun").hide(); 
});
});













































