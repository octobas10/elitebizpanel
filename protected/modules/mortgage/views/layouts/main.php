<?php
$baseUrl = Yii::app()->theme->baseUrl;
$cs = Yii::app()->getClientScript();
$user_from_url = (strpos($_SERVER['REQUEST_URI'], 'lenders/login') || Yii::app()->user->getState('usertype')=='lender') ? 'Buyer' : 'Publisher';
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>elitemortgagefinder.com <?php echo $user_from_url;?> Portal</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="Mortgage Lead Management System">
<meta name="author" content="EliteBizPanel.com">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet" type="text/css">
<link href="<?php echo $baseUrl;?>/css/mortgage-dashboard.css" rel="stylesheet" type="text/css">
<link rel="shortcut icon" href="<?php echo $baseUrl;?>/img/icons/favicon.ico">
<script src="https://cdn.tailwindcss.com"></script>
<script>
tailwind.config = {
	theme: {
		extend: {
			colors: {
				portal: {
					navy: '#244E6A',
					orange: '#F26721',
					grey: '#808080',
				},
				primary: {
					DEFAULT: '#244E6A',
					50: '#eef4f8',
					100: '#d6e4ee',
					200: '#b3cde0',
					300: '#8ab0ce',
					400: '#5c8fb8',
					500: '#244E6A',
					600: '#1a3d52',
					700: '#152f3f',
					800: '#0f212d',
					900: '#0a151d',
				},
				surface: {
					DEFAULT: '#f8fafc',
					card: '#ffffff',
					elevated: '#f1f5f9',
				}
			},
		}
	}
}
</script>
<style>
.errorMessage { color: #dc2626; }
.note { font-weight: 600; font-size: 0.9375rem; }
</style>
<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<?php
	Yii::app()->clientScript->registerCoreScript('jquery');
	$cs->registerCssFile($baseUrl.'/css/thickbox.css');
	$cs->registerScriptFile($baseUrl.'/js/plugins/jquery.sparkline.js');
	$cs->registerScriptFile($baseUrl.'/js/plugins/jquery.flot.min.js');
	$cs->registerScriptFile($baseUrl.'/js/plugins/jquery.flot.pie.min.js');
	$cs->registerScriptFile($baseUrl.'/js/charts.js');
	$cs->registerScriptFile($baseUrl.'/js/plugins/jquery.knob.js');
	$cs->registerScriptFile($baseUrl.'/js/plugins/jquery.masonry.min.js');
	$cs->registerScriptFile($baseUrl.'/js/styleswitcher.js');
	$cs->registerScriptFile($baseUrl.'/js/thickbox.js');
	$cs->registerScriptFile($baseUrl.'/js/canvasjs.min.js');
	$cs->registerScript('leads-filter-collapse',
		'(function(){ var card = document.querySelector(".mortgage-portal .leads-toolbar-card .portlet"); if(!card) return; var content = card.querySelector(".portlet-content"); var header = card.querySelector(".portlet-decoration"); if(!content || !header) return; var id = "leads-filter-content-" + Math.random().toString(36).substr(2,9); content.id = id; header.setAttribute("role","button"); header.setAttribute("tabindex","0"); header.setAttribute("aria-expanded","false"); header.setAttribute("aria-controls",id); header.setAttribute("aria-label","Filters. Click to expand or collapse filter options."); function toggle(){ var expanded = card.classList.toggle("leads-filter--expanded"); header.setAttribute("aria-expanded", expanded ? "true" : "false"); header.setAttribute("aria-label", expanded ? "Filters. Click to collapse." : "Filters. Click to expand or collapse filter options."); } header.addEventListener("click", function(e){ e.preventDefault(); toggle(); }); header.addEventListener("keydown", function(e){ if(e.key === "Enter" || e.key === " "){ e.preventDefault(); toggle(); } }); })();',
		CClientScript::POS_READY);
	$cs->registerScript('grid-view-filters-collapse',
		'(function(){ var grids = document.querySelectorAll(".mortgage-portal .grid-view"); grids.forEach(function(grid){ var filterRow = grid.querySelector("table.items tr.filters") || grid.querySelector("table tr.filters") || grid.querySelector("tr.filters"); if(!filterRow) return; var toggle = document.createElement("button"); toggle.type = "button"; toggle.className = "grid-view-filters-toggle"; toggle.setAttribute("aria-expanded", "false"); toggle.setAttribute("aria-label", "Show table filters"); toggle.textContent = "Filters"; function updateLabel(){ var open = grid.classList.contains("grid-view--filters-visible"); toggle.setAttribute("aria-expanded", open ? "true" : "false"); toggle.setAttribute("aria-label", open ? "Hide table filters" : "Show table filters"); toggle.textContent = open ? "Hide filters" : "Filters"; } toggle.addEventListener("click", function(){ grid.classList.toggle("grid-view--filters-visible"); updateLabel(); }); var first = grid.querySelector(".summary") || grid.querySelector("table"); if(first) grid.insertBefore(toggle, first); else grid.appendChild(toggle); }); })();',
		CClientScript::POS_READY);
	$cs->registerScript('filter-portlet-collapse',
		'(function(){ var portlets = document.querySelectorAll(".mortgage-portal .portlet--filters-collapsible"); portlets.forEach(function(card){ var content = card.querySelector(".portlet-content"); var header = card.querySelector(".portlet-decoration"); if(!content || !header) return; var id = "filter-content-" + Math.random().toString(36).substr(2,9); content.id = id; header.setAttribute("role","button"); header.setAttribute("tabindex","0"); header.setAttribute("aria-expanded","false"); header.setAttribute("aria-controls",id); header.setAttribute("aria-label","Filters. Click to expand or collapse."); function toggle(){ var open = card.classList.toggle("portlet--expanded"); header.setAttribute("aria-expanded", open ? "true" : "false"); header.setAttribute("aria-label", open ? "Filters. Click to collapse." : "Filters. Click to expand or collapse."); } header.addEventListener("click", function(e){ e.preventDefault(); toggle(); }); header.addEventListener("keydown", function(e){ if(e.key === "Enter" || e.key === " "){ e.preventDefault(); toggle(); } }); }); })();',
		CClientScript::POS_READY);
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
<body class="mortgage-portal bg-surface">
<section id="navigation-main">
<?php require_once('tpl_navigation.php')?>
</section>
<section class="main-body min-h-[650px] pb-28">
	<div class="w-full max-w-[1280px] mx-auto px-4 sm:px-6 lg:px-8">
		<?php echo $content; ?>
	</div>
</section>
<?php require_once('tpl_footer.php')?>
</body>
</html>
