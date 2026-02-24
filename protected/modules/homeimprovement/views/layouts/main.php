<?php
$baseUrl = Yii::app()->theme->baseUrl;
$cs = Yii::app()->getClientScript();
$user_from_url = (strpos($_SERVER['REQUEST_URI'], 'lenders/login') || Yii::app()->user->getState('usertype')=='lender') ? 'Buyer' : 'Publisher';
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>elitehomeimprovers.com <?php echo $user_from_url;?> Portal</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="homeimprovement Lead Management System">
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
<?php /*
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo $baseUrl;?>/img/icons/apple-touch-icon-144-precomposed.png">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo $baseUrl;?>/img/icons/apple-touch-icon-72-precomposed.png">
<link rel="apple-touch-icon-precomposed" href="<?php echo $baseUrl;?>/img/icons/apple-touch-icon-57-precomposed.png">

<link rel="alternate stylesheet" type="text/css" media="screen" title="style2" href="<?php echo $baseUrl;?>/css/style-brown.css" />
<link rel="alternate stylesheet" type="text/css" media="screen" title="style3" href="<?php echo $baseUrl;?>/css/style-green.css" />
<link rel="alternate stylesheet" type="text/css" media="screen" title="style4" href="<?php echo $baseUrl;?>/css/style-grey.css" />
<link rel="alternate stylesheet" type="text/css" media="screen" title="style5" href="<?php echo $baseUrl;?>/css/style-orange.css" />
<link rel="alternate stylesheet" type="text/css" media="screen" title="style6" href="<?php echo $baseUrl;?>/css/style-purple.css" />
<link rel="alternate stylesheet" type="text/css" media="screen" title="style7" href="<?php echo $baseUrl;?>/css/style-red.css" />
*/?>
<!--<script type="text/javascript">
(function(document, window){
    var script = document.createElement("script");
    script.type = "text/javascript";
    script.src = "https://api.pushnami.com/scripts/v1/pushnami-adv/5da7456e7e1a360012f6040d";
    script.onload = function() {
        Pushnami
            .update()
            .prompt()
    };
    document.getElementsByTagName("head")[0].appendChild(script);
})(document, window);
</script>
<script type="text/javascript" src="manifest.json"></script>
<script type="text/javascript" src="service-worker.js"></script>-->
</head>
<body>
<section id="navigation-main">
<?php require_once('tpl_navigation.php')?>
</section>
<section class="main-body">
<div class="container-fluid">
<?php echo $content; ?>
</div>
</section>
<?php require_once('tpl_footer.php')?>
</body>
</html>
