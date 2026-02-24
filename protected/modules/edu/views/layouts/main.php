<?php
$baseUrl = Yii::app()->theme->baseUrl;
$cs = Yii::app()->getClientScript();
/*$user_from_url = (strpos($_SERVER['REQUEST_URI'], 'lenders/login') || Yii::app()->user->getState('usertype')=='lender') ? 'Lender' : 'Affiliate';*/
if(strpos($_SERVER['REQUEST_URI'], 'feedlenders/login') || strpos($_SERVER['REQUEST_URI'], 'feedlenders/forgotPassword')){ $user_from_url = "List Manager"; }
else if(strpos($_SERVER['REQUEST_URI'], 'lenders/login') || strpos($_SERVER['REQUEST_URI'], 'lenders/forgotPassword')){ $user_from_url = "Buyer"; }
else if(strpos($_SERVER['REQUEST_URI'], 'affiliates/login') || strpos($_SERVER['REQUEST_URI'], 'affiliates/forgotPassword')){ $user_from_url = "Affiliate"; }
else if(Yii::app()->user->getState('usertype')=='affiliate'){ $user_from_url = "Affiliate"; }
else if(Yii::app()->user->getState('usertype')=='lender'){ $user_from_url = "Buyer"; }
else if(Yii::app()->user->getState('usertype')=='edulender'){ $user_from_url = "List Manager"; }
else { $user_from_url="Affiliate"; }
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Higher Learning Marketers <?php if(strpos($_SERVER['REQUEST_URI'], '/lenders/login') || strpos($_SERVER['REQUEST_URI'], '/lenders/forgotPassword') || Yii::app()->user->getState('usertype')=='lender') { echo "Lead "; } echo $user_from_url; ?> Portal</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Education Lead Managmeent System">
<meta name="author" content="EliteBizPanel.com">
<link href='https://fonts.googleapis.com/css?family=Carrois+Gothic' rel='stylesheet' type='text/css'>
<link rel="shortcut icon" href="<?php echo $baseUrl;?>/img/icons/favicon.ico">
<style>
.grid-view table.items th {
	background: none repeat scroll 0 0 #3A87AD;
	color: #FFFFFF;
	text-align: center;
	word-break: break-word;
}
.grid-view table.items td {
	font-size: 1em;
	border: 1px white solid;
	padding: 0.3em;
	word-break: break-word;
}
.grid-view table.items tr.odd {
	background: none repeat scroll 0 0 #F9F9F9;
}
.grid-view table.items tr.even {
	background: none repeat scroll 0 0 #FFFFFF;
}
.grid-view table.items tr.selected {
	background: none repeat scroll 0 0 #BCE774;
}
.errorMessage {
	color: red;
}
.note {
	font-weight: bold;
	font-size: 15px;
}
</style>
<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<?php
	Yii::app()->clientScript->registerCoreScript('jquery');
	$cs->registerCssFile($baseUrl.'/css/bootstrap.min.css');
	$cs->registerCssFile($baseUrl.'/css/bootstrap-responsive.min.css');
	$cs->registerCssFile($baseUrl.'/css/abound.css');
	$cs->registerCssFile($baseUrl.'/css/thickbox.css');
	$cs->registerCssFile($baseUrl.'/css/style-red.css');
	$cs->registerScriptFile($baseUrl.'/js/bootstrap.min.js');
	$cs->registerScriptFile($baseUrl.'/js/plugins/jquery.sparkline.js');
	$cs->registerScriptFile($baseUrl.'/js/plugins/jquery.flot.min.js');
	$cs->registerScriptFile($baseUrl.'/js/plugins/jquery.flot.pie.min.js');
	$cs->registerScriptFile($baseUrl.'/js/charts.js');
	$cs->registerScriptFile($baseUrl.'/js/plugins/jquery.knob.js');
	$cs->registerScriptFile($baseUrl.'/js/plugins/jquery.masonry.min.js');
	$cs->registerScriptFile($baseUrl.'/js/styleswitcher.js');
	$cs->registerScriptFile($baseUrl.'/js/thickbox.js');
	$cs->registerScriptFile($baseUrl.'/js/canvasjs.min.js');
?>
</head>
<body>
<section id="navigation-main">
<?php require_once('tpl_navigation.php')?>
</section>
<section class="main-body">
<div class="container">
<div class="container-fluid">
<?php echo $content; ?>
</div>
</div>
</section>
<?php require_once('tpl_footer.php')?>
</body>

</html>
