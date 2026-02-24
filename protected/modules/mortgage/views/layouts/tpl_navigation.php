<div class="navbar navbar-inverse navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container">
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>
			<a class="brand" style="margin-left: 0px;" href="#">elitemortgagefinder.com <?php echo $user_from_url;?> Portal</a>
			<div class="nav-collapse">
			<?php
			$promo_code = Yii::app()->user->id;
			$this->widget('zii.widgets.CMenu',array(
				'htmlOptions' => array(
					'class' => 'pull-right nav'
				),
				'submenuHtmlOptions' => array(
					'class' => 'dropdown-menu'
				),
				'itemCssClass' => 'item-test',
				'encodeLabel' => false,
				'items' => array(
					array(
						'label' => 'Dashboard',
						'url' => array(
							'default/index',
						),
						'visible' => !Yii::app()->user->isGuest,
					),
					array(
						'label' => '1099 Form',
						'url' => 'http://www.irs.gov/',
						'linkOptions' => array(
							'target' => '_blank',
						),
						'visible' => (Yii::app()->user->getState('roles')!='1' && !Yii::app()->user->isGuest && Yii::app()->user->getState('usertype')=='affiliate'),
					),
					array(
						'label' => 'Supression List',
						'url' => array(
							'affiliates/supression_list',
						),
						'visible' => (!Yii::app()->user->isGuest && Yii::app()->user->getState('usertype')=='affiliate'),
					),
					array(
						'label' => 'Creatives <span class="caret"></span>',
						'url' => '#',
						'itemOptions' => array(
							'class' => 'dropdown',
							'tabindex' => "-1",
						),
						'linkOptions' => array(
							'class' => 'dropdown-toggle',
							'data-toggle' => "dropdown",
						),
						'items' => array(
							array(
								'label' => 'Banner Creatives',
								'url' => array(
									'affiliates/creatives',
								),
								'linkOptions' => array(),
								'visible' => (!Yii::app()->user->isGuest),
							),
							array(
								'label' => 'Email Creatives',
								'url' => array(
									'affiliates/emailcreatives',
								),
								'linkOptions' => array(),
								'visible' => (!Yii::app()->user->isGuest),
							),
						),
						'visible' => (!Yii::app()->user->isGuest && Yii::app()->user->getState('usertype')=='affiliate'),
					),
					array(
						'label' => 'API <span class="caret"></span>',
						'url' => '#',
						'itemOptions' => array(
							'class' => 'dropdown',
							'tabindex' => "-1",
						),
						'linkOptions' => array(
							'class' => 'dropdown-toggle',
							'data-toggle' => "dropdown",
						),
						'items' => array(
							array(
								'label' => 'Ping-Post API',
								'url' => array(
									'api/pingpost',
								),
								'linkOptions' => array(
									'target' => '_blank',
								),
								'visible' => (!Yii::app()->user->isGuest)
							),
							array(
								'label' => 'Post Only(Direct Post)',
								'url' => array(
									'api/index',
								),
								'linkOptions' => array(
									'target' => '_blank',
								),
								'visible' => (!Yii::app()->user->isGuest),
							),
						),
						'visible' => (!Yii::app()->user->isGuest && Yii::app()->user->getState('usertype')=='affiliate'),
					),
					array(
						'label' => 'Support',
						'url' => array(
							'affiliates/support',
						),
						'visible' => (Yii::app()->user->getState('roles')!='1' && !Yii::app()->user->isGuest),
					),
					array(
						'label' => 'Profile/Account',
						'url' => array('affiliates/profile'),
						'visible' => (Yii::app()->user->getState('roles')!='1' && Yii::app()->user->getState('usertype')=='affiliate' && !Yii::app()->user->isGuest),
					),
					array(
						'label' => 'Landing Page',
						'url' => 'http://elitemortgagefinder.com/?promo_code='.$promo_code,
						'linkOptions' => array(
							'target' => '_blank',
						),
						'visible' => (Yii::app()->user->getState('roles')!='1'&&!Yii::app()->user->isGuest && Yii::app()->user->getState('usertype')=='affiliate'),
					),
					array(
						'label' => 'Leads <span class="caret"></span>',
						'url' => '#',
						'itemOptions' => array(
							'class' => 'dropdown',
							'tabindex' => "-1",
						),
						'linkOptions' => array(
							'class' => 'dropdown-toggle',
							'data-toggle' => "dropdown",
						),
						'items' => array(
							array(
								'label' => 'Browse Transaction',
								'url' => array(
									'leads/browsetransaction/',
								),
							),
							array(
								'label' => 'Browse Lender Transaction',
								'url' => array(
									'leads/lendertransaction',
								),
							),
							array(
								'label' => 'Export Leads',
								'url' => array(
									'leads/exportleads',
								),
							),
							array(
								'label' => 'Browse Leads',
								'url' => array(
									'leads/browseleads',
								),
							),
							array(
								'label' => 'Return Leads',
								'url' => array(
									'leads/returnleads',
								),
							),
							array(
								'label' => 'Posted Leads',
								'url' => array(
									'leads/postedleads',
								),
							),
							array(
								'label' => 'Graph Report',
								'url' => array(
									'graph/index',
								),
							),
							array(
								'label' => 'Test Auto Lender',
								'url' => array(
									'testAutoLender/index',
								),
							),
						),
						'visible' => (Yii::app()->user->getState('roles')=='1'),
					),
					array(
						'label' => 'Affiliates <span class="caret"></span>',
						'url' => '#',
						'itemOptions' => array(
							'class' => 'dropdown',
							'tabindex' => "-1",
						),
						'linkOptions' => array(
							'class' => 'dropdown-toggle',
							'data-toggle' => "dropdown",
						),
						'items' => array(
							array(
								'label' => 'Affiliate Setup',
								'url' => array(
									'affiliates/index'
								),
								'visible' => (Yii::app()->user->getState('roles')=='1'),
							),
							array(
								'label' => 'Affiliate Stats',
								'url' => array(
									'affiliates/affiliatestats'
								),
								'visible' => (Yii::app()->user->getState('roles')=='1'),
							),
						),
						'visible' => (Yii::app()->user->getState('roles')=='1'),
					),
					array(
						'label' => 'Lenders <span class="caret"></span>',
						'url' => '#',
						'itemOptions' => array(
							'class' => 'dropdown',
							'tabindex' => "-1",
						),
						'linkOptions' => array(
							'class' => 'dropdown-toggle',
							'data-toggle' => "dropdown",
						),
						'items' => array(
							array(
								'label' => 'Lender Setup',
								'url' => array(
									'lenders/index',
								),
								'visible' => (Yii::app()->user->getState('roles')=='1'),
							),
							array(
								'label' => 'Lender Report Fran',
								'url' => array(
									'lenders/lenderreport'
								),
								'visible' => (Yii::app()->user->getState('roles')=='1'),
							),
							array(
								'label' => 'Lender Stats',
								'url' => array(
									'lenders/lenderstats'
								),
								'visible' => (Yii::app()->user->getState('roles')=='1'),
							),
						),
						'visible' => (Yii::app()->user->getState('roles')=='1'),
					),
					array(
						'label' => 'Lender Affiliate Setting',
						'url' => array(
							'lenderAffiliateSettings/create',
						),
						'visible' => (Yii::app()->user->getState('roles')=='1'),
					),
					array(
						'label' => 'Feeds <span class="caret"></span>',
						'url' => '#',
						'itemOptions' => array(
							'class' => 'dropdown',
							'tabindex' => "-1",
						),
						'linkOptions' => array(
							'class' => 'dropdown-toggle',
							'data-toggle' => "dropdown",
						),
						'items' => array(
							array(
								'label' => 'List Vendors',
								'url' => array(
									'feeds/listvendor',
								),
							),
							array(
								'label' => 'Feed Lenders',
								'url' => array(
									'feeds/listlender',
								),
							),
							array(
								'label' => 'Browse Transaction',
								'url' => array(
									'browsVendorLenderTransaction/index',
								),
							),
							array(
								'label' => 'Test Feed Lenders',
								'url' => array(
									'testFeedLender/index',
								),
							),
						),
						'visible' => (Yii::app()->user->getState('roles')=='1'),
					),
					array(
						'label' => 'Leads <span class="caret"></span>',
						'url' => '#',
						'itemOptions' => array(
							'class' => 'dropdown',
							'tabindex' => "-1",
						),
						'linkOptions' => array(
							'class' => 'dropdown-toggle',
							'data-toggle' => "dropdown",
						),
						'items' => array(
							array(
								'label' => 'View Report</span>',
								'url' => array(
									'viewreport/index',
								),
							),
						),
						'visible' => (Yii::app()->user->getState('roles')=='-1'),
					),
					array(
						'label' => 'Main',
						'url' => Yii::app()->params['backEnd'],
						'visible' => Yii::app()->user->isGuest,
					),
					array(
						'label' => 'Login',
						'url' => array(
							'affiliates/login',
						),
						'visible' => Yii::app()->user->isGuest,
					),
					array(
						'label' => 'Logout',
						'url' => array(
							'default/logout',
						),
						'visible' => !Yii::app()->user->isGuest,
					),
				),
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
