<?php
/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class Controller extends CController
{
	/**
	 * @var string the default layout for the controller view. Defaults to '//layouts/column1',
	 * meaning using a single column layout. See 'protected/views/layouts/column1.php'.
	 */
	public $layout='//layouts/column1';
	/**
	 * @var array context menu items. This property will be assigned to {@link CMenu::items}.
	 */
	public $menu=array();
	/**
	 * @var array the breadcrumbs of the current page. The value of this property will
	 * be assigned to {@link CBreadcrumbs::links}. Please refer to {@link CBreadcrumbs::links}
	 * for more details on how to specify this property.
	 */
	public $breadcrumbs=array();

	/**
	 * Returns nav items for the portal header (Tailwind). Same visibility/URL logic as legacy CMenu.
	 * @return array
	 */
	public function getNavItems()
	{
		$promo_code = Yii::app()->user->id;
		$m = 'mortgage';
		return array(
			array('label' => 'Dashboard', 'url' => array($m . '/default/index'), 'visible' => !Yii::app()->user->isGuest),
			array('label' => '1099 Form', 'url' => 'http://www.irs.gov/', 'linkOptions' => array('target' => '_blank'), 'visible' => (Yii::app()->user->getState('roles') != '1' && !Yii::app()->user->isGuest && Yii::app()->user->getState('usertype') == 'affiliate')),
			array('label' => 'Supression List', 'url' => array($m . '/affiliates/supression_list'), 'visible' => (!Yii::app()->user->isGuest && Yii::app()->user->getState('usertype') == 'affiliate')),
			array('label' => 'Creatives', 'url' => '#', 'items' => array(
				array('label' => 'Banner Creatives', 'url' => array($m . '/affiliates/creatives'), 'visible' => !Yii::app()->user->isGuest),
				array('label' => 'Email Creatives', 'url' => array($m . '/affiliates/emailcreatives'), 'visible' => !Yii::app()->user->isGuest),
			), 'visible' => (!Yii::app()->user->isGuest && Yii::app()->user->getState('usertype') == 'affiliate')),
			array('label' => 'API', 'url' => '#', 'items' => array(
				array('label' => 'Ping-Post API', 'url' => array('api/pingpost'), 'linkOptions' => array('target' => '_blank'), 'visible' => !Yii::app()->user->isGuest),
				array('label' => 'Post Only(Direct Post)', 'url' => array('api/index'), 'linkOptions' => array('target' => '_blank'), 'visible' => !Yii::app()->user->isGuest),
			), 'visible' => (!Yii::app()->user->isGuest && Yii::app()->user->getState('usertype') == 'affiliate')),
			array('label' => 'Support', 'url' => array($m . '/affiliates/support'), 'visible' => (Yii::app()->user->getState('roles') != '1' && !Yii::app()->user->isGuest)),
			array('label' => 'Profile/Account', 'url' => array($m . '/affiliates/profile'), 'visible' => (Yii::app()->user->getState('roles') != '1' && Yii::app()->user->getState('usertype') == 'affiliate' && !Yii::app()->user->isGuest)),
			array('label' => 'Landing Page', 'url' => 'http://elitemortgagefinder.com/?promo_code=' . $promo_code, 'linkOptions' => array('target' => '_blank'), 'visible' => (Yii::app()->user->getState('roles') != '1' && !Yii::app()->user->isGuest && Yii::app()->user->getState('usertype') == 'affiliate')),
			array('label' => 'Leads', 'url' => '#', 'items' => array(
				array('label' => 'Browse Transaction', 'url' => array($m . '/leads/browsetransaction/')),
				array('label' => 'Browse Lender Transaction', 'url' => array($m . '/leads/lendertransaction')),
				array('label' => 'Export Leads', 'url' => array($m . '/leads/exportleads')),
				array('label' => 'Browse Leads', 'url' => array($m . '/leads/browseleads')),
				array('label' => 'Return Leads', 'url' => array($m . '/leads/returnleads')),
				array('label' => 'Posted Leads', 'url' => array($m . '/leads/postedleads')),
				array('label' => 'Graph Report', 'url' => array($m . '/graph/index')),
				array('label' => 'Test Auto Lender', 'url' => array($m . '/testAutoLender/index')),
			), 'visible' => (Yii::app()->user->getState('roles') == '1')),
			array('label' => 'Affiliates', 'url' => '#', 'items' => array(
				array('label' => 'Affiliate Setup', 'url' => array($m . '/affiliates/index'), 'visible' => (Yii::app()->user->getState('roles') == '1')),
				array('label' => 'Affiliate Stats', 'url' => array($m . '/affiliates/affiliatestats'), 'visible' => (Yii::app()->user->getState('roles') == '1')),
			), 'visible' => (Yii::app()->user->getState('roles') == '1')),
			array('label' => 'Lenders', 'url' => '#', 'items' => array(
				array('label' => 'Lender Setup', 'url' => array($m . '/lenders/index'), 'visible' => (Yii::app()->user->getState('roles') == '1')),
				array('label' => 'Lender Report Fran', 'url' => array($m . '/lenders/lenderreport'), 'visible' => (Yii::app()->user->getState('roles') == '1')),
				array('label' => 'Lender Stats', 'url' => array($m . '/lenders/lenderstats'), 'visible' => (Yii::app()->user->getState('roles') == '1')),
			), 'visible' => (Yii::app()->user->getState('roles') == '1')),
			array('label' => 'Lender Affiliate Setting', 'url' => array($m . '/lenderAffiliateSettings/create'), 'visible' => (Yii::app()->user->getState('roles') == '1')),
			array('label' => 'Feeds', 'url' => '#', 'items' => array(
				array('label' => 'List Vendors', 'url' => array($m . '/feeds/listvendor')),
				array('label' => 'Feed Lenders', 'url' => array($m . '/feeds/listlender')),
				array('label' => 'Browse Transaction', 'url' => array($m . '/browsVendorLenderTransaction/index')),
				array('label' => 'Test Feed Lenders', 'url' => array($m . '/testFeedLender/index')),
			), 'visible' => (Yii::app()->user->getState('roles') == '1')),
			array('label' => 'Leads', 'url' => '#', 'items' => array(
				array('label' => 'View Report', 'url' => array($m . '/viewreport/index')),
			), 'visible' => (Yii::app()->user->getState('roles') == '-1')),
			array('label' => 'Main', 'url' => Yii::app()->params['backEnd'], 'visible' => Yii::app()->user->isGuest),
			array('label' => 'Login', 'url' => array($m . '/affiliates/login'), 'visible' => Yii::app()->user->isGuest),
			array('label' => 'Logout', 'url' => array($m . '/default/logout'), 'visible' => !Yii::app()->user->isGuest),
		);
	}
}
