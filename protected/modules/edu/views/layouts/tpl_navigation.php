<nav class="navbar navbar-inverse navbar-fixed-top">
   <div class="container">
      <div class="navbar-header">
         <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#nav-collapse" aria-expanded="false">
         <span class="sr-only">Toggle navigation</span>
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
         </button>
         <a class="brand navbar-brand" href="#">Higher Learning Marketers <?php echo $user_from_url;?> Portal</a>
      </div>
      <div class="collapse navbar-collapse" id="nav-collapse">
         <?php
            $promo_code = Yii::app()->user->id;
            $this->widget('zii.widgets.CMenu',array(
            	'htmlOptions' => array(
            		'class' => 'nav navbar-nav'
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
            			//'visible' => (Yii::app()->user->getState('roles')!='1' && !Yii::app()->user->isGuest),
            			'visible' => !Yii::app()->user->isGuest && Yii::app()->user->getState('usertype')!='lender' && Yii::app()->user->getState('usertype')!='edulender',
            		),
            		array(
            			'label' => 'Support',
            			'url' => array(
            				'lenders/support',
            			),
            			//'visible' => (Yii::app()->user->getState('roles')!='1' && !Yii::app()->user->isGuest),
            			'visible' => !Yii::app()->user->isGuest && Yii::app()->user->getState('usertype')!='affiliate' && Yii::app()->user->getState('roles')!='1' && Yii::app()->user->getState('usertype')!='edulender',
            		),
            		array(
            			'label' => 'Block Affiliates',
            			'url' => array(
            				'lenders/pauseaffiliate',
            			),
            			//'visible' => (Yii::app()->user->getState('roles')!='1' && !Yii::app()->user->isGuest),
            			'visible' => !Yii::app()->user->isGuest && Yii::app()->user->getState('usertype')!='affiliate' && Yii::app()->user->getState('roles')!='1' && Yii::app()->user->getState('usertype')!='edulender',
            		),
            		array(
            			'label' => 'Profile/Account',
            			'url' => array('affiliates/profile'),
            			'visible' => (Yii::app()->user->getState('roles')!='1' && Yii::app()->user->getState('usertype')=='affiliate' && !Yii::app()->user->isGuest),
            		),
            		array(
            			'label' => 'Profile/Account',
            			'url' => array('feedlenders/profile'),
            			'visible' => (Yii::app()->user->getState('roles')!='1' && Yii::app()->user->getState('usertype')=='edulender' && !Yii::app()->user->isGuest),
            		),
            		array(
            			'label' => 'Landing Page <span class="caret"></span>',
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
            					'label' => 'Landing Page 1',
            					'url' => 'http://higherlearningapp.com/?promo_code='.Yii::app()->user->id,
            					'linkOptions' => array(
            						'target' => '_blank',
            					),
            					'visible' => (Yii::app()->user->getState('roles')!='1'&&!Yii::app()->user->isGuest && Yii::app()->user->getState('usertype')=='affiliate')
            				),
            				array(
            					'label' => 'Landing Page 2',
            					'url' => 'http://higherlearningapp.com/index.php/landpage/?promo_code='.Yii::app()->user->id,
            					'linkOptions' => array(
            						'target' => '_blank',
            					),
            					'visible' => (Yii::app()->user->getState('roles')!='1'&&!Yii::app()->user->isGuest && Yii::app()->user->getState('usertype')=='affiliate')
            				),
            				array(
            					'label' => 'Landing Page 3',
            					'url' => 'http://www.higherlearningapp.com/index.php/landingpage/affiliates/landingpage4?promo_code='.Yii::app()->user->id,
            					'linkOptions' => array(
            						'target' => '_blank',
            					),
            					'visible' => (Yii::app()->user->getState('roles')!='1'&&!Yii::app()->user->isGuest && Yii::app()->user->getState('usertype')=='affiliate')
            				),
            			),
            			'visible' => (Yii::app()->user->getState('roles')!='1'&&!Yii::app()->user->isGuest && Yii::app()->user->getState('usertype')=='affiliate'),
            		),
            		/*array(
            			'label' => 'Landing Page',
            			'url' => array('affiliates/landingpage?promo_code='.Yii::app()->user->id),
            			'linkOptions' => array(
            				'target' => '_blank',
            			),
            			'visible' => (Yii::app()->user->getState('roles')!='1'&&!Yii::app()->user->isGuest && Yii::app()->user->getState('usertype')=='affiliate'),
            		),*/
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
            					'label' => 'Rejected Leads - Campus Cap',
            					'url' => array(
            						'leads/campus_cap_rejected_leads',
            					),
            				),
            				array(
            					'label' => 'Questionable Leads - Campus Cap',
            					'url' => array(
            						'leads/campus_cap_rejected_leads?ltype=1',
            					),
            				),
            				array(
            					'label' => 'Questionable Leads - Report',
            					'url' => array(
            						'leads/QuestionableLeadReport',
            					),
            				),
            				array(
            					'label' => 'Email Rejected Leads',
            					'url' => array(
            						'leads/emailrejectedleads',
            					),
            				),
            				array(
            					'label' => 'Graph Report',
            					'url' => array(
            						'graph/index',
            					),
            				),
            				array(
            					'label' => 'Test Lender',
            					'url' => array(
            						'testAutoLender/index',
            					),
            				),
            				array(
            					'label' => 'Phone Verifications',
            					'url' => array(
            						'leads/PhoneVerificationDetails',
            					),
            				),
            				array( 
            					'label' => 'Email To Lead Users',
            					'url' => array(
            						'affiliates/EmailToLeadUsers',
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
            					'label' => 'Add New Affiliate',
            					'url' => array(
            						'affiliates/create'
            					),
            					'visible' => (Yii::app()->user->getState('roles')=='1'),
            				),
            				array(
            					'label' => 'Affiliate List',
            					'url' => array(
            						'affiliates/index'
            					),
            					'visible' => (Yii::app()->user->getState('roles')=='1'),
            				),
            				array(
            					'label' => 'Affiliate Revenue Stats',
            					'url' => array(
            						'affiliates/affiliatestats'
            					),
            					'visible' => (Yii::app()->user->getState('roles')=='1'),
            				),
            				array( // 14-12-2016 05:54 PM : Siddharajsinh Maharaul : Added Menu for Affiliate Report
            					'label' => 'Affiliate Report',
            					'url' => array(
            						'affiliates/affiliateReport'
            					),
            					'visible' => (Yii::app()->user->getState('roles')=='1'),
            				),
            				array(
            					'label' => 'Affiliate Stat Logs',
            					'url' => array(
            						'affiliates/affiliatestatlogs'
            					),
            					'visible' => (Yii::app()->user->getState('roles')=='1'),
            				),
            				array(
            					'label' => 'Affiliate Duplicate IP Blocking',
            					'url' => array(
            						'affiliates/duplicateipblockallow'
            					),
            					'visible' => (Yii::app()->user->getState('roles')=='1'),
            				),
            				array(
            					'label' => 'Affiliate Registration Validation',
            					'url' => array(
            						'affiliates/affiliatevalidations'
            					),
            					'visible' => (Yii::app()->user->getState('roles')=='1'),
            				),
            				array(// 26-12-2016 11:07 AM : Siddharajsinh Maharaul : Affiliate Sub-Id Pause Direct Posting
            					'label' => 'Affiliate Sub-Id Pause Direct Posting',
            					'url' => array(
            						'leads/PauseDirectPost'
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
            					'label' => 'Add New Lender',
            					'url' => array(
            						'lenders/create',
            					),
            					'visible' => (Yii::app()->user->getState('roles')=='1'),
            				),
            				array(
            					'label' => 'Lender List',
            					'url' => array(
            						'lenders/index',
            					),
            					'visible' => (Yii::app()->user->getState('roles')=='1'),
            				),
            				array(
            					'label' => 'Add New Campus',
            					'url' => array(
            						'campusSettings/create',
            					),
            					'visible' => (Yii::app()->user->getState('roles')=='1'),
            				),
            				array(
            					'label' => 'Campus List',
            					'url' => array(
            						'campusSettings/index',
            					),
            					'visible' => (Yii::app()->user->getState('roles')=='1'),
            				),
            				
            				array(
            					'label' => 'All Lenders Report(Single Row)',
            					'url' => array(
            						'lenders/lenderreport'
            					),
            					'visible' => (Yii::app()->user->getState('roles')=='1'),
            				),
            				array(
            					'label' => 'Lender Monthly Report',
            					'url' => array(
            						'lenders/lendermonthlyreport'
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
            					'label' => 'Feed API',
            					'url' => array(
            						'feeds/feed',
            					),
            					'linkOptions' => array(
            						'target' => '_blank',
            					),
            				),
            				array(
            					'label' => 'Add Feed Vendors',
            					'url' => array(
            						'feeds/createvendor',
            					),
            				),
            				array(
            					'label' => 'List Vendors',
            					'url' => array(
            						'feeds/listvendor',
            					),
            				),
            				array(
            					'label' => 'Add Feed Lenders',
            					'url' => array(
            						'feeds/createlender',
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
            					'label' => 'Browse Feed Lender Transaction',
            					'url' => array(
            						'feeds/feedlendertransaction',
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
</nav>