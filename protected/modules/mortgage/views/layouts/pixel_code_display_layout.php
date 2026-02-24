<?php /* @var $this Controller */ ?>
<!DOCTYPE html>
<html>
<head>
<title>elitemortgagefinder.com : Pixel Fire</title>
<?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>
<script>
	$(function() {
		$(".meter > span").each(function() {
			$(this)
				.data("origWidth", $(this).width())
				.width(0)
				.animate({
					width: $(this).data("origWidth")
				}, 1200);
			});
	});
</script>

<style type="text/css">
body{
	padding:0;
	margin:0;
	font-size:14px;
	font-family:Arial, Helvetica, sans-serif;
}
.wrapper{
	width:1000px;
	margin:0 auto;
	padding:0 0 30px 0;
	display:table;
	border:solid 1px #cccccc;
	text-align:center;
}
.wrapper em{
	width:95%;
	margin:0 auto;
	padding:10px 0;
	background:#CCC;
	color:#173365;
	font-size:16px;
	display:table; 
	border-radius:5px;
	margin-top:30px
}
.wrapper h1{
	font-size:17px;
	color:#333;
	padding:50px 0;
	width:95%;
	margin:0 auto;
}
.pross{
	width:50%;
	margin:20px auto 50px;
	border:solid 1px #CCCCCC;
	border-radius:5px;
}
.pross span{
	height:28px;
	background:url(http://elitecashwire.com/images/processing-img.jpg) repeat-x top left;
	width:40%;
	padding:0;
	margin:0;
	border-radius:5px 0 0 5px;
	display:block;
}
.wrapper h2{
	font-size:25px;
	padding:15px 0;
	width:95%;
	margin:0 auto;
	color:#58c2dc;
}
.wrapper h2{
	font-size:20px;
	padding:15px 0;
	width:95%;
	margin:0 auto;
	color:#58c2dc;
}
.meter { 
	height: 20px;
	position: relative;
	width:50%;
	margin: 20px auto 50px;
	background: #fff;
	-moz-border-radius: 25px;
	-webkit-border-radius: 25px;
	border-radius: 25px;
	padding:0;
	border:1px solid #ccc;
	-webkit-box-shadow: inset 0 -1px 1px rgba(255,255,255,0.3);
	-moz-box-shadow   : inset 0 -1px 1px rgba(255,255,255,0.3);
	box-shadow        : inset 0 -1px 1px rgba(255,255,255,0.3);
}
.meter > span {
	display: block;
	height: 100%;
	border-top-right-radius: 8px;
	border-bottom-right-radius: 8px;
	border-top-left-radius: 20px;
	border-bottom-left-radius: 20px;
	background-color: rgb(43,194,83);
	background-image: -webkit-gradient(linear,left bottom,left top,color-stop(0, rgb(43,194,83)),color-stop(1, rgb(84,240,84)));
	background-image: -moz-linear-gradient(center bottom,rgb(43,194,83) 37%,rgb(84,240,84) 69%);
	box-shadow: inset 0 2px 9px  rgba(255,255,255,0.3),inset 0 -2px 6px rgba(0,0,0,0.4);
	position: relative;
	overflow: hidden;
	-webkit-border-top-right-radius: 8px;
	-webkit-border-bottom-right-radius: 8px;
	-moz-border-radius-topright: 8px;
	-moz-border-radius-bottomright: 8px;
	-webkit-border-top-left-radius: 20px;
	-webkit-border-bottom-left-radius: 20px;
	-moz-border-radius-topleft: 20px;
	-moz-border-radius-bottomleft: 20px;
	-webkit-box-shadow: inset 0 2px 9px  rgba(255,255,255,0.3),inset 0 -2px 6px rgba(0,0,0,0.4);
	-moz-box-shadow: inset 0 2px 9px  rgba(255,255,255,0.3),inset 0 -2px 6px rgba(0,0,0,0.4);
}
.meter > span:after, .animate > span > span {
	content: "";
	position: absolute;
	top: 0; left: 0; bottom: 0; right: 0;
	z-index: 1;
	background-size: 50px 50px;
	border-top-right-radius: 8px;
	border-bottom-right-radius: 8px;
	border-top-left-radius: 20px;
	border-bottom-left-radius: 20px;
	overflow: hidden;
	background-image:-webkit-gradient(linear, 0 0, 100% 100%,
		color-stop(.25, rgba(255, 255, 255, .2)),
		color-stop(.25, transparent), color-stop(.5, transparent), 
		color-stop(.5, rgba(255, 255, 255, .2)), 
		color-stop(.75, rgba(255, 255, 255, .2)), 
		color-stop(.75, transparent), to(transparent)
		);
	background-image: -moz-linear-gradient(
		-45deg, 
		rgba(255, 255, 255, .2) 25%, 
		transparent 25%, 
		transparent 50%, 
		rgba(255, 255, 255, .2) 50%, 
		rgba(255, 255, 255, .2) 75%, 
		transparent 75%, 
		transparent
		);
	-webkit-border-top-left-radius: 20px;
	-webkit-border-bottom-left-radius: 20px;
	-moz-border-radius-topleft: 20px;
	-moz-border-radius-bottomleft: 20px;
	-webkit-animation: move 2s linear infinite;
	-moz-animation: move 2s linear infinite;
	-webkit-border-top-right-radius: 8px;
	-webkit-border-bottom-right-radius: 8px;
	-moz-border-radius-topright: 8px;
	-moz-border-radius-bottomright: 8px;
	-webkit-background-size: 50px 50px;
	-moz-background-size: 50px 50px;
}
.animate > span:after {
	display: none;
}
@-webkit-keyframes move {
	0% {
		background-position: 0 0;
	}
	100% {
		background-position: 50px 50px;
	}
}
@-moz-keyframes move {
	0% {
		background-position: 0 0;
	}
	100% {
		background-position: 50px 50px;
	}
}
.red_api_navigation {
    background-color: #193e5b;
    color: #eee;
    font-size: 20px;
    font-weight: 200;
    padding: 10px 63px;
}
div.aff_body {
    font-size: 18px;
    font-weight: bold;
    min-height: 700px;
    padding: 10px;
    text-align: center;
    width: 940px;
}
</style>
</head>
<body>
<div class="container">
<div class="wrapper">
<em>Please Wait</em>
<h2>Processing</h2>
<div class="meter animate">
	<span style="width: 100%"><span></span></span>
</div>
<?php echo $content; ?>
<p>Do not refresh the page..</p>
</div>
</div>
</body>
</html>
