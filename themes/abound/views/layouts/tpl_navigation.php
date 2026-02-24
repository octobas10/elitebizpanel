<div class="navbar navbar-inverse navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container">
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			</a>
			<a class="brand" style="margin-left: 0px;" href="#">Elite Leads Management Publisher Portal</a>
			<div class="nav-collapse">
			<?php
			$urlauto = !Yii::app()->user->isGuest ? 'auto/default/' : 'auto/affiliates/login';
			$urledu = !Yii::app()->user->isGuest ? 'edu/default/' : 'edu/affiliates/login';
			$aiedu = !Yii::app()->user->isGuest ? 'autoinsurance/default/' : 'autoinsurance/affiliates/login';
			$mortgage = !Yii::app()->user->isGuest ? 'mortgage/default/' : 'mortgage/affiliates/login';
			$healthinsurance = !Yii::app()->user->isGuest ? 'healthinsurance/default/' : 'healthinsurance/affiliates/login';
			$homeimprovement = !Yii::app()->user->isGuest ? 'homeimprovement/default/' : 'homeimprovement/affiliates/login';
			$debt = !Yii::app()->user->isGuest ? 'debt/default/' : 'debt/affiliates/login';
			$businessloans = !Yii::app()->user->isGuest ? 'businessloans/default/' : 'businessloans/affiliates/login';
			$this->widget('zii.widgets.CMenu', array(
				'htmlOptions' => array('class' => 'pull-right nav'),
				'submenuHtmlOptions' => array('class' => 'dropdown-menu'),
				'itemCssClass' => 'item-test',
				'encodeLabel' => false,
				'items' => array(
					array('label' => 'Auto Finance','url' => array($urlauto)),
					array('label' => 'Edu','url' => array($urledu)),
					array('label' => 'Auto Insurance','url' => array($aiedu)),
					array('label' => 'Mortgage','url' => array($mortgage)),
					array('label' => 'Health Insurance','url' => array($healthinsurance)),
					array('label' => 'Home Improvement','url' => array($homeimprovement)),
					array('label' => 'Debt','url' => array($debt)),
					array('label' => 'Business Loans','url' => array($businessloans)),
				)
			));
			?>
			</div>
		</div>
	</div>
</div>
<div class="subnav navbar navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container"></div>
	</div>
</div>
