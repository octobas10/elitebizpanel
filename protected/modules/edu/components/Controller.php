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

	/*public function init() {
		$o_affiliate_stat_logs = new AffiliateStatLogs();
		$promo_code = Yii::app()->user->id;
		$s_link = Yii::app()->request->requestUri;
		$t_link = explode('edu/', $s_link);
		// $link = Yii::app()->getController()->getAction()->controller->id;
		// $link .= '/'.Yii::app()->getController()->getAction()->controller->action->id;
		if(isset($promo_code) && !empty($promo_code) && $promo_code!=1 && isset($t_link) && !empty($t_link) && !empty($t_link[1])) {
			$o_affiliate_stat_logs->checkAffiliateStatLogs($promo_code,$t_link[1]);
		}
	}*/
}
