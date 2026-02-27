<?php
/**
 * Application footer — IntelliBuddies-inspired layout.
 * Columns: Quick links, Company, Legal & contact. Single source for layout and copy.
 */
$appName = CHtml::encode(Yii::app()->name);
$year = date('Y');
$baseUrl = Yii::app()->request->baseUrl;
?>
<footer id="footer" class="app-footer" role="contentinfo">
	<div class="app-footer__inner">
		<div class="app-footer__columns">
			<div class="app-footer__panel app-footer__panel--links">
				<h3 class="app-footer__heading">Quick links</h3>
				<ul class="app-footer__list">
					<li><a href="<?php echo Yii::app()->createUrl('/site/index'); ?>">Home</a></li>
					<li><a href="<?php echo Yii::app()->createUrl('/site/page', array('view' => 'about')); ?>">About</a></li>
					<li><a href="<?php echo Yii::app()->createUrl('/site/contact'); ?>">Contact</a></li>
					<?php if (Yii::app()->user->isGuest): ?>
					<li><a href="<?php echo Yii::app()->createUrl('/site/login'); ?>">Login</a></li>
					<?php else: ?>
					<li><a href="<?php echo Yii::app()->createUrl('/site/logout'); ?>">Logout</a></li>
					<?php endif; ?>
				</ul>
			</div>
			<div class="app-footer__panel app-footer__panel--company">
				<h3 class="app-footer__heading">Company</h3>
				<p class="app-footer__content"><?php echo $appName; ?> — We simplify your finances.</p>
			</div>
		</div>
		<div class="app-footer__copyright">
			<p class="app-footer__content">&copy; <?php echo $year; ?> <?php echo $appName; ?>. All rights reserved.</p>
			<p class="app-footer__powered"><?php echo Yii::powered(); ?></p>
		</div>
		<div class="app-footer__bar">
			<span class="app-footer__tagline"><?php echo $appName; ?></span>
		</div>
	</div>
</footer>
