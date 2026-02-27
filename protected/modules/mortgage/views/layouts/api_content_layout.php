<!DOCTYPE html>
<html lang="en" class="api-doc-page">
<head>
	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<meta name="language" content="en" />
	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
	<link rel="shortcut icon" href="<?php echo Yii::app()->theme->baseUrl; ?>/img/icons/favicon.ico" />
	<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/PostingInstruction_doc/styles.css" />
	<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/PostingInstruction_doc/style.css" />
	<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/PostingInstruction_doc/style_IE.css" />
	<link type="text/css" rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/PostingInstruction_doc/api-docs.css" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->
</head>
<body class="api-doc-page">
	<a href="#api-main" class="api-skip-link">Skip to main content</a>
	<header class="api-header" role="banner">
		<div class="api-header__inner">
			<div class="api-header__brand">
				<h1 class="api-header__title">Elite Publisher Portal</h1>
				<p class="api-header__sub">elitemortgagefinder.com · Mortgage API</p>
			</div>
			<nav class="api-nav-tabs" aria-label="API documentation">
				<?php
				$apiIndexUrl = Yii::app()->createUrl('api/index');
				$apiPingpostUrl = Yii::app()->createUrl('api/pingpost');
				$currentUrl = Yii::app()->request->requestUri;
				$isIndex = (strpos($currentUrl, 'api/index') !== false || preg_match('#/api/?$#', $currentUrl));
				$isPingpost = (strpos($currentUrl, 'api/pingpost') !== false);
				?>
				<a href="<?php echo CHtml::encode($apiIndexUrl); ?>"<?php echo $isIndex ? ' class="api-nav-tabs__active"' : ''; ?>>Direct Post</a>
				<a href="<?php echo CHtml::encode($apiPingpostUrl); ?>"<?php echo $isPingpost ? ' class="api-nav-tabs__active"' : ''; ?>>Ping-Post</a>
			</nav>
		</div>
	</header>
	<main id="api-main" class="api-main" role="main">
		<?php echo $content; ?>
	</main>
	<footer class="api-footer" role="contentinfo">
		Copyright &copy; <?php echo @date('Y'); ?> EliteCashWire.com Inc. All rights reserved.
	</footer>
</body>
</html>
